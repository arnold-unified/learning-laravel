<template>
    <div class="modal fade" id="delete-model-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="delete-model-modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-model-modal-label">Delete "{{ title }}"</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Are you sure want to delete <strong>{{ title }}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" :disabled="busy" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button @click.stop.prevent="deleteModel" :disabled="busy" type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'DeleteModel',
        
        props: {
            dataUrl: {
                type: String,
                default: null
            },
            dataTitle: {
                type: String,
                default: 'Delete'
            }
        },

        created () {
            bus.$on('show-delete-model-modal', () => {
                this.showModal()
            })
        },

        data () {
            return {
                url: null,
                title: null,
                busy: false
            }
        },

        methods: {
            showModal () {
                $('#delete-model-modal').modal('show')
            },
            hideModal () {
                $('#delete-model-modal').modal('hide')
            },
            deleteModel () {
                this.busy = true

                axios.delete(this.url)
                    .then(response => {
                        alert(response.data.message)

                        this.busy = false
                        
                        setTimeout(() => {
                            this.hideModal()
                            window.location.reload(true)
                        }, 500)
                    })
                    .catch(error => {
                        let response = error.response

                        if (response) {
                            alert(response.data.message)
                            this.hideModal()
                        }

                        this.busy = false
                    })
            }
        },

        watch: {
            dataUrl () {
                this.url = this.dataUrl
            },
            dataTitle () {
                this.title = this.dataTitle
            }
        }
    }
</script>
