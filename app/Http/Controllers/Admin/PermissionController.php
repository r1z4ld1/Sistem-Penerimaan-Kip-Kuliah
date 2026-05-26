<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;

use App\Services\PermissionService;

use App\Http\Requests\Permission\PermissionStoreRequest;
use App\Http\Requests\Permission\PermissionUpdateRequest;

class PermissionController extends Controller
{
    protected $service;

    public function __construct(
        PermissionService $service
    ) {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $permissions = $this->service
            ->getAll($request->search);

        return view(
            'dashboard.admin.permissions.index',
            compact('permissions')
        );
    }

    public function create()
    {
        return view(
            'dashboard.admin.permissions.create'
        );
    }

    public function store(
        PermissionStoreRequest $request
    ) {

        $this->service->store(
            $request->validated()
        );

        return redirect()
            ->route('admin.permissions.index')
            ->with(
                'success',
                'Permission berhasil ditambahkan'
            );
    }

    public function edit(
        Permission $permission
    ) {
        return view(
            'dashboard.admin.permissions.edit',
            compact('permission')
        );
    }

    public function update(
        PermissionUpdateRequest $request,
        Permission $permission
    ) {

        $this->service->update(
            $permission,
            $request->validated()
        );

        return redirect()
            ->route('admin.permissions.index')
            ->with(
                'success',
                'Permission berhasil diupdate'
            );
    }

    public function destroy(
        Permission $permission
    ) {

        $deleted = $this->service
            ->delete($permission);

        if (!$deleted) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Permission inti system tidak bisa dihapus'
                );
        }

        return redirect()
            ->route('admin.permissions.index')
            ->with(
                'success',
                'Permission berhasil dihapus'
            );
    }
}
