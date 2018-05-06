Vue.component('UserList', {
    data () {
        return {
            url: '',
            title: ''
        }
    },

    methods: {
        deleteModel (url, title) {
            this.url = url
            this.title = title

            bus.$emit('show-delete-model-modal')
        }
    }
});