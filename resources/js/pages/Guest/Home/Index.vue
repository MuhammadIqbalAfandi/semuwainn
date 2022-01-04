<script>
import { Head } from '@inertiajs/inertia-vue'
import GuestLayout from '@/layouts/Guest.vue'
import RoomList from '@/components/Guest/Home/RoomList.vue'
import Link from '@/shared/Link.vue'

export default {
  layout: GuestLayout,
  props: {
    rooms: Object,
  },
  components: {
    Head,
    RoomList,
    Link,
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
      <v-col cols="12">
        <h2 class="text-subtitle-1 text-md-h5">Kamar Tersedia</h2>
      </v-col>

      <v-col v-for="room in rooms.data" :key="room.id" cols="12">
        <Link :href="$route('room-details.show', room.id)">
          <RoomList :room="room" />
        </Link>
      </v-col>

      <v-col cols="12">
        <v-pagination
          v-model="current_page"
          :length="rooms.last_page"
          :total-visible="rooms.per_page"
          @input="input"
          @next="next"
          @previous="prev"
          color="orange lighten-2 grey--text text--darken-4"
          circle
        />
      </v-col>
    </v-row>
  </div>
</template>
