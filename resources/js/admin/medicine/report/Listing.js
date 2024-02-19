import AppListing from '../../app-components/Listing/AppListing';

Vue.component('medicine-report-listing', {
    mixins: [AppListing],
    methods: {
        onApproved() {
            var _this = this;
            var data = {

            }
            var url = '/admin/medicines/preview/approved';

            axios.post(url, data).then(function (response) {
                _this.onSuccess(response.data)
            }).catch(function (errors) {
                console.log(errors);
            });
        },
        onSuccess: function onSuccess(data) {
            if (data.redirect) {
                window.location.replace(data.redirect);
            }
        },
    }
});
