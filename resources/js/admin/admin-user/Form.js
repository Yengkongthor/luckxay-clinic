import AppForm from '../app-components/Form/AppForm';

Vue.component('admin-user-form', {
    mixins: [AppForm],
    data: function () {
        return {
            form: {
                first_name: '',
                last_name: '',
                email: '',
                password: '',
                activated: false,
                forbidden: false,
                language: '',
                employee: {
                    branch_id: '',
                    department_code: '',
                    lao_first_name: '',
                    lao_last_name: '',
                    position: '',
                    phone: '',
                    lab_id: []
                }

            },
        }
    }
});
