<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;

use App\Services\RoleService;

use App\Http\Requests\Role\RoleStoreRequest;
use App\Http\Requests\Role\RoleUpdateRequest;

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
}
