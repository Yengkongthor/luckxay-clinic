import AppForm from '../app-components/Form/AppForm';

Vue.component('summary-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                
            }
        }
    }

});