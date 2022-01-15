<x-shared.modal id="modal-delete-service">
    <x-slot name="title">
        <i class="fa fa-exclamation-triangle text-danger"></i> Peringatan
    </x-slot>

    <p>Yakin akan menghapus data ini?</p>

    <x-slot name="footer">
        <button type="submit" id="btn-delete-service" class="btn btn-warning float-right btn-rounded w-139">Ya</button>
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
            $(document).on('click', '.show-service-delete-btn', function() {
                State.id = $(this).attr('id')

                $('#modal-delete-service').modal('show')
            })

            $('#btn-delete-service').click(() => {
                const id = State.id

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    type: 'delete',
                    url: `/dashboard/service-orders/${id}`,
                    success(res) {
                        alert(res.message, res.status)
                        $('#modal-delete-service').modal('hide')
                        fetchServices()
                    },
                    error(res) {
                        const {
                            message,
                            status
                        } = res.responseJSON
                        alert(message, status)

                        $('#modal-delete-service').modal('hide')
                    }
                })
            })
            // end Mounted
        })
    </script>
@endpush
