@extends('layouts.app')

@section('content')
    <div class="mb-6">

        <h1 class="text-3xl font-bold">
            Notifikasi
        </h1>

        <p class="text-gray-500 mt-1">
            Riwayat notifikasi sistem
        </p>

    </div>

    <div class="space-y-4">

        @forelse($notifications as $item)
            <div class="bg-white shadow rounded-xl p-5">

                <h3 class="font-semibold">

                    {{ $item->title }}

                </h3>

                <p class="text-gray-600 mt-2">

                    {{ $item->message }}

                </p>

                <p class="text-sm text-gray-400 mt-3">

                    {{ $item->created_at->diffForHumans() }}

                </p>

            </div>

        @empty

            <div class="bg-white shadow rounded-xl p-5">

                Belum ada notifikasi

            </div>
        @endforelse

    </div>

    <div class="mt-5">

        {{ $notifications->links() }}

    </div>
@endsection
