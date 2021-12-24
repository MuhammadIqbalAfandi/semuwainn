<script>
import { mapMutations, mapGetters } from 'vuex'
import Paragraph from '@/shared/Paragraph.vue'
import ParagraphSpacing from '@/shared/ParagraphSpacing.vue'
import Button from '@/shared/Button.vue'
import mixinHelpers from '@/mixins/helpers'

export default {
  props: {
    service: Object,
  },
  mixins: [mixinHelpers],
  components: {
    Paragraph,
    ParagraphSpacing,
    Button,
  },
  computed: {
    ...mapGetters(['getRoomCount']),
  },
  methods: {
    ...mapMutations(['removeServiceCart']),
  },
}
</script>

<template>
  <v-card hover>
    <v-card-text>
      <v-row no-gutters>
        <v-col cols="12">
          <Paragraph> {{ service.name }} </Paragraph>
        </v-col>

        <v-row dense>
          <v-col cols="auto">
            <Paragraph class="text-caption red--text text--lighten-2">
              <span class="text-caption">Rp</span> {{ currencyFormat(service.price) }}
            </Paragraph>
          </v-col>

          <v-col cols="auto">
            <Paragraph class="text-caption"> (x {{ getRoomCount }} kamar) </Paragraph>
          </v-col>
        </v-row>

        <v-spacer />

        <v-col cols="auto">
          <Button @click="removeServiceCart(service.id)" text x-small>Hapus</Button>
        </v-col>
      </v-row>

      <ParagraphSpacing>
        <template #textLeft> </template>

        <template #textRight> </template>
      </ParagraphSpacing>
    </v-card-text>
  </v-card>
</template>
