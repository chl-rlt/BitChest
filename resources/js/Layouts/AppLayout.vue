<template>
    <div>
        <Head :title="title" />

        <jet-banner />

        <div class="bg-gray-100 relative content-area">

            <!-- Nav -->
            <nav class="bg-white border-b border-gray-100 fixed top-0 w-full z-10">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex-shrink-0 flex items-center xl:-ml-11">
                                <Link :href="route('markets.index')">
                                    <jet-application-logo class="block h-16 w-auto " />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <!-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <jet-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                                    Dashboard
                                </jet-nav-link>
                            </div> -->
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <jet-dropdown align="right" width="48">
                                    <template #trigger>
                                        <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                                        </button>

                                        <span v-else class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                                {{ $page.props.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Manage Account
                                        </div>

                                        <jet-dropdown-link :href="route('profile.show')">
                                            Profile
                                        </jet-dropdown-link>

                                        <jet-dropdown-link :href="route('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                                            API Tokens
                                        </jet-dropdown-link>

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <jet-dropdown-link as="button">
                                                Log Out
                                            </jet-dropdown-link>
                                        </form>
                                    </template>
                                </jet-dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden submenu-burger">
                    <div class="pt-2 pb-3 space-y-1">
                        <jet-responsive-nav-link :href="route('markets.index')" :active="route().current('markets.index')">
                            Markets
                        </jet-responsive-nav-link>
                        <jet-responsive-nav-link :href="route('wallet.index', user.id)" :active="route().current('wallet.index', user.id)" v-if="user.role == 'client'">
                            Wallet
                        </jet-responsive-nav-link>
                        <jet-responsive-nav-link :href="route('users.index')" :active="route().current('users.index')" v-if="user.role == 'admin'">
                            Users
                        </jet-responsive-nav-link>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200 bg-white">
                        <div class="flex items-center px-4">
                            <div v-if="$page.props.jetstream.managesProfilePhotos" class="flex-shrink-0 mr-3" >
                                <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                            </div>

                            <div>
                                <div class="font-medium text-base text-gray-800">{{ $page.props.user.name }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ $page.props.user.email }}</div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <jet-responsive-nav-link :href="route('profile.show')" :active="route().current('profile.show')">
                                Profile
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link :href="route('api-tokens.index')" :active="route().current('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                                API Tokens
                            </jet-responsive-nav-link>

                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <jet-responsive-nav-link as="button">
                                    Log Out
                                </jet-responsive-nav-link>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header"></slot>
                </div>
            </header>

            <div class="page-wrapper chiller-theme mt-16" :class="{toggled: !mobileView}" v-if="$page.url.startsWith('/home')">
                <a id="show-sidebar" class="btn btn-sm btn-dark top-20 pl-1.5 bg-white rounded-tr-md" href="#" @click.prevent="showSidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </a>
                <Sidebar :user="user" @close-sidebar="closeSidebar"/>

                <!-- Page Content -->
                <main class="page-content">
                    <slot></slot>
                </main>
            </div>

            <template v-else >
                <header class="bg-white shadow" v-if="$slots.header">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <slot name="header"></slot>
                    </div>
                </header>
                <main class="page-content">
                    <slot></slot>
                </main>
            </template>

        </div>
    </div>
</template>

<script>
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'
    import JetBanner from '@/Jetstream/Banner.vue'
    import JetDropdown from '@/Jetstream/Dropdown.vue'
    import JetDropdownLink from '@/Jetstream/DropdownLink.vue'
    import JetNavLink from '@/Jetstream/NavLink.vue'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue'
    import { Head, Link, usePage } from '@inertiajs/inertia-vue3';
    import Sidebar from '@/components/Sidebar.vue'
    import { computed } from 'vue'
    import { mapActions } from 'vuex'

    export default {
        props: {
            title: String,
        },

        components: {
            Head,
            JetApplicationLogo,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
            Link,
            Sidebar,
        },
        setup() {
            const user = computed(()=> usePage().props.value.auth.user);
            return { user };
        },

        data() {
            return {
                showingNavigationDropdown: false,
                mobileView: null,
            }
        },

        methods: {
            logout() {
                this.$inertia.post(route('logout'));
            },
            closeSidebar() {
                document.querySelector('.page-wrapper').classList.remove('toggled');
            },
            showSidebar() {
                document.querySelector('.page-wrapper').classList.add('toggled');
            },
            isMobileView() {
                if(window.matchMedia('(max-width: 639px)').matches) return this.mobileView = true;
                return this.mobileView = false;
            },
            ...mapActions({
                listenToLastsMarkets: 'markets/listenToLastsMarkets'
            }),
        },

        created() {
            this.isMobileView()
            window.addEventListener('resize', this.isMobileView)
            this.listenToLastsMarkets();
        },
        destroyed() {
            window.removeEventListener('resize', this.isMobileView)
        }
    }
</script>

<style scoped>
.content-area {
    min-height: calc(100vh - 4rem);
}

.submenu-burger {
    z-index: 999999999999999!important;
}

@media (max-width:500px){
    #show-sidebar{
        display: none;
    }
}
</style>
