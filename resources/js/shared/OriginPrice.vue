<script>
import Paragraph from '@/shared/Paragraph.vue'
import mixinHelper from '@/mixins/helpers'

export default {
  props: {
    price: Number,
  },
  mixins: [mixinHelper],
  components: {
    Paragraph,
  },
}
</script>

<template>
  <Paragraph v-if="price" class="text-body-2 text-md-h5 red--text text--lighten-2">
    <span class="text-caption text-md-subtitle-2">Rp</span> {{ currencyFormat(price) }}
  </Paragraph>
</template>
