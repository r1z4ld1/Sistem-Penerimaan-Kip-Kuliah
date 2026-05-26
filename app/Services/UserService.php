<?php

namespace App\Services;

use App\Models\User;

use App\Repositories\UserRepository;

use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $repository;

    public function __construct(
        UserRepository $repository
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
        // hash password
        $data['password'] = Hash::make(
            $data['password']
        );

        // ambil role
        $role = $data['role'];

        // hapus role dari data user
        unset($data['role']);

        // create user
        $user = $this->repository
            ->create($data);

        // assign role
        $user->assignRole($role);

        return $user;
    }

    public function update(
        User $user,
        array $data
    ) {

        // ambil role
        $role = $data['role'];

        // hapus role dari array
        unset($data['role']);

        // update password jika diisi
        if (!empty($data['password'])) {

            $data['password'] = Hash::make(
                $data['password']
            );
        } else {

            unset($data['password']);
        }

        // update user
        $this->repository
            ->update($user, $data);

        // sync role
        $user->syncRoles([$role]);

        return $user;
    }

    public function delete(User $user)
    {
        // prevent delete self
        if ($user->id == auth()->id()) {

            return false;
        }

        // cleanup role
        $user->syncRoles([]);

        // delete user
        return $this->repository
            ->delete($user);
    }
}
