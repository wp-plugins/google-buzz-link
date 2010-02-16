<?php
/**
 * Plugin Name: Google Buzz
 * Plugin URI: http://headwaymarketing.com/google-buzz-wordpress-plugin
 * Description: A plugin that syndicates your blog feed to your Google Buzz profile.
 * Version: 1.0
 * Author: Headway Marketing
 * Author URI: http://headwaymarketing.com
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

// add menu item
add_action('admin_menu', 'gbuzz_menu_item');

// configure menu item
function gbuzz_menu_item() {
	add_options_page('Google Buzz Settings', 'Google Buzz', 1, 'gbuzz', 'gbuzz_settings');
	}

// create page to manage settings
function gbuzz_settings() { 

    // variables for the field and option names 
    $gbuzz_username_opt_name = 'gbuzz_username';
    $hidden_field_name = 'submit_hidden_field';
    $gbuzz_username_field = 'gbuzz_username';

    // Read in existing option value from database
    $gbuzz_username_val = get_option( $gbuzz_username_opt_name );

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $gbuzz_username_val = $_POST[ $gbuzz_username_field ];

        // Save the posted value in the database
        update_option( $gbuzz_username_opt_name, $gbuzz_username_val );

        // Put an options updated message on the screen
		echo '<div class="updated"><p><strong>Settings Saved!</strong></p></div>';
} ?>
    <div class="wrap">
        <h2>Google Buzz Settings</h2>
        <p>Insert your Google Buzz username and your blog feed will be added to your Google Buzz stream.</p>
        <form name="form1" method="post" action="">
            <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
            <p>Google Buzz Username: <input type="text" name="<?php echo $gbuzz_username_field; ?>" value="<?php echo $gbuzz_username_val; ?>" /></p>
            <p><input type="submit" name="Submit" value="Update Options" /></p>
        </form>
    </div>
<?php } 

function gbuzz_link() {
    // variables for the field and option names 
    $gbuzz_username_opt_name = 'gbuzz_username';
    $hidden_field_name = 'submit_hidden_field';
    $gbuzz_username_field = 'gbuzz_username';

    // Read in existing option value from database
    $gbuzz_username_val = get_option( $gbuzz_username_opt_name );
	
	// Print link to Google Buzz Profile
	echo '<link rel="me" type="text/html" href="http://www.google.com/profiles/'.$gbuzz_username_val.'" />';
	}
add_action('wp_head', 'gbuzz_link'); 
?>