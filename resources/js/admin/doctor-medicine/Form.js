import AppForm from '../app-components/Form/AppForm';

Vue.component('doctor-medicine-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                amount:  '' ,
                cheminal_name:  '' ,
                patient_history_id:  '' ,
                
            }
        }
    }

});