<template>
    <app-layout>
        <h1 class="text-2xl py-8 uppercase">Users</h1>

        <div>
            <Table :users="users"/>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import Table from '@/components/Table.vue'

export default {
    name: 'Users',
    components: {
        AppLayout,
        Table,
    },
    props: {
       users: {
           type: Array
       }
    },
}
</script>
