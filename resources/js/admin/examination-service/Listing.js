import AppListing from '../app-components/Listing/AppListing';
import {ExaminationService} from '../event-bus/app-events';

Vue.component('examination-service-listing', {
    mixins: [AppListing],
    created(){
        this.$eventBus.listen(ExaminationService, () => this.loadData(true));
    },
    beforeDestory() {
        this.$eventBus.remove(ExaminationService);
    },
});
import AppForm from '../app-components/Form/AppForm';
Vue.component('examination-service-view-listing', {
    mixins: [AppListing,AppForm],
    data: function() {
        return {
            groupData : [],
            mediaCollections: ['upload_file']
        }
    },
    created(){
        this.groupData = _.chain(this.collection)
        .groupBy("service.name")
        .map((value, key) => ({
            groupName: key,
            data: value
        }))
        .value();
        this.$eventBus.listen(ExaminationService, () => this.loadData(true));
    },
    beforeDestory() {
        this.$eventBus.remove(ExaminationService);
    },
    data: function () {
        return {
            patient_history_id: '',
            service_id: '',
            lab_id: '',
            lab_detail_id: '',
            value: '',
            resource_url: '',
        }
    },
    methods: {
        onSuccess: function onSuccess(data) {
            if (data.redirect) {
                window.location.replace(data.redirect);
            }
        },
    }
});
