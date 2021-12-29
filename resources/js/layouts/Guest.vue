<script>
import Navbar from '@/components/Guest/Navbar.vue'
import Footer from '@/components/Guest/Footer.vue'
import FlashMessage from '@/shared/FlashMessage.vue'

export default {
  components: {
    Navbar,
    Footer,
    FlashMessage,
  },
}
</script>

<template>
  <v-app>
    <Navbar />
    <FlashMessage />
    <v-main>
      <v-container class="guest" fluid>
        <slot />
      </v-container>
    </v-main>
    <Footer />
  </v-app>
</template>

<style lang="scss">
.guest {
  max-width: 1180px;
  padding-top: 77px;
}
</style>
