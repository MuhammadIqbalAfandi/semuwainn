<script>
import { Head } from '@inertiajs/inertia-vue'
import GuestLayout from '@/layouts/Guest.vue'
import RoomList from '@/components/Guest/Home/RoomList.vue'

export default {
  layout: GuestLayout,
  props: {
    rooms: Object,
  },
  components: {
    Head,
    RoomList,
  },
}
</script>

<template>
  <div>
    <Head title="Halaman Utama" />

    <RoomList :rooms="rooms" />
  </div>
</template>
