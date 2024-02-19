import AppForm from '../app-components/Form/AppForm';

Vue.component('medicine-history-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                medicine_id:  '' ,
                cost:  '' ,
                price:  '' ,
                status_approved:  false ,
                
            }
        }
    }

});