import AppForm from '../app-components/Form/AppForm';

Vue.component('booking-date-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                last_date:  '' ,
                
            }
        }
    }

});