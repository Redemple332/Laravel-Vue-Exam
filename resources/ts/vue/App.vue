<template>
  <div class="l-page">
    <navbar></navbar>
    <div class="l-page__main">
      <router-view />
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import Navbar from './components/Navbar.vue'
export default defineComponent({
    component: { Navbar },
    setup() {
    },
    components: { Navbar }
})
</script>

<style>
/* .l-page__navbar a.router-link-exact-active {
  color: blueviolet;
} */
</style>