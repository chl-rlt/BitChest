<template>
        <div v-if="message" class="alert relative my-6 p-2 text-center rounded-lg border-solid border mx-10"
        :class="[message.status == 'error' ? 'bg-red-100 text-red-800 border-red-400' : 'bg-green-100 text-green-800 border-green-400']">
            {{ message.message }}
        <!-- <span class="absolute text-green-800 cursor-pointer top-0 right-1.5 hover:text-white" @click="$emit('close-toast')">X</span> -->
        </div>
</template>

<script>
export default {
    props: {
        message: Object,
    },
    // emits: ['close-toast'],

}
</script>
