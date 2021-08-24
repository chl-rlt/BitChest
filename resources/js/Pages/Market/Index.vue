<template>
        
        <div>
            <h1 class="text-3xl pt-10 uppercase font-bold ">Markets</h1>
            <CryptoList :cryptos="cryptos" />
        </div>
</template>

<script>

import CryptoList from '@/components/CryptoList.vue';
export default {
    name: 'Markets',
    components: {
        CryptoList
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
