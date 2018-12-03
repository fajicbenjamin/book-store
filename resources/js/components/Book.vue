<template>
    <div class="py-4 container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{book.title}}</div>

                    <div class="card-body">
                        <img :src="image" class="embed-responsive">
                        {{book.author}}<br>
                        {{book.isbn}}<br>
                        {{book.publisher}}<br>
                        {{book.edition}}<br>
                        Available: <i class="fas fa-check" v-if="book.available"></i><br>
                        {{book.code}}<br>
                        {{book.language}}<br>
                        Number of pages: {{book.pages}}<br><br>

                        Description:<br>
                        {{book.description}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['book', 'image']
    }
</script>
