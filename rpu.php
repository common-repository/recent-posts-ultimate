<?php
/***
 * Plugin Name: Recent Posts Ultimate
 * Plugin URI: https://wordpress.org/plugins/recent-posts-ultimate/
 * Description: The *ultimate* recent posts plugin, combining the very best features of four other (popular) Recent Posts plugins. Yes, even the pro versions of those plugins. Toss in an incredibly easy to use shortcode builder (including custom post types) and you've got a powerhouse, all for free! Recent Posts ULTIMATE, indeed!
 * Version: 1.0.7
 * Requires at least: 5.2
 * Author: Doug "BearlyDoug" Hazard
 * Author URI: https://wordpress.org/support/users/bearlydoug/
 * Text Domain: recent-posts-ultimate
 * License: GPLv3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * This program is free software; you can redistribute it and/or modify it under 
 * the terms of the [GNU General Public License](http://wordpress.org/about/gpl/)
 * as published by the Free Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, on an "AS IS", but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, see [GNU General Public Licenses](http://www.gnu.org/licenses/), or write to the
 * Free Software Foundation, Inc., 51 Franklin Street, 5th Floor, Boston, MA 02110, USA.
 */

/***
 * Internationalization, coming soon!
 */
// echo __('It worked! Now look for a directory named "a".', 'rpu');

/***
 *	Setting up security stuff and paths...
 */
defined('ABSPATH') or die('Sorry, Charlie. No access for you!');
require_once(ABSPATH.'wp-admin/includes/file.php' );
require_once(ABSPATH.'wp-admin/includes/plugin.php');

/***
 * Including the BearlyDoug functions file...
 */
require_once('functions-bd.php');

/***
 * DEFINE VERSION HERE
 */
define('rpuVersion', '1.0.7');
define('rpu', 'rpu');

/***
 * Recent Posts Ultimate Navigation link.
 */
function bearlydougplugins_add_rpu_submenu(){
	add_submenu_page(
		'bearlydoug',				// Parent Slug
		'Recent Posts Ultimate',		// Page Title
		'Recent Posts Ultimate',		// Menu Title
		'edit_posts',				// Capabilities
		'rpu',					// Nav Menu Link
		'rpu_main_admin_interface'	// Function name
	);
}
add_action('admin_menu', 'bearlydougplugins_add_rpu_submenu', 15);

/***
 * Loading both the Admin and Plugin CSS and JavaScript files here. Will also check to see if the main
 * BearlyDoug CSS file is enqueued. If not, then enqueue it.
 */
add_action('admin_enqueue_scripts', 'rpu_enqueue_admin_files', 15);
function rpu_enqueue_admin_files(){
	wp_register_style('rpu', plugins_url('/includes/_CSS-rpu.css',__FILE__ ));
	wp_enqueue_style('rpu');

	/***
	 * This has to get loaded into the footer, only if on the "RPU" page.
	 */
	if(isset($_GET['page']) && $_GET['page'] == 'rpu') {
		wp_enqueue_script('rpuscbuilder', plugins_url('/includes/_JS-rpuSCBuilder.js',__FILE__ ), array(), false, true);
	}

	if(!wp_style_is('bearlydougCSS', $list = 'enqueued')) {
		wp_register_style('bearlydougCSS', plugins_url('/includes/_CSS-bearlydoug.css',__FILE__ ));
		wp_register_script('bearlydougJS', plugins_url('/includes/_JS-bearlydoug.js',__FILE__) );
		wp_enqueue_style('bearlydougCSS');
		wp_enqueue_script('bearlydougJS');
	}
}

/***
 * Loading only the Plugin CSS file here.
 */
add_action('wp_enqueue_scripts', 'rpu_enqueue_shortcode_files', 15);
function rpu_enqueue_shortcode_files(){
	wp_register_style('rpu', plugins_url('/includes/_CSS-rpu.css',__FILE__ ));
	wp_enqueue_style('rpu');
}

/***
 * Handling the Recent Posts Ultimate admin page and tags saving function...
 */
function rpu_main_admin_interface(){
	global $wpdb;

	/***
	 * Need to set the Update message to null...
	 */
	$tagsUpdateMsg = null;

	/***
	 * Processing the saved/updated/changed tags...
	 */
	if(isset($_REQUEST) && isset($_REQUEST['rpuListSubmit']) && (sanitize_file_name($_REQUEST['rpuListSubmit']) == "2KC58pZQ60")) {
		/***
		 * First, we're going to count the number of items in $_REQUEST['theAllowedTags'].
		 * Then we'll set the options variable, based on 1 or 2 (or more) allowed tags.
		 * If theAllowedTags is 0, we'll delete the rpuAllowedTags wp_options, if it exists.
		 * If it doesn't exist, we'll ADD the rpuAllowedTags wp_options item.
		 * If it does exist, we'll simply update with the checked allowed tags.
		 */

		if(isset($_REQUEST['theAllowedTags'])){

		/***
		 * "bearlydougplugins_recursive_sanitize_text_field() is an array-friendly recursive version of
		 * WP's recursive_sanitize_text_field(), which only sanitizes a string. This function is called up
		 * via the "functions-bd.php" file.
		 */
			if(isset($_REQUEST['theAllowedTags'])){
				$theAllowedTags = bearlydougplugins_recursive_sanitize_text_field($_REQUEST['theAllowedTags']);
			} else {
				$theAllowedTags=null;
			}
			$tagsCNT = count($theAllowedTags);

			if(($tagsCNT == 0) && (get_option('rpuAllowedTags'))) {
				delete_option('rpuAllowedTags');
				$tagsUpdateMsg = "Allowed HTML tags have been removed!";
			} else {
				$rpuAllowedTags = sanitize_text_field(implode(",", $theAllowedTags));
				update_option('rpuAllowedTags', $rpuAllowedTags, 'yes' );
				$tagsUpdateMsg = "Allowed HTML tags have been saved!";
			}
		}
	}

	/***
	 * Let's show the WP Admin interface!
	 */
	echo '
	<h1 class="bdCTR">Recent Posts Ultimate, v' . constant("rpuVersion") . '</h1>
	<div class="bdTabs">
<!-- bdTabs Navigation Tabs -->
		<input type="radio" name="bdTabs" class="bdRadio" id="bdTab1" checked >
		<label class="bdLabel" for="bdTab1"><i class="dashicons dashicons-shortcode"></i><span>Shortcode Builder</span></label>
<!--
	Commented out, for now. Coming in a future version.
		<input type="radio" class="bdRadio" name="bdTabs" id="bdTab2">
		<label class="bdLabel" for="bdTab2"><i class="dashicons dashicons-editor-quote"></i><span>Allowed HTML tags</span></label>
-->
		<input type="radio" class="bdRadio" name="bdTabs" id="bdTab3">
		<label class="bdLabel" for="bdTab3"><i class="dashicons dashicons-info-outline"></i><span>About RPU</span></label>
		<input type="radio" class="bdRadio" name="bdTabs" id="bdTab4">
		<label class="bdLabel" for="bdTab4"><i class="dashicons dashicons-universal-access"></i><span>More BD Plugins</span></label>

		<input type="hidden" id="rputextTitle" name="rputextTitle" />
		<input type="hidden" id="rputextDate" name="rputextDate" />
		<input type="hidden" id="rputextCategory" name="rputextCategory" />
		<input type="hidden" id="rputextContent" name="rputextContent" />
		<input type="hidden" id="rputextHTML" name="rputextHTML" />
		<input type="hidden" id="rputextWords" name="rputextWords" />
		<input type="hidden" id="rputextpppg" name="rputextpppg" />
		<input type="hidden" id="rputextPType" name="rputextPType" />
		<input type="hidden" id="rputextCats" name="rputextCats" />
		<input type="hidden" id="rputheLinkTitle" name="rputheLinkTitle" />
		<input type="hidden" id="rputheLinkContent" name="rputheLinkContent" />
		<input type="hidden" id="rputheLinkOther" name="rputheLinkOther" />
		<input type="hidden" id="rputheLinkWording" name="rputheLinkWording" />
		<input type="hidden" id="rpuLinkType" name="rpuLinkType" value="" />
		<input type="hidden" id="rpuLinkToFinal" name="rpuLinkToFinal" value="" />
		<input type="hidden" id="rputextSticky" name="rputextSticky" />
		<input type="hidden" id="rputextSortBy" name="rputextSortBy" />
		<input type="hidden" id="rputextSortOrder" name="rputextSortOrder" />

<!-- bdTabs Content Tabs -->
		<div id="bdTab-content1" class="bdTab-content">
			<div class="bdWrapper">
				<div class="bdRow">
					<div class="bdDColumn">
						<fieldset>
							<legend>THE BASICS - Show/Hide and Word/Post Count options</legend>
							<div class="bdCT">
								<div class="bdBox2">
									<dl class="fancyList2">
										<dt>Post Title</dt><dd><label><input class="rpushowTitle" type="radio" name="rpushowTitle" value="1" checked /> Show</label>&emsp;<label><input class="rpushowTitle" type="radio" name="rpushowTitle" value="0" /> Hide</label></dd>
										<dt>Post Date</dt><dd><label><input class="rpushowDate" type="radio" name="rpushowDate" value="1" checked /> Show</label>&emsp;<label><input class="rpushowDate" type="radio" name="rpushowDate" value="0" /> Hide</label></dd>
										<dt>Post Category</dt><dd><label><input class="rpushowCategory" type="radio" name="rpushowCategory" value="1" checked /> Show</label>&emsp;<label><input class="rpushowCategory" type="radio" name="rpushowCategory" value="0" /> Hide</label></dd>
										<dt>Post Content</dt><dd><label><input class="rpushowContent" type="radio" name="rpushowContent" value="1" checked /> Show</label>&emsp;<label><input class="rpushowContent" type="radio" name="rpushowContent" value="0" /> Hide</label></dd>
										<dt>Show Sticky Posts 1st</dt><dd><label><input class="rpushowSticky" type="radio" name="rpushowSticky" value="no" checked /> No</label>&emsp;<label><input class="rpushowSticky" type="radio" name="rpushowSticky" value="yes" /> Yes</label></dd>
									</dl>
								</div>
								<div class="bdBox2">
									<dl class="fancyList2">
										<dt>Sort By</dt><dd><select class="rpushowSortBy" name="rpushowSortBy"><option value="date" selected>Post Date</option><option value="ID">Post ID</option><option value="author">Post Author</option><option value="title">Post Title</option><option value="name">Post Slug</option><option value="modified">Date Modified</option></select></dd>
										<dt>Sort Order</dt><dd><label><input class="rpushowSortOrder" type="radio" name="rpushowSortOrder" value="desc" checked /> Desc.</label>&emsp;<label><input class="rpushowSortOrder" type="radio" name="rpushowSortOrder" value="asc" /> Asc.</label></dd>
										<dt>Allow HTML in Post</dt><dd><label><input class="rpushowHTML" type="radio" name="rpushowHTML" value="1" checked /> Yes</label>&emsp;<label><input class="rpushowHTML" type="radio" name="rpushowHTML" value="0" /> No</label></dd>
										<dt># of words to show<span style="font-size: .85em; font-weight: normal;"><br />(50 words is default)</span></dt><dd><input id="rpuwordCNT" name="rpuwordCNT" value="50" size="3" /></dd>
										<dt># of posts to show<span style="font-size: .85em; font-weight: normal;"><br />(Default: 1; Max of 7)</span></dt><dd><input type="number" id="rpupppgCNT" name="rpupppgCNT" value="1" size="3" min="1" max="7" /></dd>
									</dl>
								</div>
							</div>
						</fieldset>

						<div class="bdCEContainer"><br />
							<input id="bdCollapsible0" class="bdTheToggle bdCEToggle" type="checkbox">
							<label for="bdCollapsible0" class="bdCELabel" tabindex="0">Configure Post Types and/or Categories</label>
							<div class="bdCEContent">
								<div class="bdCEInner">
									<div>You cannot select both Post Types and Categories at the same time, for now. This feature will be greatly improved on, soon!</div>
									<div><br /><strong>By post type</strong></div>
									<div class="bdCols3">';
/***
 * Get a list of all post types...
 */
	$tableName = $wpdb->prefix . 'posts';
	$postTypes = $wpdb->get_results("
		SELECT `post_type` 
		FROM $tableName 
		GROUP BY `post_type` 
		ORDER BY FIELD(`post_type`, 'post') DESC, `post_type` ASC
	");

	if(!empty($postTypes)) {
		$rpuDisallowedPostTypes = array("page", "attachment", "customize_changeset", "nav_menu_item", "revision", "custom_css");
		foreach($postTypes as $tPt){
			$thePostType = $tPt->post_type;
			if(!in_array($thePostType, $rpuDisallowedPostTypes)) {
				$rpuIDme = ($thePostType == "post") ? ' id="rpuspostType"' : '';
				$rpuPostDesc = ($thePostType == "post") ? ' checked /> Posts (via Categories)</label></div>' : ' /> ' . $thePostType . '</label></div>';
				echo '
										<div><label><input' . $rpuIDme . ' class="rpuPostType" name="rpuPostType" type="radio" value="' . $thePostType . '"' . $rpuPostDesc;
			}
		}
	}

	echo '
									</div>
									<div><br /><strong>By Category/Categories</strong></div>
									<div class="bdCols3">';

/***
 * Get a list of all categories types...
 */
	$categories = get_categories(array(
		'orderby'		=> 'name',
		'order'		=> 'ASC',
		'hide_empty'	=> false
	));

	foreach($categories as $category) {
		echo '
										<div><label><input class="rpuCategories" name="rpuCategories" type="checkbox" value="' . $category->term_id . '" /> ' . $category->name . ' (' . $category->count . ')</label></div>';
	}

	echo '
									</div>
								</div>
							</div>

							<input id="bdCollapsible1" class="bdTheToggle bdCEToggle" type="checkbox">
							<label for="bdCollapsible1" class="bdCELabel" tabindex="1">Post Linking options</label>
							<div class="bdCEContent">
								<div class="bdCEInner">
									<dl class="fancyList">
										<dt>What should be linked</dt><dd>&nbsp;</dd>
										<dt>Post Title</dt><dd><label><input class="rpulinkTitle" type="radio" name="rpulinkTitle" value="0" checked /> No</label>&emsp;<label><input class="rpulinkTitle" type="radio" name="rpulinkTitle" value="1" /> Yes</label></dd>
										<dt>Post Content</dt><dd><label><input class="rpulinkContent" type="radio" name="rpulinkContent" value="0" checked /> No</label>&emsp;<label><input class="rpulinkContent" type="radio" name="rpulinkContent" value="1" /> Yes</label></dd>
										<dt>Post Other</dt><dd><label><input id="rpulinkOtherFalse" class="rpulinkOther" type="radio" name="rpulinkOther" value="0" checked /> No</label>&emsp;<label><input id="rpulinkOtherTrue" class="rpulinkOther" type="radio" name="rpulinkOther" value="1" /> Yes</label></dd>
										<dt>If "Other", wording</dt><dd><input class="rpulinkWording" style="width: 98%" name="rpulinkWording" value="Read more..." /></dd>
										<dt>Link to what</dt><dd><label><input id="rpuLinkToPost" class="rpuLinkTo" type="radio" name="rpuLinkTo" value="post" checked /> The Post, itself</label><br /><label><input id="rpuLinkToPage" class="rpuLinkTo" type="radio" name="rpuLinkTo" value="page" /> A Page</label><br /><label><input id="rpuLinkToOther" class="rpuLinkTo" type="radio" name="rpuLinkTo" value="other" /> Another URL</label></dd>
									</dl>
									<dl id="rpuPageSelector" class="fancyList bdHide">
										<dt>Select Page</dt>
										<dd>
											<select id="rpuSelectPage" name="rpuSelectPage">
												<option value="">' . esc_attr(__("Select which page")) . '</option> ';

	$pages = get_pages(array(
		'sort_column'	=> 'post_parent,post_title',
		'post_status'	=> array('publish', 'private', 'draft', 'pending'),
		'hierarchical'		=> 1
	)); 
	foreach ($pages as $page) {
		$childOf = ($page->post_parent != 0) ? '=> ' : '';
		echo '
												<option value="' . get_page_link($page->ID) . '">' . $childOf . ' ' . $page->post_title . ' (' . $page->post_status . ')</option>';
	}
	echo '
											</select>
										</dd>
									</dl>
									<dl id="rpuURLSelector" class="fancyList bdHide">
										<dt>URL to link to</dt><dd><input id="rpuLinkToURL" style="width: 98%" name="rpuLinkToURL" value="" placeholder="FULL URL, including http:// or https://" /><span style="font-size: .85em; font-weight: normal;"><br />(opens in new tab/window)</span></dd>
									</dl>
								</div>
							</div>

<!--
	Gonna tuck this away for a future release...
							<input id="bdCollapsible2" class="bdTheToggle bdCEToggle" type="checkbox">
							<label for="bdCollapsible2" class="bdCELabel" tabindex="2">Lanking options</label>
							<div class="bdCEContent">
								<div class="bdCEInner">
									<p>Careen fluke jolly boat keel topgallant Admiral of the Black barkadeer sloop poop deck salmagundi. Avast red ensign parley clap of thunder no prey, no pay killick stern clipper execution dock splice the main brace. Grog blossom yardarm bilge water marooned cog wherry tackle aye Shiver me timbers come about.</p>
								</div>
							</div>
-->
						</div>
					</div>
					<div class="bdColumn">
						<div id="bdSCcontainer">
							<div class="bdExampleBorder">
								<div id="rpuSampleTitle" class="rpuTitle"><a href="#">Sample Post Title</a></div>
								<div id="rpuSampleCategory" class="rpuDate"><a class="rpuDate" href="#">Parent Category</a> / <a class="rpuDate" href="#">Category</a></div>
								<div id="rpuSampleDate" class="rpuDate">October 11, 2020</div>
								<div id="rpuSampleContent" class="rpuContent">
									<p style="text-align: center;"><span style="font-weight: bold;"><span style="color: #ff0000;">B</span><span style="color: #e2001c;">A</span><span style="color: #c60038;">C</span><span style="color: #a90055;">O</span><span style="color: #8d0071;">N</span><span style="color: #71008d;">!</span> <span style="color: #3800c6;">B</span><span style="color: #1c00e2;">A</span><span style="color: #0000ff;">A</span><span style="color: #1c00e2;">A</span><span style="color: #3800c6;">A</span><span style="color: #5400aa;">A</span><span style="color: #71008d;">A</span><span style="color: #8d0071;">A</span><span style="color: #a90055;">C</span><span style="color: #c60038;">O</span><span style="color: #e2001c;">N</span><span style="color: #ff0007;">!</span></span></p>
									<p>Spicy<strong> jalapeno </strong>dolor amet <span style="text-decoration: underline;">ipsum kevin chicken irure.</span> Pastrami sed leberkas pork<span style="color: #0000ff;"> labore, nostrud volup<span style="text-decoration: underline;"><strong><em>tate Beef ribs. Biltong sirloin sepica</em></strong></span></span></p>
									<p><span style="text-decoration: underline;"><strong><em>nha. Ea alcatra kielba</em></strong></span>sa doner non...</p>
								</div>
							</div>
							<textarea id="bdShortCode" class="bdCTR" name="bdShortCode" wrap="soft"></textarea>
							<div id="bdMsg" class="bdHide">Text copied into your clipboard. Paste where you need/want it.</div>
						</div>
						<div>
							<div>When all your options (to the left) are set, simply click on the short code above. It\'ll select and copy the entire shortcode automatically. You can paste that into a widget, inside a Gutenberg block, or in your Classic Editor interface.</div>
							<div><br />For experienced WordPress developers, you can do a &quot;do_shortcode()&quot; call into your theme file(s). HOPEFULLY you\'re using a child theme!</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="bdTab-content2" class="bdTab-content">';
	/***
	 * Showing the save/confirmation message here, if needed.
	*/
	if(!is_null($tagsUpdateMsg)) {
		echo '
			<div class="bdHide">' . $tagsUpdateMsg . '</div>';
	}

	/***
	 * Listing all allowed tags.
	 */
	$completeList = array("a", "abbr", "address", "area", "audio", "b", "bdi", "bdo", "blockquote", "br", "button", "canvas", "caption", "cite", "code", "col", "colgroup", "data", "datalist", "dd", "dl", "dt", "del", "details", "dfn", "dialog", "div", "em", "embed", "fieldset", "figcaption", "figure", "form", "frame", "frameset", "h1", "h2", "h3", "h4", "h5", "h6", "hr", "i", "iframe", "img", "input", "label", "legend", "ul", "ol", "li", "map", "mark", "meter", "object", "optgroup", "option", "output", "p", "picture", "pre", "progress", "q", "rp", "rt", "ruby", "s", "samp", "select", "small", "source", "span", "strong", "sub", "summary", "sup", "svg", "table", "tbody", "td", "tfoot", "th", "thead", "tr", "textarea", "time", "track", "u", "var", "video", "wbr");

	/***
	 * Getting the current allowed HTML tags (keeping it as a string, so we can SHOW folks what current tags are set.
	 * We'll then change the left/right brackets to HTML entities, so we can display current tags, properly.
	 * Now that's done, we need to make sure the current allowed tags are set up as an actual array, so that we
	 * can do a comparison against the complete list (from above), so that we can check the checkboxes correctly.
	 * We're also setting the counter to 0.
	 */
/*
	$theTagList = get_option("rpuAllowedTags");
*/
	$theTagList = "<a>,<b>,<br />,<br>,<div>,<em>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<i>,<img>,<li>,<ol>,<p>,<span>,<strong>,<u>,<ul>";
	$rpuAllowedTags = explode(",", $theTagList);
	$cnt=0;

	/***
	 * We need to re-display the current options... AFTER they've been saved.
	 */
	$displayTags = str_replace("<", "&lt;", $theTagList);
	$displayTags = str_replace(">", "&gt;", $displayTags);

	echo '
			<div>Control which tags are actually allowed in your HTML output for this plugin. See below this list for why we don\'t include certain HTML tags.</div>
			<div><br />Your CURRENT allowed HTML list:<br /> ' . $displayTags . '</div>
			<form action="admin.php?page=rpu" method="post">
				<input type="hidden" id="rpuListSubmit" name="rpuListSubmit" value="1" />
				<input type="hidden" id="TBD" name="TBD" value="" />
				<div><br /><b>The available HTML Tag list...</b></div>
				<br /><div class="bdCols6">
';

/***
 * Now, we're going to display ALL allowed HTML tags and check the ones
 * that are actually permitted within the HTML output...
 */
	foreach($completeList as $theTag2) {
		$theTag = '<' . $theTag2 . '>';
		$checked = (in_array($theTag, $rpuAllowedTags)) ? ' checked' : '';
		echo '
					<div><label for="tg' . $cnt . '"><input type="checkbox" id="tg' . $cnt . '" name="theAllowedTags[]" value="' . $theTag . '"' . $checked . '> &lt;' . $theTag2 . '&gt;</label></div>';
		$cnt++;
	}

	echo '
				<br class="rpuCL" />
				</div>
				<input type="submit" value="Save selected allowed tags" />
			</form>
		</div>
		<div id="bdTab-content3" class="bdTab-content">
			<div class="bdWrapper">
				<div class="bdRow">
					<div class="bdDColumn">
						<h2 class="bdCTR">About Recent Posts Ultimate</h2>
						<div>As a full time WordPress developer, responsible for nearly 200 websites, I\'ve frequently used the "Category Posts Widget", "Posts in Page", "Recent Posts Widget Extended" and "Recent Posts Widget With Thumbnails" plugins.</div>
						<div><br />Through my time with my current employer, one message has remained consistent: "Why is it that no HTML is showing up on these posts on the front page?" <strong><u>(Special shout-out to Father Ball at the Richmond Diocese: If it weren\'t for him requesting this (more than once, hah!), this plugin would\'ve never come to life!)</u></strong>&nbsp; Never a good idea to have an unhappy boss, so I decided to do something about it. Hence, Recent Posts Ultimate (RPU) was crafted like a fine espresso with decorative and artistic foam work topping it.</div>
						<div><br />While this is the first version of this plugin, it should be robust enough to handle just about any of your needs.</div>
						<br /><h2 class="bdCTR">What\'s next for RPU?!</h2>
						<div>The following items are planned updates/enhancements, as this plugin moves forward. Not all of them will be implemented in the next release.&ensp;As I "tick off the checklist", I\'ll note the date/version that feature was added and move it to the bottom of each section.</div>
						<br />
						<ul class="bdList">
							<li>Overall Plugin</li>
							<li>Add Thumbnail support with image position specifications and image shadowing option.</li>
							<li>Pagination with customized next/previous wording.</li>
							<li>Add base template and template file system to allow people to create their own templates.</li>
							<li>Change Posts & Categories to display categories/taxonomies by post_type.</li>
							<li>Improve section on BearlyDoug.com with additional documentation and examples.</li>
							<li>Allowed HTML tags in snippet, with section to control which HTML tags are allowed.</li>
							<li>Internationalization.</li>
							<li>Suggestions from you?</li>
						</ul>
					</div>
					<div class="bdColumn">
						<h3 class="bdCTR">Important Notes</h3>
						<div>&bull; If you opt to hide the content, you should make sure the title is linked to the post, itself. Not required, but helpful if you want people to read more.</div>
						<div><br />&bull; Not all features mentioned below (Quick Notes section) are in this current version. See below for our planned updates.</div>
						<br />
						<h3 class="bdCTR">Quick Notes</h3>
						<div>This plugin takes the best features of "Category Posts Widget", "Posts in Page", "Recent Posts Widget Extended" and "Recent Posts Widget With Thumbnails", tosses in the ability to show posts with or without HTML code and gives you a Shortcode builder (which you can copy/paste anywhere on a page, a post or inside a widget), while allowing custom post types to be used.</div>
						<div><br />You can limit it to certain post types, certain categories, sort it by title or date posted, ascending, descending. You can even select whether you want the featured image shown (as a thumbnail), hide/show the title, link the title, the text, control how many words you want shown in the snippet, etc.</div>
					</div>
				</div>
			</div>
		</div>
		<div id="bdTab-content4" class="bdTab-content">';

	/***
	 * Centralizing the latest news from BD Plugins...
	 */
	include plugin_dir_path( __FILE__ ) . "includes/BDPluginsNews.php";

	echo '
		</div>
	</div>';
}

/***
 * Checks to see if the rpuAllowedTags Meta option exists upon activation. If it doesn't,
 * let's create it.
 *
 * This will be activated in a future version. For now, it's parked here so I don't lose the work
 * I've already started.
 */
// function rpu_install() {
// 	if(!get_option('rpuAllowedTags')){
// 		update_option('rpuAllowedTags', '<a>,<b>,<br />,<br>,<div>,<em>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<i>,<img>,<li>,<ol>,<p>,<span>,<strong>,<u>,<ul>', 'yes');
// 	}
// }
// register_activation_hook(__FILE__, 'rpu_install');

/***
 * Let's clean everything up on a deactivation, too.
 *
 * This will be activated in a future version. For now, it's parked here so I don't lose the work
 * I've already started.
 */
//function qotw_deactivate() {
//	/***
//	 * Clearing out the timezone offset option.
//	 */
//	$option_name = 'rpuAllowedTags';
//	delete_option($option_name);
//	delete_site_option($option_name);
//}
//register_deactivation_hook(__FILE__, 'qotw_deactivate');

/***
 * Allow specific HTML tags in the excerpt. Taken from user "Adrian B." on StackOverflow, and modified accordingly.
 * https://wordpress.stackexchange.com/questions/141125/allow-html-in-excerpt
 * https://wordpress.stackexchange.com/questions/207050/read-more-tag-shows-up-on-every-post
 *
 * This will be activated in a future version. For now, it's parked here so I don't lose the work
 * I've already started.
 */
// function rpu_trim_excerpt($rpu_wordcount = 50, $rpu_excerpt = null) {
// 	global $post;
// 	$raw_excerpt = $rpu_excerpt;
// 	$rpuAllowedTags = get_option('rpuAllowedTags');

// 	if('' == $rpu_excerpt) {
// 		$rpu_excerpt = get_the_content('');
// 		$rpu_excerpt = strip_shortcodes($rpu_excerpt);
// 		$rpu_excerpt = apply_filters('the_content', $rpu_excerpt);
// 		$rpu_excerpt = str_replace(']]>', ']]>', $rpu_excerpt);
// 		$rpu_excerpt = strip_tags($rpu_excerpt, $rpuAllowedTags);

// 		$excerpt_length = apply_filters('excerpt_length', $rpu_wordcount);
// 		$tokens = array();
// 		$excerptOutput = '';
// 		$count = 0;

// 		preg_match_all('/(<[^>]+>|[^<>s]+)s*/u', $rpu_excerpt, $tokens);

// 		foreach ($tokens[0] as $token) {
// 			if ($count >= $rpu_wordcount && preg_match('/[,;?.!]s*$/uS', $token)) {
// 				$excerptOutput .= trim($token);
// 				break;
// 			}
// 			$count++;
// 			$excerptOutput .= $token;
// 		}

// 		$rpu_excerpt = trim(force_balance_tags($excerptOutput));

// 		if($count >= $rpu_wordcount) {
// 			$excerpt_end = ' <a href="'. esc_url(get_permalink()) . '">' . '&raquo;&nbsp;' . sprintf(__('Read more about: %s &nbsp;&raquo;', 'wpse'), get_the_title()) . '</a>'; 
// 			$excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end); 
// 			$rpu_excerpt .= $excerpt_more;
// 		} 
// 		return $rpu_excerpt;
// 	}
// 	return apply_filters('rpu_trim_excerpt', $rpu_excerpt, $raw_excerpt);
// }

/***
 *	The ShortCode function...
 */
function rpu_shortcode($atts) {

	/***
	 * Setting up the defaults for the attributes, and sanitizing 'em.
	 * 
	 * The options below are for a future release...
	 * 'XX'		=> 'XX',
	 * 'orderby'	=> 'post_date',
	 * 'order'	=> 'DESC'
	 */
	$rpuAttribs = shortcode_atts(array(
		'showtitle'		=> 'yes',
		'showdate'		=> 'yes',
		'showcategory'	=> 'yes',
		'showcontent'	=> 'yes',
		'showhtml'		=> 'yes',
		'showsticky'		=> 'no',
		'sortorder'		=> 'date',
		'sortby'		=> 'desc',
		'words'		=> 50,
		'pppg'			=> 1,
		'cats'			=> 0,
		'ptype'		=> 'post',
		'linktitle'		=> 'no',
		'linkcontent'		=> 'no',
		'linkother'		=> 'no',
		'linkwording'		=> 'Read more...',
		'linktype'		=> '',
		'linktourl'		=> ''
	), $atts, 'rpu');

	$showtitle		= filter_var($rpuAttribs['showtitle'], FILTER_SANITIZE_STRING);
	$showdate		= filter_var($rpuAttribs['showdate'], FILTER_SANITIZE_STRING);
	$showcategory	= filter_var($rpuAttribs['showcategory'], FILTER_SANITIZE_STRING);
	$showcontent	= filter_var($rpuAttribs['showcontent'], FILTER_SANITIZE_STRING);
	$showhtml		= filter_var($rpuAttribs['showhtml'], FILTER_SANITIZE_STRING);
	$showsticky		= filter_var($rpuAttribs['showsticky'], FILTER_SANITIZE_STRING);
	$sortorder		= filter_var($rpuAttribs['sortorder'], FILTER_SANITIZE_STRING);
	$sortby		= filter_var($rpuAttribs['sortby'], FILTER_SANITIZE_STRING);
	$words		= filter_var($rpuAttribs['words'], FILTER_SANITIZE_STRING);
	$pppg			= filter_var($rpuAttribs['pppg'], FILTER_SANITIZE_STRING);
	$cats			= filter_var($rpuAttribs['cats'], FILTER_SANITIZE_STRING);
	$postType		= filter_var($rpuAttribs['ptype'], FILTER_SANITIZE_STRING);
	$linkTitle		= filter_var($rpuAttribs['linktitle'], FILTER_SANITIZE_STRING);
	$linkContent		= filter_var($rpuAttribs['linkcontent'], FILTER_SANITIZE_STRING);
	$linkOther		= filter_var($rpuAttribs['linkother'], FILTER_SANITIZE_STRING);
	$linkWording		= filter_var($rpuAttribs['linkwording'], FILTER_SANITIZE_STRING);
	$linkType		= filter_var($rpuAttribs['linktype'], FILTER_SANITIZE_STRING);
	$linkURL		= filter_var($rpuAttribs['linktourl'], FILTER_SANITIZE_URL);
	$rpuQuote		= "";
	$rpuQuoteCNT	= 0;
	$stickyArray		= array();

	/***
	 * If Posts Per Page ($pppg) is larger than 7, max it to 7...
	 */
	if($pppg > 7) {
		$pppg = 7;
	}

	/***
	 * Check to see if we want to show sticky posts, first...
	 */

	if($showsticky == "yes") {
		/***
		 * Setting up the wp_query array...
		 */
		$rpuPostsA = new WP_Query(array(
			'cat'				=> array($cats),
			'posts_per_page'		=> $pppg,
			'post__in'			=> get_option('sticky_posts'),
			'ignore_sticky_posts'	=> 0,
			'post_type'			=> $postType,
			'orderby'			=> $sortby,
			'order'			=> $sortorder,
			'post_status'		=> 'publish',
		));

		while ($rpuPostsA->have_posts()) : $rpuPostsA->the_post();
			$stickyArray[] = get_the_ID();
			$theDate = get_the_date();

		/***
		 * Setting up the link URL and the link target...
		 */
			$therpuLink = ($linkURL != "") ? $linkURL : get_permalink();
			$hrefTarget = ($linkType == "other") ? ' target="_blank"' : '';

		/***
		 * Do we want to allow HTML to come through?
		 * How about linking it?
		 */
			if($showhtml != "no") {
				$rpuBlatherings = force_balance_tags(html_entity_decode(wp_trim_words(htmlentities(wpautop(get_the_content())), $words)));
				$updatedContent = apply_filters('the_content', $rpuBlatherings);
			} else {
				$updatedContent = wp_trim_words(get_the_content(), $words);
			}

			$wordCNT = isa_count_content_words($updatedContent);
			$totalWords = ($wordCNT >= $words) ? $wordCNT - $words : $words - $wordCNT;

		/***
		 * Now, we're going to link the title, if requested
		 */
			$theTitle = ($linkTitle == "yes" && $totalWords >= 0) ? '<a href="' . $therpuLink . '"' . $hrefTarget . '>' . get_the_title() . '</a>' : get_the_title();

		/***
		 * If we have multiple posts, separate them out via a <br /> call...
		 */
			if($rpuQuoteCNT > 0) {
			$rpuQuote .= '
	<br />';
			}

		/***
		 * Building the output...
		 */
			$rpuQuote .= '
	<div class="rpu">';

		/***
		 * If we're showing the title, then drop this line in...
		 */
			if($showtitle != "no") {
				$rpuQuote .= '
			<div class="rpuTitle">' . $theTitle . '</div>';
			}

		/***
		 * If we're showing the Category, then drop this line in...
		 */
			if($showcategory != "no") {
				$rpuCat = wp_get_post_categories(get_the_id());
				$catID = $rpuCat[0];
				$cat = get_category($catID);
				$rpuQuote .= '
		<div class="rpuDate"><a class="rpuDate" href="' . esc_url(get_category_link($catID)) . '">' . esc_html($cat->name) . '</a></div>';
			}

		/***
		 * If we're showing the date, then drop this line in...
		 */
			if($showdate != "no") {
				$rpuQuote .= '
		<div class="rpuDate">' . $theDate . '</div>';
			}

			$finalContent = ($linkContent == "yes" && $totalWords >= 0) ? '<a href="' . $therpuLink . '"' . $hrefTarget . '>' . $updatedContent . '</a>' : $updatedContent;

			if($showcontent == "yes") {
				$rpuQuote .= '
		<div class="rpuContent">' . $finalContent . '</div>';
			}

			if($linkOther == "yes" && $totalWords >= 0) {
				$rpuQuote .= '			
			<div><br /><a href="' . $therpuLink . '"' . $hrefTarget . '>' . $linkWording . '</a></div>';
			}
			$rpuQuote .= '
	</div>';

			$rpuQuoteCNT++;
		endwhile;
		wp_reset_query();
	}

	/***
	 * Setting up the wp_query array...
	 */
	$rpuPosts = new WP_Query(array(
		'cat'				=> array($cats),
		'posts_per_page'		=> $pppg,
		'post__not_in'		=> $stickyArray,
		'post_type'			=> $postType,
		'orderby'			=> $sortby,
		'order'			=> $sortorder,
		'post_status'		=> 'publish',
	));

	while ($rpuPosts->have_posts()) : $rpuPosts->the_post();
		$theDate = get_the_date();

	/***
	 * Setting up the link URL and the link target...
	 */
		$therpuLink = ($linkURL != "") ? $linkURL : get_permalink();
		$hrefTarget = ($linkType == "other") ? ' target="_blank"' : '';

		/***
		 * Do we want to allow HTML to come through?
		 * How about linking it?
		 */
			if($showhtml != "no") {
				$rpuBlatherings = force_balance_tags(html_entity_decode(wp_trim_words(htmlentities(wpautop(get_the_content())), $words)));
				$updatedContent = apply_filters('the_content', $rpuBlatherings);
			} else {
				$updatedContent = wp_trim_words(get_the_content(), $words);
			}

			$wordCNT = isa_count_content_words($updatedContent);
			$totalWords = ($wordCNT >= $words) ? $wordCNT - $words : $words - $wordCNT;

	/***
	 * Now, we're going to link the title, if requested
	 */
		$theTitle = ($linkTitle == "yes" && $totalWords >= 0) ? '<a href="' . $therpuLink . '"' . $hrefTarget . '>' . get_the_title() . '</a>' : get_the_title();

	/***
	 * If we have multiple posts, separate them out via a <br /> call...
	 */

		if($rpuQuoteCNT > 0) {
		$rpuQuote .= '
	<br />';
		}

	/***
	 * Building the output...
	 */
		$rpuQuote .= '
	<div class="rpu">';

	/***
	 * If we're showing the title, then drop this line in...
	 */
		if($showtitle != "no") {
			$rpuQuote .= '
		<div class="rpuTitle">' . $theTitle . '</div>';
		}

	/***
	 * If we're showing the Category, then drop this line in...
	 */
		if($showcategory != "no") {
			$rpuCat = wp_get_post_categories(get_the_id());
			$catID = $rpuCat[0];
			$cat = get_category($catID);
			$rpuQuote .= '
		<div class="rpuDate"><a class="rpuDate" href="' . esc_url(get_category_link($catID)) . '">' . esc_html($cat->name) . '</a></div>';
		}

	/***
	 * If we're showing the date, then drop this line in...
	 */
		if($showdate != "no") {
			$rpuQuote .= '
		<div class="rpuDate">' . $theDate . '</div>';
		}

		$finalContent = ($linkContent == "yes" && $totalWords >= 0) ? '<a href="' . $therpuLink . '"' . $hrefTarget . '>' . $updatedContent . '</a>' : $updatedContent;

		if($showcontent == "yes") {
			$rpuQuote .= '
		<div class="rpuContent">' . $finalContent . '</div>';
		}

		if($linkOther == "yes" && $totalWords >= 0) {
			$rpuQuote .= '			
			<div><br /><a href="' . $therpuLink . '"' . $hrefTarget . '>' . $linkWording . '</a></div>';
		}
		$rpuQuote .= '
	</div>';

		$rpuQuoteCNT++;
	endwhile;
	wp_reset_query();

	/***
	 * Output it!
	 */
	return $rpuQuote;
}
add_shortcode('rpu', 'rpu_shortcode');

/***
 * Count the number of words in post content
 * @param string $content The post content
 * @return integer $count Number of words in the content
 * SOURCE: https://isabelcastillo.com/count-words-wordpress
 */
function isa_count_content_words($content) {
	$decode_content = html_entity_decode($content);
	$filter_shortcode = do_shortcode($decode_content);
	$strip_tags = wp_strip_all_tags($filter_shortcode, true);
	$count = str_word_count($strip_tags);
	return $count;
}
?>