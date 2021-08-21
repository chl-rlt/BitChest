<template>
<div>
    <form @submit.prevent="onSubmit">
        <label for="quantity">Quantity : </label>
        <input type="number" v-model="purchase.quantity"  id="quantity" min="1">
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
        }
    },

    data() {
        return {
            purchase: {
                quantity: '',
                market_id: this.market.id,
                user_id: this.user_id,
                bought_at: ''
            }
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
