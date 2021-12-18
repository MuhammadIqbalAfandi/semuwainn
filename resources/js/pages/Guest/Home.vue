<script>
import { Head } from '@inertiajs/inertia-vue'

import GuestLayout from '@/layouts/Guest.vue'
import Room from '@/components/Guest/Home/Room.vue'

export default {
  layout: GuestLayout,
  props: {
    rooms: Object,
  },
  components: {
    Head,
    Room,
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

    <Room :rooms="rooms.data" />

    <v-row>
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
