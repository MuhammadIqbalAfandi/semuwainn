<x-shared.modal id="modal-edit" title="Ubah Ruangan">
    <form>
        <div class="form-group">
            <label for="room-number-edit">Nomor Kamar</label>
            <input type="text" name="room_number" id="room-number-edit" class="form-control"
                placeholder="Tulis nomor kamar">

            <span class="text-danger msg-error room_number-error"></span>
        </div>

        <div class="form-group">
            <label for="room-type-id-edit">Tipe Kamar</label>
            <select class="form-control" name="room_type_id" id="room-type-id-edit" style="width: 100%;">
                <option></option>
            </select>

            <span class="text-danger msg-error room_type_id-error"></span>
        </div>

        <button type="submit" id="btn-edit" class="btn btn-block btn-warning">Simpan</button>
    </form>
</x-shared.modal>

@push('scripts')
    <script>
        $(() => {
            // Data
            const State = {
                id: '',
                roomTypeId: '',
            }
            // end Data

            // Mounted
            $(document).on('click', '.btn-show-edit', function() {
                const id = $(this).attr('id')
                State.id = id

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'get',
                    url: `rooms/${id}/edit`,
                    beforeSend() {
                        $('.msg-error').text('')
                        $('#modal-edit').modal('show')
                    },
                    success(res) {
                        State.roomTypeId = res.roomTypeId
                        fetchRoomType()

                        $('#room-number-edit').val(res.roomNumber)
                    }
                })
            })

            $('#btn-edit').click((e) => {
                e.preventDefault()

                const id = State.id
                const roomNumber = $('#room-number-edit').val()
                const roomTypeId = $('#room-type-id-edit').val()

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'patch',
                    url: `rooms/${id}`,
                    data: {
                        id,
                        room_number: roomNumber,
                        room_type_id: roomTypeId,
                    },
                    success(res) {
                        const {
                            message,
                            status
                        } = res
                        alert(message, status)
                        $('#modal-edit').modal('hide')
                        fetchRooms()
                    },
                    error(res) {
                        const {
                            errors,
                            message,
                            status
                        } = res.responseJSON
                        if (status === 'failed') {
                            alert(message, status)
                        } else {
                            for (const key in errors) {
                                $(`.${key}-error`).text(errors[key])
                            }
                        }
                    }
                })
            })
            // end Mounted

            // Methods
            function fetchRoomType() {
                $('#room-type-id-edit').select2({
                    placeholder: 'Pilih tipe kamar',
                    theme: 'bootstrap4'
                })

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    type: 'get',
                    url: 'rooms/room-types',
                    beforeSend() {
                        $('#room-type-id-edit').children('option:not(:first)').remove()
                    },
                    success(res) {
                        if (res) {
                            res.forEach((roomType) => {
                                let newOption = new Option(
                                    roomType.name,
                                    roomType.id,
                                    false,
                                    State.roomTypeId === roomType.id ?? false,
                                )
                                $('#room-type-id-edit').append(newOption)
                            })
                        }
                    }
                })
            }
            // end Methods
        })
    </script>
@endpush
