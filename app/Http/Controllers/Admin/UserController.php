<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;

        $this->middleware('permission:view user')
            ->only('index');

        $this->middleware('permission:create user')
            ->only(['create', 'store']);

        $this->middleware('permission:edit user')
            ->only(['edit', 'update']);

        $this->middleware('permission:delete user')
            ->only('destroy');
    }

    public function index(Request $request)
    {
        $users = $this->service
            ->getAll($request->search);

        return view(
            'dashboard.admin.users.index',
            compact('users')
        );
    }

    public function create()
    {
        $roles = Role::all();

        return view(
            'dashboard.admin.users.create',
            compact('roles')
        );
    }

    public function store(
        UserStoreRequest $request
    ) {

        $this->service->store(
            $request->validated()
        );

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'User berhasil ditambahkan'
            );
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view(
            'dashboard.admin.users.edit',
            compact('user', 'roles')
        );
    }

    public function update(
        UserUpdateRequest $request,
        User $user
    ) {

        $this->service->update(
            $user,
            $request->validated()
        );

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'User berhasil diupdate'
            );
    }

    public function destroy(User $user)
    {
        $deleted = $this->service
            ->delete($user);

        if (!$deleted) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Anda tidak bisa menghapus akun sendiri'
                );
        }

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'User berhasil dihapus'
            );
    }
}
