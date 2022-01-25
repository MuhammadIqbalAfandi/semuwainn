<script>
import { Head } from '@inertiajs/inertia-vue'
import GuestLayout from '@/layouts/Guest.vue'

export default {
  layout: GuestLayout,
  props: {
    policy: String,
  },
  components: {
    Head,
  },
}
</script>

<template>
  <div>
    <Head title="Halaman Kebijakan" />

    <article v-html="policy"></article>
  </div>
</template>

<style></style>
