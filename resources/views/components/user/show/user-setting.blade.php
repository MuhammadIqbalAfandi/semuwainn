<x-shared.card>
    <x-slot name="cardFills">
        <li class="nav-item">
            <a class="nav-link active" href="#edit-user" data-toggle="tab">
                Ubah Akun User
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#change-password" data-toggle="tab">Ubah
                Kata Sandi
            </a>
        </li>
    </x-slot>

    <div class="tab-content">
        <div class="active tab-pane" id="edit-user">
            <x-user.show.change-data :user="$user"></x-user.show.change-data>
        </div>
        <div class="tab-pane" id="change-password">
            <x-user.show.change-password></x-user.show.change-password>
        </div>
    </div>
</x-shared.card>
