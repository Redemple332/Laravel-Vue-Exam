<template>
    <role-form :role="role"   @loadRole="refreshData"></role-form>
    <div class="overflow-x-auto relative m-10">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                       Name
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Description
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
          
            <tr v-for="role in roles"  :key="role.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <role @edit="editRole"  @loadRole="refreshData" :role="role"></role>
            </tr>
         
            </tbody>
        </table>
    </div>
</template>

<script lang="ts">
import Role from './Role.vue'
import RoleData from "../../services/RoleData";
import RoleForm from "./RoleForm.vue"
import { defineComponent, ref, } from 'vue'

export default defineComponent({

    setup() {
        const roles = ref<any[]>([])
        const role = ref<any>([])
        const id = ref<any>()
        
        return {roles,role, id}
    },
    components: {
        Role,
        RoleForm,
    },
    methods: {
        async getRoles(){
            await RoleData.getAll().then( (res) => {
                this.roles = res.data.roles
            })
        },
        async refreshData (event : string) {
           await this.getRoles()
        },
        async editRole(id : any){
           await RoleData.get(id).then( (res) => {
            this.role =  res.data.role
           })
        }
    },
    async created(){
       await this.getRoles()
    },
   emits: ["edit"]
    
})
</script>


