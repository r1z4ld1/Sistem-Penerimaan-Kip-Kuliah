<?php

namespace App\Services;

use App\Repositories\RoleRepository;

use Spatie\Permission\Models\Role;

class RoleService
{
    protected $repository;

    public function __construct(
        RoleRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function getAll($search = null)
    {
        return $this->repository
            ->getAll($search);
    }

    public function store(array $data)
    {
        return $this->repository
            ->create($data);
    }

    public function update(
        Role $role,
        array $data
    ) {
        return $this->repository
            ->update($role, $data);
    }

    public function delete(Role $role)
    {
        // prevent delete role system
        $protectedRoles = [
            'admin',
            'mahasiswa',
            'verifikator'
        ];

        if (in_array(
            $role->name,
            $protectedRoles
        )) {
            return false;
        }

        return $this->repository
            ->delete($role);
    }
}
