<x-dashboard-layout title="Hidangan Restoran">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Hidangan Restoran">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item active">Hidangan Restoran</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-shared.card>
                <div class="row mb-2">
                    <div class="col">
                        @can('isAdmin')
                            <button type="button" id="btn-add" class="btn btn-sm btn-warning float-right"
                                data-toggle="modal">
                                <i class="fa fa-plus"></i>
                            </button>
                        @endcan
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Hidangan</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Tanggal Ditambahkan</th>
                                    @can('isAdmin')
                                        <th>Aksi</th>
                                    @endcan
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </x-shared.card>

            <x-restaurant.modal-add></x-restaurant.modal-add>

            <x-restaurant.modal-edit></x-restaurant.modal-edit>

            <x-restaurant.modal-delete></x-restaurant.modal-delete>
        </x-shared.content>
    </x-shared.content-wrapper>

    @prepend('scripts')
        <script>
            // Mounted
            $('.table').DataTable({
                serverSide: true,
                ajax: "{{ route('dashboard.restaurants.restaurants') }}",
                columns: [{
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'unit',
                        name: 'unit',
                    },
                    {
                        data: 'price',
                        name: 'price',
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    @can('isAdmin')
                        {
                        data: 'actions',
                        name: 'actions'
                        }
                    @endcan
                ],
            })
            // end Mounted

            // Methods
            function clearForm() {
                $('[name="name"]').val('')
                $('[name="unit"]').val('')
                $('[name="price"]').val('')
            }

            function fetchRestaurants() {
                $('.table').DataTable().ajax.reload()
            }
            // end Methods
        </script>
    @endprepend
</x-dashboard-layout>
