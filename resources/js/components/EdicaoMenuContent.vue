<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import { CheckCheckIcon, CheckIcon, FileSlidersIcon, ListTodo, LogOut, NewspaperIcon, NotebookPenIcon, Settings, TrophyIcon, UserRoundCog, UsersRound } from '@lucide/vue';
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
                <CheckIcon class="mr-2 h-4 w-4" />
                2026
            </Link>
        </DropdownMenuItem>
        <DropdownMenuSeparator />
        <DropdownMenuItem :as-child="true">
            <Link class="block w-full cursor-pointer" href="#">
                <CheckIcon class="mr-2 h-4 w-4" />
                2025
            </Link>
        </DropdownMenuItem>
        <DropdownMenuSeparator />
        <DropdownMenuItem :as-child="true">
            <Link class="block w-full cursor-pointer" href="#">
                <CheckIcon class="mr-2 h-4 w-4" />
                2024
            </Link>
        </DropdownMenuItem>
        <DropdownMenuSeparator />
        <DropdownMenuItem :as-child="true">
            <Link class="block w-full cursor-pointer" href="#">
                <CheckIcon class="mr-2 h-4 w-4" />
                2023
            </Link>
        </DropdownMenuItem>
        <DropdownMenuSeparator />
        <DropdownMenuItem :as-child="true">
            <Link class="block w-full cursor-pointer" href="#">
                <CheckIcon class="mr-2 h-4 w-4" />
                2022
            </Link>
        </DropdownMenuItem>
        <DropdownMenuSeparator />
        <DropdownMenuItem :as-child="true">
            <Link class="block w-full cursor-pointer" href="#">
                <CheckIcon class="mr-2 h-4 w-4" />
                2021
            </Link>
        </DropdownMenuItem>
        <DropdownMenuSeparator />
        <DropdownMenuItem :as-child="true">
            <Link class="block w-full cursor-pointer" href="#">
                <CheckIcon class="mr-2 h-4 w-4" />
                2020
            </Link>
        </DropdownMenuItem>
        <DropdownMenuSeparator />
        <DropdownMenuItem :as-child="true">
            <Link class="block w-full cursor-pointer" href="#">
                <CheckIcon class="mr-2 h-4 w-4" />
                2019
            </Link>
        </DropdownMenuItem>
        <DropdownMenuSeparator />
        <DropdownMenuItem :as-child="true">
            <Link class="block w-full cursor-pointer" href="#">
                <CheckIcon class="mr-2 h-4 w-4" />
                2018
            </Link>
        </DropdownMenuItem>
    </DropdownMenuGroup>
    <DropdownMenuSeparator />
        <DropdownMenuItem :as-child="true">
            <Link class="block w-full cursor-pointer" href="#">
                <CheckIcon class="mr-2 h-4 w-4" />
                2017
            </Link>
        </DropdownMenuItem>
</template>
