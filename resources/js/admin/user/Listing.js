import AppListing from '../app-components/Listing/AppListing';
import AppForm from '../app-components/Form/AppForm';
import Services from "../services";



Vue.component('user-listing', {
    mixins: [AppListing, Services, AppForm],
    data: function () {
        return {
            patientId: '',
            full_name_phone: '',
            packageId: '',
            form: {
                patient: '',
                comment: '',
                important: '',
            },

        }
    },
    created() {},
    methods: {
        show(item) {
            this.$modal.show('queue-modal', {
                item: item
            });
        },
        hide() {
            this.$modal.hide('queue-modal');
        },
        showPackage(item) {
            this.$modal.show('package-modal', {
                item: item
            });
        },
        hidePackage() {
            this.$modal.hide('package-modal');
        },
        beforeOpen(event) {
            var patient = event.params.item;
            this.patientId = patient.patient.id
            this.full_name_phone = patient.full_name_phone
            this.form.patient = patient.patient.id
        },
        onPackageExamination() {
            var _this = this;
            var data = {
                'package_id': this.packageId,
                'patient_id': this.patientId
            }
            var url = '/admin/packages/exam/package'
            axios.post(url, data).then(function (response) {
                _this.hidePackage()
                _this.$notify({
                    type: 'success',
                    title: 'Success!!',
                    text: response.data.message
                });
            }).catch(function (errors) {
                return _this.onFail(errors.response.data);
            });
        }
    },
    props: {

    }
});
