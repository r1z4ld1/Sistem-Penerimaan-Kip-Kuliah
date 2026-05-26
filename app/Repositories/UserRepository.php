<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getAll($search = null)
    {
        return User::with('roles')

            ->when($search, function ($query) use ($search) {

                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })

            ->latest()
            ->paginate(10);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(User $user, array $data)
    {
        return $user->update($data);
    }

    public function delete(User $user)
    {
        return $user->delete();
    }
}
