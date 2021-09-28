<template>
  <v-btn
    v-bind="$attrs"
    v-on="$listeners"
    color="orange lighten-2 grey--text text--darken-4"
    :small="$vuetify.breakpoint.smAndDown ? true : false"
    rounded
  >
    <template>
      <slot />
    </template>
  </v-btn>
</template>
