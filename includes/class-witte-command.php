<?php

WP_CLI::add_command( 'witte', Witte_Command::class );

/**
 * The class that handles the WP_CLI plugin commands.
 */
class Witte_Command extends WP_CLI_Command {

	/**
	 * The constructor.
	 */
	public function __construct() {
		// Example constructor called when plugin loads.
	}

	/**
	 * 'wp witte hello_world'
	 * Returns the most epic string.
	 *
	 * @param $args
	 * @param $assoc_args
	 */
	public function hello_world( $args, $assoc_args ) {
		echo 'Hello world.';
		WP_CLI::success( 'Bye bye!' );
	}

}
