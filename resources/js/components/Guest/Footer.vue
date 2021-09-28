<script>
import Paragraph from '@/shared/Paragraph.vue'

export default {
  components: {
    Paragraph,
  },
}
</script>

<template>
  <v-footer class="orange--text text--lighten-2 text-subtitle-2">
    <v-container class="footer">
      <v-row justify="center">
        <v-col cols="auto">
          <v-img
            :max-width="$vuetify.breakpoint.smAndDown ? '100' : '132'"
            src="/img/logo-title.webp"
            alt="Logo Semuwainn"
            contain
          />
        </v-col>
      </v-row>

      <v-row class="text-center text-caption text-md-body-2" justify="center" align="center">
        <v-col cols="12" md="auto">
          <Paragraph>Kontak Kami</Paragraph>
        </v-col>
        <v-col cols="auto">
          <v-row justify="center">
            <v-col cols="12" md="auto">
              <Paragraph>Whatsapp<span class="d-block">0858 1150 0888</span></Paragraph>
            </v-col>
            <v-col cols="12" md="auto">
              <Paragraph>Email<span class="d-block">semuwainn@gmail.com</span></Paragraph>
            </v-col>
            <v-col cols="12" md="auto">
              <Paragraph>Call Center<span class="d-block">0804 1500 878 (Indonesia only)</span></Paragraph>
            </v-col>
          </v-row>
        </v-col>
      </v-row>

      <v-row>
        <v-divider />
      </v-row>

      <v-row justify="center">
        <v-col cols="auto">
          <paragraph class="text-caption text-md-body-2">&copy;2021 - Semuwainn</paragraph>
        </v-col>
      </v-row>
    </v-container>
  </v-footer>
</template>

<style lang="scss">
.footer {
  max-width: 1180px;
}
</style>
