<template>
         <h1 class="text-2xl py-8 uppercase">Create new user</h1>
            <div class="mt-10 sm:mt-0">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form @submit.prevent="submit">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6 sm:col-span-3">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" id="name" autocomplete="given-name" v-model="user.name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            <div class="error" v-if="v$.user.name.$error || $page.props.errors.name ">
                                <p class="text-sm">{{ v$.user.name.$error ? v$.user.name.$errors[0].$message : $page.props.errors.name }}</p>
                            </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                            <label for="email-address" class="block text-sm font-medium text-gray-700">Email address</label>
                            <input type="text" id="email-address" v-model="user.email" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            <div class="error" v-if="v$.user.email.$error || $page.props.errors.email">
                                <p class="text-sm">{{ v$.user.email.$error ? v$.user.email.$errors[0].$message : $page.props.errors.email }}</p>
                            </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" id="password" v-model="user.password" autocomplete="password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            <div class="error" v-if="v$.user.password.$error || $page.props.errors.password">
                                <p class="text-sm">{{ v$.user.password.$error ? v$.user.password.$errors[0].$message : $page.props.errors.password }}</p>
                            </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                            <label for="password-confirm" class="block text-sm font-medium text-gray-700">Password confirm</label>
                            <input type="password" id="password_confirm" v-model="user.password_confirm" autocomplete="password_confirm" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            <div class="error" v-if="v$.user.password_confirm.$error || $page.props.errors.password_confirm">
                                <p class="text-sm">{{ v$.user.password_confirm.$error ? v$.user.password_confirm.$errors[0].$message : $page.props.errors.password_confirm }}</p>
                            </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                            <label for="role" class="block text-sm font-medium text-gray-700">Roles</label>
                            <select id="role" v-model="user.role_id" autocomplete="role" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option v-for="role in roles" :key="role.id" :value="role.id" class="capitalize">{{ role.name }}</option>
                            </select>
                            <div class="error" v-if="v$.user.role_id.$error || $page.props.errors.role_id">
                                <p class="text-sm">{{ v$.user.role_id.$error ? v$.user.role_id.$errors[0].$message : $page.props.errors.role_id }}</p>
                            </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label class="block text-sm font-medium text-gray-700">
                                Photo
                                </label>
                                <div class="mt-1 flex items-center">
                                    <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                        <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </span>
                                    <button type="button" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Change
                                    </button>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                        </button>
                        </div>
                    </div>
                    </form>
                </div>
                </div>
            </div>
</template>

<script>
import useVuelidate from '@vuelidate/core'
import { required, email, minLength, alphaNum, sameAs, helpers } from '@vuelidate/validators'

const containsMajAndNumber = helpers.regex(/^(?=.{6,})(?=.*[a-z])(?=.*[A-Z])(?=.*\d).*$/);

export default {
    components: {
    },
    props:{
        roles: {
            type:Array
        },
        errors: Object,
    },
    data() {
        return {
            isError: false,
            frontErrors: [],

            user: {
                name: '',
                email: '',
                password: '',
                password_confirm: '',
                role_id: '',
            },
        }
    },

    validations(){
        return {
            user:{
                name: {required, minLength: minLength(1) },
                email: { required, email },
                password: { required, alphaNum, minLength: minLength(6),
                majAndDigit : helpers.withMessage('Must contain at least one uppercase, lowercase charactere and one digit', containsMajAndNumber) },
                password_confirm: { required, alphaNum, minLength: minLength(6), sameAsPassword: sameAs(this.user.password),
                majAndDigit : helpers.withMessage('Must contain at least one uppercase, lowercase charactere and one digit', containsMajAndNumber) },
                role_id : { required },
            }
        }
    },
    methods: {
        submit() {
            this.v$.$validate();
            if(this.v$.$error){
                this.frontErrors = [];
                this.isError = true;
                return false;
            }
            this.$inertia.post('/dashboard/users', this.user);
        }
    },

    setup(){
      return {
        v$: useVuelidate()
      }
    },


}
</script>
