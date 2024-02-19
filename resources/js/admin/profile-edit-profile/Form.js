import AppForm from '../app-components/Form/AppForm';

Vue.component('profile-edit-profile-form', {
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
                status: true,
                examination_class:''

            },
            status: true,
            mediaCollections: ['avatar'],
            examination_class: ''
        }
    },
    created() {
        this.form.status = this.form.employee.employee_status ? this.form.employee.employee_status.status : false;
        this.form.examination_class = this.data.employee.employee_status.examination_class
    },
    methods: {
        onSuccess(data) {
            if (data.notify) {
                this.$notify({
                    type: data.notify.type,
                    title: data.notify.title,
                    text: data.notify.message
                });
            } else if (data.redirect) {
                window.location.replace(data.redirect);
            }
        },
        toggleSwitch: function toggleSwitch() {
            var _this = this;
            var url = '/admin/employee/status';
            var data = {
                employee_id: this.form.employee.id,
                status: this.form.status,
            }
            axios.post(url, data).then(function (response) {
                _this.status = response.data.employeeStatus.status
                _this.$notify({
                    type: 'success',
                    title: 'Success!',
                    text: response.data.message ? response.data.message : 'Item successfully changed.'
                });
                console.log(_this.status);
            }, function (error) {
                _this.$notify({
                    type: 'error',
                    title: 'Error!',
                    text: error.response.data.message ? error.response.data.message : 'An error has occured.'
                });
            });
        },
        onChange(event) {
            // console.log(event.target.value)

            var url = '/admin/profile/examination-class/' + event.target.value;

            // Make a request for a user with a given ID
            axios.get(url)
                .then(function (response) {
                    // handle success
                    console.log(response);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

        }
    }
});
