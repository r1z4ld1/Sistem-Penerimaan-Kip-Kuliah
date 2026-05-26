<?php

namespace App\Services;


use App\Repositories\PermissionRepository;
use App\Enums\PermissionEnum;
use Spatie\Permission\Models\Permission;

class PermissionService
{
    protected $repository;

    public function __construct(
        PermissionRepository $repository
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
        Permission $permission,
        array $data
    ) {
        return $this->repository
            ->update($permission, $data);
    }

    public function delete(Permission $permission)
    {
        // protect core permissions
        $protectedPermissions = [

            PermissionEnum::VIEW_DASHBOARD->value,

            PermissionEnum::VIEW_USER->value,
            PermissionEnum::CREATE_USER->value,
            PermissionEnum::EDIT_USER->value,
            PermissionEnum::DELETE_USER->value,

            PermissionEnum::MANAGE_ROLE->value,
            PermissionEnum::MANAGE_PERMISSION->value,

        ];

        if (in_array(
            $permission->name,
            $protectedPermissions
        )) {
            return false;
        }

        return $this->repository
            ->delete($permission);
    }
}
