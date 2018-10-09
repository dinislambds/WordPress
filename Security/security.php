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



## Show code error on development mode
#=========================================================================

// Put the below code in wp-config.php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true);
ini_set('display_errors', 'on');



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

// block proxy visits @ 
// More details: http://m0n.co/01

function shapeSpace_block_proxy_visits() {
	if (@fsockopen($_SERVER['REMOTE_ADDR'], 80, $errstr, $errno, 1)) {
		die('Proxy access not allowed');
	}
}
add_action('after_setup_theme', 'shapeSpace_block_proxy_visits');



## Remove Version Number from Source URL + Feed
#=========================================================================

1 // Akistmet - For Spam Comment
2 // Stop User Enumeration - User permalink is forbiden
3// Activity Log - Who doing what - check
4// BBQ - Block Bad Queries
5 // Exploit Scanner
6// WP Health (Formerly My WP Health Check)
**// All in One WP Secuirty - Will solve all above issue :)


## Beware about below code/functions
#=========================================================================

// Exploit Scanner plugin check those codes

eval()
base64



# .htaccess codes
#=========================================================================

# TEMP MAINTENANCE PAGE  ?>
<IfModule mod_rewrite.c>
	RewriteEngine On
	RewriteCond %{REMOTE_ADDR} !^000.000.000.000$
	RewriteRule .* - [R=503,L]
</IfModule>
ErrorDocument 503 "<h1>The site is getting an update</h1><p>Back in 30 minutes!</p>
<IfModule mod_headers.c>
	# 3600 = 60 minutes
	# 86400 = 1 day
	Header always set Retry-After "86400"
</IfModule>



<?php
# SECURE LOOSE FILES 
# http://m0n.co/04 ?>
<IfModule mod_alias.c>
	RedirectMatch 403 (?i)(^#.*#|~)$
	RedirectMatch 403 (?i)/readme\.(html|txt)
	RedirectMatch 403 (?i)\.(ds_store|well-known)
	RedirectMatch 403 (?i)/wp-config-sample\.php
	RedirectMatch 403 (?i)\.(7z|bak|bz2|com|conf|dist|fla|git|inc|ini|log|old|psd|rar|tar|tgz|save|sh|sql|svn|swo|swp)$
</IfModule>



<?php
# PROTECT WP-CONFIG ?>
<Files wp-config.php>
	
	# Apache < 2.3
	<IfModule !mod_authz_core.c>
		Order allow,deny
		Deny from all
		Satisfy All
	</IfModule>
	
	# Apache >= 2.3
	<IfModule mod_authz_core.c>
		Require all denied
	</IfModule>
	
</Files>


<?php
# STOP HOTLINKING (METHOD 1)  ?>
<IfModule mod_rewrite.c>
	RewriteCond %{HTTP_REFERER} !^$
	RewriteCond %{HTTP_REFERER} !^http(s)?://([^.]+\.)?example\.com [NC]
	RewriteRule \.(gif|jpe?g?|png)$ - [NC,F,L]
</IfModule>


<?php
# STOP HOTLINKING (METHOD 2)  ?>
<IfModule mod_rewrite.c>
	RewriteCond %{HTTP_REFERER} !^$
	RewriteCond %{HTTP_REFERER} !^http(s)?://([^.]+\.)?example\.com [NC]
	RewriteCond %{REQUEST_FILENAME} !hotlink.gif [NC]
	RewriteRule \.(gif|jpe?g?|png)$ /hotlink.gif [NC,R,L]
</IfModule>


<?php
# BLOCK SPAM  ?>
<IfModule mod_rewrite.c>
	RewriteEngine On
	RewriteCond %{REQUEST_METHOD} POST
	RewriteCond %{HTTP_USER_AGENT} ^$ [OR]
	RewriteCond %{HTTP_REFERER} !example.com [NC]
	RewriteCond %{REQUEST_URI} /wp-comments-post\.php [NC]
	RewriteRule .* - [F,L]
</IfModule>




<!-- # BLOCK BAD BOTS -->
<IfModule mod_setenvif.c>
	SetEnvIfNoCase User-Agent (archive.org|binlar|casper|checkpriv|choppy|clshttp|cmsworld|diavol|dotbot|extract|feedfinder|flicky|g00g1e|harvest|heritrix|httrack|kmccrew|loader|miner|nikto|nutch|planetwork|postrank|purebot|pycurl|python|seekerspider|siclab|skygrid|sqlmap|sucker|turnit|vikspider|winhttp|xxxyy|youda|zmeu|zune) badbot
	
	SetEnvIfNoCase User-Agent (BadBotUserAgentString) badbot
	
	# Apache < 2.3
	<IfModule !mod_authz_core.c>
		Order Allow,Deny
		Allow from all
		Deny from env=badbot
	</IfModule>

	# Apache >= 2.3
	<IfModule mod_authz_core.c>
		<RequireAll>
			Require all Granted
			Require not env badbot
		</RequireAll>
	</IfModule>

</IfModule>


<?php
# 6G FIREWALL/BLACKLIST
# @ https://perishablepress.com/6g/
# include the entire 6G Blacklist in the root .htaccess file of your site.  ?>

# 6G:[QUERY STRINGS]
<IfModule mod_rewrite.c>
	RewriteEngine On
	RewriteCond %{QUERY_STRING} (eval\() [NC,OR]
	RewriteCond %{QUERY_STRING} (127\.0\.0\.1) [NC,OR]
	RewriteCond %{QUERY_STRING} ([a-z0-9]{2000}) [NC,OR]
	RewriteCond %{QUERY_STRING} (javascript:)(.*)(;) [NC,OR]
	RewriteCond %{QUERY_STRING} (base64_encode)(.*)(\() [NC,OR]
	RewriteCond %{QUERY_STRING} (GLOBALS|REQUEST)(=|\[|%) [NC,OR]
	RewriteCond %{QUERY_STRING} (<|%3C)(.*)script(.*)(>|%3) [NC,OR]
	RewriteCond %{QUERY_STRING} (\\|\.\.\.|\.\./|~|`|<|>|\|) [NC,OR]
	RewriteCond %{QUERY_STRING} (boot\.ini|etc/passwd|self/environ) [NC,OR]
	RewriteCond %{QUERY_STRING} (thumbs?(_editor|open)?|tim(thumb)?)\.php [NC,OR]
	RewriteCond %{QUERY_STRING} (\'|\")(.*)(drop|insert|md5|select|union) [NC]
	RewriteRule .* - [F]
</IfModule>

# 6G:[REQUEST METHOD]
<IfModule mod_rewrite.c>
	RewriteCond %{REQUEST_METHOD} ^(connect|debug|delete|move|put|trace|track) [NC]
	RewriteRule .* - [F]
</IfModule>

# 6G:[REFERRERS]
<IfModule mod_rewrite.c>
	RewriteCond %{HTTP_REFERER} ([a-z0-9]{2000}) [NC,OR]
	RewriteCond %{HTTP_REFERER} (semalt.com|todaperfeita) [NC]
	RewriteRule .* - [F]
</IfModule>

# 6G:[REQUEST STRINGS]
<IfModule mod_alias.c>
	RedirectMatch 403 (?i)([a-z0-9]{2000})
	RedirectMatch 403 (?i)(https?|ftp|php):/
	RedirectMatch 403 (?i)(base64_encode)(.*)(\()
	RedirectMatch 403 (?i)(=\\\'|=\\%27|/\\\'/?)\.
	RedirectMatch 403 (?i)/(\$(\&)?|\*|\"|\.|,|&|&amp;?)/?$
	RedirectMatch 403 (?i)(\{0\}|\(/\(|\.\.\.|\+\+\+|\\\"\\\")
	RedirectMatch 403 (?i)(~|`|<|>|:|;|,|%|\\|\s|\{|\}|\[|\]|\|)
	RedirectMatch 403 (?i)/(=|\$&|_mm|cgi-|etc/passwd|muieblack)
	RedirectMatch 403 (?i)(&pws=0|_vti_|\(null\)|\{\$itemURL\}|echo(.*)kae|etc/passwd|eval\(|self/environ)
	RedirectMatch 403 (?i)\.(aspx?|bash|bak?|cfg|cgi|dll|exe|git|hg|ini|jsp|log|mdb|out|sql|svn|swp|tar|rar|rdf)$
	RedirectMatch 403 (?i)/(^$|(wp-)?config|mobiquo|phpinfo|shell|sqlpatch|thumb|thumb_editor|thumbopen|timthumb|webshell)\.php
</IfModule>

# 6G:[USER AGENTS]
<IfModule mod_setenvif.c>
	SetEnvIfNoCase User-Agent ([a-z0-9]{2000}) bad_bot
	SetEnvIfNoCase User-Agent (archive.org|binlar|casper|checkpriv|choppy|clshttp|cmsworld|diavol|dotbot|extract|feedfinder|flicky|g00g1e|harvest|heritrix|httrack|kmccrew|loader|miner|nikto|nutch|planetwork|postrank|purebot|pycurl|python|seekerspider|siclab|skygrid|sqlmap|sucker|turnit|vikspider|winhttp|xxxyy|youda|zmeu|zune) bad_bot
	
	# Apache < 2.3
	<IfModule !mod_authz_core.c>
		Order Allow,Deny
		Allow from all
		Deny from env=bad_bot
	</IfModule>

	# Apache >= 2.3
	<IfModule mod_authz_core.c>
		<RequireAll>
			Require all Granted
			Require not env bad_bot
		</RequireAll>
	</IfModule>
</IfModule>

# 6G:[BAD IPS]
<Limit GET HEAD OPTIONS POST PUT>
	Order Allow,Deny
	Allow from All
	# uncomment/edit/repeat next line to block IPs
	# Deny from 123.456.789
</Limit>




<?php
# BLOCK PROXY VISITS
# http://m0n.co/02
# http://m0n.co/03   ?>
<IfModule mod_rewrite.c>
	RewriteEngine on
	RewriteCond %{HTTP:VIA}                 !^$ [OR]
	RewriteCond %{HTTP:FORWARDED}           !^$ [OR]
	RewriteCond %{HTTP:USERAGENT_VIA}       !^$ [OR]
	RewriteCond %{HTTP:X_FORWARDED_FOR}     !^$ [OR]
	RewriteCond %{HTTP:PROXY_CONNECTION}    !^$ [OR]
	RewriteCond %{HTTP:XPROXY_CONNECTION}   !^$ [OR]
	RewriteCond %{HTTP:HTTP_PC_REMOTE_ADDR} !^$ [OR]
	RewriteCond %{HTTP:HTTP_CLIENT_IP}      !^$
	RewriteRule .* - [F]
</IfModule>