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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-slate-50 font-sans text-slate-800 antialiased selection:bg-blue-200 selection:text-blue-900">

    {{-- Wrapper utama dengan state Alpine untuk Mobile Menu --}}
    <div x-data="{ mobileMenuOpen: false }" class="min-h-screen flex overflow-hidden">

        {{-- Mobile Overlay Background --}}
        <div x-show="mobileMenuOpen" x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 lg:hidden"
            @click="mobileMenuOpen = false"></div>

        {{-- ====================================================== --}}
        {{-- SIDEBAR CONTAINER --}}
        {{-- ====================================================== --}}
        <aside :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-72 bg-white/95 backdrop-blur-xl border-r border-slate-100 shadow-[1px_0_40px_rgba(0,0,0,0.05)] flex flex-col justify-between transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0">

            <div class="flex-1 flex flex-col overflow-hidden">
                {{-- App Brand / Logo --}}
                <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l9-5-9-5-9 5 9 5z" />
                            </svg>
                        </div>
                        <h1
                            class="text-xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-slate-800 to-slate-500">
                            KIP Kuliah
                        </h1>
                    </div>
                    {{-- Close button for mobile --}}
                    <button @click="mobileMenuOpen = false" class="lg:hidden text-slate-400 hover:text-slate-600">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Sidebar Navigation Component --}}
                <div class="flex-1 overflow-y-auto no-scrollbar">
                    @include('components.sidebar')
                </div>
            </div>

            {{-- User Profile & Logout Widget --}}
            <div class="p-5 border-t border-slate-100 bg-slate-50/50">
                <div class="flex items-center gap-3 mb-4">
                    {{-- Avatar Placeholder --}}
                    <div
                        class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-lg border-2 border-white shadow-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="font-bold text-sm text-slate-700 truncate">
                            {{ auth()->user()->name }}
                        </p>
                        <p class="text-xs font-semibold text-blue-600 uppercase tracking-wider">
                            {{ auth()->user()->getRoleNames()->first() }}
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 hover:shadow-sm rounded-xl transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- ====================================================== --}}
        {{-- MAIN CONTENT AREA --}}
        {{-- ====================================================== --}}
        <main class="flex-1 flex flex-col h-screen overflow-hidden bg-slate-50 relative">

            {{-- Header/Navbar --}}
            <header class="sticky top-0 z-30 bg-white/70 backdrop-blur-lg border-b border-slate-200/60 shadow-sm">
                <div class="px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">

                    {{-- Left section: Mobile Toggle & Page Title --}}
                    <div class="flex items-center gap-4">
                        <button @click="mobileMenuOpen = true"
                            class="p-2 rounded-xl bg-white border border-slate-200 text-slate-500 hover:text-blue-600 hover:bg-blue-50 transition-colors lg:hidden shadow-sm">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </button>
                        <h1 class="font-bold text-lg lg:text-xl text-slate-800 tracking-tight">
                            Dashboard
                        </h1>
                    </div>

                    {{-- Right section: Notifications --}}
                    <div class="flex items-center gap-4">
                        <div x-data="{ open: false }" class="relative">
                            {{-- Bell Button --}}
                            <button @click="open = !open"
                                class="relative p-2.5 rounded-full bg-white border border-slate-200 text-slate-500 hover:text-blue-600 hover:bg-blue-50 hover:shadow-md transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>

                                @if ($unreadCount > 0)
                                    <span
                                        class="absolute top-0 right-0 w-2.5 h-2.5 bg-rose-500 border-2 border-white rounded-full animate-pulse"></span>
                                    {{-- Optional: If you want to show number --}}
                                    {{-- <span class="absolute -top-1.5 -right-1.5 flex items-center justify-center min-w-[20px] h-[20px] px-1 bg-rose-500 text-white text-[10px] font-bold rounded-full border-2 border-white">{{ $unreadCount }}</span> --}}
                                @endif
                            </button>

                            {{-- Notification Dropdown --}}
                            <div x-show="open" @click.outside="open = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                                class="absolute right-0 mt-3 w-80 sm:w-96 bg-white/95 backdrop-blur-xl rounded-2xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.15)] border border-slate-100 z-50 overflow-hidden origin-top-right">

                                <div
                                    class="px-5 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                                    <h3 class="font-bold text-slate-800">Notifikasi</h3>
                                    @if ($unreadCount > 0)
                                        <span
                                            class="bg-rose-100 text-rose-600 text-xs font-bold px-2.5 py-0.5 rounded-full">{{ $unreadCount }}
                                            Baru</span>
                                    @endif
                                </div>

                                <div class="max-h-[350px] overflow-y-auto">
                                    @forelse($unreadNotifications as $notification)
                                        <a href="{{ route('notifications.index') }}"
                                            class="block px-5 py-4 border-b border-slate-50 transition-colors duration-200
                                           @if ($notification->type->value == 'success') bg-emerald-50/50 hover:bg-emerald-50
                                           @elseif ($notification->type->value == 'warning') bg-amber-50/50 hover:bg-amber-50
                                           @elseif ($notification->type->value == 'error') bg-rose-50/50 hover:bg-rose-50
                                           @else hover:bg-slate-50 @endif">

                                            <div class="flex items-start gap-3">
                                                {{-- Status Indicator Dot --}}
                                                <div class="mt-1.5">
                                                    @if ($notification->type->value == 'success')
                                                        <span
                                                            class="block w-2.5 h-2.5 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]"></span>
                                                    @elseif ($notification->type->value == 'warning')
                                                        <span
                                                            class="block w-2.5 h-2.5 rounded-full bg-amber-500 shadow-[0_0_8px_rgba(245,158,11,0.5)]"></span>
                                                    @elseif ($notification->type->value == 'error')
                                                        <span
                                                            class="block w-2.5 h-2.5 rounded-full bg-rose-500 shadow-[0_0_8px_rgba(244,63,94,0.5)]"></span>
                                                    @else
                                                        <span
                                                            class="block w-2.5 h-2.5 rounded-full bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.5)]"></span>
                                                    @endif
                                                </div>

                                                <div class="flex-1">
                                                    <p class="font-semibold text-sm text-slate-800">
                                                        {{ $notification->title }}
                                                    </p>
                                                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                                        {{ Str::limit($notification->message, 60) }}
                                                    </p>
                                                    <p
                                                        class="text-[11px] font-medium text-slate-400 mt-2 flex items-center gap-1">
                                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        {{ $notification->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    @empty
                                        <div class="px-5 py-8 text-center flex flex-col items-center justify-center">
                                            <div
                                                class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center mb-3">
                                                <svg class="w-6 h-6 text-slate-400" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                </svg>
                                            </div>
                                            <p class="text-sm font-medium text-slate-500">Tidak ada notifikasi baru</p>
                                        </div>
                                    @endforelse
                                </div>

                                <div class="px-5 py-3 border-t border-slate-100 bg-slate-50/50 text-center">
                                    <a href="{{ route('notifications.index') }}"
                                        class="text-sm font-semibold text-blue-600 hover:text-blue-700 hover:underline decoration-2 underline-offset-2 transition-all">
                                        Lihat Semua Notifikasi
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Main Content Canvas (Scrollable) --}}
            <div class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </div>

            @include('components.footer')
        </main>
    </div>

    {{-- ====================================================== --}}
    {{-- SCRIPTS (Logika Backend & Alert Tetap Utuh) --}}
    {{-- ====================================================== --}}
    <script>
        let lastNotificationId = null;
    </script>
    <script>
        setInterval(() => {
            fetch("{{ route('notifications.latest') }}")
                .then(response => response.json())
                .then(data => {
                    if (!data) return;
                    if (lastNotificationId === null) {
                        lastNotificationId = data.id;
                        return;
                    }
                    if (data.id != lastNotificationId) {
                        lastNotificationId = data.id;
                        let icon = 'info';
                        if (data.type === 'success') icon = 'success';
                        if (data.type === 'error') icon = 'error';
                        if (data.type === 'warning') icon = 'warning';

                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: icon,
                            title: data.title,
                            text: data.message,
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                            customClass: {
                                popup: 'rounded-xl shadow-lg border border-slate-100',
                            }
                        });
                    }
                });
        }, 5000);
    </script>

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
                    timerProgressBar: true,
                    customClass: {
                        popup: 'rounded-xl shadow-lg border border-slate-100'
                    }
                });
            });
        </script>
    @endif

    {{-- Sweet Alert Error --}}
    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: "{{ session('error') }}",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    customClass: {
                        popup: 'rounded-xl shadow-lg border border-slate-100'
                    }
                });
            });
        </script>
    @endif

    {{-- Sweet Alert Delete Logic --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.form-delete').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Yakin hapus data?',
                        text: 'Data yang dihapus tidak bisa dikembalikan!!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#94a3b8',
                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal',
                        customClass: {
                            popup: 'rounded-2xl shadow-xl border border-slate-100',
                            confirmButton: 'rounded-lg font-semibold',
                            cancelButton: 'rounded-lg font-semibold'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>
