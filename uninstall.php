<?php
/***
 * This file fires the Recent Posts Ultimate plugin is deleted.
 */

/***
 * If uninstall.php is not called by WordPress, don't even THINK about actin' silly.
 */
	if(!defined('WP_UNINSTALL_PLUGIN')) {
		die;
	}
 
/***
 * Need to toss the QotW Timezone Offset WordPress option in [$wpdb->prefix]options table...
 */
	$rpu_wpOptionName = 'rpuAllowedTags';
	if(!get_option('rpuAllowedTags')){
		delete_option($rpu_wpOptionName);
		delete_site_option($rpu_wpOptionName);
	}
?>