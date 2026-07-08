<script setup lang="ts">

import Swal from 'sweetalert2';
import { Trash2 } from '@lucide/vue';
import { router } from '@inertiajs/vue3';

interface Props {
    url:string;
    title?:string;
    buttonText?:string;
}

const props = defineProps<Props>();

const confirmDelete = () => {
    Swal.fire({
    title: props.title?? "Tem certeza que deseja excluir este registro?",
    text: "Essa ação não poderá ser desfeita!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: props.buttonText?? "Sim, excluir esse registro!",
    cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed){
            router.delete(props.url)        
        
        };
    });
};

</script>

<template>
    <button class="inline-flex items-center bg-red-500 text-white text-sm px-4 py-2 rounded hover:bg-red-600 mb-4"
        @click="confirmDelete()"
    >
        <Trash2 class="mr-1 h-4 w-4"/> <span>{{ buttonText?? 'Excluir'}}</span>

    </button>
</template>
