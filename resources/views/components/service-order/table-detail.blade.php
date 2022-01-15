<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Nama Layanan</th>
            {{-- <th>Nomor Ruangan</th> --}}
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
</table>

<div class="row mt-3">
    <div class="col d-flex justify-content-end">
        <button type="button" class="btn btn-sm btn-warning" id="btn-save"><i class="fa fa-save"></i>
            Simpan pesanan</button>
    </div>
</div>

@push('scripts')
    <script>
        // Data
        const State = {
            initialServices: [],
            // initialRooms: [],
            listOfServiceBooked: [],
            // listOfRoomBooked: [],
            error: false,
        }
        // end Data

        // Mounted
        const table = $('.table').DataTable({
            paging: false,
            searching: false,
            ordering: false,
            info: false,
            autoWidth: false,
            scrollX: true,
            responsive: true,
        })

        $(document).on('click', '.btn-delete-detail', function() {
            const serviceId = $(this).attr('data-id-service')
            // const roomId = $(this).attr('data-id-room')

            State.listOfServiceBooked = State.listOfServiceBooked.filter((service) =>
                service.id != serviceId)
            // State.listOfRoomBooked = State.listOfRoomBooked.filter((room) =>
            //     room.id != roomId)

            fetchService()
            // fetchRoom()

            table.row($(this).parents('tr')).remove().draw()
        })

        $('#btn-save').click(() => {
            const id = $('#reservation-id').val()
            const services = State.listOfServiceBooked

            if (!services.length) {
                return alert('Pesanan tidak boleh kosong', 'failed')
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                type: 'post',
                url: `/dashboard/service-orders`,
                data: {
                    id,
                    services,
                },
                success(res) {
                    const {
                        message,
                        status
                    } = res
                    alert(message, status)
                    fetchService()
                    // fetchRoom()
                    table.clear().draw()
                },
                error(res) {
                    const {
                        message,
                        status,
                    } = res.responseJSON
                    alert(message, status)
                }
            })
        })
        // end Mounted

        // Methods
        function fetchService() {
            $('#service').select2({
                placeholder: 'Pilih Layanan',
                theme: 'bootstrap4',
            })

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                type: 'get',
                url: `/dashboard/service-orders/${id}/edit`,
                beforeSend() {
                    $('#service').children('option:not(:first)').remove()
                },
                success(res) {
                    if (res) {
                        State.initialServices = res

                        const services = _.differenceBy(res, State.listOfServiceBooked, 'id')
                        services.forEach((service) => {
                            let newOption = new Option(service.name, service.id, false, false)
                            $('#service').append(newOption)
                        })
                    }
                }
            })
        }

        // function fetchRoom() {
        //     $('#room').select2({
        //         placeholder: 'Pilih Layanan',
        //         theme: 'bootstrap4',
        //     })

        //     $.ajax({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         dataType: 'json',
        //         type: 'get',
        //         url: `/dashboard/service-orders/rooms/${id}`,
        //         beforeSend() {
        //             $('#room').children('option:not(:first)').remove()
        //         },
        //         success(res) {
        //             if (res) {
        //                 State.initialRooms = res

        //                 const rooms = _.differenceBy(res, State.listOfRoomBooked, 'id')
        //                 rooms.forEach((room) => {
        //                     let newOption = new Option(room.room_number, room.id,
        //                         false, false)
        //                     $('#room').append(newOption)
        //                 })
        //             }
        //         }
        //     })
        // }

        function clearForm() {
            $('#service').val(null).trigger('change');
            // $('#room').val(null).trigger('change');
        }
        // end Methods
    </script>
@endpush
