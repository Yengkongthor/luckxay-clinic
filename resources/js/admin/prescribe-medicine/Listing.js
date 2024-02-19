import AppListing from '../app-components/Listing/AppListing';
import {
    PrescribeMedicines
} from '../event-bus/app-events';

Vue.component('prescribe-medicine-listing', {
    mixins: [AppListing],
    data: function () {
        return {
            audio: null,
        }
    },
    created() {
        this.audio = new Audio('../audio/sound.mp3');
        this.$eventBus.listen(PrescribeMedicines, () => {
            this.loadData(true);
            this.audio.play();
        });
    },
    beforeDestory() {
        this.$eventBus.remove(PrescribeMedicines);
    },
});
