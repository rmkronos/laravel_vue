<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import { CalendarClock, ListCheckIcon, ListTodo, LogOut, Settings, UserRoundCog, UsersRound } from '@lucide/vue';
import {
    DropdownMenuGroup,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
} from '@/components/ui/dropdown-menu';
import UserInfo from '@/components/UserInfo.vue';
import { logout } from '@/routes';
import { edit } from '@/routes/profile';
import type { User } from '@/types';


</script>

<template>             
    <DropdownMenuGroup>
        <DropdownMenuItem :as-child="true">
            <Link class="block w-full cursor-pointer" href="#">
                <CalendarClock class="mr-2 h-4 w-4" />
                Fases do prêmio
            </Link>
        </DropdownMenuItem>
        <DropdownMenuSeparator />
        <DropdownMenuItem :as-child="true">
            <Link class="block w-full cursor-pointer" href="#">
                <ListCheckIcon class="mr-2 h-4 w-4" />
                Categorias
            </Link>
        </DropdownMenuItem>
        <DropdownMenuSeparator />
        <DropdownMenuItem :as-child="true">
            <Link class="block w-full cursor-pointer" href="#">
                <ListTodo class="mr-2 h-4 w-4" />
                Tipos 
            </Link>
        </DropdownMenuItem>
        <DropdownMenuSeparator />
        <DropdownMenuItem :as-child="true">
            <Link class="block w-full cursor-pointer" href="#">
                <UsersRound class="mr-2 h-4 w-4" />
                Usuários e Jurados 
            </Link>
        </DropdownMenuItem>
    </DropdownMenuGroup>
</template>
