import AppListing from '../app-components/Listing/AppListing';
import {
    statusDoctorMedicine,
} from '../event-bus/app-events';

Vue.component('doctor-medicine-listing', {
    mixins: [AppListing],
    props: [
        'medicines',
        'examinationResult',
        'patientHistoryId'
    ],
    data: function () {
        return {
            amount: '',
            value: '',
            times: [],
            tablets: [],
            dose:'',
            use:'',
            statusDoctorMedicine: false
        }
    },
    created() {},
    methods: {
        show() {
            this.$modal.show('doctor-medicine');
            this.value = null;
            this.amount = null;
            this.times = [];
            this.tablets = [];
        },
        hide() {
            this.$modal.hide('doctor-medicine');
        },
        onSave() {
            var _this = this;
            var data = {
                medicine_id: this.value.id,
                type: this.value.category.name,
                dose: this.dose,
                use: this.use,
                cheminal_name: this.value.cheminal_name,
                amount: this.amount,
                times: this.times,
                tablets: this.tablets,
                patient_history_id: this.patientHistoryId ? this.patientHistoryId : this.examinationResult.patient_history_last.id,
            }
            var url = '/admin/doctor-medicines';


            axios.post(url, data).then(function (response) {
                _this.hide();
                _this.loadData();
            }).catch(function (errors) {

                _this.$notify({
                    type: 'error',
                    title: 'Error!',
                    text: errors.response.data
                });

            });
        },
        toggleSwitch() {
            this.$eventBus.publish(new statusDoctorMedicine(this.statusDoctorMedicine));
        }
    }
});
