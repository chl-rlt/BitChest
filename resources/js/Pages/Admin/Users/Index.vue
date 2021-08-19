<template>
        <h1 class="text-2xl py-8 uppercase">Users</h1>

        <div>
            <Table :users="users"/>
        </div>
</template>

<script>
import Table from '@/components/Table.vue'

export default {
    name: 'Users',
    components: {
        Table,
    },
    props: {
       users: {
           type: Array
       }
    },
}
</script>
