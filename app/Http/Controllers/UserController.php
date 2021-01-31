<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        return view('sample', [
            'users' => User::all()->toArray(),
            'roles' => Role::all()->toArray(),
            'roleUser' => $this->getCachedRoleUser(),
        ]);
    }

    public function getAll(Request $request): array
    {
        $user = $request->user;
        $type = $request->type;
        $role = $request->role;

        if ($type === 'children'){
            return $this->getChildren($user, $role);
        }

        return $this->getParents($user, $role);
    }

    private function getChildren($user, $role = false): array
    {
        $condition = $role ? "where roleId >= $role" : "";

        $sql = <<<SQL
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

        $results = DB::select("$sql");

        foreach ($results as $result) {
            $ids[] = $result->id;
        }

        return isset($ids) ? $ids : [];
    }

    private function getCachedRoleUser()
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

    private function getParents($userId, $role): array
    {
        $roleUser = $this->getCachedRoleUser();
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

    public function getRoles(Request $request)
    {
        $user = $request->user;
        $type = $request->type === 'parent' ? '<' : '>';

        $roleId = RoleUser::where('user_id', $user)->first()->role_id;

        return Role::where("id", $type, $roleId)->get(['id', 'title'])->toArray();
    }
}
