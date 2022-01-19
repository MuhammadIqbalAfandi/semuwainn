<x-shared.modal id="modal-add" title="Tambah Ruangan">
    <form>
        <div class="form-group">
            <label for="room-number">Nomor Kamar</label>

            <input type="text" name="room_number" id="room-number" class="form-control"
                placeholder="Tulis nomor kamar disini">

            <span class="text-danger msg-error room_number-error"></span>
        </div>

        <div class="form-group">
            <label for="room-type-id">Tipe Kamar</label>

            <select class="select2" name="room_type_id" id="room-type-id" style="width: 100%;">
                <option></option>
            </select>

            <span class="text-danger msg-error room_type_id-error"></span>
        </div>

        <button type="submit" id="btn-save" class="btn btn-block btn-warning">Simpan</button>
    </form>
</x-shared.modal>

@push('scripts')
    <script>
        $(() => {
            // Mounted
            fetchRoomType()

            $('#btn-add').click(() => {
                clearForm()
                $('.msg-error').text('')
                $('#modal-add').modal('show')
            })

            $('#btn-save').click((e) => {
                e.preventDefault()

                const roomNumber = $('#room-number').val()
                const roomTypeId = $('#room-type-id').val()

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('dashboard.rooms.store') }}",
                    data: {
                        room_number: roomNumber,
                        room_type_id: roomTypeId,
                    },
                    success(res) {
                        const {
                            message,
                            status
                        } = res
                        alert(message, status)
                        $('#modal-add').modal('hide')
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
                $('#room-type-id').select2({
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
                        $('#room-type-id').children('option:not(:first)').remove()
                    },
                    success(res) {
                        if (res) {
                            res.forEach((roomType) => {
                                let newOption = new Option(
                                    roomType.name,
                                    roomType.id,
                                    false,
                                    false,
                                )
                                $('#room-type-id').append(newOption)
                            })
                        }
                    }
                })
            }
            // end Methods
        })
    </script>
@endpush
