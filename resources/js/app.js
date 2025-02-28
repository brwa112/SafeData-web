import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { PerfectScrollbarPlugin } from 'vue3-perfect-scrollbar';
import Popper from 'vue3-popper';
import { TippyPlugin } from 'tippy.vue';
import vue3JsonExcel from 'vue3-json-excel';
import Maska from 'maska';
import VueEasymde from 'vue3-easymde';
import { i18nVue } from 'laravel-vue-i18n'
import layout from '@/Layouts/Admin.vue';
import Svg from '@/Components/Svg.vue';
import helpers from './helpers';
import permissions from './permissions';
import Vue3Shortkey from 'vue3-shortkey';
import PermissionPlugin from './Plugins/PermissionPlugin';


const app = createApp({});

const { el, App, props, plugin } = createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
    const page = pages[`./Pages/${name}.vue`];
    page.default.layout = page.default.layout || layout;

    return page;
  },
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props), provide: { helpers } })
      .use(plugin)
      .use(ZiggyVue)
      .use(i18nVue, {
        lang: localStorage.getItem('language') || 'en',
        resolve: lang => {
          const langs = import.meta.glob('../../lang/*.json', { eager: true });
          return langs[`../../lang/${lang}.json`].default;
        },
      })
      .use(PerfectScrollbarPlugin)
      .use(TippyPlugin)
      .use(vue3JsonExcel)
      .use(Maska)
      .use(VueEasymde)
      .component('Popper', Popper)
      .component('Svg', Svg)
      .use(permissions)
      .use(Vue3Shortkey)
      .mount(el);

    // app.config.globalProperties.helpers = helpers;

    // app.mount(el);
  },
});

app.mount(el);
