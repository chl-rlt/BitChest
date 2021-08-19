<template>
        <h1>Update User</h1>
</template>

<script>

export default {
    components: {
    },
    props:{
        user: {
            type: Object,
            required: true,
        },
    },

    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                terms: false,
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        }
    }
}
</script>
