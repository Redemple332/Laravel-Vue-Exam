<template>
    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
        {{role?.name}}
    </th>
    <td class="py-4 px-6">
        {{role?.description}}
    </td>
    <td class="py-4 px-6">
        {{new Date(role?.created_at).toLocaleString()}}
    </td>
    <td scope="col" class="py-3 px-6">
        <button @click="$emit('edit', role?.id)" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Edit</button>
        <button @click.prevent="deleteUser(role?.id)" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Delete</button>
    </td>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import RoleData from '../../services/RoleData'

export default defineComponent({
    props: {
        role: Object
    },
    setup(){
        const id = ref<number>()
        return {id}
    },
    methods: {
        async deleteUser(id:  string | number){
            if(confirm("Do you really want to delete?")){
                await RoleData.delete(id).then(res => {
                    if(res.status){
                        this.$emit('loadRole')
                    }
                }).catch( err => {
                    console.error(err)
                })
            }
        },
        
        
    },emits: ["loadRole", 'edit']
})
</script>
