# WP Article Viewer

Wordpress Plugin that publishes an article viewer with key bindings to navigate to the previous / next article. Use "J (Previous) and "K" for forward. Support for swipping on touch-enabled devices :)

## Built With

* Wordpress https://wordpress.com/
* Vue.js v2 https://vuejs.org/
* WP-API v2 http://v2.wp-api.org/

![Image](https://d2ppvlu71ri8gs.cloudfront.net/items/1c1V3d2j2a442B0Y3U3K/Image%202017-04-26%20at%204.12.01%20am.png?v=dcffbac5)

## Getting Started

* Download the last plugin release.
* Decompress it into your WP plugin folder.
* Activate via admin plugins `wp-admin/plugins.php`
* Go to the plugin settings (It will create a new menu called `Article Viewer` on your WP Admin).
* Select the categories that you want to show.
* Create a new page to show the plugin in action i.e `/viewer` and define the `Template` for this page as `Article Viewer`
* Go to your Wordpress page. i.e. http://yourdomain.com/viewer

## How to hack the project

* Via terminal access the plugin folder and `cd article-view-wp-api-vue`
* Inside of `article-view-wp-api-vue` folder run the command `npm install`
* After that just run `npm run dev` and you're abble to make changes on the project.

## Author

* **Rodrigo Venancio** - http://rodrigovenancio.info/
