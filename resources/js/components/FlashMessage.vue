<script setup lang="ts">
import {usePage} from '@inertiajs/vue3';
import Swal from 'sweetalert2';

import {computed} from 'vue';


const page = usePage();

const success = computed(() => page.props.flash?.success);
const error = computed(() => page.props.flash?.error);
console.log('success',success);

const msgSuccess = (msg: string)=>{
    Swal.fire({          
        title: msg,
        icon: "success",
        draggable: true
    });
}

const msgError = (msg: string)=>{
    Swal.fire({
        title: msg,
        icon: "danger",
        draggable: true
    });
}

</script>

<template>
    <!-- <div class="mb-4">
        <div v-if="success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Sucesso!</strong>
            <span class="block sm:inline">{{ sucess }}</span>
        </div>
        <div v-if="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Erro!</strong>
            <span class="block sm:inline">{{ error }}</span>
        </div>
    </div> -->
       <div class="mb-4">
            <div v-if="success">
            {{ msgSuccess(`${success}`) }}
        </div>
        <div v-if="error">
            {{ msgError(`${error}`) }}
        </div>  
    </div> 
    
</template>