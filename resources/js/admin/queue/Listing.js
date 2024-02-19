import AppListing from '../app-components/Listing/AppListing';

import {
    DoctorStatus
} from '../event-bus/app-events';

Vue.component('queue-listing', {
    mixins: [AppListing],
    data: function () {
        return {
            form: {
                doctor: '',
                queueId: ''
            }
        }
    },
    methods: {
        show(item) {
            this.$modal.show('add-queue-doctor', {
                item: item
            });
        },
        hide() {
            this.$modal.hide('add-queue-doctor');
        },
        beforeOpen(event) {
            this.form.queueId = event.params.item.id
        },
        onSave() {
            var _this = this;
            var data = {
                'employee_id': _this.form.doctor,
                'queue_id': _this.form.queueId,
            }
            var url = '/admin/employee-statuses';

            axios.post(url, data).then(function (response) {
                _this.$notify({
                    type: 'success',
                    title: 'Success!',
                    text: data.message
                });
                _this.hide();
                _this.loadData();
                _this.$eventBus.publish(new DoctorStatus());


            }).catch(function (errors) {
                _this.$notify({
                    type: 'error',
                    title: 'Error!',
                    text: data.message
                });
            });

        },

        playSound(sound) {
            if (sound) {
                var audio = new Audio(sound);
                audio.play();
            }
        }
    }

});
