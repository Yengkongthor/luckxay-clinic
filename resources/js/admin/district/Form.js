import AppForm from '../app-components/Form/AppForm';

Vue.component('district-form', {
    mixins: [AppForm],
    props:[
        'province'
    ],
    created(){
        this.form.province_id = this.province;
    },
    data: function() {
        return {
            form: {
                name:  '' ,
                province_id:  '' ,

            }
        }
    }

});
