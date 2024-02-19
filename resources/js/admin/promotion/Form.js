import AppForm from '../app-components/Form/AppForm';

Vue.component('promotion-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                short_desc:  '' ,
                link:  '' ,

            },
            mediaCollections: ['promotion']
        }
    }

});
