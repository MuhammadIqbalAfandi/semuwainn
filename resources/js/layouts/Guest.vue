<script>
import { mapMutations, mapState } from 'vuex'
import Navbar from '@/components/Guest/Navbar.vue'
import Footer from '@/components/Guest/Footer.vue'
import FlashMessage from '@/shared/FlashMessage.vue'

export default {
  components: {
    Navbar,
    Footer,
    FlashMessage,
  },
  watch: {
    roomCart: {
      handler(val, oldVal) {
        if (val.length < oldVal.length) {
          this.hideFlashMessage()
          this.$nextTick(() => {
            this.setText({ text: 'Ruangan berhasil dihapus' })
            this.showFlashMessage()
          })
        } else {
          this.hideFlashMessage()
          this.$nextTick(() => {
            this.setText({ text: 'Ruagan berhasil ditambahkan', icon: 'mdi-cart' })
            this.showFlashMessage()
          })
        }
      },
      deep: true,
    },
    serviceCart: {
      handler(val, oldVal) {
        if (val.length < oldVal.length) {
          this.hideFlashMessage()
          this.$nextTick(() => {
            this.setText({ text: 'Layanan berhasil dihapus' })
            this.showFlashMessage()
          })
        } else {
          this.hideFlashMessage()
          this.$nextTick(() => {
            this.setText({ text: 'Layanan berhasil ditambahkan', icon: 'mdi-cart' })
            this.showFlashMessage()
          })
        }
      },
      deep: true,
    },
    '$page.props.flash': {
      handler(flash) {
        if (flash.success) {
          this.hideFlashMessage()
          this.$nextTick(() => {
            this.setText({ text })
            this.showFlashMessage()
          })
        }

        if (flash.error) {
          this.hideFlashMessage()
          this.$nextTick(() => {
            this.setText({ text })
            this.showFlashMessage()
          })
        }
      },
      deep: true,
    },
  },
  computed: {
    ...mapState(['roomCart', 'serviceCart']),
  },
  methods: {
    ...mapMutations('flashMessage', ['hideFlashMessage', 'showFlashMessage', 'setText']),
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
