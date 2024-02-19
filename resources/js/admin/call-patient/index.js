import AppListing from '../app-components/Listing/AppListing';


Vue.component('call-patient-listing', {
    methods: {
        callPatient(patient, type) {
            var _this = this;
            var url = '/admin/call-pateints/' + patient + '/' + type + '';

            axios.get(url)
                .then(function (response) {
                    _this.$notify({ type: 'success', title: 'Success!', text: 'Call successfully' });
                })
                .catch(function (errors) {
                    _this.$notify({ type: 'warning', title: 'Warning!', text: 'Call Ready' });
                });
        }
    }
});
