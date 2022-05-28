// import Swal from 'sweetalert2'
export const errorsMixin = {
    methods: {
        errorClass(item) {
            return { 'form-control': true, 'is-invalid': this.errors.hasOwnProperty(item) }
        },
        getError(item) {
            return (this.errors && this.errors.hasOwnProperty(item)) ? this.errors[item][0] : null
        }
    },
    computed: {
        hasErrors() {
            return _.isEmpty(this.errors)
        }
    },
}
