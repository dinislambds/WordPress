<?php 

755 = Read / Write / Execute
644 = Read / Writer for Administrator && Only read for Other(Group/User)

## Remove unused/unnecessary WordPress files
#=========================================================================

1// readme.html
2// config-sample.php
3// license.txt



## Disable File Editing from Admin Dashboard (Editor will be disabled)
#=========================================================================

// Put the below code in wp-config.php
define('DISALLOW_FILE_EDIT', true);



## Authentication Unique Keys and Salts
#=========================================================================

// Visit below link and Replace generated code in your wp-config.php (User have to login again) You should do this regular basis, As a result each time new cache/cookie will generate

https://api.wordpress.org/secret-key/1.1/salt/



## Remove Version Number from Source URL + Feed
#=========================================================================

// remove version from head
remove_action('wp_head', 'wp_generator');

// remove version from rss
add_filter('the_generator', '__return_empty_string');

// remove version from scripts and styles
function shapeSpace_remove_version_scripts_styles($src) {
	if (strpos($src, 'ver=')) {
		$src = remove_query_arg('ver', $src);
	}
	return $src;
}
add_filter('style_loader_src', 'shapeSpace_remove_version_scripts_styles', 9999);
add_filter('script_loader_src', 'shapeSpace_remove_version_scripts_styles', 9999);


## Remove Version Number from Source URL + Feed
#=========================================================================

1 // Akistmet - For Spam Comment
2 // Stop User Enumeration - User permalink is forbiden
3// Activity Log - Who doing what - check
4// BBQ - Block Bad Queries
5 // Exploit Scanner
6// WP Health (Formerly My WP Health Check)
** // All in One WP Secuirty - Will solve all above issue :)


## Beware about below code/functions
#=========================================================================

// Exploit Scanner plugin check those codes

eval()
base64
