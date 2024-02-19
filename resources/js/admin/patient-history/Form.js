import AppForm from '../app-components/Form/AppForm';

Vue.component('patient-history-form', {
    mixins: [AppForm],
    props: [
        'patients',
    ],
    data: function () {
        return {
            form: {
                patient_id: '',
                weight: '',
                temperature: '',
                test_at: '',
                patient: ''

            }
        }
    }

});
