import AppForm from '../app-components/Form/AppForm';

Vue.component('service-form', {
    mixins: [AppForm],
    props: [
        'labs'
    ],
    data: function () {
        return {
            form: {
                name: '',
                lab_detail: []
            }
        }
    },
    created(){

    }

});
