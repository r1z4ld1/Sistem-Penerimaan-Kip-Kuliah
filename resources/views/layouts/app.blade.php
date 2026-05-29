@php
    use Illuminate\Support\Str;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
        <main class="flex-1">

            {{-- Header --}}
            <div class="bg-white shadow-sm border-b">

                <div class="px-6 py-4 flex items-center justify-between">

                    <h1 class="font-semibold text-lg">
                        Dashboard
                    </h1>

                    <div class="flex items-center gap-4">

                        <div x-data="{ open: false }" class="relative">

                            <button @click="open = !open" class="relative">

                                <span class="text-2xl">
                                    🔔
                                </span>

                                @if ($unreadCount > 0)
                                    <span
                                        class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">

                                        {{ $unreadCount }}

                                    </span>
                                @endif

                            </button>
                            {{-- untuk menampilkan dropdown notifikasi --}}
                            <div x-show="open" @click.outside="open = false" x-transition
                                class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-lg border z-50">

                                <div class="py-2">

                                    <div class="px-4 py-3 border-b">
                                        <h3 class="font-semibold">
                                            Notifikasi
                                        </h3>
                                    </div>

                                    @forelse($unreadNotifications as $notification)
                                        <a href="{{ route('notifications.index') }}"
                                            class="block px-4 py-3 border-b

                @if ($notification->type->value == 'success') bg-green-50 hover:bg-green-100
                @elseif ($notification->type->value == 'warning')
                    bg-yellow-50 hover:bg-yellow-100
                @elseif ($notification->type->value == 'error')
                    bg-red-50 hover:bg-red-100
                @else
                    hover:bg-gray-50 @endif">

                                            <div class="flex items-center gap-2">

                                                @if ($notification->type->value == 'success')
                                                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                                @elseif ($notification->type->value == 'warning')
                                                    <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                                                @elseif ($notification->type->value == 'error')
                                                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                                @endif

                                                <p class="font-medium text-sm">
                                                    {{ $notification->title }}
                                                </p>

                                            </div>

                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ Str::limit($notification->message, 50) }}
                                            </p>

                                            <p class="text-xs text-gray-400 mt-1">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>

                                        </a>

                                    @empty

                                        <div class="p-4 text-center text-gray-500">
                                            Tidak ada notifikasi baru
                                        </div>
                                    @endforelse

                                    <div class="p-3 text-center border-t">

                                        <a href="{{ route('notifications.index') }}"
                                            class="text-sm text-blue-600 hover:text-blue-800">

                                            Lihat Semua Notifikasi

                                        </a>

                                    </div>

                                </div>

                            </div>
                            {{-- end dropdown notifikasi --}}

                        </div>

                    </div>

                </div>

            </div>

            {{-- Page Content --}}
            <div class="p-6">

                @yield('content')

            </div>

        </main>

    </div>

    {{-- Script untuk notifikasi realtime --}}
    <script>
        let lastNotificationId = null;
    </script>
    <script>
        setInterval(() => {

            fetch(
                    "{{ route('notifications.latest') }}"
                )

                .then(response => response.json())

                .then(data => {

                    if (!data) {
                        return;
                    }

                    if (
                        lastNotificationId === null
                    ) {

                        lastNotificationId = data.id;

                        return;
                    }

                    if (
                        data.id != lastNotificationId
                    ) {

                        lastNotificationId = data.id;

                        let icon = 'info';

                        if (data.type === 'success') {
                            icon = 'success';
                        }

                        if (data.type === 'error') {
                            icon = 'error';
                        }

                        if (data.type === 'warning') {
                            icon = 'warning';
                        }

                        Swal.fire({

                            toast: true,
                            position: 'top-end',
                            icon: icon,
                            title: data.title,
                            text: data.message,
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true

                        });

                    }

                });

        }, 5000);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Sweet Alert Success --}}
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });

            });
        </script>
    @endif

    {{-- Sweet Alert Error --}}
    @if (session('error'))
        <script>
            Swal.fire({

                toast: true,
                position: 'top-end',
                icon: 'error',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true

            });
        </script>
    @endif

    {{-- sweet alert hapus data --}}
    <script>
        document.querySelectorAll('.form-delete')
            .forEach(form => {

                form.addEventListener('submit', function(e) {

                    e.preventDefault();

                    Swal.fire({
                        title: 'Yakin hapus data?',
                        text: 'Data yang dihapus tidak bisa dikembalikan!!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {

                        if (result.isConfirmed) {
                            form.submit();
                        }

                    });

                });

            });
    </script>
</body>

</html>
