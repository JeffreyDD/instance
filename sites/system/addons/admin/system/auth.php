<?php

function admin_require_authentication(){
	    header('WWW-Authenticate: Basic realm="My Realm"');
	    header('HTTP/1.0 401 Unauthorized');
	    echo 'Invalid Credentials';
	    exit;	
}

function admin_authenticate(){
	// Set $authenticated by default to false.
	$authenticated = false;
	
	// Check if authentication details have been send
	if (!isset($_SERVER['PHP_AUTH_USER'])) {
		// No user send, show auth dialog
		admin_require_authentication();
	}else{
		// User send, continue with password check
		
		// FIXME: Do this in the DB or something
		$passwords['admin'] = 'InStAnCeTeSt2012';
		
		// Check if password is sent
		if($_SERVER['PHP_AUTH_USER'] && $_SERVER['PHP_AUTH_PW']){
			// Password is sent, check if it matched the sent user
			if($passwords[$_SERVER['PHP_AUTH_USER']] === $_SERVER['PHP_AUTH_PW'])
				// Password matches, set $authenticated from false to the authenticated user
				$authenticated=$_SERVER['PHP_AUTH_USER'];
			else
				// Password doesn't match, show auth dialog
				admin_require_authentication();
		}else{
			// No password sent, show auth dialog
			admin_require_authentication();
		}
	}
	
	// Return the $authenticated state
	return $authenticated;
}

if($admin)
	$current_admin_authorization = admin_authenticate();

?>