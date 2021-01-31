<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getAll();

    public function getRoles();

    public function getUsers();

    public function getRoleUser();

    public function getRolesForUser();
}
