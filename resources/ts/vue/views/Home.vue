<template>
    <login-name></login-name>
    <add-button></add-button>
    <users></users>
</template>

<script lang="ts">
import { defineComponent, ref } from "vue";
import Users from '../components/Users.vue'
import AddButton from "../components/AddButton.vue"
import LoginName from "../components/LoginName.vue"
export default defineComponent({

  components: {
    Users,
    AddButton,
    LoginName
  },

});
</script>
