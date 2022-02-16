<script>
import Paragraph from '@/components/Shared/Paragraph.vue'

export default {
  props: {
    icon: String,
    warning: Boolean,
    text: String,
    multiText: Array,
  },
  components: {
    Paragraph,
  },
  computed: {
    warningText() {
      return this.warning ? 'orange--text text--lighten-2' : ''
    },
    warningIcon() {
      return this.warning ? 'orange lighten-2' : ''
    },
  },
}
</script>

<template>
  <Paragraph>
    <v-icon left small :color="warningIcon">{{ icon }}</v-icon>
    <span v-if="text" :class="warningText">{{ text }}&nbsp;</span>
    <span v-for="(text, index) in multiText" :key="index" :class="warningText">{{ text }}&nbsp;&nbsp;</span>
  </Paragraph>
</template>
