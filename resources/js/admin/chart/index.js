Vue.component('component-chart', {

})

import BarChart from './chart.js'
Vue.component('lab-chart', {
    components: {
        BarChart
    },
    data: function data() {
        return {
            datePickerConfig: {
                dateFormat: 'Y-m-d',
                altInput: true,
                altFormat: 'd.m.Y',
                locale: null
            },
            datacollection: null,
            datacollectionTotal: null,
            datacollectionTime: null,
            datacollectionGenderMale: null,
            datacollectionGenderFemale: null,
            datacollectionProvince: null,
            fromDate: '',
            toDate: '',
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        }
    },
    mounted() {
        this.getDataChart()
    },
    methods: {
        onReview() {
            var _this = this;
            axios.get('/admin/reports/get-summary?fromDate=' + this.fromDate + '&toDate=' + this.toDate).then(function (response) {
                var data = response.data;
                _this.datacollection = {
                    labels: data.service_name_key,
                    datasets: [
                        {
                            label: ' ສະຫຼຸບລາຍຮັບທີ່ເກີດຂື້ນໃນແຕ່ລະລາຍການ',
                            backgroundColor: '#66d6e1',
                            data: data.service_name_price,
                        }
                    ],


                }
                _this.datacollectionTotal = {
                    labels: data.date,
                    datasets: [
                        {
                            label: ' ສະຫຼຸບລາຍຮັບລວມໃນແຕ່ລະວັນ',
                            backgroundColor: '#e05a5a',
                            data: data.dateTotal,
                        }
                    ]
                }
                _this.datacollectionTime = {
                    labels: data.timeName,
                    datasets: [
                        {
                            label: ' ສະຫຼຸບຈຳນວນຄົນທີ່ມາໃຊ້ບໍລິການຕາມຊ່ວງເວລາທີ່ມາໃຊ້ບໍລິການ',
                            backgroundColor: '#e05a5a',
                            data: data.timeValue,
                        }
                    ]
                }
                _this.datacollectionGenderMale = {
                    labels: data.maleAge,
                    datasets: [
                        {
                            label: ' ສະຫຼຸບຈຳນວນຄົນທີ່ມາໃຊ້ບໍລິການຕາມອາຍູ (ຊາຍ)',
                            backgroundColor: '#e05a5a',
                            data: data.maleTotal,
                        }
                    ]
                }
                _this.datacollectionGenderFemale = {
                    labels: data.femaleAge,
                    datasets: [
                        {
                            label: ' ສະຫຼຸບຈຳນວນຄົນທີ່ມາໃຊ້ບໍລິການຕາມອາຍູ (ຍິງ)',
                            backgroundColor: '#e05a5a',
                            data: data.femaleTotal,
                        }
                    ]
                }
            }, function (error) {

            });
        },
        getDataChart() {
            var _this = this;
            axios.get('/admin/reports/get-summary').then(function (response) {
                var data = response.data;
                _this.datacollection = {
                    labels: data.service_name_key,
                    datasets: [
                        {
                            label: ' ສະຫຼຸບລາຍຮັບທີ່ເກີດຂື້ນໃນແຕ່ລະລາຍການ',
                            backgroundColor: '#66d6e1',
                            data: data.service_name_price,
                        }
                    ]
                }
                _this.datacollectionTotal = {
                    labels: data.date,
                    datasets: [
                        {
                            label: ' ສະຫຼຸບລາຍຮັບລວມໃນແຕ່ລະວັນ',
                            backgroundColor: '#e05a5a',
                            data: data.dateTotal,
                        }
                    ]
                }
                _this.datacollectionTime = {
                    labels: data.timeName,
                    datasets: [
                        {
                            label: ' ສະຫຼຸບຈຳນວນຄົນທີ່ມາໃຊ້ບໍລິການຕາມຊ່ວງເວລາທີ່ມາໃຊ້ບໍລິການ',
                            backgroundColor: '#e05a5a',
                            data: data.timeValue,
                        }
                    ]
                }
                _this.datacollectionGenderMale = {
                    labels: data.maleAge,
                    datasets: [
                        {
                            label: ' ສະຫຼຸບຈຳນວນຄົນທີ່ມາໃຊ້ບໍລິການຕາມອາຍູ (ຊາຍ)',
                            backgroundColor: '#e05a5a',
                            data: data.maleTotal,
                        }
                    ]
                }
                _this.datacollectionGenderFemale = {
                    labels: data.femaleAge,
                    datasets: [
                        {
                            label: ' ສະຫຼຸບຈຳນວນຄົນທີ່ມາໃຊ້ບໍລິການຕາມອາຍູ (ຍິງ)',
                            backgroundColor: '#e05a5a',
                            data: data.femaleTotal,
                        }
                    ]
                }
                _this.datacollectionProvince = {
                    labels: data.provinceName,
                    datasets: [
                        {
                            label: ' ສະຫຼຸບຈຳນວນຄົນທີ່ມາໃຊ້ບໍລິການຕາມຂອບເຂດພື້ນທີ່',
                            backgroundColor: '#e05a5a',
                            data: data.provinceValue,
                        }
                    ]
                }
            }, function (error) {

            });

        },

    }
})

