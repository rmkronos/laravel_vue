<script setup lang="ts">

// const props = defineProps<{
//     user: {
//         data: Array<{
//             id: number;
//             name: string;
//             email: string;
//         }>
//     }
// }>();

   
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


console.log(props.user.name);

</script>

<template>
  <div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Visualizar Usuário</h1>
    <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
      <div><span class="text-bold text-gray-500">Código:</span> <span class="text-gray-700">{{ props.user.id  }}</span></div>      
      <div><span class="text-bold text-gray-500">Nome:</span> <span class="text-gray-700">{{ props.user.name }}</span></div>
      <div><span class="text-bold text-gray-400">Email:</span> <span class="text-gray-700">{{ props.user.email }}</span></div>
      <div><span class="text-bold text-gray-400">Data de Criação:</span> <span class="text-gray-700">{{ props.user.created_at }}</span></div>
      <div><span class="text-bold text-gray-400">Data de Atualização:</span> <span class="text-gray-700">{{ props.user.updated_at }}</span></div>
    </div>
  </div>
</template>