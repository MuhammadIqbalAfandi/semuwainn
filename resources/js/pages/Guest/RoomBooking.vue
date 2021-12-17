<script>
import { mapActions, mapState } from 'vuex'
import { Link } from '@inertiajs/inertia-vue'

import GuestLayout from '@/layouts/Guest.vue'
import Button from '@/shared/Button.vue'
import Date from '@/components/Guest/RoomBooking/Date.vue'
import GuestForm from '@/components/Guest/RoomBooking/GuestForm.vue'
import Service from '@/components/Guest/RoomBooking/Service.vue'
import RoomDetail from '@/components/Guest/RoomBooking/RoomDetail.vue'
import PriceDetail from '@/components/Guest/RoomBooking/PriceDetail.vue'
import ServiceDetail from '@/components/Guest/RoomBooking/ServiceDetail.vue'

export default {
  layout: GuestLayout,
  props: {
    services: Object,
  },
  components: {
    Link,
    Button,
    Date,
    GuestForm,
    RoomDetail,
    PriceDetail,
    ServiceDetail,
    Service,
  },
  methods: {
    ...mapActions(['removeRoomCart', 'removeServiceCart']),
  },
  computed: {
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
          <v-card>
            <v-card-title class="text-body-2 text-md-h5" tag="h3">Pelayanan tambahan</v-card-title>
            <v-card-subtitle class="mb-0 text-caption text-md-body-2" tag="p">
              Mau menambah pelayanan yang membuatmu makin nyaman? Pilih disini. Layanan tergantung persediaan dan
              mungkin dikenakan biaya tambahan.
            </v-card-subtitle>

            <v-divider />

            <v-card-text>
              <Service :services="services" />
            </v-card-text>
          </v-card>
        </v-col>

        <v-col class="text-end" cols="12">
          <p class="text-caption text-sm-body-2">
            Dengan menekan tombol, kamu menyetujui
            <Link class="orange--text text--lighten-2">Kebijakan Privasi</Link>
            dan
            <Link class="orange--text text--lighten-2">Syarat & Ketentuan kami</Link>
          </p>
          <Button>Pesan sekarang</Button>
        </v-col>
      </v-row>
    </v-col>

    <v-col cols="12" md="auto" order="1" order-md="2">
      <v-card :width="$vuetify.breakpoint.smAndDown ? '100%' : '390'">
        <v-card-title class="text-body-2 text-md-h5">Detail Pemesanan</v-card-title>

        <v-card-text>
          <v-row dense>
            <v-col v-for="room in roomCart" :key="room.id" cols="12">
              <RoomDetail @roomDelete="removeRoomCart" :room="room" />
            </v-col>

            <v-col v-for="service in serviceCart" :key="service.id" cols="12">
              <ServiceDetail @serviceDelete="removeServiceCart" :service="service" />
            </v-col>

            <v-col cols="12">
              <v-row>
                <v-col cols="12">
                  <PriceDetail />
                </v-col>
              </v-row>
            </v-col>
          </v-row>
        </v-card-text>
      </v-card>
    </v-col>
  </v-row>
</template>
