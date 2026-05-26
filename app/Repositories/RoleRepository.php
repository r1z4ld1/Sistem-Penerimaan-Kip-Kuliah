<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;

class RoleRepository
{
    public function getAll($search = null)
    {
        return Role::withCount([
            'users',
            'permissions'
        ])

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
        return Role::create($data);
    }

    public function update(Role $role, array $data)
    {
        return $role->update($data);
    }

    public function delete(Role $role)
    {
        return $role->delete();
    }
}
