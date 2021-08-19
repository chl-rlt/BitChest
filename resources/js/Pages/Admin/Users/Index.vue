<template>
        <h1 class="text-2xl py-8 uppercase">Users</h1>
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
