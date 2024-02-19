import AppForm from '../app-components/Form/AppForm';
import {
    BookingTimeCreatedEvent,
    BookingTimeEditEvent,
} from '../event-bus/app-events';

var FormSupport = {
    data: function () {
        return {
            actionOverride: this.action,
            timePickerConfig: {
                enableTime: true,
                noCalendar: true,
                time_24hr: true,
                enableSeconds: false,
                dateFormat: 'H:i:S',
                altInput: true,
                altFormat: 'H:i',
                locale: null
            },
        }
    },
    methods: {
        onSubmit: function onSubmit() {
            var _this4 = this;

            return this.$validator.validateAll().then(function (result) {
                if (!result) {
                    _this4.$notify({
                        type: 'error',
                        title: 'Error!',
                        text: 'The form contains invalid fields.'
                    });
                    return false;
                }

                var data = _this4.form;
                if (!_this4.sendEmptyLocales) {
                    data = _.omit(_this4.form, _this4.locales.filter(function (locale) {
                        return _.isEmpty(_this4.form[locale]);
                    }));
                }

                _this4.submiting = true;

                axios.post(_this4.actionOverride, _this4.getPostData()).then(function (response) {
                    return _this4.onSuccess(response.data);
                }).catch(function (errors) {
                    return _this4.onFail(errors.response.data);
                });
            });
        },
        onSuccessNotify: function onSuccessNotify(data) {
            this.submiting = false;
            this.actionOverride = this.action;
            this.form.start_time = '';
            this.form.end_time = '';
            if (data.message) {
                this.$notify({
                    type: 'success',
                    title: 'Success!',
                    text: data.message
                });
            }
        },
    }
}

Vue.component('booking-time-form', {
    mixins: [AppForm, FormSupport],
    props: [
        'type'
    ],
    created() {
        this.$eventBus.listen(BookingTimeEditEvent, (event) => {
            if (this.type != event.type) return;
            var item = event.item;
            this.form.start_time = item.start_time;
            this.form.end_time = item.end_time;
            this.actionOverride = item.resource_url;
        });
    },
    beforeDestory() {
        this.$eventBus.remove(BookingTimeEditEvent);
    },
    data: function () {
        return {
            form: {
                start_time: '',
                end_time: '',
                status_time: this.type,
            }
        }
    },
    methods: {
        onSuccess: function onSuccess(data) {
            this.$eventBus.publish(new BookingTimeCreatedEvent(this.type));
            this.onSuccessNotify(data);
        },
    }
});