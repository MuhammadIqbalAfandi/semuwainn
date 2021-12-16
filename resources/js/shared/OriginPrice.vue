<script>
import Paragraph from '@/shared/Paragraph.vue'
import mixinHelper from '@/mixins/helpers'

export default {
  props: {
    price: [String, Number],
  },
  mixins: [mixinHelper],
  components: {
    Paragraph,
  },
}
</script>

<template>
  <Paragraph v-if="price" class="text-md-h5 text-body-2 red--text text--lighten-2">
    <span class="text-md-subtitle-2 text-caption">Rp</span> {{ currencyFormat(Number(price)) }}
  </Paragraph>
</template>
