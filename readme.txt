=== Recent Posts Ultimate ===
Contributors: BearlyDoug
Plugin URI: https://wordpress.org/plugins/recent-posts-ultimate/
Donate link: https://paypal.me/BearlyDoug
Tags: Recent Posts, Posts, HTML allowed, excerpts, shortcode, categories, custom post types
Requires at least: 5.2
Tested up to: 6.4.1
Stable tag: 1.0.7
Requires PHP: 5.6
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

RPU is the ultimate recent posts plugin, even allowing HTML to be displayed. Quick, easy and efficient!

== Description ==
Recent Posts Ultimate 

This plugin takes the best features of five VERY popular recent posts plugins, tosses in the ability to show posts with or without HTML code and gives you a Shortcode builder (which you can copy/paste anywhere on a page, a post or inside a widget), while allowing custom post types to be used.

You can limit it to certain post types, certain categories, sort it by title or date posted, ascending, descending. You can even select whether you want the featured image shown (as a thumbnail), hide/show the title, link the title, the text, control how many words you want shown in the snippet, etc.

Important note: Not all features mentioned above are in this current version. See below for our planned updates.

While this is the first version of this plugin, it should be robust enough to handle just about any of your needs.

**Current Version 1.0.7**

= Features: = 
* Shortcode builder allows you to customize most aspects of the post (hide post title, category, date).
* Works anywhere you can use shortcode.
* Responsive, width-wise. Height of div will adjust automatically.

This plugin is not compatible with WordPress versions less than 5.0. Requires PHP 5.6+.

= TROUBLESHOOTING: =
* Check the FAQs/Help located on WordPress' Plugin page, or the Support forum on WordPress.org's plugin area.
* The Shortcode Builder has been extensively tested with both jQuery version 1.12.4 and 3.5.1, without any issues. The output, however, does not need jQuery/JavaScript.

== Installation ==

= If you downloaded this plugin: =
1. Upload the `rpu` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Once activated, locate the "BD Plugins" section in WP Admin, and then click on "Quotopia".
4. Follow the directions on the Shortcode Builder tab, create a new quotes library under the Quotes Builder tab, etc.

= If you install this plugin through WordPress 2.8+ plugin search interface: =
1. Click "Install" on 'Recent Posts Ultimate".
2. Activate the plugin through the 'Plugins' menu.
3. Once activated, locate the "BD Plugins" section in WP Admin, and then click on "Recent Posts Ultimate".
4. Follow the directions on the Shortcode Builder tab, etc.

== Frequently Asked Questions ==
** As this is the first release of RPU, FAQs are a little minimal right now ** 

= Why is the Shortcode Builder not working? =
Check to make sure you've got JavaScript enabled on your browser. Also make sure jQuery is working on your site.

= Where's the widget for this? Gutenberg block?! =
Coming in a future version, I promise!

= Why is the Admin interface not in [LANGUAGE] language? =
Internationalization will be coming very soon.

= What's with the animated bear icon / Why "BearlyDoug"? =
You'll need to check out the plugin and click on "BD Plugins" after you activate this plugin. :)

= Why free? Do you have a commercial version, too? =
Because I want to give back to the community that has given so much to me, no. What you see is what you get.WordPress has allowed me to advance my career and put me into a position where I'm doing okay. That said, you can still support this plugin (and others, as I release them) by hittin' that "Donate" link over on the right.

== Screenshots ==
1. Shortcode Builder.
2. Controllable HTML tags (in a future version)
3. RPU, in action (demo site - no settings)
4. RPU, in action (demo site - one set of settings)
5. RPU, in action (demo site - different settings)
6. RPU, in action (demo site - another set of settings)
7. RPU, in action (live site)

== Changelog ==
= TODO =
* Internationalization
* RPU Widget and Gutenberg block
* Add Order By and Ascending/Descending
* Add base templates (standard stacked, accordion, cycle (multiple methods), slider).
* Add a template file to allow people to create their own templates.
* Change Posts & Categories to display categories/taxonomies by post_type
* Link options (External URL, Category, Page, the post itself)
* Add Thumbnail support with image position specifications
* Add image shadowing for thumbnails
* Allowed HTML tags in snippet, with section to control which HTML tags are allowed.
* Suggestions from you?

= 1.0.7 =
* Bumped supported WordPress version up to 6.4.1
* Centralized the info in "More BD Plugins", so that I only have to edit one file across the board.
* Minor changes to functions-bd.php
* Removed reference to Gutenberg under "About RPU", because I refuse to be assimilated by GutenBORG. Resistance is NOT futile!

= 1.0.6 =
* The post title wasn't standing out enough. Increased font size from 1.05em to 1.13em and bolded it.
* Per S.Stanley and J.Webb, the "read more" change in 1.0.5 was slightly flawed in its calculation. I've implemented a workaround for this.

= 1.0.5 =
* The post title wasn't standing out enough. Increased font size from 1.05em to 1.13em and bolded it.
* Per E.Martin, "read more" should only display if more than X words are available (get total word count, subtract shown words. If greater than 0, show read more link). Thank you, E!

= 1.0.4 =
* From my day job, J.Webb wanted to have sticky posts show up first, and then regular posts after. Introduced a "Show Stickies" option via the shortcode builder tool. Thank you, JW! (June 5th, 2021)
* Added the following sort by methods: Post Date, Post ID, Post Author, Post Title, Post Slug, Post Date Modified. Also added ascending and descending option. Default is "Post Date" and "Descending".

= 1.0.3 =
* Standardized the wp-admin side CSS file for all plugins.
* Introduced a "More BD Plugins" tab, linking to current plugins, announcing future planned plugins and relocated the "Support me/this plugin!" request to that page.
* Fixed a bug in the coding that wasn't hiding the date in the sample when clicking "Hide".
* Introduced Multi-Post support. Default is to show only 1 post. Show max 7 posts.
* Introduced the option to hide the content. See the notes on the right side of the "About RPU" tab.
* More features?

= 1.0.2 =
* Fixed the recursive sanitization function in functions-bd.php. WP's sanitize_text_field() does not work on arrays. I had located a recursive_sanitize_text_field() function and adapted it. Problem was that I forgot to do a second function renaming within the initial function to allow it to process arrays that go deeper than just one level. Fixed on Oct. 20th, 2020.

= 1.0.1 =
* Plugin launch (Oct. 19th, 2020)

= 1.0.0 =
* Initial Plugin development and launch (Oct. 10th, 2020)

== Upgrade Notice ==
* Coming soon!