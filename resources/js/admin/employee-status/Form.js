import AppForm from '../app-components/Form/AppForm';

Vue.component('employee-status-form', {
    mixins: [AppForm],
    data: function () {
        return {
            form: {
                employee_id: '',
                queue_id: '',
                status: false,

            }
        }
    }

});
