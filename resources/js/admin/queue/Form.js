import AppForm from '../app-components/Form/AppForm';

var FormSupport = {

}

Vue.component('queue-form', {
    mixins: [AppForm],
    props: [
        'patients',
        'status',
        'queueId'
    ],
    data: function () {
        return {
            form: {
                patient: '',
                comment: '',
            },
            print: null,
            charge: '',
            vat: '',
            exam_fee_discount: '',
            discount_total_money: '',
            discounted_services: '',
            // doctor_fee: '',
            // doctor_fee_discount: '',
            medicine_discount: '',
            printMedicine: null,
            prescribe_medicine: [],
            queue_id:''
        }
    },
    created() {

    },
    methods: {
        show() {
            this.$modal.show('pay');
        },
        showModalPrintSticker(item) {
            this.queue_id = this.queueId;
            this.$modal.show('sticker', {
                item: item
            });
        },
        hideModalPrintSticker() {
            this.$modal.show('sticker');
        },
        hide() {
            this.$modal.hide('pay');
        },
        beforeOpen(event) {
            this.prescribe_medicine = event.params.item;
        },
        onPay(queueId) {
            var _this = this;

            var url = '/admin/payments/pay'

            var data = {
                'id': queueId,
                'status': this.status,
                'pay': {
                    'charge': this.charge,
                    'vat': this.vat,
                    'exam_fee_discount': this.exam_fee_discount,
                    'discounted_services': this.discounted_services,
                    'discount_total_money': this.discount_total_money,
                    // 'doctor_fee': this.doctor_fee,
                    // 'doctor_fee_discount': this.discounted_services,
                    'medicine_discount': this.medicine_discount,
                }
            }

            axios.post(url, data).then(function (response) {
                window.location.replace(response.data.redirect);
            }).catch(function (errors) {
                // _this.onFailNotify(errors.response.data);
            });
        },
        onPrint(queueId) {
            var _this = this;
            var timestamp = Date.now();
            _this.print = '/admin/payments/print/bill?queue_id=' + queueId + '&status=' + this.status + '&' + timestamp;
        },


        onPrintMedicine(queueId, size, id) {
            var _this = this;
            var timestamp = Date.now();
            if (size == '7x5') {
                _this.printMedicine = '/admin/get-medicines/print/medicines-7-5?id=' + id + '&&queue_id=' + queueId + '&' + timestamp;

            }
            if (size == '10x8') {
                _this.printMedicine = '/admin/get-medicines/print/medicines?id=' + id + '&&queue_id=' + queueId + '&' + timestamp;

            }
            if (size == '10x15') {
                _this.printMedicine = '/admin/get-medicines/print/medicines-10-15?id=' + id + '&&queue_id=' + queueId + '&' + timestamp;

            }
        },
        onPrintSaline(queueId, size) {
            var _this = this;
            var timestamp = Date.now();
            if (size == '7x5') {
                _this.printMedicine = '/admin/saline-7-5?queue_id=' + queueId + '&' + timestamp;

            }
            if (size == '10x8') {
                _this.printMedicine = '/admin/saline-10-8?queue_id=' + queueId + '&' + timestamp;

            }
            if (size == '10x15') {
                _this.printMedicine = '/admin/saline-10-15?queue_id=' + queueId + '&' + timestamp;

            }
        }
    }

});
