<script>
import { Head } from '@inertiajs/inertia-vue'
import GuestLayout from '@/layouts/Guest.vue'

export default {
  layout: GuestLayout,
  props: {
    privacy: String,
  },
  components: {
    Head,
  },
}
</script>

<template>
  <div>
    <Head title="Halaman Privasi" />

    <article v-html="privacy"></article>
  </div>
</template>

<style></style>
