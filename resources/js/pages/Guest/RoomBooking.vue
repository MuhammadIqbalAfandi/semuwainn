<script>
import { mapState } from 'vuex'
import { Link } from '@inertiajs/inertia-vue'

import GuestLayout from '@/layouts/Guest.vue'
import Button from '@/shared/Button.vue'
import Date from '@/components/Guest/RoomBooking/Date.vue'
import GuestForm from '@/components/Guest/RoomBooking/GuestForm.vue'
import Service from '@/components/Guest/RoomBooking/Service.vue'
import BookingDetail from '@/components/Guest/RoomBooking/BookingDetail.vue'

export default {
  layout: GuestLayout,
  props: {
    services: Object,
    errors: Object,
  },
  components: {
    Link,
    Button,
    Date,
    GuestForm,
    Service,
    BookingDetail,
  },
  methods: {
    order() {
      if (this.$children[1].$refs.form.validate() && this.roomCart.length) {
        const form = {
          name: this.name,
          nik: this.nik,
          phone: this.phone,
          email: this.email,
          checkIn: this.checkIn,
          checkOut: this.checkOut,
          rooms: this.roomCart,
          services: this.serviceCart,
        }

        this.$inertia.post(this.$route('room-booking.store'), form)
      }
    },
  },
  computed: {
    ...mapState('roomBooking', ['checkIn', 'checkOut', 'valid', 'name', 'nik', 'phone', 'email']),
    ...mapState(['roomCart', 'serviceCart']),
  },
}
</script>

<template>
  <v-row class="room-booking" dense>
    <v-col order="2" order-md="1">
      <v-row dense>
        <v-col cols="12">
          <Date />
        </v-col>

        <v-col cols="12">
          <GuestForm />
        </v-col>

        <v-col cols="12">
          <Service v-once :services="services" />
        </v-col>

        <v-col class="text-end" cols="12">
          <p class="text-caption text-sm-body-2">
            Dengan menekan tombol, kamu menyetujui
            <Link class="orange--text text--lighten-2">Kebijakan Privasi</Link>
            dan
            <Link class="orange--text text--lighten-2">Syarat & Ketentuan kami</Link>
          </p>

          <Button @click="order" :disabled="!this.roomCart.length">Pesan sekarang</Button>
        </v-col>
      </v-row>
    </v-col>

    <v-col cols="12" md="auto" order="1" order-md="2">
      <BookingDetail />
    </v-col>
  </v-row>
</template>
