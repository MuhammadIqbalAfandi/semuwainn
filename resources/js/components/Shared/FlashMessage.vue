<script>
import { mapMutations, mapState } from 'vuex'
import Button from '@/components/Shared/Button.vue'

export default {
  components: {
    Button,
  },
  data() {
    return {
      snackbar: false,
    }
  },
  watch: {
    '$page.url': {
      handler() {
        this.snackbar = false
      },
    },
    flashMessage: {
      handler(v) {
        this.snackbar = v
      },
    },
  },
  computed: {
    ...mapState('flashMessage', ['flashMessage', 'flashText', 'flashIcon']),
  },
  methods: {
    ...mapMutations('flashMessage', ['hideFlashMessage', 'setIcon', 'setText']),
  },
}
</script>

<template>
  <v-snackbar v-model="snackbar" timeout="4000" app left>
    {{ flashText }}
    <v-icon small>{{ flashIcon }}</v-icon>

    <template #action="{ attrs }">
      <Button @click="hideFlashMessage" v-bind="attrs" icon small>
        <v-icon small>mdi-close</v-icon>
      </Button>
    </template>
  </v-snackbar>
</template>
