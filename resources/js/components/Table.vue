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
            class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0 justify-center">
                <row-link :href="route('users.show',user)" className="w-full lg:w-auto text-gray-800 justify-center border border-b block lg:table-cell relative lg:static"> {{ user.name }} </row-link>
                <row-link :href="route('users.show',user)" className="w-full lg:w-auto text-gray-800 text-center border border-b block lg:table-cell relative lg:static"> {{ user.email }} </row-link>
                <row-link :href="route('users.show',user)" className="w-full lg:w-auto text-gray-800 text-center border border-b block lg:table-cell relative lg:static"> {{ user.role.name }} </row-link>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                    <div class="flex flex-row justify-center text-center ">
                        <Link class="flex-1 w-1/4 ml-10	" :href="route('users.edit', user)" title="Modify">
                        <svg class="h-6 w-6 text-green-500" width="24"  height="24"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"  fill="none"  stroke="currentColor">  <path stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round" />  <path d="M12 20h9" />  <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" /></svg>
                        </Link>
                        <button class="flex-1 w-1/4 -ml-10" @click="selectUser(user.id)" title="Delete">
                            <svg class="h-6 w-6 text-red-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
            <ConfirmationModal v-show="isModalVisible" @close="closeModal" @delete-confirmation="deleteUser" :id="idUser" title="Delete Client" button="Delete">
                Are you sure you want to delete this client ?
            </ConfirmationModal>
        </tbody>
    </table>
    <div class="inline-block mr-2">
        <Link :href="route('users.create')"><button type="button" class="focus:outline-none text-white text-base font-semibold py-2.5 px-10 border-b-4 border-blue-600 rounded-md bg-blue-500 hover:bg-blue-400 lg:mt-10">Create</button></Link>
    </div>

</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import ConfirmationModal from '@/components/ConfirmationModal.vue';
import RowLink from '@/components/RowLink.vue'

export default {
    name: 'Table',
    components: {
        Link,
        ConfirmationModal,
        RowLink,
    },
    props: {
        users: {
            type: Array,
        },
    },
    data() {
      return {
        isModalVisible: false,
        idUser: null,
      };
    },
    watch: {
        idUser(val) {
            if(val) this.showModal()
        }
    },
    methods: {
        selectUser(id) {
            this.idUser = id;
        },
        showModal() {
            this.isModalVisible = true;
        },
        closeModal() {
            this.isModalVisible = false;
        },
        deleteUser($id) {
            this.$inertia.delete(route('users.destroy',$id))
            this.idUser = null,
            this.closeModal()
            console.log($id);
        }
    },
}
</script>

<style scoped>

</style>
