import AppForm from '../app-components/Form/AppForm';

Vue.component('book-an-appointment-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                user_id:  '' ,
                
            }
        }
    }

});