import AppForm from '../app-components/Form/AppForm';

Vue.component('lab-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                
            }
        }
    }

});