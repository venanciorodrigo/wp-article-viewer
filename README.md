# WP Article Viewer

Wordpress Plugin that publishes an article viewer with key bindings with animations to navigate to the previous / next article. 

Use **<** (Previous) and **>** for forward. Support for swipping on touch-enabled devices :)

## Built With

* Wordpress https://wordpress.com/
* Vue.js v2 https://vuejs.org/
* WP-API v2 http://v2.wp-api.org/

![Image](https://dzwonsemrish7.cloudfront.net/items/022S2n2l2Q1P3c1H3p46/Image%202018-09-15%20at%2010.38.35%20am.png)

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

## Demo

![Image](https://dzwonsemrish7.cloudfront.net/items/2F2Q3E173O0a241V2K0L/Screen%20Recording%202018-09-15%20at%2012.31%20pm.gif)

http://rodrigovenancio.info/viewer

## Author

* **Rodrigo Venancio** - http://rodrigovenancio.info/
