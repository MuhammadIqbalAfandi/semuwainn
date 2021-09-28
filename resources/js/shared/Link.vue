<script>
import { Link } from '@inertiajs/inertia-vue'

export default {
  components: {
    Link,
  },
}
</script>

<template>
  <Link v-bind="$attrs" class="text-decoration-none orange--text text--lighten-2"><slot /></Link>
</template>
