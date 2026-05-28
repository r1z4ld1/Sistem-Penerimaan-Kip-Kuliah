<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Services\RoleService;
use App\Http\Requests\Role\RoleStoreRequest;
use App\Http\Requests\Role\RoleUpdateRequest;
use App\Helpers\PermissionHelper;
use App\Enums\RoleEnum;


class RoleController extends Controller
{
    protected $service;

    public function __construct(
        RoleService $service
    ) {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $roles = $this->service
            ->getAll($request->search);

        return view(
            'dashboard.admin.roles.index',
            compact('roles')
        );
    }

    public function create()
    {
        return view(
            'dashboard.admin.roles.create'
        );
    }

    public function store(
        RoleStoreRequest $request
    ) {

        $this->service->store(
            $request->validated()
        );

        return redirect()
            ->route('admin.roles.index')
            ->with(
                'success',
                'Role berhasil ditambahkan'
            );
    }

    public function edit(Role $role)
    {
        return view(
            'dashboard.admin.roles.edit',
            compact('role')
        );
    }

    public function update(
        RoleUpdateRequest $request,
        Role $role
    ) {

        $this->service->update(
            $role,
            $request->validated()
        );

        return redirect()
            ->route('admin.roles.index')
            ->with(
                'success',
                'Role berhasil diupdate'
            );
    }

    public function destroy(Role $role)
    {
        $deleted = $this->service
            ->delete($role);

        if (!$deleted) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Role system tidak bisa dihapus'
                );
        }

        return redirect()
            ->route('admin.roles.index')
            ->with(
                'success',
                'Role berhasil dihapus'
            );
    }
    public function permissions(Role $role)
    {
        $allowedPermissions = PermissionHelper::getPermissionsByRole(
            $role->name
        );

        $permissions = Permission::whereIn(
            'name',
            $allowedPermissions
        )->get();
        $rolePermissions = $role
            ->permissions
            ->pluck('name')
            ->toArray();

        return view(
            'dashboard.admin.roles.permissions',
            compact(
                'role',
                'permissions',
                'rolePermissions'
            )
        );
    }
    public function updatePermissions(
        Request $request,
        Role $role
    ) {

        $allowedPermissions = PermissionHelper::getPermissionsByRole(
            $role->name
        );

        $permissions = collect(
            $request->permissions ?? []
        )
            ->filter(function ($permission) use ($allowedPermissions) {

                return in_array(
                    $permission,
                    $allowedPermissions
                );
            })
            ->toArray();

        $role->syncPermissions($permissions);

        return redirect()
            ->back()
            ->with(
                'success',
                'Permission role berhasil diperbarui'
            );
    }
}
