<template>
    <div v-if="article">
        <h1>{{ article.title.rendered }}</h1>
        <div v-if="article._embedded['wp:featuredmedia']">
            <img v-bind:src="article._embedded['wp:featuredmedia'][0].media_details.sizes['issuem-featured-rotator-image'].source_url" >
        </div>
        <h4 v-html="article.content.rendered"></h4>
        <div class="previous"><router-link v-if="article.next_post" :to="{ name: 'article', params: { id: article.next_post.id }}"><<< Previous</router-link></div>
        <div class="next"><router-link v-if="article.previous_post" :to="{ name: 'article', params: { id: article.previous_post.id }}">Next >>></router-link></div>
    </div>
</template>
<script>
    export default{
        data(){
            return {
                article: null
            }
        },
        mounted() {
            this.fetchData();
        },
        methods: {
            fetchData: function() {
                var self = this;
                var articleId = self.$route.params.id;
                this.$http.get('../wp-json/wp/v2/posts/' + articleId + '?_embed').then(function(response){
                    self.article = response.data;
                });
            }
        }
    }
</script>