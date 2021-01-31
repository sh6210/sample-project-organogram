<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view('sample', [
            'users' => $this->user->getUsers(),
            'roles' => $this->user->getRoles(),
            'roleUser' => $this->user->getRoleUser(),
        ]);
    }

    public function getAll(): array
    {
        return $this->user->getAll();
    }

    public function getRolesForUser()
    {
        return $this->user->getRolesForUser();
    }
}
