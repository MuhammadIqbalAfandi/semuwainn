<script>
import { mapState } from 'vuex'
import { Link } from '@inertiajs/inertia-vue'

import GuestLayout from '@/layouts/Guest.vue'
import Button from '@/shared/Button.vue'
import BookingDate from '@/components/Guest/RoomBooking/BookingDate.vue'
import GuestBookingForm from '@/components/Guest/RoomBooking/GuestBookingForm.vue'
import ServiceBooking from '@/components/Guest/RoomBooking/ServiceBooking.vue'
import BookingPrice from '@/components/Guest/RoomBooking/BookingPrice.vue'

export default {
  layout: GuestLayout,
  props: {
    services: Object,
    errors: Object,
  },
  components: {
    Link,
    Button,
    BookingDate,
    GuestBookingForm,
    ServiceBooking,
    BookingPrice,
  },
  methods: {
    order() {
      if (this.valid && this.roomCart.length) {
        const rooms = this.roomCart.map((room) => {
          return {
            id: room.id,
            price: room.price,
            roomCount: room.roomCount,
            guestCount: room.guestCount,
          }
        })

        const services = this.serviceCart.map((service) => {
          return {
            id: service.id,
            price: service.price,
          }
        })

        const form = {
          name: this.name,
          nik: this.nik,
          phone: this.phone,
          email: this.email,
          checkIn: this.checkIn,
          checkOut: this.checkOut,
          rooms,
          services,
        }
        this.$inertia.post(this.$route('room-booking.store'), form)
      }
    },
  },
  computed: {
    ...mapState('roomBooking', ['checkIn', 'checkOut', 'valid', 'name', 'nik', 'phone', 'email', 'valid']),
    ...mapState(['roomCart', 'serviceCart']),
    hideSubmitButton() {
      return !this.roomCart.length || !this.valid
    },
  },
}
</script>

<template>
  <v-row dense>
    <v-col order="2" order-md="1">
      <v-row dense>
        <v-col cols="12">
          <BookingDate />
        </v-col>

        <v-col cols="12">
          <GuestBookingForm />
        </v-col>

        <v-col cols="12">
          <ServiceBooking v-once :services="services" />
        </v-col>

        <v-col class="text-end" cols="12">
          <p class="text-caption text-sm-body-2">
            Dengan menekan tombol, kamu menyetujui
            <Link class="orange--text text--lighten-2">Kebijakan Privasi</Link>
            dan
            <Link class="orange--text text--lighten-2">Syarat & Ketentuan kami</Link>
          </p>

          <Button @click="order" :disabled="hideSubmitButton">Pesan sekarang</Button>
        </v-col>
      </v-row>
    </v-col>

    <v-col cols="12" md="auto" order="1" order-md="2">
      <BookingPrice />
    </v-col>
  </v-row>
</template>
