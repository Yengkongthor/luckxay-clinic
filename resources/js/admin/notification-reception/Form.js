import AppForm from '../app-components/Form/AppForm';

Vue.component('notification-reception-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                caller:  '' ,
                class:  '' ,
                patient:  '' ,
                
            }
        }
    }

});