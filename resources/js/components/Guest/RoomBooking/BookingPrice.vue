<script>
import { mapState } from 'vuex'
import RoomBookingPrice from '@/components/Guest/RoomBooking/BookingPrice/RoomBookingPrice.vue'
import ServiceBookingPrice from '@/components/Guest/RoomBooking/BookingPrice/ServiceBookingPrice.vue'
import BookingPriceTotal from '@/components/Guest/RoomBooking/BookingPrice/BookingPriceTotal.vue'

export default {
  components: {
    RoomBookingPrice,
    ServiceBookingPrice,
    BookingPriceTotal,
  },
  computed: {
    ...mapState(['roomCart', 'serviceCart']),
  },
}
</script>

<template>
  <v-card :width="$vuetify.breakpoint.smAndDown ? '100%' : '390'">
    <v-card-title class="text-body-2 text-md-h5">Detail Pemesanan</v-card-title>

    <v-card-text>
      <v-row dense>
        <v-col v-for="room in roomCart" :key="`room ${room.roomId}`" cols="12">
          <RoomBookingPrice :room="room" />
        </v-col>

        <v-col v-for="service in serviceCart" :key="`service ${service.id}`" cols="12">
          <ServiceBookingPrice :service="service" />
        </v-col>

        <v-col cols="12">
          <BookingPriceTotal />
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>
