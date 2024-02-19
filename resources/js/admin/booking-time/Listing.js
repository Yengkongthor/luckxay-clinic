import AppListing from '../app-components/Listing/AppListing';
import {
    BookingTimeCreatedEvent,
    BookingTimeEditEvent,
} from '../event-bus/app-events';

Vue.component('booking-time-listing', {
    mixins: [AppListing],
    props: [
        'type'
    ],
    created() {
        this.$eventBus.listen(BookingTimeCreatedEvent, (event) => {
            if (this.type == event.type) this.loadData(true);
        });
    },
    beforeDestory() {
        this.$eventBus.remove(BookingTimeCreatedEvent);
    },
    methods: {
        onEdit(item) {
            this.$eventBus.publish(new BookingTimeEditEvent(this.type, item));
        }
    }
});