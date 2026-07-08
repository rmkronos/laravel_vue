<script setup lang="ts">
import ButtonDelete from '@/components/ButtonDelete.vue';
import FlashMessage from '@/components/FlashMessage.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { EyeIcon, FileDownIcon, FileIcon, SquarePenIcon, UserRoundPlusIcon } from '@lucide/vue';
import { ref, watch } from 'vue';

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
    },
    filters: {
        search: string;
    }
}>();

//Função para buscar usuários com base na pesquisa
const searchQuery = ref(props.filters.search || '');
const isLoading = ref(false);
let debounceTimeout: ReturnType<typeof setTimeout> | null = null;

const performSearch = (value) => {
    // isLoading.value = true;
    router.get('/users', { search: value }, {
        preserveState: true,
        replace: true,
        only: ['users'],
        onStart: () => {
            isLoading.value = true;
        },        
        onSuccess: () => {
            isLoading.value = false;
        },
        onError: () => {
            isLoading.value = false;
        },
        onFinish: () => {
            isLoading.value = false;
        }
    });
};


// Monitoramento reativo do input com implementação nativa de Debounce
watch(searchQuery, (newValue) => {
  // Limpa o temporizador anterior se o usuário continuar digitando antes dos 300ms
  if (debounceTimeout) {
    clearTimeout(debounceTimeout);
  }

  // Define o novo debounce para proteger a infraestrutura de sobrecarga
  debounceTimeout = setTimeout(() => {
    performSearch(newValue);
  }, 300);
});


// const exportData = (format) => {
// const baseUrl = format === 'csv' ? router.get('/users/exportcsv') : router.get('/users/exportpdf');
// const params = new URLSearchParams({ search: searchQuery.value }).toString();
  
//   // Executa o download nativo via browser passando o filtro atual do input
// window.location.href = `${baseUrl}?${params}`;
// }

//Função para deletar usuário sem o uso do componente ButtonDelete.vue
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
            <div class="flex gap-2 justify-center">
                <div class="inline-flex items-center justify-center bg-blue-500 text-white text-sm px-4 py-2 rounded hover:bg-blue-600 mb-4">
                    <Link href="/users/create" class="inline-flex items-center"><UserRoundPlusIcon class="mr-1 h-4 w-4" /> Adicionar Usuário</Link>
                </div>
                <a
                    :href="`/users/exportcsv?search=${searchQuery}`"                    
                    class="inline-flex items-center px-4 py-2 mb-4 bg-green-600 hover:bg-green-700 text-white text-sm rounded transition-colors focus:outline-none focus:ring-2 focus:ring-green-500"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <FileDownIcon class="w-4 h-4 mr-2" />
                CSV
                </a>

                <a
                    :href="`/users/exportpdf?search=${searchQuery}`"
                    class="inline-flex items-center px-4 py-2 mb-4 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-red-500"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <FileIcon class="w-4 h-4 mr-2" />
                PDF
                </a>
            </div>
      </div>
      <div class="flex items-center justify-between p-4 bg-sidebar rounded-lg shadow-sm border border-gray-100 mb-4">
        <input
          v-model="searchQuery"
          type="text"
          placeholder="Pesquisar por nome ou e-mail..."
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm transition-all"
        />
      </div>

     <div 
      v-if="isLoading" 
      class="flex items-center justify-center p-8 bg-gray-50 border border-dashed border-gray-200 rounded-lg mb-6 transition-opacity duration-200"
    >
      <svg class="animate-spin h-5 w-5 text-blue-600 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
      </svg>
      <span class="text-sm font-medium text-gray-600">Aguarde enquanto estou trabalhando...</span>
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
                    <td class="border-b text-center">
                        <button class="inline-flex items-center bg-amber-400 text-white text-sm px-4 py-2 rounded hover:bg-amber-600"><SquarePenIcon class="mr-1 h-4 w-4"/> 
                            <Link :href="`/users/edit/${user.id}`" > Editar</Link>
                        </button>

                        <!-- <button class="inline-flex items-center bg-red-500 text-white text-sm px-4 py-2 rounded hover:bg-red-600 ml-1"
                        @click="deleteUser(user.id)"
                        >
                            <Trash2 class="mr-1 h-4 w-4"/> Excluir
                        </button> -->
                        <ButtonDelete :url="`/users/delete/${user.id}`" title="Tem certeza que deseja excluir este usuário?" class="ml-1" /> 

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