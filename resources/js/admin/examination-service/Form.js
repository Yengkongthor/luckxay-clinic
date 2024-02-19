import AppForm from '../app-components/Form/AppForm';

Vue.component('examination-service-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                patient_history_id:  '' ,
                service_id:  '' ,
                lab_id:  '' ,
                lab_detail_id:  '' ,
                value:  '' ,

            }
        }
    }

});
