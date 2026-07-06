<script setup lang="ts">
import ButtonDelete from '@/components/ButtonDelete.vue';
import FlashMessage from '@/components/FlashMessage.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { EyeIcon, SquarePenIcon, Trash2, UserRoundPlusIcon } from '@lucide/vue';

const props = defineProps<{
    users: {
        data: {
            id: number;
            name: string;
            email: string;
        },
        links: {
            url: string | null;
            label: string;
            active: boolean;
        };
    }
}>();

const deleteUser = (userId: number) => {
    if (confirm('Tem certeza que deseja excluir este usuário?')) {
        // Enviar requisição para deletar o usuário
        // Você pode usar Inertia.post ou Inertia.delete aqui
        // Exemplo:
        // Inertia.delete(`/users/delete/${userId}`);
        router.delete(`/users/delete/${userId}`, {
            onSuccess: () => {
                // Ação após sucesso, como atualizar a lista de usuários
                console.log(`Usuário ${userId} deletado com sucesso.`);
            },
            onError: (errors) => {
                // Ação em caso de erro
                console.error('Erro ao deletar usuário:', errors);
            }
        });
    }
};

</script>

<template>
    <Head title="Usuários" />
    
    <div class="container mx-auto py-8">
        <FlashMessage />
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
                        <button class="inline-flex items-center bg-amber-400 text-white text-sm px-4 py-2 rounded hover:bg-amber-600"><SquarePenIcon class="mr-1 h-4 w-4"/> 
                            <Link :href="`/users/edit/${user.id}`" > Editar</Link>
                        </button>

                        <!-- <button class="inline-flex items-center bg-red-500 text-white text-sm px-4 py-2 rounded hover:bg-red-600 ml-1"
                        @click="deleteUser(user.id)"
                        >
                            <Trash2 class="mr-1 h-4 w-4"/> Excluir
                        </button> -->
                        <ButtonDelete :url="`/users/delete/${user.id}`" title="Tem certeza que deseja excluir este usuário?" /> 

                        <button class="inline-flex items-center bg-emerald-600 text-white text-sm px-4 py-2 rounded hover:bg-emerald-800 ml-1"><EyeIcon class="mr-1 h-4 w-4"/> 
                            <Link :href="`/users/show/${user.id}`" > Visualizar</Link>                        
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="flex gap-2 justify-center">
            
            <Link v-for="link in props.users.links" :key="link.url" :href="link.url ?? '' "
            class="text-sm my-2 px-3 py-1 border rounded" 
            :class="{'bg-gray-300 dark:bg-background font-bold': link.active, 
            'bg-gray-400 pointer-events-none': !link.url}">
                <span v-html="link.label"></span>
            </Link>           

        </div>
    </div>
 
</template>