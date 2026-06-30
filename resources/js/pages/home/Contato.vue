<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

const props = defineProps<{
    conteudo:String,
    celular: String,
    endereco: String,
    cidade: String
}>();

</script>

<template>
    <Head title="Contato" />
    <h1 class="text-4xl text-gray-600 font-bold mb-4">Contato</h1>
    <p class="text-lg text-gray-600">{{ props.conteudo }}</p>
    <div>
        <p class="text-lg text-gray-600">Celular: {{ props.celular }}</p>
        <p class="text-lg text-gray-600">Endereço: {{ props.endereco }}</p>
        <p class="text-lg text-gray-600">Cidade: {{ props.cidade }}</p>
    </div>
    
</template>

