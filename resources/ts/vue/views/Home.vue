<template>
    <add-button></add-button>
    <user-form></user-form>
    <users></users>
</template>

<script lang="ts">
import axios from "axios";
import { defineComponent, ref } from "vue";
import Users from '../components/Users.vue'
import AddButton from "../components/AddButton.vue"
import UserForm from "../components/UserForm.vue"

export default defineComponent({

  components: {
    Users,
    AddButton,
    UserForm
  },

});
</script>
