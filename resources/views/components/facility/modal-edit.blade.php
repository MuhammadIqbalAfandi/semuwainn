  <x-shared.modal id="modal-edit" title="Ubah Fasilitas">
      <form>
          <div class="form-group">
              <label for="name-edit">Nama Fasilitas</label>
              <input type="text" name="name" id="name-edit" class="form-control"
                  placeholder="Tulis nama fasilitas disini">

              <span class="text-danger msg-error name-error"></span>
          </div>

          <button id="btn-edit" type="submit" class="btn btn-block btn-warning">Edit</button>
      </form>
  </x-shared.modal>

  @push('scripts')
      <script>
          $(() => {
              // Data
              const State = {
                  id: '',
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
                      dataType: 'json',
                      type: 'get',
                      url: `facilities/${id}/edit`,
                      beforeSend() {
                          $('.msg-error').text('')
                          $('#modal-edit').modal('show')
                      },
                      success(res) {
                          $('#name-edit').val(res.facility.name)
                      },
                  })
              })

              $('#btn-edit').click((e) => {
                  e.preventDefault()

                  const id = State.id
                  const name = $('#name-edit').val()

                  $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      dataType: 'json',
                      type: 'patch',
                      url: `facilities/${id}`,
                      data: {
                          id,
                          name,
                      },
                      beforeSend() {
                          $('.msg-error').text('')
                      },
                      success(res) {
                          alert(res.message, res.status)
                          $('#modal-edit').modal('hide')
                          fetchFacilities()
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
          })
      </script>
  @endpush
