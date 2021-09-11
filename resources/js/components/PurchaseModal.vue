<template>
<div>
    <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" id="myModal" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
             <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="">
                                <div class="flex">
                                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-gray-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-2 lg:ml-3 ml-1" id="modal-title">
                                    Purchase
                                </h3>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    
                                    <div class="mt-2">
                                    <purchase-form  @on-submit="submit" :purchases="purchases" :market="lasts_markets(crypto_id, initial_latest_markets)" :errors="$page.props.errors" :user_id="user.id" class="-ml-3" />
                                    <button type="button" @click="close" class="py-2.5 mt-5 inline-flex justify-center rounded-md border border-gray-300 shadow-sm bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-3 sm:text-sm sm:px-auto lg:pl-48 lg:pr-52 lg:ml-1 px-auto">
                                    Cancel
                                    </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
        </div>
        <!-- {{lasts_markets(crypto_id, initial_latest_markets)}} -->

</template>

<script>
import BlueButton from '@/components/BlueButton.vue'
import PurchaseForm from '@/components/PurchaseForm.vue';
import { mapGetters, mapState } from 'vuex'

export default {
    name: 'PurchaseModal',

    components: {
        BlueButton,
        PurchaseForm
    },

    emits:['purchase_confirmation', 'close'],

    props: {

        initial_latest_markets: {
          type: Array,
        },

        cryptoShow: {
            type: Object,
        },

        markets: {
            type: Array,
        },

        purchases: {
            type: Array,
        },

        crypto_id: {
            type:Number,
        },

        user: Object,

    },

    computed: {
        ...mapGetters('markets', {
            lasts_markets : 'lastCryptoMarket'
        })
    },

    methods: {
        submit(purchase) {
            this.$inertia.post(route('wallet.buy'), purchase);
            this.close()
        },

        close(){
            this.$emit('close');
        },
    },

}
</script>

<style>

</style>
