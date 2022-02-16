<script>
import { mapState } from 'vuex'
import Navbar from '@/components/Guest/Navbar.vue'
import Footer from '@/components/Guest/Footer.vue'
import FlashMessage from '@/components/Shared/FlashMessage.vue'
import mixinFlashMessage from '@/mixins/flash-message'

export default {
  components: {
    Navbar,
    Footer,
    FlashMessage,
  },
  mixins: [mixinFlashMessage],
  watch: {
    roomCart: {
      handler(val, oldVal) {
        if (this.$page.props.flash.success) {
          return false
        }

        if (val.length < oldVal.length) {
          this.activeFlashMessage({ text: 'Ruangan berhasil dihapus' })
        } else {
          this.activeFlashMessage({ text: 'Ruagan berhasil ditambahkan', icon: 'mdi-cart' })
        }
      },
      deep: true,
    },
    serviceCart: {
      handler(val, oldVal) {
        if (!this.roomCart.length) {
          return false
        }

        if (val.length < oldVal.length) {
          this.activeFlashMessage({ text: 'Layanan berhasil dihapus' })
        } else {
          this.activeFlashMessage({ text: 'Layanan berhasil ditambahkan', icon: 'mdi-cart' })
        }
      },
      deep: true,
    },
    '$page.props.flash': {
      handler(flash) {
        if (flash.success) {
          this.activeFlashMessage({ text: flash.success })
        }

        if (flash.error) {
          this.activeFlashMessage({ text: flash.error })
        }
      },
      deep: true,
    },
  },
  computed: {
    ...mapState(['roomCart', 'serviceCart']),
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
