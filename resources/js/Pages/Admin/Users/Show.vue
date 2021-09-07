<template>
    <back-button> Go back</back-button>
    {{}}
    <div class="max-w-md py-4 px-10 ml-10 mr-5 bg-white shadow-lg rounded-lg my-20">
        <div class="flex justify-center md:justify-end -mt-16">
            <img class="w-20 h-20 object-cover rounded-full border-2 border-indigo-500" :src="userShown.profile_photo_path ?? userShown.profile_photo_url " alt="User picture">
        </div>
        <div>
            <h2 class="text-gray-800 text-2xl uppercase font-semibold">{{ userShown.name }}</h2>
            <p class="mt-2 text-gray-600">{{ userShown.email }}</p>
            <p class="mt-2 text-gray-600"> Role : {{ role.name }}</p>
            <p class="mt-2 text-gray-600"> Join {{ userShown.created_at }}</p>
        </div>
        <div class="flex justify-end">
            <blue-button class="mt-4 mb-2 text-sm bg-white font-medium text-white-500" type="button"><Link :href="route('users.edit', userShown)">Modify</Link></blue-button>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import BlueButton from '@/components/BlueButton.vue'
import BackButton from '@/components/BackButton.vue'

export default {
    components: {
        Link,
        BlueButton,
        BackButton
    },
    props: {
        userShown: {
            type: Object,
            required: true,
        },
        role: {
            type: Object,
            required: true,
        },
    },
}
</script>
