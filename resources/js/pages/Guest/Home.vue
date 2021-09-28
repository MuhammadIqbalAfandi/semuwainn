<script>
import { Link } from '@inertiajs/inertia-vue'

import GuestLayout from '@/layouts/Guest.vue'
import Room from '@/components/Guest/Home/Room.vue'
import PriceFilter from '@/components/Guest/Home/PriceFilter.vue'
import roomTypes from '@/mock/rooms.json'

export default {
  props: {
    rooms: Object,
  },
  layout: GuestLayout,
  components: {
    Link,
    Room,
    PriceFilter,
  },
  data() {
    return {
      roomTypes,
      sheet: false,
    }
  },
  mounted() {
    // console.log(this.rooms)
  },
}
</script>

<template>
  <v-row dense>
    <v-col cols="auto">
      <v-card class="d-none d-md-block" max-width="fit-content" max-height="fit-content">
        <v-card-title class="text-subtitle-1">Urutkan</v-card-title>
        <v-card-text>
          <PriceFilter />
        </v-card-text>
      </v-card>

      <!-- Mobile version -->
      <v-btn class="d-md-none" @click="sheet = !sheet" color="orange lighten-2" fixed fab bottom right small>
        <v-icon color="grey darken-4" small>mdi-sort</v-icon>
      </v-btn>
      <v-bottom-sheet v-model="sheet" width="100%">
        <v-sheet>
          <v-container>
            <p class="text-subtitle-1">Urutkan</p>
            <PriceFilter />
          </v-container>
        </v-sheet>
      </v-bottom-sheet>
    </v-col>

    <v-col>
      <v-row dense>
        <v-col cols="12">
          <h2 class="text-subtitle-1 text-md-h5">Kamar Tersedia</h2>
        </v-col>

        <v-col v-for="(roomType, index) in roomTypes.roomTypes" :key="index" cols="12">
          <Link class="text-decoration-none" href="/room-detail">
            <Room :roomType="roomType" />
          </Link>
        </v-col>
      </v-row>
    </v-col>
  </v-row>
</template>
