import AppForm from '../app-components/Form/AppForm';

Vue.component('wage-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                price:  '' ,
                
            }
        }
    }

});