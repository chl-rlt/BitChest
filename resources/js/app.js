require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import AppLayout from '@/Layouts/AppLayout.vue';
import store from '@/store/index'
// import Vuex from 'vuex'

// import { createStore } from 'vuex'
// const store = createStore({
//   state () {
//     return {
//       count: 0
//     }
//   },
//   mutations: {
//     increment (state) {
//       state.count++
//     }
//   }
// })

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'BitChest';

// Pusher.log = function (message) { window.console.log(message); }

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const page = require(`./Pages/${name}.vue`).default;
        if(!name.startsWith('Auth/')) page.layout = AppLayout;
        return page;
    },
    setup({ el, app, props, plugin }) {
        return createApp({
            render: () => h(app, props)
        })
            .use(store)
            .use(plugin)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
