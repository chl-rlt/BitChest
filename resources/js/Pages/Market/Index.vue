<template>
        <h1 class="text-2xl pt-8 uppercase">Markets</h1>
        <div>
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
