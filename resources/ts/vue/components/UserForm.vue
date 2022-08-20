<template>
  
  <form class="mx-80 border p-12">
    <div class="mb-6">
      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Full Name</label>
      <input v-model="name"  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="name@flowbite.com">
    </div>
    <div class="mb-6">
      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your email</label>
      <input  v-model="email" type="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="name@flowbite.com">
    </div>
    <div class="mb-6">
      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your password</label>
      <input v-model="password" type="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
      <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> Username already taken!</p>
    </div>
    <div class="mb-6">
      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Confirm Your password</label>
      <input v-model="password_confirmation" type="password_confirmation" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
      <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> Username already taken!</p>
    </div>
    
      <div class="mb-6">
          <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select Role</label>
          <select  v-model="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
              <option selected>Chosen Role</option>
              <option v-for="role in roles" :key="role.id" :value="role.id">
                {{role.name}}
              </option>
          </select>
      </div>

    <button @click.prevent="createUser" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register new account</button>
  </form>

</template>

<script lang="ts">
import axios from 'axios'
import { defineComponent, ref } from 'vue'
import router from '../../router'

export default defineComponent({
  setup() {
    const roles = ref<any[]>([])
    const role = ref<number>(1)
    const name = ref<string>()
    const email = ref<string>()
    const password = ref<string | number>()
    const password_confirmation = ref<string | number>()
    return {
      roles, 
      role,
      email,
      password,
      password_confirmation,
      name
    }
  },
  methods: {
    createUser(){
      axios.post('/api/user/store', {
        email: this.email,
        password: this.password,
        role_id: this.role,
        password_confirmation: this.password_confirmation,
        name : this.name,
      })
      .then(response => {
        if(response.status == 200){
          router.push("/")
        }
      }).catch( error => {
        // this.errors = error.response.data.errors; // this should be errors.
      })
    }
  },
  async created() {
    await  axios.get('api/roles').then( (res) => {
      this.roles = res.data.roles
    })
  }
})
</script>
