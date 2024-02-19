import AppListing from '../app-components/Listing/AppListing';
import {
    DoctorStatus,
} from '../event-bus/app-events';

Vue.component('employee-status-listing', {
    mixins: [AppListing],
    props: ['assign'],
    data: function () {
        return {
            form: {
                assign: 0,

            }
        }
    },
    created() {
        this.$eventBus.listen(DoctorStatus, () => this.loadData(true));
        this.form.assign = this.assign;
    },
    beforeDestory() {
        this.$eventBus.remove(DoctorStatus);
    },
    methods: {
        allowAssign(employee_id) {
            var _this = this;
            var url = '/admin/employee-statuses/assign/employee';
            var data = {
                assign: this.form.assign,
                employee_id: employee_id,
            }


            axios.post(url, data).then(function (response) {
                _this.$notify({
                    type: 'success',
                    title: 'Success!',
                    text: response.data.message ? response.data.message : 'Item successfully changed.'
                });
            }, function (error) {
                _this.$notify({
                    type: 'error',
                    title: 'Error!',
                    text: error.response.data.message ? error.response.data.message : 'An error has occured.'
                });
            });
        },
    }

});
