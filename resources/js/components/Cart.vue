<template>
    <div>
        <div class="py-4 container">
            <div class="row justify-content-center">
                <div class="col-md-8" v-if="books.length > 0">
                    <div class="text-center">
                        <h4>Total price of the cart is: <b>{{price}} $</b>.
                            Click <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#buyModal">here</button> to proceed.</h4>
                    </div>
                    <div class="card" v-for="book in books">
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <img :src="getImageUrl(book)" class="photo img-thumbnail">
                            </div>
                            <div class="col-md-4 col-12 text-center" style="line-height: 99px;">
                                <span class="align-middle title">{{book.title}}</span>
                            </div>
                            <div class="col-md-2 col-8 text-center" style="line-height: 99px;">
                                <span class="align-middle title">${{book.price}}</span>
                            </div>
                            <div class="col-md-1 col-8 text-center">
                                <input type="number" style="width: 50px; margin-top: 5vh;" v-model="book.quantity" @change="computePrice">
                            </div>
                            <div class="col-md-2 col-3 text-center" style="line-height: 99px;">
                                <i class="fa fa-times" style="cursor: pointer;" @click="removeFromCart(book)"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8" v-else>
                    <h2>Cart is empty.</h2>
                </div>
            </div>
        </div>

        <!-- BUY MODAL -->
        <div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="buyModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Buy books</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Whole receipt will cost <b>{{price}}$</b>
                        <form>
                            <div class="form-group">
                                <label for="card-holder" class="col-form-label">Card holder name:</label>
                                <input type="text" class="form-control" id="card-holder" v-model="name">
                            </div>
                            <div class="form-group">
                                <label for="card-number" class="col-form-label">Card number:</label>
                                <input type="text" class="form-control" id="card-number" v-model="number">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="buy">Buy</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                books: [],
                quantities: [],
                price: 0,
                name: '',
                number: '',
                status: false
            }
        },
        created() {
            this.books = JSON.parse(localStorage.getItem('books')) || []
            this.books.forEach((book) => {
                book.quantity = 1
            })
            this.computePrice()
        },
        methods: {
            getImageUrl(book) {
                return process.env.MIX_APP_URL + '/storage/' + book.media[0].id + '/' + book.media[0].file_name
            },
            removeFromCart(book) {
                let oldItems = JSON.parse(localStorage.getItem('books')) || [];
                let filtered = oldItems.filter(function (value, index, arr) {
                    return value.id !== book.id
                });
                this.books = filtered
                console.log(filtered)
                localStorage.setItem('books', JSON.stringify(filtered));
                localStorage.setItem('cartCounter', filtered.length)
                // update icon
                document.getElementById('cartCounter').innerText = localStorage.getItem('cartCounter') || 0;
            },
            buy() {
                if (this.name === 'Benjamin Fajić' && this.number === '12345678') {
                    alert('You have successfully finished transaction!')
                    $('#buyModal').modal('hide')
                    this.books = []
                    localStorage.setItem('books', JSON.stringify([]));
                    localStorage.setItem('cartCounter', 0)
                    // update icon
                    document.getElementById('cartCounter').innerText = 0;
                } else {
                    alert('Your transaction failed.')
                }
            },
            computePrice() {
                let sum = 0
                this.books.forEach((book) => {
                    sum += book.price * book.quantity
                })
                this.price = sum
            }
        }
    }
</script>

<style scoped>
    .photo {
        width: 100%;
        height: 100px;
    }
    .title {
        font-size: 30px;
    }
</style>