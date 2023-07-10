import './bootstrap';


// Import Store
import store from '../js/store/index'

// Import modules...
import { createApp, h } from 'vue';
import Notifications from '@kyvg/vue3-notification'
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { createPinia } from 'pinia'
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { CIcon } from '@coreui/icons-vue'
import { iconsSet as icons } from '@/assets/icons'
import CoreuiVue from '@coreui/vue'
import {Tabs, Tab} from 'vue3-tabs-component';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(createPinia())
            .use(CoreuiVue)
            .use(store)
            .use(Notifications)
            .component('tabs', Tabs)
            .component('tab', Tab)
            .component('CIcon', CIcon)
            .provide('icons', icons)
            .mixin({ methods:  {route}  })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
