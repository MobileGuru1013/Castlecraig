<?php
/**
 * Functions to be used within the wp_all_import plugin
 */

/**
 * Replaced things like img paths in the body
 * @param  [string] $body 	text to be sanitized
 * @return [string]      	Sanitized text
 */
function sanitizeBody($body) {
	$body = str_replace("/sites/default/files", "/wp-content/uploads/legacy-files", $body);
	$body = str_replace("sites/default/files", "/wp-content/uploads/legacy-files", $body);
	$body = str_replace("<p>[insert index]</p>", "", $body);
	$body = str_replace("[insert index]", "", $body);
	return $body;
}


/**
 * Set the title to the short title (menu title) if available and to the normal title if not
 * @param [string] $title      
 * @param [string] $menu_title
 */
function setTitle ($title, $menu_title) {
	if ($menu_title) {
		return $menu_title;
	}
	return $title;
}

/**
 * Set the long title if both a menu title exists
 * @param [string] $title
 * @param [string] $menu_title
 */
function setLongTitle ($title, $menu_title) {
	if ($menu_title && $menu_title != $title) {
		return $title;
	}
	return "";
}



// Tests
$body = '<p>[insert index]</p>[insert index]<img src="/sites/default/files/inline_images/about_us/lee.jpg" alt="Lee Taylor" width="166" height="218" hspace="5" align="left" />Since graduating from Strathclyde University"';
echo "<pre>";
print htmlspecialchars (sanitizeBody($body)) . "\n";

print "1. " . setTitle ("Long title", "") . "\n";
print "2. " .  setTitle ("Long title", "menu title")  . "\n";

print "3. " .  setLongTitle ("Long title", "") . "\n";
print "4. " .  setLongTitle ("Long title", "menu title")  . "\n";
print "5. " .  setLongTitle ("Long title", "Long title")  . "\n";


?>