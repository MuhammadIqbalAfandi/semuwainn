<script>
import { mapActions } from 'vuex'

import ParagraphSpacing from '@/shared/ParagraphSpacing.vue'
import Paragraph from '@/shared/Paragraph.vue'
import Button from '@/shared/Button.vue'
import mixinHelpers from '@/mixins/helpers'

export default {
  props: {
    service: Object,
  },
  mixins: [mixinHelpers],
  components: {
    ParagraphSpacing,
    Paragraph,
    Button,
  },
  methods: {
    ...mapActions(['removeServiceCart']),
  },
}
</script>

<template>
  <v-card hover>
    <v-card-text>
      <ParagraphSpacing>
        <template #textLeft>
          <Paragraph> {{ service.name }} </Paragraph>
          <Paragraph class="text-caption red--text text--lighten-2">
            <span class="text-caption">Rp</span> {{ currencyFormat(service.price) }}
          </Paragraph>
        </template>

        <template #textRight>
          <Button @click="removeServiceCart(service.id)" text x-small>Hapus</Button>
        </template>
      </ParagraphSpacing>
    </v-card-text>
  </v-card>
</template>
