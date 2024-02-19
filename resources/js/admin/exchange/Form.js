import AppForm from '../app-components/Form/AppForm';

Vue.component('exchange-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                thb:  '' ,
                usd:  '' ,
                
            }
        }
    }

});