<script>
import { Head } from '@inertiajs/inertia-vue'

import Link from '@/shared/Link.vue'
import GuestLayout from '@/layouts/Guest.vue'
import Room from '@/components/Guest/Home/Room.vue'
import PriceFilter from '@/components/Guest/Home/PriceFilter.vue'

export default {
  layout: GuestLayout,
  props: {
    rooms: Object,
  },
  components: {
    Head,
    Link,
    Room,
    PriceFilter,
  },
  data() {
    return {
      current_page: this.rooms.current_page,
    }
  },
  methods: {
    next() {
      this.$inertia.get(this.rooms.next_page_url, '', { preserveScroll: true })
    },
    prev() {
      this.$inertia.get(this.rooms.prev_page_url, '', { preserveScroll: true })
    },
    input() {
      this.$inertia.get(`${this.rooms.path}/?page=${this.current_page}`, '', { preserveScroll: true })
    },
  },
}
</script>

<template>
  <div>
    <Head title="Halaman Utama" />

    <v-row dense>
      <v-col>
        <v-row dense>
          <v-col cols="12">
            <h2 class="text-subtitle-1 text-md-h5">Kamar Tersedia</h2>
          </v-col>

          <v-col v-for="(roomType, index) in rooms.data" :key="index" cols="12">
            <Link :href="$route('room-detail.show', roomType.id)">
              <Room :roomType="roomType" />
            </Link>
          </v-col>

          <v-col cols="12">
            <v-pagination
              v-model="current_page"
              :length="rooms.last_page"
              :total-visible="rooms.per_page"
              @input="input()"
              @next="next()"
              @previous="prev()"
              color="orange lighten-2 grey--text text--darken-4"
              circle
            />
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </div>
</template>
