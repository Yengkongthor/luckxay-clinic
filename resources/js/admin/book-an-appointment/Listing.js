import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import {
    AppointmentUserCreated,
    AppointmentUserModalCancel
} from '../event-bus/app-events';

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) {
    return typeof obj;
} : function (obj) {
    return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
};

Vue.component('book-an-appointment-listing', {
    components: {
        FullCalendar
    },
    props: ['data', 'url', 'todayDate'],
    created() {
        this.$eventBus.listen(AppointmentUserModalCancel, (event) => {
            this.hideModalCreatePatient();
        });
        this.$eventBus.listen(AppointmentUserCreated, (event) => {
            this.selectedUser = event.user;
            this.hideModalCreatePatient();
        });
    },
    beforeDestory() {
        this.$eventBus.remove(AppointmentUserModalCancel);
        this.$eventBus.remove(AppointmentUserCreated);
    },
    data() {
        return {
            calendar: null,
            selected: {
                year: moment(this.todayDate).format('YYYY'),
                month: moment(this.todayDate).format('MM'),
                el: null,
                date: this.todayDate,
                dayBgColor: 'rgba(55, 136, 215, 0.3)', //'rgba(143, 223, 131, 0.3)',
            },
            dateEvents: this.data.dateEvents,
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                dateClick: this.handleDateClick,
                events: this.data.monthEvents,
                dayMaxEvents: true,
                headerToolbar: {
                    left: 'title',
                    right: 'showModalCreateAppointment myToday myPrev,myNext'
                },
                customButtons: {
                    myToday: {
                        text: 'Current month',
                        click: this.today
                    },
                    showModalCreateAppointment: {
                        text: 'Create',
                        click: this.showModalCreateAppointment,
                    },
                    myPrev: {
                        icon: 'fc-icon fc-icon-chevron-left',
                        click: this.prev
                    },
                    myNext: {
                        icon: 'fc-icon fc-icon-chevron-right',
                        click: this.next
                    }
                },
                dayCellDidMount: this.dayRender,
            },
            users: [],
            morning_times: [],
            afternoon_times: [],
            selectedUser: null,
            form: {
                user_id: null,
                booking_date: null,
                booking_time: null,
                purpose: '',
                patient: '',
                comment: '',
                important: '',
            }
        }
    },
    mounted: function () {
        this.calendar = this.$refs.fullCalendar.getApi();
    },
    methods: {
        getAppoirntmentLists: function (date) {
            var _this = this;
            return new Promise((resolve) => {
                axios.get(this.url + `?type=date&date=${date}`)
                    .then(response => resolve(response))
                    .catch(function (errors) {
                        return _this.onFail(errors.response.data);
                    });
            });
        },
        handleDateClick: function (arg) {
            this.getAppoirntmentLists(arg.dateStr)
                .then(response => {
                    if (response.data.data) {
                        this.selected.el.style.backgroundColor = ''
                        arg.dayEl.style.backgroundColor = this.selected.dayBgColor;
                        this.selected.el = arg.dayEl;
                        this.selected.date = arg.dateStr;

                        this.dateEvents = response.data.data.dateEvents;
                    }
                });
        },
        today: function () {
            this.calendar.today();
            this.getEventsByYearMonth();
        },
        prev: function () {
            this.calendar.prev();
            this.getEventsByYearMonth();
        },
        next: function () {
            this.calendar.next();
            this.getEventsByYearMonth();
        },
        getEventsByYearMonth() {
            var _this = this;
            var date = this.calendar.getDate();
            this.selected.year = date.getFullYear();
            this.selected.month = date.getMonth() + 1;

            axios.get(this.url + `?type=month&year=${this.selected.year}&month=${this.selected.month}`)
                .then(response => {
                    if (response.data.data) {
                        this.calendarOptions.events = response.data.data.monthEvents;
                    }
                }).catch(function (errors) {
                    return _this.onFail(errors.response.data);
                });
        },
        dayRender: function (dayRenderInfo) {
            if (this.selected.date == moment(dayRenderInfo.date).format('YYYY-MM-DD')) {
                this.selected.el = dayRenderInfo.el;
                dayRenderInfo.el.style.backgroundColor = this.selected.dayBgColor;
            }
        },
        showModalCreateAppointment: function () {
            var _this = this;

            if (!moment(this.selected.date).isSameOrAfter(moment(this.todayDate))) {
                alert("Can't create an appointment on past date.")
                return;
            }

            axios.get('/admin/book-an-appointments/times?date=' + this.selected.date).then(function (response) {
                var data = response.data.data;
                _this.morning_times = data.morning_times;
                _this.afternoon_times = data.afternoon_times;
                _this.users = data.users;
                _this.$modal.show('create-appointment');
            }).catch(function (errors) {
                return _this.onFail(errors.response.data);
            });
        },
        hideModalCreateAppointment: function () {
            this.morning_times = [];
            this.afternoon_times = [];
            this.selectedUser = null;
            this.form = {};
            this.$modal.hide('create-appointment');
        },
        createAppointment: function () {
            var _this = this;

            _this.form.user_id = _this.selectedUser.id;
            _this.form.booking_date = this.selected.date;

            axios.post('/admin/book-an-appointments', _this.form).then(function (response) {
                _this.hideModalCreateAppointment();
                _this.getEventsByYearMonth();
                _this.getAppoirntmentLists(_this.selected.date)
                    .then(response => {
                        if (response.data.data) {
                            _this.dateEvents = response.data.data.dateEvents;
                        }
                    });
            }).catch(function (errors) {
                return _this.onFail(errors.response.data);
            });
        },
        showModalCreatePatient: function () {
            var _this = this;
            _this.hideModalCreateAppointment();
            _this.$modal.show('create-patient');
        },
        hideModalCreatePatient: function () {
            var _this = this;
            _this.$modal.hide('create-patient');
            _this.showModalCreateAppointment();
        },
        deleteItem: function deleteItem(url) {
            var _this = this;

            this.$modal.show('dialog', {
                title: 'Warning!',
                text: 'Do you really want to delete this item?',
                buttons: [{
                    title: 'No, cancel.'
                }, {
                    title: '<span class="btn-dialog btn-danger">Yes, delete.<span>',
                    handler: function handler() {
                        _this.$modal.hide('dialog');
                        axios.delete(url).then(function (response) {
                            _this.getEventsByYearMonth();
                            _this.getAppoirntmentLists(_this.selected.date)
                                .then(response => {
                                    if (response.data.data) {
                                        _this.dateEvents = response.data.data.dateEvents;
                                    }
                                });
                            _this.$notify({
                                type: 'success',
                                title: 'Success!',
                                text: response.data.message ? response.data.message : 'Item successfully deleted.'
                            });
                        }, function (error) {
                            _this.$notify({
                                type: 'error',
                                title: 'Error!',
                                text: error.response.data.message ? error.response.data.message : 'An error has occured.'
                            });
                        });
                    }
                }]
            });
        },
        addToQueue: function (item) {
            var _this = this;
            var data = {
                patient: item.patient_id,
                comment: 'No Comment',
                important: '3',
                book_id: item.id,
            }
            var url = '/admin/queues';

            axios.post(url, data).then(function (response) {
                _this.getEventsByYearMonth();
                _this.getAppoirntmentLists(_this.selected.date)
                    .then(response => {
                        if (response.data.data) {
                            _this.dateEvents = response.data.data.dateEvents;
                        }
                    });
                _this.$notify({
                    type: 'success',
                    title: 'Success!',
                    text: response.data.message ? response.data.message : 'Item successfully '
                });
            }).catch(function (errors) {
                return _this.onFail(errors.response.data);
            });

            // alert(item.user_id);
        },
        onFail: function onFail(data) {
            this.submiting = false;
            if (_typeof(data.errors) !== (typeof undefined === 'undefined' ? 'undefined' : _typeof(undefined))) {
                var bag = this.$validator.errors;
                bag.clear();
                Object.keys(data.errors).map(function (key) {
                    var splitted = key.split('.', 2);
                    // we assume that first dot divides column and locale (TODO maybe refactor this and make it more general)
                    if (splitted.length > 1) {
                        bag.add({
                            field: splitted[0] + '_' + splitted[1],
                            msg: data.errors[key][0]
                        });
                    } else {
                        bag.add({
                            field: key,
                            msg: data.errors[key][0]
                        });
                    }
                });
                if (_typeof(data.message) === (typeof undefined === 'undefined' ? 'undefined' : _typeof(undefined))) {
                    this.$notify({
                        type: 'error',
                        title: 'Error!',
                        text: 'The form contains invalid fields.'
                    });
                }
            }
            if (_typeof(data.message) !== (typeof undefined === 'undefined' ? 'undefined' : _typeof(undefined))) {
                this.$notify({
                    type: 'error',
                    title: 'Error!',
                    text: data.message
                });
            }
        },

    }
});
