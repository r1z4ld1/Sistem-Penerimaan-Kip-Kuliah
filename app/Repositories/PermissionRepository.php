<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    public function getAll($search = null)
    {
        return Permission::with('roles')

            ->withCount('roles')

            ->when($search, function ($query) use ($search) {

                $query->where(
                    'name',
                    'like',
                    "%{$search}%"
                );
            })

            ->latest()
            ->paginate(10);
    }

    public function create(array $data)
    {
        return Permission::create($data);
    }

    public function update(
        Permission $permission,
        array $data
    ) {
        return $permission->update($data);
    }

    public function delete(Permission $permission)
    {
        return $permission->delete();
    }
}
