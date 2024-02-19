import AppListing from '../app-components/Listing/AppListing';

Vue.component('exam-package-listing', {
    mixins: [AppListing],
    props: [
        'doctors'
    ],
    data: function () {
        return {
            doctor: '',
            doctorId: '',
            examPackageId: '',
            statusAssign: '',
            package_id: '',
            resource_url: '',
            doctor_medicines: '',
            status_exam_package: '',
            exam_package_id: '',
            printMedicinePackage: null
        }
    },
    methods: {
        show(item) {
            this.$modal.show('exam-package', {
                item: item
            });
        },
        hide() {
            this.$modal.hide('exam-package');
        },
        beforeOpen(event) {
            var item = event.params.item;
            this.statusAssign = item.patientHistory.status;
            this.package_id = item.package_id;
            this.resource_url = item.resource_url;
        },
        onAssignDoctor() {
            var _this = this;
            var data = {
                employee_id: this.doctor.id,
                package_id: this.package_id,
                status: 'examination'
            };
            var url = this.resource_url;

            axios.post(url, data).then(function (response) {
                _this.hide();
                _this.$notify({
                    type: 'success',
                    title: 'Success!',
                    text: 'This is notification test.'
                });
                _this.loadData();
            }).catch(function (errors) {
                console.log(errors);
            });
        },
        showPackage(item) {
            this.$modal.show('get-medicine-package', {
                item: item
            });
        },
        hidePackage() {
            this.$modal.hide('get-medicine-package');
        },
        beforeOpenPackage(event) {
            var item = event.params.item;
            this.doctor_medicines = item.patientHistory.doctor_medicines
            this.status_exam_package = item.status
            this.exam_package_id = item.id
        },
        onGetMedicinePackage(id) {
            var _this = this;
            var url = '/admin/get-medicines/update';
            var data = {
                'exam_package_id': id,
                'status': 'package',
            }
            axios.post(url, data).then(function (response) {
                _this.hidePackage();
                _this.loadData();
            }).catch(function (errors) {
                // _this.onFailNotify(errors.response.data);
            });
        },
        onPrintMedicinePackage(id,size) {
            var _this = this;
            var timestamp = Date.now();

            if (size == '7x5') {
                _this.printMedicinePackage = '/admin/get-medicines/print/exam-package?exam_package_id=' + id + '&' + timestamp;

            }
            if (size == '10x8') {
                _this.printMedicinePackage = '/admin/get-medicines/print/exam-package?exam_package_id=' + id + '&' + timestamp;

            }
            if (size == '10x15') {
                _this.printMedicinePackage = '/admin/get-medicines/print/exam-package?exam_package_id=' + id + '&' + timestamp;

            }
        }
    }
});
