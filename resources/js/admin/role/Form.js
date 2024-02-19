import AppForm from '../app-components/Form/AppForm';

Vue.component('role-form', {
    mixins: [AppForm],
    props: ['permissions'],
    data: function () {
        return {
            form: {
                name: '',
                guard_name: '',
            },
        }
    },
    computed: {
        isClickedAll: {
            get: function () {
                return this.permissions.length == this.form.permissions.length
            },
            set: function () { }
        }
    },
    methods: {
        groupPermissions: function (name, equal = false) {
            return this.permissions.filter(function (permission) {
                if (equal) return permission.name == name
                return permission.name.indexOf(name) === 0;
            })
        },
        onBulkItemsClickedAll: function () {
            if (this.form.permissions.length < this.permissions.length) {
                this.form.permissions = this.permissions.map((permission) => permission.id)
            } else {
                this.form.permissions = []
            }
        }
    }
});
