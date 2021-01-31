<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(): array
    {
        $user = request()->user;
        $type = request()->type;
        $role = request()->role;

        if ($type === 'children') {
            return $this->getChildren($user, $role);
        }

        return $this->getParents($user, $role);
    }

    public function getUsers(): array
    {
        return User::all()->toArray();
    }

    public function getRoles(): array
    {
        return Role::all()->toArray();
    }

    public function getRoleUser()
    {
        return Cache::get('role_user') ?? $this->putAndGetRoleUserCached();
    }

    private function putAndGetRoleUserCached()
    {
        $roleUser = RoleUser::all()->toArray();
        $custom = [];

        foreach ($roleUser as $each) {
            $custom[$each['user_id']] = $each;
        }

        Cache::put('role_user', $custom, 1200);
        return Cache::get('role_user');
    }

    public function getRolesForUser()
    {
        $user = request()->user;
        $type = request()->type === 'parent' ? '<' : '>';

        $roleId = RoleUser::where('user_id', $user)->first()->role_id;

        return Role::where("id", $type, $roleId)->get(['id', 'title'])->toArray();
    }

    private function getChildren($user, $role = false): array
    {
        $condition = $role ? "where roleId >= $role" : "";

        $sql = $this->getSqlForChildren($user, $condition);

        $results = DB::select($sql);

        foreach ($results as $result) {
            $ids[] = $result->id;
        }

        return isset($ids) ? $ids : [];
    }

    private function getSqlForChildren($user, $condition): string
    {
        return <<<SQL
                with recursive children as (
                    select u.id, u.name, roleUser.user_id, r.title, r.id roleId
                    from role_user roleUser
                             inner join users u on roleUser.user_id = u.id
                             inner join roles r on roleUser.role_id = r.id
                    where parent_user_id = $user
                    union
                    select u2.id, u2.name, roleUser2.user_id, r2.title, r2.id
                    from children c
                             join role_user roleUser2 on roleUser2.parent_user_id = c.user_id
                             join users u2 on roleUser2.user_id = u2.id
                             join roles r2 on roleUser2.role_id = r2.id
                ) select * from children $condition;
SQL;
    }

    private function getParents($userId, $role): array
    {
        $roleUser = $this->getRoleUser();
        $ids = [];

        while ($userId) {
            if (isset($roleUser[$userId])) {

                if ($role and $roleUser[$userId]['role_id'] < $role) {
                    $userId = $roleUser[$userId]['parent_user_id'];
                    continue;
                }

                $ids[] = $roleUser[$userId]['user_id'];
                $userId = $roleUser[$userId]['parent_user_id'];
            }
        }

        array_shift($ids);
        return $ids;
    }
}
