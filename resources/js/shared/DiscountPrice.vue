<script>
import Paragraph from '@/shared/Paragraph.vue'

export default {
  components: {
    Paragraph,
  },
  props: {
    price: String,
  },
}
</script>

<template>
  <Paragraph
    v-if="price"
    class="text-md-subtitle-2 text-caption text-decoration-line-through orange--text text--lighten-2"
  >
    <span class="text-caption">RP</span> {{ price }}
  </Paragraph>
</template>
