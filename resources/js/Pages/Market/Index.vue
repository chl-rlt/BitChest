<template>
        
        <div>
            <toast :message="$page.props.flash.message" />
            <h1 class="text-gray-800 text-3xl font-semibold py-5 uppercase">Markets</h1>
            <CryptoList :cryptos="cryptos" />
        </div>
</template>

<script>

import CryptoList from '@/components/CryptoList.vue';
import Toast from '@/components/Toast.vue'
export default {
    name: 'Markets',
    components: {
        CryptoList,
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
    
}
</script>