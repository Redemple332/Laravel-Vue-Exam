<template>
    <form class="my-20 mx-80 border">
      <div class="m-10">
        <div class="mb-6">
          <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your email</label>
          <input type="email" v-model="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@email.com">
          <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{errors.email}}</span></p>

        </div>
        <div class="mb-6">
          <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your password</label>
          <input type="password" v-model="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{errors.password}}</span></p>
        </div>
        <div class="flex items-start mb-6">
          <div class="flex items-center h-5">
            <input id="remember" type="checkbox" value="" class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800">
          </div>
          <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
        </div>
        <button @click.prevent="login" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
      </div>
    </form>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import axios from 'axios'
import router from '../../router'
export default defineComponent({
  name: "Login",
  setup() {
    const email = ref("")
    const password = ref("")
    const errors = ref([])
    return {email, password, errors}
  },

  methods: {
    login(){
        axios.post('/api/login', {
          email: this.email,
          password: this.password
        })
        .then(response => {
          if(response.status == 200){
            router.push("/")
          }
        }).catch( error => {
          this.errors = error.response.data.errors; // this should be errors.
        })
    }
  }
})
</script>
