<template>
        <div v-if="message" class="alert relative bg-green-100 text-green-800 my-6 p-2 text-center rounded-lg border-solid border border-green-400">
            {{ message }}
        <!-- <span class="absolute text-green-800 cursor-pointer top-0 right-1.5 hover:text-white" @click="$emit('close-toast')">X</span> -->
        </div>
</template>

<script>
export default {
    props: {
        message: String,
    },
    // emits: ['close-toast'],

}
</script>
