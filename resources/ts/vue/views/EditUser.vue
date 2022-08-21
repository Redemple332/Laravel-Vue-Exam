<template>
  <form class="border p-12 mx-80 mt-10">
        <p class="text-center text-xl mb-5">Edit User Form</p>
    <div class="mb-6">
      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Full Name</label>
      <input v-model="name"  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
      <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{errors.name ? errors.name[0] : ''}}</span></p>
    </div>
    <div class="mb-6">
      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your email</label>
      <input  v-model="email" type="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="name@email.com">
      <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{errors.email ? errors.email[0] : ''}}</span></p>
    </div>
    <div class="mb-6">
      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your password</label>
      <input v-model="password" type="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
      <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{errors.password ? errors.password[0] : ''}}</span></p>
    </div>
    <div class="mb-6">
      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Confirm Your password</label>
      <input v-model="password_confirmation" type="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
    </div>
    
      <div class="mb-6">
        <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select Role</label>
        <select  v-model="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="">Select Role</option>
            <option v-for="role in roles" :key="role.id" :value="role.id">
              {{role.name}}
            </option>
        </select>
        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{errors.role_id ? errors.role_id[0] : ''}}</span></p>
      </div>
    
    <button @click.prevent="updateUser(id)" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
  </form>
        
</template>

<script lang="ts">
import axios from 'axios'
import { defineComponent, ref } from 'vue'
import router from '../../router'


export default defineComponent({



  setup() {
    const roles = ref<any[]>([])
    const role = ref<string>()
    const name = ref<string>()
    const email = ref<string>()
    const password = ref<string | number>()
    const password_confirmation = ref<string | number>()
    const errors = ref<any>([])
    const user =  ref<any>()
    const id = ref<any>()
    return {
      roles, 
      role,
      email,
      password,
      password_confirmation,
      name,
      errors,
      user,
      id
    }
  },
  methods: {
    async updateUser(id: number){
      await axios.put(`/api/user/${id}`, {
        email: this.email,
        password: this.password,
        role_id: this.role,
        password_confirmation: this.password_confirmation,
        name : this.name,
      })
      .then(response => {
        if(response.status == 200){
          this.clearData()
          alert('User Updated Successfully Added.')
          router.push("/")
        }
      }).catch( error => {
        this.errors = error.response.data.errors; // this should be errors.
      })
    },
    clearData(){
      this.role = ""
      this.password = ""
      this.password_confirmation = ""
      this.role = ""
      this.name = ""
      this.email = ""
    },
    async getRoles(){
      await axios.get('http://127.0.0.1:8000/api/roles').then( (res) => {
      this.roles =  res.data.roles
    })
    },
    async getUser(){
      this.id = this.$route.params.id;
      await axios.get(`http://127.0.0.1:8000/api/user/edit/${this.id}`).then( (res) => {
      this.user =  res.data.user
      this.name = this.user.name
      this.email = this.user.email
      this.role = this.user.role_id
    })
    }
  },
  async created() {
    await this.getUser()
    await this.getRoles()
  },
 
})
</script>
