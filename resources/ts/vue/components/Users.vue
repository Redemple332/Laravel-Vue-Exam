<template>
    <div class="overflow-x-auto relative m-10">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Full Name
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Email
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Role
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Created
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Action
                    </th>
                </tr>
            </thead>

            <tbody>
          
            <tr v-for="user in users"  :key="user.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <user  @loadUser="refreshData" :user="user"></user>
            </tr>
         
            </tbody>
        </table>
    </div>
</template>

<script lang="ts">
import axios from 'axios'
import User from './User.vue'
import { defineComponent, ref } from 'vue'

export default defineComponent({

    setup() {
        const users = ref<any[]>([])
        return {users}
    },
    components: {
        User
    },
    methods: {
        async userData(){
            await  axios.get('api/users').then( (res) => {
                this.users = res.data.users
            })
        },
        async refreshData () {
           await  this.userData()
        }
    },
    async created(){
       await this.userData()
    }
})
</script>


