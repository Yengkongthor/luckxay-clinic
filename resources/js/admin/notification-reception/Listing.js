import AppListing from '../app-components/Listing/AppListing';

import {
    NotificationRecepltion,
} from '../event-bus/app-events';


Vue.component('notification-reception-listing', {
    mixins: [AppListing],
    created() {
        this.$eventBus.listen(NotificationRecepltion, () => this.loadData(true));
    },
    beforeDestory() {
        this.$eventBus.remove(NotificationRecepltion);
    },
});
