<script>
export default {
  props: {
    discount: Number,
  },
}
</script>

<template>
  <v-chip
    v-bind="$attrs"
    v-on="$listeners"
    v-if="discount"
    color="red lighten-2 text-caption text-md-body-2"
    :x-small="$vuetify.breakpoint.smAndDown"
    md
  >
    <span>Hemat&nbsp;</span>
    <span>{{ discount }}%</span>
  </v-chip>
</template>
