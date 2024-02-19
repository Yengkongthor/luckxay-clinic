import AppForm from '../app-components/Form/AppForm';

Vue.component('medicine-form', {
    mixins: [AppForm],
    props: [
        'brands',
        'categories',
    ],
    data: function () {
        return {
            form: {
                brand: '',
                category: '',
                cheminal_name: '',
                dose: '',
                type: '',
                manufacture_date: '',
                best_before_date: '',
                cost: '',
                price: '',
                amount: '',
                min_amount: '',

            }
        }
    }

});
