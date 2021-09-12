<template>
    <back-button>Go back</back-button>

    <h1 class="text-gray-800 text-2xl font-semibold pt-1 px-10 mb-2">Update User</h1>
    <div class="">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="lg:mt-5 md:mt-0 md:col-span-2">
                <user-form :userToUpdate="userToUpdate" @on-submit="submit" :roles="roles" :errors="$page.props.errors"/>
            </div>
        </div>
    </div>
</template>

<script>
import UserForm from '@/components/UserForm.vue'
import BackButton from '@/components/BackButton.vue'

export default {
    components: {
        UserForm,
        BackButton,
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
            this.$inertia.post(route('users.update', user), {
                _method: 'patch',
                user
            })
        }
    },

}
</script>
