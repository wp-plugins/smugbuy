=== SmugBuy ===
Contributors: chrismartino
Donate link: http://chrismartino.com/smugbuy
Tags: smugmug, photography, photographer, photograh, photographs, photo, photos, ecommerce, sell, image, images, picture, pictures, print, prints, wordpress, shortcode, post, page, links, plugin, cart, shopping
Requires at least: 2.8
Tested up to: 3.3.1
Stable tag: 1.1.3

A plugin to automatically insert SmugMug "buy" links into wordpress posts and pages using a shortcode.

== Description ==

In January 2011 SmugMug introduced a new feature that enabled users to add a photo directly to the SmugMug shopping
cart from external websites.  This plugin parses the standard SmugMug photo page and automatically creates a custom
tailored "buy" link to add to your WordPress posts and pages via a shortcode.

Visit the [SmugBuy homepage](http://chrismartino.com/smugbuy/) for more information on how to incorporate the plugin into your blog.

For more information on SmugMug head to [www.smugmug.com](http://www.smugmug.com).

== Installation ==

1. Make sure you have printing enabled in your gallery settings on SmugMug.
1. Upload `smugbuy.php` to the `/wp-content/plugins/` directory.
1. Activate the plugin through the *Plugins* menu in WordPress.
1. Edit the SmugBuy options through the *Settings* menu in WordPress.
1. Place `[smugbuy photo="<smugmug photo url>"]` or `[smugbuy gallery="<smugmug gallery url>"]` in the post or page where you'd like your "buy" link to show up.

Example (Photo w/o display):

`[smugbuy photo="http://prints.chrismartino.com/Galleries/ForYourWall/12948111_n28si#812797367_X3w3G"]`

Example (Photo w/ display):

`[smugbuy photo="http://prints.chrismartino.com/Galleries/ForYourWall/12948111_n28si#812797367_X3w3G" display="yes"]`

Example (Gallery):

`[smugbuy gallery="http://prints.chrismartino.com/Galleries/ForYourWall/12948111_n28si"]`

== Frequently Asked Questions ==

= I recently upgraded my SmugBuy plugin, however some of the options are missing.  What do I do? =

Try deactivating and reactivating SmugBuy from the *Plugins* administration screen.

= How do I customize the SmugBuy links using CSS? =

First, you must enable the use of `smugbuy.css` in the SmugBuy settings screen.  Once enabled edit `smugbuy.css` in the *Plugins* editor screen.

= Why aren't my SmugBuy links generating properly? =
Sometimes using the visual editor can create problems with SmugBuy.  If you're using the visual editor make sure the SmugMug links don't get linkified.  If they do, click on the `unlink` icon on the toolbar, or press `alt-shift-a`.

== Screenshots ==

1. The administration panel.
2. Example post.
3. Post editor example.

== Changelog ==

= 1.1.3 =
* Added some support options in the admin screen.
* Verified compatibility with WordPress 3.3.1.

= 1.1.2 =
* Added option to open the "buy" link in a new window.
* Verified compatibility with WordPress 3.1.

= 1.1.1 =
* Added the ability to customize the links using a css file.  The feature is disabled by default and can be enabled in the SmugBuy options panel.

= 1.1 =
* Added gallery support.
* Added the ability to display the image along with the "buy" link.
* Added "Settings" link on the plugin page.

= 1.0.1 =
* Changed method for obtaining the smugmug url, thus elimating the "smugbuy_url" option.

= 1.0 =
* Initial release.

== Upgrade Notice ==

= 1.1.3 =
Support options now in the admin screen!

= 1.1.2 =
Open your "buy" links in a new window!

= 1.1.1 =
Customize the links using CSS!

= 1.1 =
Display the photo above your "buy" link, and also insert gallery "buy" links!

= 1.0.1 =
Simplifies the user definable options in the administration panel.

== Donations ==

To support this plugin and it's development, please consider [purchasing a fine art print](http://prints.chrismartino.com/buy/12948111_n28si) from me.  Prints start at $10 USD and will look great
displayed on your wall or desk.
