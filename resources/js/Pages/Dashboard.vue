<template>
    <!-- <app-layout title="Dashboard"> -->
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template> -->
        <!-- <div class="">
            <Sidebar :user="user"/>
        </div> -->


        <div class="py-12 ">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                    <!-- <client v-if="user.role == 'client'"/> -->
                    <!-- <admin v-if="user.role == 'admin'" > -->
                        <!-- <slot></slot> -->
                    <!-- </admin> -->
                    Bonjour {{user.name}} 🙂 
                </div>
            </div>
        </div>
    <!-- </app-layout> -->
</template>

<script>
    // import AppLayout from '@/Layouts/AppLayout.vue'
    import Sidebar from '@/components/Sidebar.vue'
    import Client from '@/Pages/Client/Index.vue'
    import Admin from '@/Pages/Admin/Index.vue'
    import { computed } from 'vue'
    import { usePage } from '@inertiajs/inertia-vue3'


    export default {
        components: {
            // AppLayout,
            Sidebar,
            Client,
            Admin
        },
        setup() {
            const user = computed(()=> usePage().props.value.auth.user);
            return { user };
        }
    }
</script>
