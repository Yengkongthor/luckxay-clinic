import AppListing from '../app-components/Listing/AppListing';

import {
    Payment
} from '../event-bus/app-events';

Vue.component('payment-listing', {
    mixins: [AppListing],
    data: function () {
        return {
            audio: null,
        }
    },
    created() {
        this.audio = new Audio('../audio/sound.mp3');
        this.$eventBus.listen(Payment, () => {
            this.loadData(true);
            this.audio.play();
        });
    },
    beforeDestory() {
        this.$eventBus.remove(Payment);
    },
});
