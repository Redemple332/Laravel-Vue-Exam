<template>
    <p class="text-4xl font-bold text-gray-900 mx-10 my-3">Hello! {{user.name}}</p>
</template>

<script lang="ts">
import axios from 'axios'
import { defineComponent, ref } from 'vue'

export default defineComponent({
    setup() {
        const user = ref<any[]>([])
        return {user}
    },
    async mounted(){
        await axios.get('api/user').then( (res) => {
        this.user = res.data
        })
    },
})
</script>
