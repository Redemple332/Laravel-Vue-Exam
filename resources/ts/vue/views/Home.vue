<template>
  <h1>Home </h1>

</template>

<script lang="ts">
import { defineComponent, ref } from "vue";
export default defineComponent({
  setup() {
    const hello = ref("hello");
    return {
      hello,
    };
  },
});
</script>
