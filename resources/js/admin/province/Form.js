import AppForm from '../app-components/Form/AppForm';

Vue.component('province-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                en_name:  '' ,
                la_name:  '' ,
                
            }
        }
    }

});