@extends('layouts.app')

@section('content')
    <div class="mb-6">

        <h1 class="text-3xl font-bold">
            Permission Role
        </h1>

        <p class="text-gray-500 mt-1">
            Atur permission untuk role:
            <span class="font-semibold">
                {{ $role->name }}
            </span>
        </p>

    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <form action="{{ route('admin.roles.permissions.update', $role->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                @foreach ($permissions as $permission)
                    <label class="flex items-center gap-3 border rounded-lg p-3 hover:bg-gray-50 cursor-pointer">

                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="w-5 h-5"
                            {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>

                        <span class="font-medium">
                            {{ $permission->name }}
                        </span>

                    </label>
                @endforeach

            </div>

            <div class="mt-6 flex justify-end">

                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg">

                    Simpan Permission

                </button>

            </div>

        </form>

    </div>
@endsection
