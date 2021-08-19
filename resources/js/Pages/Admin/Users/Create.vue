<template>
    <h1 class="text-2xl py-8 uppercase">Create new user</h1>
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <user-form @on-submit="submit" :roles="roles" :errors="$page.props.errors"/>
            </div>
        </div>
    </div>
</template>

<script>
import UserForm from '@/components/UserForm.vue'

export default {
    components: {
        UserForm,
    },
    props:{
        roles: {
            type:Array
        },
        errors: Object,
    },
    methods: {
        submit(user) {
            this.$inertia.post(route('users.store'), user);
        }
    },

}
</script>
