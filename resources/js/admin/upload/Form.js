import AppForm from '../app-components/Form/AppForm';

Vue.component('upload-form', {
    mixins: [AppForm],
    props :{
        patientHistoryId: Number,
        employeeId: Number,
    },
    data: function () {
        return {
            form: {
                employee_id: this.employeeId,
                patient_history_id: this.patientHistoryId,

            },
            mediaCollections: ['upload_file']
        }
    },
    created() {},
    mounted() {}

});
