<template>
        <h1>Update User</h1>
        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <user-form :userToUpdate="userToUpdate" @on-submit="submit" :roles="roles" :errors="$page.props.errors"/>
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
        userToUpdate: {
            type: Object,
            required: true,
        },
        roles: {
            type: Array,
            required: true,
        },
        errors: Object,
    },

    methods: {
        submit(user) {
            this.$inertia.patch(route('users.update', user), user)
        }
    },

}
</script>
