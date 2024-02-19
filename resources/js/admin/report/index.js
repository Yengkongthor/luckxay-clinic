import AppForm from '../app-components/Form/AppForm';


Vue.component('report-form', {
    mixins: [AppForm],

    data: function () {
        return {
            datePickerConfig: {
                dateFormat: 'Y-m-d ',
                altInput: true,
                altFormat: 'd.m.Y',
                locale: null
            },
            date_form: '',
            date_to: '',
            print: null,
            printStock: null,
            title: '',
            status: ''
        }
    },
    created() {},
    methods: {
        show(title, status) {
            this.title = title;
            this.status = status;
            this.date_form = ''
            this.date_to = ''
            this.$modal.show('report');
        },
        hide() {
            this.$modal.hide('report');
        },
        onPirntReport(status) {
            var _this = this;
            var timestamp = Date.now();
            _this.print = '/admin/reports/print/' + this.date_form + '/' + this.date_to + '/' + status + '?' + timestamp;

        },
        onPirntReportAddStock() {
            var _this = this;
            var timestamp = Date.now();
            _this.printStock = '/admin/reports/print/add/stock/' + this.date_form + '/' + this.date_to + '?' + timestamp;

        },
    }

});
