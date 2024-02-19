import AppForm from '../app-components/Form/AppForm';

Vue.component('health-tip-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                title:  '' ,
                short_desc:  '' ,
                detail:  '' ,

            },
            mediaCollections: ['healthTips']
        }
    }

});
