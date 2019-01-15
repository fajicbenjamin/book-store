<template>
    <div class="col-sm-12 col-md-4 offset-md-4 py-4">
        <div class="alert alert-danger" role="alert" v-show="errors.length > 0">
            <span v-for="error in errors">{{error}}<br></span>
        </div>
        <form @submit.prevent="submitForm">
            <div class="form-group">
                <input v-model="title" type="text" class="form-control" id="title" placeholder="Enter title of the book">
            </div>
            <div class="form-group">
                <input v-model="author" type="text" class="form-control" id="author" placeholder="Enter name of the author">
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="col">
                        <input v-model="publisher" type="text" class="form-control" id="publisher" placeholder="Publisher">
                    </div>
                    <div class="col">
                        <input v-model="edition" type="text" class="form-control" id="edition" placeholder="Edition of the book">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input v-model="isbn" type="text" class="form-control" id="isbn" placeholder="Enter 13-digit ISBN code">
            </div>
            <div class="form-group">
                <input v-model="pages" type="number" class="form-control" id="pages" placeholder="Enter number of pages">
            </div>
            <div class="form-group">
                <input v-model="language" type="text" class="form-control" id="language" placeholder="Language of the book">
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="col">
                        <label for="image">Upload image</label>
                        <input type="file" ref="file" class="form-control-file" id="image" @change="handleImageUpload">
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input v-model="available" type="checkbox" class="form-check-input" id="available">
                            <label class="form-check-label" for="available">Available</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <textarea v-model="description" class="form-control" id="description" rows="3" placeholder="Description about the book"></textarea>
            </div>
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input v-model="price" type="number" class="form-control" id="price" placeholder="Enter price of the book">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        props: ['book'],
        data: function () {
            return {
                title: '',
                author: '',
                publisher: '',
                isbn: '',
                pages: null,
                language: '',
                edition: '',
                available: 0,
                image: '',
                description: '',
                price: null,
                errors: []
            }
        },
        created() {
          if (this.book) {
              this.fillFields(this.book)
          }
        },
        methods: {
            handleImageUpload () {
                this.image = this.$refs.file.files[0]
            },
            submitForm () {
                let vm = this
                let formData = new FormData()
                // need to append all fields to FormData instead of passing directly from data
                // because have to send FormData due to appending image file
                formData.append('title', vm.title)
                formData.append('author', vm.author)
                formData.append('publisher', vm.publisher)
                formData.append('isbn', vm.isbn)
                formData.append('pages', vm.pages)
                formData.append('language', vm.language)
                formData.append('edition', vm.edition)
                formData.append('available', vm.available ? 1 : 0)
                formData.append('description', vm.description)
                formData.append('price', vm.price)
                formData.append('image', vm.image)

                vm.errors = []
                let url = '/book/store'

                if (vm.book) {
                    url = '/book/' + vm.book.id + '/update'

                    axios.post(url, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                        .then(function (response) {
                            if (response.status === 200 || response.status === 201) {
                                window.location.href = '/book/' + response.data
                            } else {
                                console.log(response)
                            }
                        })
                        .catch(function(error) {
                            for (let prop in error.response.data) {
                                error.response.data[prop].forEach((iter) => {
                                    vm.errors.push(iter)
                                })
                            }
                        })
                } else {
                    axios.post(url, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                        .then(function (response) {
                            if (response.status === 200 || response.status === 201) {
                                window.location.href = '/book/' + response.data
                            } else {
                                console.log(response)
                            }
                        })
                        .catch(function(error) {
                            for (let prop in error.response.data) {
                                error.response.data[prop].forEach((iter) => {
                                    vm.errors.push(iter)
                                })
                            }
                        })
                }
            },
            fillFields(book) {
                this.title = book.title
                this.author = book.author
                this.publisher = book.publisher
                this.isbn = book.isbn
                this.pages = book.pages
                this.language = book.language
                this.edition = book.edition
                this.available = book.available
                this.description = book.description
                this.price = book.price
            }
        }
    }
</script>

<style scoped>

</style>