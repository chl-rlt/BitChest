<template>
    <table class="border-collapse w-full">
        <thead>
            <tr>
                <th  class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Nom</th>
                <th  class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Email</th>
                <th  class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Role</th>
                <th  class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users" :key='user.id'
            class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static"> {{ user.name }} </td>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static"> {{ user.email }} </td>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static"> {{ user.role.name }} </td>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                    <Link :href="route('users.edit', user)">E</Link>
                    <button class="" @click="showModal" >X</button>
                    <ConfirmationModal v-show="isModalVisible" @close="closeModal" />
                </td>
            </tr>
        </tbody>
    </table>
    <div class="inline-block mr-2 mt-2">
        <Link :href="route('users.create')"><button type="button" class="focus:outline-none text-white text-sm py-2.5 px-5 border-b-4 border-blue-600 rounded-md bg-blue-500 hover:bg-blue-400">Create</button></Link>
    </div>

</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import ConfirmationModal from '@/components/ConfirmationModal.vue';


export default {
    name: 'Table',
    components: {
        Link,
        ConfirmationModal
    },
    props: {
        users: {
            type: Array,
        },
    },
    data() {
      return {
        isModalVisible: false,
      };
    },
    methods: {

        showModal() {
        this.isModalVisible = true;
        },
        closeModal() {
        this.isModalVisible = false;
        },
    },
}
</script>

<style scoped>

</style>
