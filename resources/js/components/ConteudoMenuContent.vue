<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import { FileSlidersIcon, ListTodo, LogOut, NewspaperIcon, NotebookPenIcon, Settings, TrophyIcon, UserRoundCog, UsersRound } from '@lucide/vue';
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
                <NotebookPenIcon class="mr-2 h-4 w-4" />
                Conteúdos
            </Link>
        </DropdownMenuItem>
        <DropdownMenuSeparator />
        <DropdownMenuItem :as-child="true">
            <Link class="block w-full cursor-pointer" href="#">
                <FileSlidersIcon class="mr-2 h-4 w-4" />
                Banners
            </Link>
        </DropdownMenuItem>
        <DropdownMenuSeparator />
        <DropdownMenuItem :as-child="true">
            <Link class="block w-full cursor-pointer" href="#">
                <NewspaperIcon class="mr-2 h-4 w-4" />
                Notícias
            </Link>
        </DropdownMenuItem>
        <DropdownMenuSeparator />
        <DropdownMenuItem :as-child="true">
            <Link class="block w-full cursor-pointer" href="#">
                <TrophyIcon class="mr-2 h-4 w-4" />
                Prêmio
            </Link>
        </DropdownMenuItem>
    </DropdownMenuGroup>
</template>
