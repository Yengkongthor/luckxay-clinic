import AppListing from '../app-components/Listing/AppListing';
import AppForm from '../app-components/Form/AppForm';


var FormSupport = {

    methods: {
        onSuccessNotify: function onSuccessNotify(data) {
            this.submiting = false;
            if (data.message) {
                this.$notify({
                    type: 'success',
                    title: 'Success!',
                    text: data.message
                });
            }
        },
    }
}

Vue.component('lab-detail-listing', {
    mixins: [AppListing, AppForm, FormSupport],
    props: [
        'labId'
    ],
    data: function () {
        return {
            form: {
                lab_id: '',
                name: '',
                unit: '',
                reference: '',
                cost: '',
                price: '',

            }
        }
    },
    created() {
        this.form.lab_id = this.labId;
    },
    methods: {
        show(item) {
            this.form.name = '';
            this.form.unit = '';
            this.form.reference = '';
            this.form.cost = '';
            this.form.price = '';

            this.$modal.show('lab-detail', {
                item: item != 'null' ? item : 'null'
            });

        },
        hide() {
            this.$modal.hide('lab-detail');
        },
        beforeOpen(event) {
            var item = event.params.item;
            if (item != 'null') {
                this.form.name = item.name;
                this.form.unit = item.unit;
                this.form.reference = item.reference;
                this.form.cost = item.cost;
                this.form.price = item.price;
                this.action = item.resource_url
            }
        },
        onSuccess: function onSuccess(data) {
            this.onSuccessNotify(data);
            this.hide();
            this.loadData();
            this.formClear()
        },
    },
});
