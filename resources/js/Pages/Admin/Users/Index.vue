<template>
        <h1 class="text-gray-800 text-3xl font-semibold uppercase pt-10 px-10 mb-5">Users</h1>
        <toast :message="$page.props.flash.message"/>
        <div>
            <Table :users="users"/>
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

}
</script>
