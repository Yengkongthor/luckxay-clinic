import './bootstrap';

import 'vue-multiselect/dist/vue-multiselect.min.css';
import flatPickr from 'vue-flatpickr-component';
import VueQuillEditor from 'vue-quill-editor';
import Notifications from 'vue-notification';
import Multiselect from 'vue-multiselect';
import VeeValidate from 'vee-validate';
import 'flatpickr/dist/flatpickr.css';
import VueCookie from 'vue-cookie';
import {
    Admin
} from 'craftable';
import VModal from 'vue-js-modal'
import Vue from 'vue';

import './app-components/bootstrap';
import './index';

import 'craftable/dist/ui';

import EventBus from './event-bus';
import VueAudio from 'vue-audio-better'


Vue.use(VueAudio)


Vue.component('multiselect', Multiselect);
Vue.use(VeeValidate, {
    strict: true
});
Vue.component('datetime', flatPickr);
Vue.use(VModal, {
    dialog: true,
    dynamic: true,
    injectModalsContainer: true
});
Vue.use(VueQuillEditor);
Vue.use(Notifications);
Vue.use(VueCookie);
Vue.use(EventBus);


Vue.filter('striphtml', function (value) {
    var div = document.createElement("div");
    div.innerHTML = value;
    var text = div.textContent || div.innerText || "";
    return text;
});

var numeral = require("numeral");

Vue.filter("formatNumber", function (value) {
    return numeral(value).format("0,0"); // displaying other groupings/separators is possible, look at the docs
});



new Vue({
    mixins: [Admin],
});
