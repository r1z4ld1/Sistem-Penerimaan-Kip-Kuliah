<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex">

        {{-- Sidebar --}}
        <aside class="w-64 bg-white shadow-md flex flex-col justify-between">

            <div>

                <div class="p-5 border-b">
                    <h1 class="text-xl font-bold">
                        KIP Kuliah
                    </h1>
                </div>

                <div class="p-4">
                    @include('components.sidebar')
                </div>

            </div>

            <div class="p-4 border-t">

                <div class="mb-3">

                    <p class="font-semibold">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-sm text-gray-500">
                        {{ auth()->user()->getRoleNames()->first() }}
                    </p>

                </div>

                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button type="submit" class="w-full bg-red-500 text-white py-2 rounded">

                        Logout

                    </button>

                </form>

            </div>

        </aside>

        {{-- Content --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>

    </div>

</body>

</html>
