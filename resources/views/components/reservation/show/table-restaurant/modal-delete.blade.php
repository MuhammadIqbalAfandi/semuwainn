<x-shared.modal id="modal-delete-restaurant">
    <x-slot name="title">
        <i class="fa fa-exclamation-triangle text-danger"></i> Peringatan
    </x-slot>

    <p>Yakin akan menghapus data ini?</p>

    <x-slot name="footer">
        <button type="submit" id="btn-delete-restaurant"
            class="btn btn-warning float-right btn-rounded w-139">Ya</button>
    </x-slot>
</x-shared.modal>

@push('scripts')
    <script>
        $(() => {
            // Data
            const State = {
                id: ''
            }
            // end Data

            // Mounted
            $(document).on('click', '.show-restaurant-delete-btn', function() {
                State.id = $(this).attr('id')

                $('#modal-delete-restaurant').modal('show')
            })

            $('#btn-delete-restaurant').click(() => {
                const id = State.id

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    type: 'delete',
                    url: `services/${id}`,
                    success(res) {
                        alert(res.message, res.status)
                        $('#modal-delete-restaurant').modal('hide')
                        fetchServices()
                    },
                    error(res) {
                        const {
                            message,
                            status
                        } = res.responseJSON
                        alert(message, status)

                        $('#modal-delete-restaurant').modal('hide')
                    }
                })
            })
            // end Mounted
        })
    </script>
@endpush
