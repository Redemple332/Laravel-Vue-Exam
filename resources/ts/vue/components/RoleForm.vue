<template>
     <form v-show="showAddRole" class="border p-12 mx-80 mt-10">
         
        <p class="text-center text-xl mb-5">Role Form</p>
        <div class="mb-6">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Role Name</label>
            <input v-model="data.name"  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{errors.name ? errors.name[0] : ''}}</span></p>
        </div>
        
        <div class="mb-6">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Description</label>
            <input v-model="data.description"  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{errors.name ? errors.description[0] : ''}}</span></p>
        </div>
    <button @click="createRole" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
    <button v-show="showCancel" @click="cancel" type="button" class="ml-20 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-blue-800">Cancel</button>
  </form>
  
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import RoleData from '../../services/RoleData';

export default defineComponent({


    props: {
        role: Object,
    },

    setup() {
        const data = {
            name: '',
            description : ''
        }
        const showAddRole = ref(true)
        const showCancel = ref(false)
        const errors = ref<any[]>([])
        const id = ref<any>()
        return {data, errors, showAddRole, showCancel, id}
    },
    methods: {

        async updateUser(id: string|number){
            await RoleData.update(id, this.data).then(response => {
                if(response.status == 200){
                alert('Role Updated Successfully Added.')
                }
            }).catch( error => {
                this.errors = error.response.data.errors; // this should be errors.
            })
        },
        async createRole(){

            if(this.showCancel){
                this.updateUser(this.id)
                this.cancel()
            }else{
                await RoleData.create(this.data)
                .then(response => {
                    if(response.status == 200){
                        this.data = {
                            name: '',
                            description : ''
                        }             
                    }
                }).catch( error => {
                    this.errors = error.response.data.errors; 
                })
            }
            this.$emit('loadRole')
        },
        cancel(){
            this.showCancel = false
            this.data = {
                name: '',
                description : ''
            }
        }
    },
     watch: { 
      	role: function(role) { // watch it
          this.id = role.id
          this.data = {
                name: role.name,
                description : role.description  
            }
            if(role){
                this.showCancel = true
            }
        }
      },
   emits: ["loadRole"]
})
</script>
