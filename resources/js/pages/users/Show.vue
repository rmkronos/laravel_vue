<script setup lang="ts">
import ButtonDelete from '@/components/ButtonDelete.vue';
import FlashMessage from '@/components/FlashMessage.vue';
import { Link } from '@inertiajs/vue3';
import {  CirclePlusIcon, List, SquarePenIcon, Trash2Icon } from '@lucide/vue';

   
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
    <FlashMessage />
    <div class="flex items-center justify-between p-4 bg-sidebar rounded-lg shadow-sm border border-gray-100">
      <h1 class="text-2xl font-bold mb-4">Visualizar Usuário</h1>
      <div class="flex gap-2 justify-center">
          <Link href="/users/create" class="inline-flex items-center bg-emerald-500 text-white text-sm px-4 py-2 rounded hover:bg-emerald-600 mb-4"><CirclePlusIcon class="mr-1 h-4 w-4" /> Adicionar</Link>
          <Link :href="`/users/edit/${user.id}`" class="inline-flex items-center bg-amber-500 text-white text-sm px-4 py-2 rounded hover:bg-amber-600 mb-4"><SquarePenIcon class="mr-1 h-4 w-4" /> Editar</Link>
          <!-- <Link :href="`/users/delete/${user.id}`" class="inline-flex items-center bg-red-500 text-white text-sm px-4 py-2 rounded hover:bg-red-600 mb-4"><Trash2Icon class="mr-1 h-4 w-4" /> Excluir</Link> -->
           <ButtonDelete :url="`/users/delete/${user.id}`" title="Tem certeza que deseja excluir este usuário?" /> 
          <Link href="/users" class="inline-flex items-center bg-blue-500 text-white text-sm px-4 py-2 rounded hover:bg-blue-600 mb-4"><List class="mr-1 h-4 w-4" /> Listar</Link>
      </div>
    </div>
    <div class="shadow-lg sm:rounded-b-lg p-4 border border-gray-200 text-gray-900 dark:text-gray-200 dark:border-gray-100 dark:border dark:bg-sidebar">
      <p><span class="text-bold text-gray-500">Código:</span> <span class="dark:text-gray-100">{{ props.user.id  }}</span></p>      
      <div><span class="text-bold text-gray-500">Nome:</span> <span class="dark:text-gray-100">{{ props.user.name }}</span></div>
      <div><span class="text-bold text-gray-500">Email:</span> <span class="dark:text-gray-100">{{ props.user.email }}</span></div>
      <div><span class="text-bold text-gray-500">Data de Criação:</span> <span class="dark:text-gray-100">{{ new Date(props.user.created_at).toLocaleDateString() }}</span></div>
      <div><span class="text-bold text-gray-500">Data de Atualização:</span> <span class="dark:text-gray-100">{{ new Date(props.user.updated_at).toLocaleDateString() }}</span></div>     
    </div>
  </div>
</template>