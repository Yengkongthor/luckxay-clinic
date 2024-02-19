import AppForm from '../app-components/Form/AppForm';

Vue.component('shutdown-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                
            }
        }
    },
    methods: {
        toggleSwitch: function toggleSwitch() {
            var _this = this;
            var data = {
                shutdown: this.form.shutdown,
            }
            axios.post(_this.action, data).then(function (response) {
                _this.$notify({
                    type: 'success',
                    title: 'Success!',
                    text: response.data.message ? response.data.message : 'Successfully.'
                });
            }, function (error) {
                console.log(error);
                _this.$notify({
                    type: 'error',
                    title: 'Error!',
                    text: error.response.data.message ? error.response.data.message : 'An error has occured.'
                });
            });
        },
    }
});