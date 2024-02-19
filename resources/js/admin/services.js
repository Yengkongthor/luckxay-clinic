export default {
    methods: {
        getData(url) {
            return axios.get(url).then(response => {
                return response.data
            })
        }
    }
};
