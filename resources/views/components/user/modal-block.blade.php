<x-shared.modal id="modal-block">
    <x-slot name="title">
        <i class="fa fa-exclamation-triangle text-danger"></i> Peringatan
    </x-slot>

    <span id="block-msg">Yakin ingin mengubah status user</span>

    <x-slot name="footer">
        <button type="submit" id="btn-block" class="btn btn-warning float-right btn-rounded w-140">Ya</button>
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
            $(document).on('click', '.btn-show-block', function() {
                State.id = $(this).attr('id')

                $('#modal-block').modal('show')
            })

            $('#btn-block').click((e) => {
                e.preventDefault()

                const id = State.id

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    type: 'delete',
                    url: `users/${id}`,
                    success(res) {
                        alert(res.message, res.status)
                        $('#modal-block').modal('hide')
                        fetchUsers()
                    },
                })
            })
            // end Mounted
        })
    </script>
@endpush
