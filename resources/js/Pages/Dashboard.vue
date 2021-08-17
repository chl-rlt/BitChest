<template>
    <app-layout title="Dashboard">
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template> -->
        <Sidebar :user="user"/>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <show-client v-if="user.role == 'client'"/>
                    <show-admin v-else-if="user.role == 'admin'"/>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Sidebar from '@/components/Sidebar.vue'
    import ShowClient from '@/Pages/Client/ShowClient.vue'
    import ShowAdmin from '@/Pages/Admin/Show.vue'
    import { computed } from 'vue'
    import { usePage } from '@inertiajs/inertia-vue3'


    export default {
        components: {
            AppLayout,
            Sidebar,
            ShowClient,
            ShowAdmin
        },
        setup() {
            const user = computed(()=> usePage().props.value.auth.user);
            return { user };
        }
    }
</script>
