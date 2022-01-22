  <x-shared.modal id="modal-add" title="Tambah Fasilitas">
      <form>
          <div class="form-group">
              <label for="name">Nama Fasilitas</label>
              <input type="text" name="name" id="name" class="form-control" placeholder="Tulis nama fasilitas">

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
                      url: "{{ route('dashboard.facilities.store') }}",
                      data: {
                          name,
                      },
                      success(res) {
                          const {
                              message,
                              status
                          } = res
                          alert(message, status)
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
