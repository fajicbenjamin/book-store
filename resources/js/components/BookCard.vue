<template>
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" :src="image" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{book.title}}</h5>
            <p class="card-text">{{book.description}}</p>
            <a href="#" class="btn btn-primary">Buy book</a>
            Price: {{book.price}}
        </div>
    </div>
</template>

<script>
    export default {
        props: ['book', 'image'],
        created () {
            console.log(this.book)
        }
    }
</script>

<style scoped>

</style>