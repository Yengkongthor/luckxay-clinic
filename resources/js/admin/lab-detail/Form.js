import AppForm from '../app-components/Form/AppForm';

Vue.component('lab-detail-form', {
    mixins: [AppForm],
    props: [
        'labs',
    ],
    data: function () {
        return {
            form: {
                lab_id: '',
                name: '',
                unit: '',
                reference: '',
                cost: '',
                price: '',

            }
        }
    }

});
