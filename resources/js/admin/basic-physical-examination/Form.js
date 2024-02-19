import AppForm from '../app-components/Form/AppForm';

Vue.component('basic-physical-examination-form', {
    mixins: [AppForm],
    props: [
        'patientId'
    ],
    data: function () {
        return {
            form: {
                patient_id: '',
                pressure: '',
                weight: '',
                temperature: '',
                ta: '',
                spo2: '',
                pr: '',
                bp: '',
                rr: '',
            }
        }
    },
    created() {
        this.form.patient_id = this.patientId;
    }

});
