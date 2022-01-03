<script>
import { Head } from '@inertiajs/inertia-vue'
import GuestLayout from '@/layouts/Guest.vue'
import Room from '@/components/Guest/Room/RoomList.vue'

export default {
  layout: GuestLayout,
  props: {
    rooms: Object,
  },
  components: {
    Head,
    Room,
  },
}
</script>

<template>
  <div>
    <Head title="Halaman Utama" />

    <Room :rooms="rooms" />
  </div>
</template>
