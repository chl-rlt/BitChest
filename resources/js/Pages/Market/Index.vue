<template>
        
        <div>
            <toast :message="$page.props.flash.message" />
            <h1 class="text-gray-800 text-3xl font-semibold py-5 uppercase">Markets</h1>
            <CryptoList :cryptos="cryptos" />
        </div>
</template>

<script>

import CryptoList from '@/components/CryptoList.vue';
import Sidebar from '@/components/Sidebar.vue'
    import Client from '@/Pages/Client/Index.vue'
    import Admin from '@/Pages/Admin/Index.vue'
    import { computed } from 'vue'
    import { usePage } from '@inertiajs/inertia-vue3'
    import Toast from '@/components/Toast.vue'

export default {
    name: 'Markets',
    components: {
        CryptoList,
        Sidebar,
        Client,
        Admin,
        Toast
        
    },

    props: {
       markets: {
           type: Array
       },
       cryptos: {
           type: Array
       }
    },
    setup() {
            const user = computed(()=> usePage().props.value.auth.user);
            return { user };
        }
}
</script>
