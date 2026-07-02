<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { List } from '@lucide/vue';

   
export interface User {
    id: number;
    name: string;
    email: string;
    created_at: string;
    updated_at: string;
}

const props = defineProps<{
    user: User; 
    
}>();


</script>

<template>
  <div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Visualizar Usuário</h1>
    <div class="flex space-x-1">Listar</div>
    <div class="shadow-lg sm:rounded-b-lg p-4 border border-gray-200 text-gray-900 dark:text-gray-200 dark:border-gray-700 dark:border-2 dark:bg-sidebar">
      <p><span class="text-bold text-gray-500">Código:</span> <span class="dark:text-gray-100">{{ props.user.id  }}</span></p>      
      <div><span class="text-bold text-gray-500">Nome:</span> <span class="dark:text-gray-100">{{ props.user.name }}</span></div>
      <div><span class="text-bold text-gray-400">Email:</span> <span class="dark:text-gray-100">{{ props.user.email }}</span></div>
      <div><span class="text-bold text-gray-400">Data de Criação:</span> <span class="dark:text-gray-100">{{ new Date(props.user.created_at).toLocaleDateString() }}</span></div>
      <div><span class="text-bold text-gray-400">Data de Atualização:</span> <span class="dark:text-gray-100">{{ new Date(props.user.updated_at).toLocaleDateString() }}</span></div>     
    </div>
  </div>
</template>