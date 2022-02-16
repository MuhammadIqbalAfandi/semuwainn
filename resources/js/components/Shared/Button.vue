<template>
  <v-btn v-bind="$attrs" v-on="$listeners" color="orange lighten-2 grey--text text--darken-4" rounded>
    <template>
      <slot />
    </template>
  </v-btn>
</template>
