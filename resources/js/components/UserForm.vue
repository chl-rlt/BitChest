<template>
<form @submit.prevent="onSubmit">
    <div class="shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">
            <div class="grid grid-cols-6 gap-6">

                <div class="col-span-6 sm:col-span-3">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" autocomplete="given-name" v-model="user.name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                <div class="error" v-if="v$.user.name.$error || errors.name ">
                    <p class="text-sm">{{ v$.user.name.$error ? v$.user.name.$errors[0].$message : errors.name }}</p>
                </div>
                </div>

                <div class="col-span-6 sm:col-span-3">
                <label for="email-address" class="block text-sm font-medium text-gray-700">Email address</label>
                <input type="text" id="email-address" v-model="user.email" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                <div class="error" v-if="v$.user.email.$error || errors.email">
                    <p class="text-sm">{{ v$.user.email.$error ? v$.user.email.$errors[0].$message : errors.email }}</p>
                </div>
                </div>

                <div class="col-span-6 sm:col-span-3">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" v-model="user.password" autocomplete="password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                <div class="error" v-if="v$.user.password.$error || errors.password">
                    <p class="text-sm">{{ v$.user.password.$error ? v$.user.password.$errors[0].$message : errors.password }}</p>
                </div>
                </div>

                <div class="col-span-6 sm:col-span-3">
                <label for="password-confirm" class="block text-sm font-medium text-gray-700">Password confirm</label>
                <input type="password" id="password_confirm" v-model="user.password_confirm" autocomplete="password_confirm" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                <div class="error" v-if="v$.user.password_confirm.$error || errors.password_confirm">
                    <p class="text-sm">{{ v$.user.password_confirm.$error ? v$.user.password_confirm.$errors[0].$message : errors.password_confirm }}</p>
                </div>
                </div>

                <div class="col-span-6 sm:col-span-3">
                <label for="role" class="block text-sm font-medium text-gray-700">Roles</label>
                <select id="role" v-model="user.role_id" autocomplete="role" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option v-for="role in roles" :key="role.id" :value="role.id" class="capitalize">{{ role.name }}</option>
                </select>
                <div class="error" v-if="v$.user.role_id.$error || errors.role_id">
                    <p class="text-sm">{{ v$.user.role_id.$error ? v$.user.role_id.$errors[0].$message : errors.role_id }}</p>
                </div>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label class="cursor-pointer mt-1 flex items-center ">
                        <img v-if="url" :src="url" class="h-12 w-12 rounded-full overflow-hidden object-cover"/>
                        <span v-else class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                            <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </span>

                        <span class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Browse</span>
                        <input type="file" class="hidden" ref="file" @change="onFileChange">

                    </label>
                </div>
            </div>
        </div>
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
        <blue-button>
            Save
        </blue-button>
        </div>
    </div>
</form>
</template>

<script>
import BlueButton from '@/components/BlueButton.vue'
import useVuelidate from '@vuelidate/core'
import JetLabel from '@/Jetstream/Label.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
import { required, requiredIf, email, minLength, alphaNum, sameAs, helpers } from '@vuelidate/validators'

const containsMajAndNumber = helpers.regex(/^(?=.{6,})(?=.*[a-z])(?=.*[A-Z])(?=.*\d).*$/);

export default {
    setup(){
      return {
        v$: useVuelidate()
      }
    },
    emits: ['on-submit'],
    components: {
        BlueButton,
        JetLabel,
        JetSecondaryButton
    },
    props:{
        userToUpdate: Object,
        roles: {
            type: Array,
            required: true,
        },
        errors: {
            type: Object,
            default: null,
        },
    },
    data() {
        return {
            user: {
                id: '',
                name: '',
                role_id: '',
                email: '',
                password: '',
                password_confirm: '',
                profile_photo_path: null,
            },
            url: null,
        }
    },
    mounted() {
        if(this.userToUpdate) {
            this.user.id = this.userToUpdate.id,
            this.user.name = this.userToUpdate.name,
            this.user.role_id = this.userToUpdate.role_id,
            this.user.email = this.userToUpdate.email,
            this.user.profile_photo_path = this.userToUpdate.profile_photo_path,
            this.url = this.userToUpdate.profile_photo_path ?? this.userToUpdate.profile_photo_url
        }

    },
    validations(){
        return {
            user:{
                name: {required, minLength: minLength(3) },
                email: { required, email },
                password: { alphaNum, minLength: minLength(6),
                majAndDigit : helpers.withMessage('Must contain at least one uppercase, lowercase charactere and one digit', containsMajAndNumber) },
                password_confirm: { alphaNum, minLength: minLength(6), sameAsPassword: sameAs(this.user.password),
                majAndDigit : helpers.withMessage('Must contain at least one uppercase, lowercase charactere and one digit', containsMajAndNumber) },
                profile_photo_path: {  },
                role_id : { required },
            }
        }
    },
    methods: {
        onSubmit() {
            this.v$.$validate();
            if(!this.user.password) delete this.user.password
            if(!this.user.password_confirm) delete this.user.password_confirm
            if(!this.user.profile_photo_path) delete this.user.profile_photo_path
            if(this.v$.$error) return
            this.$emit('on-submit',this.user);

        },
        onFileChange(event){
            // Set the local file variable to what the user has selected.
            const file = this.user.profile_photo_path = event.target.files[0];

            this.url = URL.createObjectURL(file);
        },
    }
}
</script>
