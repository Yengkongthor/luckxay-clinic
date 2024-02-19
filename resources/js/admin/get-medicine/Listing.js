import AppListing from '../app-components/Listing/AppListing';

import {
    GetMidicine
} from '../event-bus/app-events';

Vue.component('get-medicine-listing', {
    mixins: [AppListing],
    data: function () {
        return {
            prescribe_medicine: '',
            queues_status: '',
            queue_id: '',
            money: '',
            printMedicine: null,
            audio: null,
        }
    },
    created() {
        this.audio = new Audio('../audio/sound.mp3');
        this.$eventBus.listen(GetMidicine, () => {
            this.loadData(true);
            this.audio.play();
        });
    },
    beforeDestory() {
        this.$eventBus.remove(GetMidicine);
    },
    methods: {
        show(item) {
            this.$modal.show('get-medicine', {
                item: item
            });
        },
        hide() {
            this.$modal.hide('get-medicine');
        },
        beforeOpen(event) {
            var item = event.params.item;
            this.queues_status = item.queues_status;
            this.queue_id = item.id;
            this.prescribe_medicine = item.prescribe_medicines.patient_history.doctor_medicines;
            this.money = item.prescribe_medicines.money
            console.log(this.prescribe_medicine);
        },
        onGetMedicine(queueId) {
            var _this = this;
            var url = '/admin/get-medicines/update';
            var data = {
                'queue_id': queueId,
            }
            axios.post(url, data).then(function (response) {
                _this.hide();
                return _this.onSuccess(response.data);
            }).catch(function (errors) {
                // _this.onFailNotify(errors.response.data);
            });
        },
        onSuccess: function onSuccess(data) {
            if (data.redirect) {
                window.location.replace(data.redirect);
            }
        },
        onPrintMedicine(queueId, size,id) {
            var _this = this;
            var timestamp = Date.now();
            if (size == '7x5') {
                _this.printMedicine = '/admin/get-medicines/print/medicines-7-5?id='+id+'&&queue_id=' + queueId + '&' + timestamp;

            }
            if (size == '10x8') {
                _this.printMedicine = '/admin/get-medicines/print/medicines?id='+id+'&&queue_id=' + queueId + '&' + timestamp;

            }
            if (size == '10x15') {
                _this.printMedicine = '/admin/get-medicines/print/medicines-10-15?id='+id+'&&queue_id=' + queueId + '&' + timestamp;

            }
        },
        onPrintSaline(queueId,size){
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
