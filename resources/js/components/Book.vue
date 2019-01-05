<template>
    <div class="py-4 container">
        <div class="row">
            <div class="col-md-8">
                <img :src="image" :alt="book.title" class="card-img photo">
            </div>
            <div class="col-md-3 offset-md-1 aside">
                <button type="button" class="btn btn-outline-info edit-button" v-if="parseInt(this.currentUser) === this.user.id" @click="editBook">Edit <i class="fas fa-pen"></i></button>
                <h2>{{book.title}}</h2>
                <h5>{{book.author}}</h5>
                <p class="details">
                    ISBN: {{book.isbn}}<br>
                    Publisher: {{book.publisher}}<br>
                    Edition: {{book.edition}}<br>
                    Available: <i class="fas fa-check" v-if="book.available"></i><i class="fas fa-times" v-else></i><br>
                    Book store code: {{book.code}}<br>
                    Language: {{book.language}}<br>
                    Number of pages: {{book.pages}}<br><br>
                </p>
                <div class="price">
                    <h4>Price: {{book.price}} $</h4>
                </div>
                <p class="details-user">
                    Posted by: <a :href="'/user/' + user.id" target="_blank">{{user.name}}</a><br>
                    {{book.created_at}}
                </p>
                <button type="button" class="btn btn-info buy-button" @click="addToCart">Add to cart <i class="fas fa-shopping-cart"></i></button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['book', 'image', 'user', 'currentUser'],
        methods: {
            editBook() {
              window.location.href = '/book/' + this.book.id + '/edit'
            },
            addToCart() {
                let oldItems = JSON.parse(localStorage.getItem('books')) || [];
                oldItems.push(this.book);
                localStorage.setItem('books', JSON.stringify(oldItems));
                localStorage.setItem('cartCounter', oldItems.length)
                // update icon
                document.getElementById('cartCounter').innerText = localStorage.getItem('cartCounter') || 0;
            }
        },
        created() {
        }
    }
</script>

<style scoped>
    .photo {
        -webkit-box-shadow: 10px 10px 20px -6px rgba(0,0,0,0.75);
        -moz-box-shadow: 10px 10px 20px -6px rgba(0,0,0,0.75);
        box-shadow: 10px 10px 20px -6px rgba(0,0,0,0.75);
        height: auto;
        max-height: 80vh;
    }

    .details {
        margin-top: 30px;
    }

    .details-user {
        margin-top: 30px;
    }

    .edit-button {
        position: absolute;
        right: 0;
        top: 0;
    }

    .buy-button {
        width: 150px;
    }

    @media (max-width: 768px) {
        .aside {
            margin-top: 30px;
        }

        .price {
            text-align: center;
        }
    }
</style>