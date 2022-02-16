<x-dashboard-layout title="Pengaturan Akun User">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Pengaturan Akun User">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item active">Pengaturan Akun User</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <div class="row">
                <div class="col-12 col-lg-5">
                    <x-dashboard.user.show.user-profile :user="$user"></x-dashboard.user.show.user-profile>
                </div>

                <div class="col-12 col-lg-7">
                    <x-dashboard.user.show.user-setting :user="$user"></x-dashboard.user.show.user-setting>
                </div>
        </x-shared.content>
    </x-shared.content-wrapper>
</x-dashboard-layout>
