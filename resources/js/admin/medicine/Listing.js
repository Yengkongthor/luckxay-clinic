import AppListing from '../app-components/Listing/AppListing';
import {
    GetMidicine,
    ShoppingCard
} from '../event-bus/app-events';


var FormSupport = {
    methods: {
        onSuccessNotify: function onSuccessNotify(data) {
            if (data.message) {
                this.$notify({
                    type: 'success',
                    title: 'Success!',
                    text: data.message
                });
            }
        },
        onFailNotify: function onFailNotify(data) {
            if (data.message) {
                this.$notify({
                    type: 'error',
                    title: 'error!',
                    text: data.message
                });
            }
        }
    },
}



Vue.component('medicine-listing', {
    mixins: [AppListing, FormSupport],
    data: function () {
        return {
            printStock: null,
            typePrint: 'all'
        }
    },
    created() {
        this.$eventBus.listen(GetMidicine, () => this.loadData(true));
    },
    beforeDestory() {
        this.$eventBus.remove(GetMidicine);
    },
    methods: {
        onAdd(item) {
            var _this = this;
            var url = '/admin/prescribe-medicines/shopping-cart/add';
            var data = {
                'medicine_id': item.medicine_id,
                'medicine_pricing_id': item.id,
                'price': item.medicine.price,
                'amount': 1,
            }
            axios.post(url, data).then(function (response) {
                _this.$eventBus.publish(new ShoppingCard());
                _this.loadData();
                _this.onSuccessNotify(response.data);
            }).catch(function (errors) {
                _this.onFailNotify(errors.response.data);
            });
        },
        onPrintStock() {
            var _this = this;
            var timestamp = Date.now();
            _this.printStock = '/admin/medicines/stock/print/' + _this.typePrint + '?' + timestamp;

        },
        show() {
            this.$modal.show('medicine-print');
        },
        hide() {
            this.$modal.hide('medicine-print');
        }


    }
});
