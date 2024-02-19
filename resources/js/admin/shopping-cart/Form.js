import AppForm from '../app-components/Form/AppForm';

Vue.component('shopping-cart-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                medicine_id:  '' ,
                cost:  '' ,
                price:  '' ,
                amount:  '' ,
                
            }
        }
    }

});