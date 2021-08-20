<template>
    <back-button>Go back</back-button>
    {{  }}
    <div>
        <h1 class="uppercase">{{ userShown.name }}</h1>
        <img class="img-responsive img-rounded" :src="userShown.profile_photo_url" alt="User picture">
        <p>{{ userShown.email }}</p>
        <p>{{ role.name }}</p>
        <p>Join {{ userShown.created_at }}</p>
        <blue-button type="button"><Link :href="route('users.edit', userShown)">Modify</Link></blue-button>
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
