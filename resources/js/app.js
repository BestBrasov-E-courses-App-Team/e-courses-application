import './bootstrap';
import '../css/app.css';

import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/lara-dark-teal/theme.css';
// import 'primevue/resources/themes/lara-light-green/theme.css'

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

// import "primevue/resources/themes/lara-light-teal/theme.css";
import "primevue/resources/primevue.min.css";
import "primeicons/primeicons.css";


import Fieldset from 'primevue/fieldset';
import Button from "primevue/button";
import SplitButton from "primevue/splitbutton";
import Card from "primevue/card";
import Chip from "primevue/chip";
import MultiSelect from 'primevue/multiselect';
import Badge from "primevue/badge";
import TabView from "primevue/tabview";
import TabPanel from "primevue/tabpanel";
import Panel from "primevue/panel";
import InputText from "primevue/inputtext";
import Textarea from "primevue/textarea";
import InputNumber from "primevue/inputnumber";
import InputGroupAddon from "primevue/InputGroupAddon";
import Checkbox from "primevue/checkbox";
import RadioButton from "primevue/radiobutton";
import Dropdown from "primevue/dropdown";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import ColumnGroup from "primevue/columngroup";
import Row from "primevue/row";
import Paginator from "primevue/paginator";
import Carousel from "primevue/carousel";
import Accordion from "primevue/accordion";
import AccordionTab from "primevue/accordiontab";
import Tooltip from "primevue/tooltip";
import ConfirmationService from "primevue/confirmationservice";
import ConfirmDialog from "primevue/confirmdialog";
import FileUpload from 'primevue/fileupload';
import Dialog from "primevue/dialog";
import Menu from "primevue/menu";
import Tree from "primevue/tree";
import Divider from "primevue/divider";
import Toast from "primevue/toast";

import ToastService from "primevue/toastservice";
import { ToastSeverity } from "primevue/api";

import Main from './Layouts/Main.vue'

import { createPinia } from 'pinia'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const pinia = createPinia()

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(ToastService)
            .use(ConfirmationService)

            .directive("tooltip", Tooltip)

            .component("Button", Button)
            .component("SplitButton", SplitButton)
            .component("Card", Card)
            .component("MultiSelect", MultiSelect)
            .component("Chip", Chip)
            .component("Badge", Badge)
            .component("TabView", TabView)
            .component("TabPanel", TabPanel)
            .component("Tree", Tree)
            .component("Panel", Panel)
            .component("InputText", InputText)
            .component("Textarea", Textarea)
            .component("InputNumber", InputNumber)
            .component("Fieldset", Fieldset)
            .component("InputGroupAddon", InputGroupAddon)
            .component("Checkbox", Checkbox)
            .component("RadioButton", RadioButton)
            .component("Dropdown", Dropdown)
            .component("DataTable", DataTable)
            .component("Column", Column)
            .component("ColumnGroup", ColumnGroup)
            .component("FileUpload", FileUpload)
            .component("Row", Row)
            .component("Paginator", Paginator)
            .component("Carousel", Carousel)
            .component("Accordion", Accordion)
            .component("AccordionTab", AccordionTab)
            .component("ConfirmDialog", ConfirmDialog)
            .component("Dialog", Dialog)
            .component("Menu", Menu)
            .component("Toast", Toast)
            .component("Divider", Divider)

            .component("Main", Main)

            .use(PrimeVue)

            .use(plugin)
            .use(pinia)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
