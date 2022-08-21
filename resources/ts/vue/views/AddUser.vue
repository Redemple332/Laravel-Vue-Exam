<template>
    
  <form class="border p-12 mx-80 mt-10">
        <p class="text-center text-xl mb-5">Add User Form</p>
    <div class="mb-6">
      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Full Name</label>
      <input v-model="data.name"  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
      <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{errors.name ? errors.name[0] : ''}}</span></p>
    </div>
    <div class="mb-6">
      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your email</label>
      <input  v-model="data.email" type="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="name@email.com">
      <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{errors.email ? errors.email[0] : ''}}</span></p>
    </div>
    <div class="mb-6">
      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your password</label>
      <input v-model="data.password" type="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
      <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{errors.password ? errors.password[0] : ''}}</span></p>
    </div>
    <div class="mb-6">
      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Confirm Your password</label>
      <input v-model="data.password_confirmation" type="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
    </div>
    
      <div class="mb-6">
        <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select Role</label>
        <select  v-model="data.role_id" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="">Select Role</option>
            <option v-for="role in roles" :key="role.id" :value="role.id">
              {{role.name}}
            </option>
        </select>
        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{errors.role_id ? errors.role_id[0] : ''}}</span></p>
      </div>
    
    <button @click.prevent="createUser" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
  </form>

</template>

<script lang="ts">
import axios from 'axios'
import { defineComponent, ref } from 'vue'
import router from '../../router'
import UserData from '../../services/UserData'
import RoleData from '../../services/RoleData'

export default defineComponent({

  setup() {
    const data = ref({
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      role_id: ''
    })

    const roles = ref<any>([])
    const errors = ref<any>([])
    
    return {
      roles, 
      data,
      errors
    }
  },
  methods: {
    async createUser(){
      await UserData.create(this.data)
      .then(response => {
        if(response.status == 200){
          router.push("/")
        }
      }).catch( error => {
        this.errors = error.response.data.errors; 
      })
    },
    async getRoles(){
      await RoleData.getAll().then( (res) => {
      this.roles =  res.data.roles
      this.data.role_id = ""
    })
    }
  },
  async created() {
    await this.getRoles()
  }
})
</script>
