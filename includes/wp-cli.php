<?php

// Check that the request is from the WP-CLI.
if ( defined( 'WP_CLI' ) && WP_CLI ) {
	require_once 'class-witte-command.php';
}
