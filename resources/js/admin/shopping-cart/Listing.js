import AppListing from '../app-components/Listing/AppListing';
import {
    ShoppingCard,
    GetMidicine
} from '../event-bus/app-events';


Vue.component('shopping-cart-listing', {
    mixins: [AppListing],
    data: function () {
        return {
            amount: '',
            medicine_id: '',
            medicine_pricing_id: '',

        }
    },
    props: [
        'queueId',
        'status'
    ],
    created() {
        this.$eventBus.listen(ShoppingCard, () => this.loadData(true));
    },
    beforeDestory() {
        this.$eventBus.remove(ShoppingCard);
    },
    methods: {
        addAmount() {
            var _this = this;
            var url = '/admin/prescribe-medicines/shopping-cart/add-amount';
            var data = {
                'medicine_id': _this.medicine_id,
                'medicine_pricing_id': _this.medicine_pricing_id,
                'price': '0',
                'amount': _this.amount,
            }
            axios.post(url, data).then(function (response) {
                _this.loadData();
                _this.hide();
            }).catch(function (errors) {
                _this.onFailNotify(errors.response.data);
            });
        },

        onRemove(item) {
            var _this = this;
            var url = '/admin/prescribe-medicines/shopping-cart/remove';
            var data = {
                'medicine_id': item.medicine_id,
                'medicine_pricing_id': item.medicine_pricing_id,
                'price': item.price,
                'amount': 1,
            }
            axios.post(url, data).then(function (response) {
                // _this.$eventBus.publish(new ShoppingCard());
                _this.loadData();
                _this.$eventBus.publish(new GetMidicine());
                // _this.onSuccessNotify(response.data);
            }).catch(function (errors) {
                // _this.onFailNotify(errors.response.data);
            });
        },
        onConfirm(statusMedicine) {
            var _this = this;
            var url = '/admin/prescribe-medicines/shopping-cart/confirm';
            var data = {
                'id': _this.queueId,
                'status': _this.status,
                'status_medicine': statusMedicine,
            }
            axios.post(url, data).then(function (response) {
                _this.$eventBus.publish(new GetMidicine());
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
        onFailNotify: function onFailNotify(data) {
            this.$notify({
                type: 'error',
                title: 'Medicine!',
                text: data.message
            });
        },
        show(item) {
            this.$modal.show('amount-shopping', {
                item: item
            });
        },
        hide() {
            this.$modal.hide('amount-shopping');
        },
        beforeOpen(event) {
            var item = event.params.item;
            this.medicine_pricing_id = item.medicine_pricing_id
            this.amount = item.amount;
            this.medicine_id = item.medicine_id;
        }


    }
});
