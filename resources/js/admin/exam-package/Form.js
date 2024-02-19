import AppForm from '../app-components/Form/AppForm';

Vue.component('exam-package-form', {
    mixins: [AppForm],
    data: function () {
        return {
            form: {
                employee_id: '',
                package_id: '',
                status: '',
                body:''

            }
        }
    },
    created(){
        this.form.status = 'pharmacy';
    },
    methods: {
        callPateint() {
            this.$notify({
                type: 'success',
                title: 'Success!',
                text: 'This is notification test.'
            });
        }
    }

});
