<x-dashboard-layout title="Tambah Layanan">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Tambah Layanan">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.reservations.index') }}"
                        class="text-warning">Daftar
                        Pemesanan Kamar</a></li>
                <li class="breadcrumb-item active">Tambah Layanan</li>
            </x-slot>
        </x-shared.content-header>
    </x-shared.content-wrapper>
</x-dashboard-layout>
