<script>
import { mapState } from 'vuex'

import RoomBooking from '@/components/Guest/RoomBooking/BookingDetail/RoomBooking.vue'
import ServiceBooking from '@/components/Guest/RoomBooking/BookingDetail/ServiceBooking.vue'
import BookingPrice from '@/components/Guest/RoomBooking/BookingDetail/BookingPrice.vue'

export default {
  components: {
    RoomBooking,
    ServiceBooking,
    BookingPrice,
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
        <v-col v-for="room in roomCart" :key="room.id" cols="12">
          <RoomBooking :room="room" />
        </v-col>

        <v-col v-for="service in serviceCart" :key="service.id" cols="12">
          <ServiceBooking :service="service" />
        </v-col>

        <v-col cols="12">
          <BookingPrice />
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>
