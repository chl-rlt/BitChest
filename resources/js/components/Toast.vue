<template>
        <div v-if="message" class="alert relative my-6 p-2 text-center rounded-lg border-solid border mx-10 cursor-pointer"
        :class="[message.status == 'error' ? 'bg-red-100 text-red-800 border-red-400' : 'bg-green-100 text-green-800 border-green-400']"
        @click="()=>$emit('close-toast')">
            {{ message.message }}
        </div>
</template>

<script>
export default {
    props: {
        message: Object,
    },
    emits: ['close-toast'],

    mounted() {
        setTimeout(()=> this.$emit('close-toast', false) , 5000)
    },

}
</script>