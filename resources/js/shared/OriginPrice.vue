<script>
import Paragraph from '@/shared/Paragraph.vue'

export default {
  props: {
    price: String,
  },
  components: {
    Paragraph,
  },
}
</script>

<template>
  <Paragraph v-if="price" class="text-md-h5 text-body-2 red--text text--lighten-2">
    <span class="text-md-subtitle-2 text-caption">Rp</span> {{ price }}
  </Paragraph>
</template>
