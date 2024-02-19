import AppForm from '../app-components/Form/AppForm';

Vue.component('package-form', {
    mixins: [AppForm],
    props: [
        'labs'
    ],
    data: function () {
        return {
            form: {
                name: '',
                price: '',
                lab_detail: []
            },
        }
    }

});
