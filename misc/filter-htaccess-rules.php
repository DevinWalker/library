<?php
/**
 * Filter the htaccess rules. In this example we have removed mp3 from the FileMatch line if the method is set to 'direct'
*/
function sumobi_edd_filter_htaccess_rules( $rules, $method ) {
	
	switch( $method ) :

		case 'redirect' :
			// Prevent directory browsing
			$rules = "Options -Indexes";
			break;

		case 'direct' :
		default :
			// Prevent directory browsing and direct access to all files, except images (they must be allowed for featured images / thumbnails)
			$rules = "Options -Indexes\n";
			$rules .= "deny from all\n";
			$rules .= "<FilesMatch '\.(jpg|png|gif|ogg)$'>\n";
			    $rules .= "Order Allow,Deny\n";
			    $rules .= "Allow from all\n";
			$rules .= "</FilesMatch>\n";
			break;

	endswitch;

	return $rules;
}
add_filter( 'edd_protected_directory_htaccess_rules', 'sumobi_edd_filter_htaccess_rules', 10, 2 );