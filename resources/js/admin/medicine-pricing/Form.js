import AppForm from '../app-components/Form/AppForm';

Vue.component('medicine-pricing-form', {
    mixins: [AppForm],
    props:[
        'medicines',
        'suppliers'
    ],
    data: function() {
        return {
            form: {
                amount:  '' ,
                base_price:  '' ,
                best_before_date:  '' ,
                manufacture_date:  '' ,
                medicine:  '' ,
                supplier:  '' ,

            }
        }
    }

});
