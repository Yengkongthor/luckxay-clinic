import AppForm from '../app-components/Form/AppForm';
import {
    statusDoctorMedicine,
} from '../event-bus/app-events';

Vue.component('examination-result-form', {
    mixins: [AppForm],
    props: [
        'queueId',
    ],
    data: function () {
        return {
            form: {
                body: '',
                status_doctor_medicine: false,
                queue_id: this.queueId,
                doctor_fee:'',
                doctor_fee_discount:'',
            },
            print: null,
            groupData : []
        }
    },
    created() {
        this.$eventBus.listen(statusDoctorMedicine, (e) => {
            this.form.status_doctor_medicine = e.status
        });

       this.groupData =  _.chain(this.data.patient_history_last.examination_services_result)
        .groupBy("service.name")
        .map((value, key) => ({
            groupName: key,
            data: value
        }))
        .value();
    },
    beforeDestory() {
        this.$eventBus.remove(statusDoctorMedicine);
    },
    methods: {
        callPatient(queueId) {
            var _this = this;
            var url = '/admin/examination-results/call-patient';
            var data = {
                'queue_id': queueId,
            }
            axios.post(url, data).then(function (response) {}).catch(function (errors) {
                // _this.onFailNotify(errors.response.data);
            });
        },
        printExaminationResult(queueId) {
            var _this = this;
            var timestamp = Date.now();
            _this.print = '/admin/examination-results/print?queue_id=' + queueId + '&' + timestamp;
        },

        printPaientInfo(queueId) {
            var _this = this;
            var timestamp = Date.now();
            _this.print = '/admin/examination-results/print/patient-info?queue_id=' + queueId + '&' + timestamp;
        },
        inputAgain(id) {

            var _this = this;
            var url = '/admin/examination-results/input/again';
            var data = {
                'examination_service_id': id,
            }

            _this.$modal.show('dialog', {
                title: 'Warning!',
                text: 'Do you really want to Input Again Value ?',
                buttons: [{
                    title: 'No, cancel.'
                }, {
                    title: '<span class="btn-dialog btn-warning">Yes, Input Again.<span>',
                    handler: function handler() {
                        _this.$modal.hide('dialog');
                        axios.post(url, data).then(function (response) {
                            _this.$notify({
                                type: 'success',
                                title: 'Success!',
                                text: response.data.message
                            });

                        }).catch(function (errors) {
                            // _this.onFailNotify(errors.response.data);
                        });
                    }
                }]
            });



        }
    }
});

Vue.component('info-data', {
    props: [
        'info'
    ],
    data: function () {
        return {
            result: ''
        }
    },
    created() {

    },
    beforeDestory() {},
    methods: {
        titleCase(str) {
            var splitStr = str.toLowerCase().split('_');
            for (var i = 0; i < splitStr.length; i++) {
                // You do not need to check if i is larger than splitStr length, as your for does that for you
                // Assign it back to the array
                splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
            }
            // Directly return the joined string
            return splitStr.join(' ');
        },




    }
});
