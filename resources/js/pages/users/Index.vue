<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { EyeIcon, SquarePenIcon, Trash2, UserRound, UserRoundPlusIcon } from '@lucide/vue';

const props = defineProps<{
    users: {
        data: Array<{
            id: number;
            name: string;
            email: string;
        }>
    }
}>();


</script>

<template>
    <Head title="Usuários" />
    <div class="container mx-auto py-8">
        <div class="flex items-center justify-between p-4 bg-sidebar rounded-lg shadow-sm border border-gray-100">            
            <h1 class="text-2xl font-bold mb-4">Lista de Usuários</h1>
            <div class="inline-flex items-center justify-center bg-blue-500 text-white text-sm px-4 py-2 rounded hover:bg-blue-600 mb-4">
                <Link href="/users/create" class="inline-flex items-center"><UserRoundPlusIcon class="mr-1 h-4 w-4" /> Adicionar Usuário</Link>
            </div>
      </div>
        
        <table class="min-w-full bg-white border border-gray-700 shadow-lg rounded-l-lg rounded-r-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-50 text-gray-700 text-left">    
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Nome</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in props.users.data" :key="user.id" class="bg-gray-50 text-gray-700 odd:bg-white even:bg-gray-100 hover:bg-gray-200 dark:odd:bg-white dark:even:bg-gray-200 dark:hover:bg-gray-300 transition-colors">
                    <td class="py-2 px-4 border-b">{{ user.id }}</td>
                    <td class="py-2 px-4 border-b">{{ user.name }}</td>
                    <td class="py-2 px-4 border-b">{{ user.email }}</td>
                    <td class="py-2 px-4 border-b text-center">
                        <button class="inline-flex items-center bg-blue-500 text-white text-sm px-4 py-2 rounded hover:bg-blue-600"><SquarePenIcon class="mr-1 h-4 w-4"/> 
                            <Link :href="`/users/edit/${user.id}`" > Editar</Link>
                        </button>
                        <button class="inline-flex items-center bg-red-500 text-white text-sm px-4 py-2 rounded hover:bg-red-600 ml-1"><Trash2 class="mr-1 h-4 w-4"/> Excluir</button>
                        <button class="inline-flex items-center bg-emerald-600 text-white text-sm px-4 py-2 rounded hover:bg-emerald-800 ml-1"><EyeIcon class="mr-1 h-4 w-4"/> 
                            <Link :href="`/users/show/${user.id}`" > Visualizar</Link>                        
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
     
</template>