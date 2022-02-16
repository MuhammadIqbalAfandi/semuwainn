@props(['user'])

<x-shared.card>
    <x-slot name="cardFills">
        <li class="nav-item">
            <a class="nav-link active" href="#edit-user" data-toggle="tab">
                Ubah Akun User
            </a>
        </li>
        @can('isAuth', $user->id)
            <li class="nav-item">
                <a class="nav-link" href="#change-password" data-toggle="tab">Ubah
                    Kata Sandi
                </a>
            </li>
        @endcan
    </x-slot>

    <div class="tab-content">
        <div class="active tab-pane" id="edit-user">
            <x-dashboard.user.show.change-data :user="$user"></x-dashboard.user.show.change-data>
        </div>
        @can('isAuth', $user->id)
            <div class="tab-pane" id="change-password">
                <x-dashboard.user.show.change-password></x-dashboard.user.show.change-password>
            </div>
        @endcan
    </div>
</x-shared.card>
