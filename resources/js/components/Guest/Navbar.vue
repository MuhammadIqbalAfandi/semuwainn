<script>
import Link from '@/shared/Link.vue'

export default {
  components: {
    Link,
  },
}
</script>

<template>
  <nav>
    <v-app-bar height="85" fixed>
      <v-container class="navbar">
        <v-row align="center">
          <v-col cols="auto">
            <Link href="/">
              <v-row>
                <v-img
                  :max-width="$vuetify.breakpoint.smAndDown ? '54' : '64'"
                  position="left center"
                  src="/img/logo-no-title.webp"
                  alt="Semuwainn Logo"
                  contain
                />
                <h1 class="text-md-h5 text-subtitle-1 text-center ml-5">
                  Semuwainn <span class="text-md-body-2 text-caption d-block">Sentani</span>
                </h1>
              </v-row>
            </Link>
          </v-col>

          <v-spacer />

          <v-col cols="auto">
            <Link v-if="$page.url !== '/room-booking'" href="/room-booking">
              <v-badge content="2" color="orange lighten-2 grey--text text--darken-4" overlap>
                <v-btn icon :small="$vuetify.breakpoint.smAndDown">
                  <v-icon :small="$vuetify.breakpoint.smAndDown">mdi-cart</v-icon>
                </v-btn>
              </v-badge>
            </Link>
          </v-col>
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
