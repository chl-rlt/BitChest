<template>
<p class="text-3xl font-semibold">{{ crypto?.name ?? market.name }}
    <span class="text-gray-500 mt-1.5 ml-1 text-xl font-light"> {{ crypto?.tag ?? market.tag }}</span>
</p>
<p class="text-gray-600 text-xl mt-3 font-normal">{{ market.price }} €</p>
<div>
    <form @submit.prevent="onSubmit" class="flex flex-col mt-4">
        <label for="quantity" class="text-gray-500 text-sm mb-2 " >Quantity:  </label>
        <input type="number" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md mb-5" v-model="purchase.quantity"  id="quantity" min="1">

        <div class="error" v-if="v$.purchase.quantity.$error || errors.name ">
                    <p class="text-sm">{{ v$.purchase.quantity.$error ? v$.purchase.quantity.$errors[0].$message : errors.name }}</p>
                </div>
        <blue-button>
            Buy
        </blue-button>
    </form>
</div>

</template>

<script>

import BlueButton from '@/components/BlueButton.vue'
import useVuelidate from '@vuelidate/core'
import { required } from '@vuelidate/validators'


export default {

    setup(){
      return {
        v$: useVuelidate()
      }
    },



    emits: ['on-submit'],

    name: 'PurchaseForm',

    components: {
        BlueButton,
    },


    props: {
        errors: {
            type: Object,
            default: null,
        },
        user_id: {
            type: Number,
            required:true,
        },
        market: {
            type: Object,
            required: true,
        },
        crypto: {
            type:Object,
            // required: true,
        }
    },

    data() {
        return {
            purchase: {
                quantity: '',
                market_id: this.market.id,
                user_id: this.user_id,
                bought_at: '',
                status: 'holding'
            },
        }
    },

     validations(){
        return {
            purchase :{
                quantity: {required},
            }

        }
    },

    methods: {
        onSubmit() {
            this.v$.$validate();
            if(this.v$.$error) return
            this.purchase['bought_at'] = Date.now();
            this.$emit('on-submit',this.purchase);
        }
    },



}
</script>

<style>

</style>
