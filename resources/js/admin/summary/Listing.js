import AppListing from '../app-components/Listing/AppListing';

Vue.component('summary-listing', {
    mixins: [AppListing],
    data: function () {
        return {
            datePickerConfig: {
                dateFormat: 'Y-m-d',
                altInput: true,
                altFormat: 'd.m.Y',
                locale: null
            },
            // startDate: '2020-10-01',
            // endDate: '2020-10-03',
            startDate: '',
            endDate: '',
            filters: {
                startDate: '',
                endDate: '',
            },
            print: null
        }
    },
    methods: {
        onView() {
            this.filters.startDate = this.startDate;
            this.filters.endDate = this.endDate;
            this.loadData(true);
        },
        onPrint() {
            var _this = this;
            var timestamp = Date.now();
            _this.print = '/admin/summaries/print?startDate=' + this.startDate + '&endDate=' + this.endDate + '&' + timestamp;
        }
    }
});
