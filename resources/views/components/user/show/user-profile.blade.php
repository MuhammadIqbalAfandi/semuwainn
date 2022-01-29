 <x-shared.card>
     <section>
         <div class="text-center">
             <img class="profile-user-img img-fluid img-circle"
                 src="{{ $user->gender_id === 1 ? asset('img/avatar1.png') : asset('img/avatar2.png') }}"
                 alt="User profile picture" id="profile-user">
         </div>
         <h3 class="profile-username text-center" id="name-text"></h3>
         <p class="text-muted text-center" id="role-name-text"></p>
     </section>

     <div class="divider"></div>

     <section>
         <section>
             <strong><i class="fas fa-clock mr-1"></i>Dibuat pada</strong>
             <p class="text-muted" id="created-text"></p>
         </section>

         <hr>

         <section>
             <strong><i class="fas fa-venus-mars mr-1"></i>Jenis Kelamin</strong>
             <p class="text-muted" id="gender-text"></p>
         </section>

         <hr>

         <section>
             <strong><i class="fas fa-phone-alt mr-1"></i>Phone</strong>
             <p class="text-muted" id="phone-text"></p>
         </section>

         <hr>

         <section>
             <strong><i class="fas fa-at mr-1"></i>Email</strong>
             <p class="text-muted" id="email-text"></p>
         </section>

         <hr>

         <section>
             <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
             <p class="text-muted" id="address-text"></p>
         </section>
     </section>
 </x-shared.card>

 @push('scripts')
     <script>
         // Mounted
         setUser()
         // end Mounted

         // Methods
         function setUser() {
             $.ajax({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 dataType: 'json',
                 type: 'get',
                 url: "{{ route('dashboard.users.user', $user->id) }}",
                 success(res) {
                     $('#created-text').text(res.created_at)
                     $('#name-text').text(res.name)
                     $('#role-name-text').text(res.role.name)
                     $('#gender-text').text(res.gender.gender)
                     $('#phone-text').text(res.phone)
                     $('#email-text').text(res.email)
                     $('#address-text').text(res.address)

                     if (res.gender_id === 1) {
                         $('#profile-user').attr("src", "{{ asset('img/avatar1.png') }}")

                         if ({{ auth()->user()->id }} === res.id) {
                             $('#user-panel-profile').attr("src", "{{ asset('img/avatar1.png') }}")
                         }
                     } else {
                         $('#profile-user').attr("src", "{{ asset('img/avatar2.png') }}")

                         if ({{ auth()->user()->id }} === res.id) {
                             $('#user-panel-profile').attr("src", "{{ asset('img/avatar2.png') }}")
                         }
                     }

                     if ({{ auth()->user()->id }} === res.id) {
                         $('#user-panel-name').text(res.name)
                     }
                 },
             })
         }
         // end Methods
     </script>
 @endpush
