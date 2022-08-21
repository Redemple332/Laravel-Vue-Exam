<template>
    <login-name></login-name>
    <roles></roles>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import Roles from '../components/Roles.vue'
import LoginName from "../components/LoginName.vue"
export default defineComponent({

  components: {
    Roles,
    LoginName
  },

});
</script>
