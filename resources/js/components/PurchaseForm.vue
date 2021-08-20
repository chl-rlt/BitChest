<template>
<div>
    <form @submit.prevent="onSubmit">
        <label for="quantity">Quantity : </label>
        <input type="number" v-model="purchase.quantity"  id="quantity" min="1">
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
    name: 'PurchaseForm',

    components: {
        BlueButton,
    },

    setup(){
      return {
        v$: useVuelidate()
      }
    },

    emits: ['on-submit'],

    props: {
        errors: {
            type: Object,
            default: null,
        },
    },

    data() {
        return {
            purchase: {
                id: '',
                quantity: '',
                market_id: '',
                user_id: ''

            }
        }
    },

     validations(){
        return {
            purchase :{
                quantity: {required},
                bought_at: { required},
                role_id : { required },
                market_id: {required}
            }
        }
    },

    methods: {
        onSubmit() {
            this.v$.$validate();
            if(this.v$.$error) return
            this.$emit('on-submit',this.purchase);
        }
    },



}
</script>

<style>

</style>
