<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';
import { List, SavePlusIcon } from '@lucide/vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submitForm = () => {
    form.post('/users/store', {
        onSuccess: () => {
            alert('Usuário cadastrado com sucesso!');
            form.reset();
        },
        onError: (errors) => {
            // Handle validation errors
            console.log(errors);
        },
    });
};


</script>

<template>
  <div class="container mx-auto py-8">
    <div class="flex items-center justify-between p-4 bg-sidebar rounded-lg shadow-sm border border-gray-100">
      <h1 class="text-2xl font-bold mb-4">Cadastrar Usuário</h1>
      <div class="inline-flex items-center justify-center bg-blue-500 text-white text-sm px-4 py-2 rounded hover:bg-blue-600 mb-4">
          <Link href="/users" class="inline-flex items-center"><List class="mr-1 h-4 w-4" /> Listar</Link>
      </div>
    </div>
    <div class="shadow-lg sm:rounded-b-lg p-4 border border-gray-200 text-gray-900 dark:text-gray-200 dark:border-gray-100 dark:border dark:bg-sidebar">

        <form action="/users/store" method="post" @submit.prevent="submitForm">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Nome:</label>
                <input type="text" id="name" name="name" 
                v-model="form.name" 
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500 dark:bg-sidebar dark:text-gray-200 dark:border-gray-700" 
                required/>   
                <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">
                    {{ form.errors.name }}
                </div>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Email:</label>
                <input type="email" id="email" name="email" 
                v-model="form.email"
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500 dark:bg-sidebar dark:text-gray-200 dark:border-gray-700" 
                required/>
                <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">
                    {{ form.errors.email }}
                </div>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Senha:</label>
                <input type="password" id="password" name="password" 
                v-model="form.password"
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500 dark:bg-sidebar dark:text-gray-200 dark:border-gray-700" 
                required/>
            </div>
            <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">
                {{ form.errors.password }}
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Confirmar Senha:</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                v-model="form.password_confirmation"
                 class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500 dark:bg-sidebar dark:text-gray-200 dark:border-gray-700" 
                 required/>
            </div>
            <div v-if="form.errors.password_confirmation" class="text-red-500 text-sm mt-1">
                {{ form.errors.password_confirmation }}
            </div>

            <div class="flex justify-center">
                <button type="submit" class="inline-flex items-center justify-center bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    <SavePlusIcon class="mr-1 h-4 w-4" />
                    <span>{{form.processing?'Salvando...':'Cadastrar'}}</span>                    
                </button>
            </div>


        </form>
     
    </div>
  </div>
</template>