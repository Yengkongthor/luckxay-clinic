import AppListing from '../app-components/Listing/AppListing';
import {
    ReceptionAssignDoctor,
    Examination,
    ExaminationResult,
    AssignQueueToDoctor
} from '../event-bus/app-events';


Vue.component('examination-processing-listing', {
    mixins: [AppListing],
    data: function data() {
        return {
            filters: {
                status: 'all'
            },
            patient_history_last: '',
            queue_id: ''

        }
    },
    created() {
        this.$eventBus.listen(AssignQueueToDoctor, () => this.loadData(true));
    },
    beforeDestory() {
        this.$eventBus.remove(AssignQueueToDoctor);
    },
    methods: {
        show(item) {
            this.$modal.show('examination', {
                item: item
            });
        },
        hide() {
            this.$modal.hide('examination');
        },
        beforeOpen(event) {
            var item = event.params.item;
            this.patient_history_last = item.patient_history_last;
            this.queue_id = item.id;
        },
        onExaminationResult() {
            var _this = this;
            var data = {
                'queue_id': this.queue_id,
            }
            axios.post('/admin/queues/change/status', data).then(function (response) {
                _this.loadData();
                _this.hide();
            }).catch(function (errors) {
                console.log(errors);
            });
        },
    }
});



Vue.component('examination-listing', {
    mixins: [AppListing],
    data: function data() {
        return {
            filters: {
                status: 'all'
            },
            patient_history_last: '',
            queue_id: ''

        }
    },
    created() {
        this.$eventBus.listen(Examination, () => this.loadData(true));
    },
    beforeDestory() {
        this.$eventBus.remove(Examination);
    },
    methods: {
        show(item) {
            this.$modal.show('examination', {
                item: item
            });
        },
        hide() {
            this.$modal.hide('examination');
        },
        beforeOpen(event) {
            var item = event.params.item;
            this.patient_history_last = item.patient_history_last;
            this.queue_id = item.id;
        },
        onExaminationResult() {
            var _this = this;
            var data = {
                'queue_id': this.queue_id,
            }
            axios.post('/admin/queues/change/status', data).then(function (response) {
                _this.loadData();
                _this.hide();
                _this.$eventBus.publish(new ExaminationResult());
            }).catch(function (errors) {
                console.log(errors);
            });
        },
    }
});


Vue.component('examination-result-listing', {
    mixins: [AppListing],
    data: function data() {
        return {}
    },
    created() {
        this.$eventBus.listen(ExaminationResult, () => this.loadData(true));
    },
    beforeDestory() {
        this.$eventBus.remove(ExaminationResult);
    },

});
