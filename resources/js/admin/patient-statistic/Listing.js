import {
    method
} from 'lodash';
import AppListing from '../app-components/Listing/AppListing';

Vue.component('patient-statistic-listing', {
    mixins: [AppListing],
    data: function data() {
        return {
            datePickerConfig: {
                dateFormat: 'Y-m-d H:i:S',
                altInput: true,
                altFormat: 'd.m.Y',
                locale: null
            },
            filters: {
                startDate: '',
                endDate: ''
            },
            startDate: '',
            endDate: '',
        }

    },
    methods: {
        onView() {
            this.filters.startDate = this.startDate;
            this.filters.endDate = this.endDate;
            this.loadData();
        }
    }
});
