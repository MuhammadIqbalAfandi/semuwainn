  <x-shared.modal id="modal-add" title="Tambah Fasilitas">
      <form>
          <div class="form-group">
              <label for="name">Nama Fasilitas</label>
              <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                  placeholder="Tulis nama fasilitas disini">

              <span class="text-danger msg-error name-error"></span>
          </div>

          <button id="btn-save" type="submit" class="btn btn-block btn-warning">Simpan</button>
      </form>
  </x-shared.modal>

  @push('scripts')
      <script>
          $(() => {
              // Mounted
              $('#btn-add').click(() => {
                  clearForm()
                  $('.msg-error').text('')
                  $('#modal-add').modal('show')
              })

              $('#btn-save').click((e) => {
                  e.preventDefault()

                  const name = $('#name').val()

                  $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      type: 'post',
                      url: 'facilities',
                      data: {
                          name,
                      },
                      beforeSend() {
                          $('.msg-error').text('')
                      },
                      success(res) {
                          alert(res.message, res.status)
                          $('#modal-add').modal('hide')
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
