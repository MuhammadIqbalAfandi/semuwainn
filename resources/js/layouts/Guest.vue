<script>
import Navbar from '@/components/Guest/Navbar.vue'
import Footer from '@/components/Guest/Footer.vue'

export default {
  components: {
    Navbar,
    Footer,
  },
}
</script>

<template>
  <v-app>
    <Navbar />
    <v-main>
      <v-container class="guest">
        <slot />
      </v-container>
    </v-main>
    <Footer />
  </v-app>
</template>

<style lang="scss">
.guest {
  max-width: 1180px;
  padding-top: 95px;
}
</style>
