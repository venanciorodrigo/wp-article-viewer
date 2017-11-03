<template>
    <div id="app">
        <div v-if="posts.length">
            <div class="categories">
                <span>Filter:</span>
                    <a v-on:click="getPostList" class="category all">All Categories</a>
                <template v-for="category in categories">
                    <a v-bind:class="{ active: isActive }" v-on:click="categoryFilter(category.id)" class="category">{{ category.name }}</a>
                </template>
            </div>
            <div class="content">
                <transition v-for="position in [currentPost]" name="fade" mode="out-in">
                    <div transition="fade" :key="position" >
                        <v-touch v-on:swipeleft="prev" v-on:swiperight="next">
                            <div>
                            <h1 v-html="posts[currentPost].title.rendered"></h1>

                            <div v-if="posts[currentPost]._embedded['wp:featuredmedia']">
                                <img v-bind:src="posts[currentPost]._embedded['wp:featuredmedia'][0].media_details.sizes['full'].source_url" >
                            </div>

                            <h4 v-html="posts[currentPost].content.rendered"></h4>
                            </div>
                        </v-touch>

                    </div>
                </transition>
                <div class="previous"><a href="#" v-if="currentPost > 0" v-on:click="prev"><<<< Previous</a></div>
                <div class="next"><a href="#" v-if="currentPost < posts.length - 1" v-on:click="next">Next >>>></a></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return {
                posts: {},
                categories: {},
                currentPost: 0,
                apiPath: "../wp-json/wp/v2/",
                isActive: false,
                categoriesSelected: null
            }
        },
        created() {
            var self = this;

            // Categories selected by the user on plugin settings
            this.getSelectedCategories();

            // Key bindings
            window.addEventListener('keyup', function(event) {

                // Redirect to the previous post
                if (event.keyCode == 74) {
                    if(self.currentPost > 0)
                        self.prev();
                }

                // Redirect to next post
                if (event.keyCode == 75) {
                    if(self.currentPost < self.posts.length - 1)
                        self.next();
                }
            });

        },
        methods: {
            next: function() {
                if(this.currentPost < this.posts.length - 1)
                    this.currentPost += 1
            },
            prev: function() {
                if(this.currentPost > 0)
                    this.currentPost -= 1
            },
            categoryFilter: function(categoryId) {
                this.$http.get(this.apiPath + 'posts?_embed&categories=' + categoryId).then(function(response){
                    this.currentPost = 0;
                    this.posts = response.data;
                });
            },
            getPostList: function() {
                this.$http.get(this.apiPath + 'posts?_embed&categories=' + this.categoriesSelected).then(function(response){
                    this.posts = response.data;
                });
            },
            getCategoryList: function() {
                this.$http.get(this.apiPath + 'categories?include=' + this.categoriesSelected).then(function(response){
                    this.categories = response.data;
                });
            },
            getSelectedCategories: function() {
                this.$http.get(this.apiPath + 'article-viewer').then(function(response){
                    this.categoriesSelected = response.data.toString();
                    if(this.categoriesSelected) {
                        // Categories List
                        this.getCategoryList();

                        // Posts List
                        this.getPostList();
                    }

                });
            }
        }
    }
</script>
<style lang="scss">@import 'main.scss'</style>