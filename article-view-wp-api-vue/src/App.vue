<template>
    <div id="app">
        <div class="categories">
            <span>Categories:</span>
            <template v-for="category in categories">
                <a href="#" class="category">{{ category.name }}</a>
            </template>
        </div>
        <div class="content">
            <transition name="fade" mode="out-in">
                <router-view :key="$route.fullPath"></router-view>
            </transition>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return {
                categories: null
            }
        },
        created() {
            var self = this;

            // redirect to the last article created
            if(!self.$route.params.id) {
                self.$http.get('../wp-json/wp/v2/posts?per_page=1').then(function(response){
                    self.$router.push({ name: 'article', params: { id: response.data[0].id }});
                });
            }

            // Get Categories
            self.$http.get('../wp-json/wp/v2/categories').then(function(response){
                self.categories = response.data;
            });

            // If the key "k" or "j" was pressed...
            window.addEventListener('keyup', function(event) {
                var articlePrevious = self.$children[0]._data.article.next_post;
                var articleNext = self.$children[0]._data.article.previous_post;

                // Redirect to the previous post
                if (event.keyCode == 74 && articlePrevious !== null) {
                    self.$router.push({ name: 'article', params: { id: articlePrevious.id }});
                }

                // Redirect to next post
                if (event.keyCode == 75 && articleNext !== null) {
                    self.$router.push({ name: 'article', params: { id: articleNext.id }});
                }
            });
        },
    }
</script>

<style lang="scss">
body{
    background-color: #F3F3F3;
}
#app {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 50px;
}

.content {
    width: 700px;
    margin-left: auto;
    margin-right: auto;
    background-color: #fff;
    padding: 10px 30px 40px;
    border: 2px solid #EAEAEA;
}

.categories {
    width: 760px;
    margin-left: auto;
    margin-right: auto;
    text-align: left;
    margin-bottom: 20px;
}

.category {
    background-color: #555555;
    padding: 5px 10px;
    border-radius: 5px;
    margin: 0 5px;
    color: #fff;
}

span {
    font-size: 20px;
}

h1, h4 {
  font-weight: normal;
  text-align: left;
}

img {
    max-width: 700px;
    height: auto;
}

a {
  color: #42b983;
  text-decoration: none;
}

.fade-enter-active, .fade-leave-active {
    transition: opacity .5s
}
.fade-enter, .fade-leave-active {
    opacity: 0
}

.previous {
    float: left;
}

.next {
    float: right;
}
</style>
