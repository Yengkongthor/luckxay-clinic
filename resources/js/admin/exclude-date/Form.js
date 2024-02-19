import AppForm from '../app-components/Form/AppForm';

Vue.component('exclude-date-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                date:  '' ,
                
            }
        }
    }

});