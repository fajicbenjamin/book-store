<template>
    <div class="col-4 offset-4 py-4">
        <form @submit.prevent="submitForm">
            <div class="form-group">
                <!--<label for="title">Title</label>-->
                <input v-model="title" type="text" class="form-control" id="title" placeholder="Enter title of the book">
            </div>
            <div class="form-group">
                <!--<label for="author">Author</label>-->
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
                <!--<label for="isbn">ISBN</label>-->
                <input v-model="isbn" type="text" class="form-control" id="isbn" placeholder="Enter 13-digit ISBN code">
            </div>
            <div class="form-group">
                <!--<label for="pages">Number of pages</label>-->
                <input v-model="pages" type="number" class="form-control" id="pages" placeholder="Enter number of pages">
            </div>
            <div class="form-group">
                <!--<label for="language">Language</label>-->
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
                            <input v-model="available" @change="test" type="checkbox" class="form-check-input" id="available">
                            <label class="form-check-label" for="available">Available</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <!--<label for="description">Description</label>-->
                <textarea v-model="description" class="form-control" id="description" rows="3" placeholder="Description about the book"></textarea>
            </div>
            <div class="form-group">
                <!--<label for="price">Price</label>-->
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
                price: null
            }
        },
        methods: {
            test() {
                console.log(this.available)
            },
            handleImageUpload () {
                console.log('udje')
                this.image = this.$refs.file.files[0]
                console.log(this.image)
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

                axios.post('/book/store', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then(function (response) {
                        console.log(response)
                    })
                    .catch(function(error) {
                        console.log(error.response.data)
                    })
            }
        }
    }
</script>

<style scoped>

</style>