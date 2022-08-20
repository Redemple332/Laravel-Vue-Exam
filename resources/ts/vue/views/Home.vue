<template>
    <add-button></add-button>
    <users></users>
</template>

<script lang="ts">
import { defineComponent, ref } from "vue";
import Users from '../components/Users.vue'
import AddButton from "../components/AddButton.vue"

export default defineComponent({

  components: {
    Users,
    AddButton
  },

});
</script>
