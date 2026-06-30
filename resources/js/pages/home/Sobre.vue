<script setup lang="ts">
import { Head } from '@inertiajs/vue3';


const props = defineProps<{
    conteudo:String
}>();

</script>

<template>
    <Head title="Sobre a empresa" />
    <h1 class="text-4xl text-gray-600  font-bold mb-4">Sobre</h1>
    <p class="text-lg text-gray-600">{{ props.conteudo }}</p>
</template>