<script>
import Paragraph from '@/shared/Paragraph.vue'

export default {
  props: {
    icon: String,
    text: String,
    multiText: Array,
  },
  components: {
    Paragraph,
  },
}
</script>

<template>
  <Paragraph>
    <v-icon left small>{{ icon }}</v-icon>
    <span v-if="text">{{ text }}&nbsp;</span>
    <span v-for="(text, index) in multiText" :key="index">{{ text }}&nbsp;&nbsp;</span>
  </Paragraph>
</template>
