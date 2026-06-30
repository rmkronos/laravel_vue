<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    description: String,    
    titulo: String,
    user: Object,
});

 </script>
<template>
    
    <Head title="Minha Home" />
     
    
    <div class="text-center">                
        <h1 class="text-4xl text-gray-600  font-bold mb-4">{{ titulo }}</h1>
        <p class="text-lg text-gray-600">{{ description }}</p>
        <p class="text-lg text-gray-600">Usuário: {{ props.user[0].name }}</p>
        <p class="text-lg text-gray-600">Email: {{ user[0].email }}</p>
        <p class="text-lg text-gray-600">ID: {{ user[0].id }}</p>
    </div>

    

</template>