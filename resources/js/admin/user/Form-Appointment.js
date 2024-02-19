import AppForm from '../app-components/Form/AppForm';
import {
    AppointmentUserCreated,
    AppointmentUserModalCancel
} from '../event-bus/app-events';

Vue.component('user-form-appointment', {
    mixins: [AppForm],
    data: function () {
        return {
            form: {
                name: '',
                surname: '',
                phone: '',
                patient: {
                    birth_date: '',
                    gender: 'male',
                    marital_status: '',
                    birth_date: new Date(),
                    blood_group: '',
                    village: null,
                    district: null,
                    province: null,
                    diseases_history: '',
                    medicine_history: '',
                    drug_allergy_or_food: 1,
                    drug_or_food: '',
                },
            },
        }
    },
    methods: {
        hideModalCreatePatient: function () {
            this.$eventBus.publish(new AppointmentUserModalCancel());
        },
        onSuccess: function onSuccess(data) {
            this.$eventBus.publish(new AppointmentUserCreated(data.user));
        },
    }
});
