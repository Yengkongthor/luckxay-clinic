import AppForm from '../app-components/Form/AppForm';

Vue.component('user-form', {
    mixins: [AppForm],

    created() {
    },
    data: function () {
        return {
            form: {
                name: '',
                surname: '',
                phone: '',
                patient: {
                    lao_first_name: '',
                    lao_last_name: '',
                    nick_name: '',
                    birth_date: '',
                    gender: 'male',
                    marital_status: '',
                    blood_group: '',
                    village: '',
                    district: '',
                    province: '',
                    diseases_history: '',
                    medicine_history: '',
                    drug_allergy_or_food: 1,
                    drug_or_food: '',
                    job: '',
                    salary: '',
                },
                password: '',
                districts: [],


            },
            mediaCollections: ['patient_photo', 'patient_document'],
        }
    },
    methods: {

        onChange(value) {
            var _this = this;

            axios.get('/admin/provinces/districts-in-province/' + value.id)
                .then(function (response) {
                    // handle success
                    _this.form.districts = response.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
        },
    }
});
