<script>
import Paragraph from '@/shared/Paragraph.vue'
import mixinsLogo from '@/mixins/logo'

export default {
  components: {
    Paragraph,
  },
  mixins: [mixinsLogo],
}
</script>

<template>
  <v-footer class="orange--text text--lighten-2 text-subtitle-2">
    <v-container class="footer" fluid>
      <v-row justify="center">
        <v-col cols="auto">
          <img height="90px" :src="logoTitle" alt="Logo Semuwainn" />
        </v-col>
      </v-row>

      <v-row class="text-center text-caption text-md-body-2" justify="center" align="center">
        <v-col cols="12" md="auto">
          <Paragraph>Kontak Kami</Paragraph>
        </v-col>

        <v-col cols="auto">
          <v-row justify="center">
            <v-col cols="12" md="auto">
              <Paragraph
                >Whatsapp<span class="d-block">{{ $page.props.footer.whatsapp }}</span></Paragraph
              >
            </v-col>

            <v-col cols="12" md="auto">
              <Paragraph
                >Email<span class="d-block">{{ $page.props.footer.email }}</span></Paragraph
              >
            </v-col>

            <v-col cols="12" md="auto">
              <Paragraph
                >Call Center<span class="d-block">{{ $page.props.footer.callCenter }}</span></Paragraph
              >
            </v-col>
          </v-row>
        </v-col>
      </v-row>

      <v-row>
        <v-divider />
      </v-row>

      <v-row justify="center">
        <v-col cols="auto">
          <paragraph class="text-caption text-md-body-2">{{ $page.props.footer.copyright }}</paragraph>
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
