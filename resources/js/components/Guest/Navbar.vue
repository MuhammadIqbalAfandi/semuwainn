<script>
import { mapState } from 'vuex'
import Link from '@/shared/Link.vue'
import mixinsLogo from '@/mixins/logo'

export default {
  components: {
    Link,
  },
  mixins: [mixinsLogo],
  computed: {
    ...mapState(['roomCart']),
    hideCart() {
      return !this.$page.url.includes('/room-booking')
    },
  },
}
</script>

<template>
  <nav>
    <v-app-bar height="65" max-height="65" fixed>
      <v-container class="navbar" fluid>
        <v-row align="center">
          <img class="d-none d-md-block" :src="logo" alt="Semuwainn Logo" height="54px" />
          <Link href="/">
            <h1 class="text-subtitle-1 text-md-h5 text-center ml-5">
              Semuwainn <span class="text-caption text-md-body-2 d-block">Sentani</span>
            </h1>
          </Link>

          <v-spacer />

          <Link v-if="hideCart" :href="$route('room-booking.index')">
            <v-badge
              :content="roomCart.length"
              :value="roomCart.length"
              color="orange lighten-2 grey--text text--darken-4"
              overlap
            >
              <v-btn elevation="2" icon small>
                <v-icon small>mdi-cart</v-icon>
              </v-btn>
            </v-badge>
          </Link>
        </v-row>
      </v-container>
    </v-app-bar>
  </nav>
</template>

<style lang="scss">
.navbar {
  max-width: 1180px;
}
</style>
