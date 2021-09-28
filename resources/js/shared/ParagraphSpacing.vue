<script>
import Paragraph from '@/shared/Paragraph.vue'

export default {
  props: {
    textLeft: String,
    textRight: String,
  },
  components: {
    Paragraph,
  },
}
</script>

<template>
  <v-row justify="space-between" align="center" dense>
    <v-col cols="auto">
      <Paragraph v-if="textLeft">{{ textLeft }}</Paragraph>
      <slot name="textLeft" />
    </v-col>
    <v-col cols="auto">
      <Paragraph v-if="textRight">{{ textRight }}</Paragraph>
      <slot name="textRight" />
    </v-col>
  </v-row>
</template>
