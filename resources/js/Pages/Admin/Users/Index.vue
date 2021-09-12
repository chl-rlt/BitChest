<template>
    <div>
        <h1 class="text-gray-800 text-3xl font-semibold uppercase pt-10 px-10 mb-5">Users</h1>
        <toast :message="$page.props.flash.message" v-if="showToast" @close-toast="closeToast"/>
        <div>
            <Table :users="users"/>
        </div>
    </div>
</template>

<script>
import Table from '@/components/Table.vue'
import Toast from '@/components/Toast.vue'

export default {
    name: 'Users',
    components: {
        Table,
        Toast
    },
    props: {
       users: {
           type: Array
       }
    },
    computed: {
        showToast() {
            return this.$page.props.flash.message ? true : false
        }
    },

    methods: {
        closeToast() {
            this.$page.props.flash.message = null
        }
    },

}
</script>
