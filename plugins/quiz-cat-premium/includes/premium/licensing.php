<?php

/************************************
Licensing & Automatic Updates - implementation. Built on top of EDD-SL (https://easydigitaldownloads.com/extensions/software-licensing/) 
http://docs.easydigitaldownloads.com/article/383-automatic-upgrades-for-wordpress-plugins
 ************************************* */
 
// load our custom updater
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
	include FCA_QC_PLUGIN_DIR . '/includes/premium/EDD_SL_Plugin_Updater.php';
}

//DEFINE SOME USEFUL CONSTANTS
$plugin_name = '';
switch ( FCA_QC_PLUGIN_PACKAGE ) {

	case 'Elite':
		$plugin_name = 'Quiz Cat Premium: Elite';
		break;
	
	case 'Personal':
		$plugin_name = 'Quiz Cat Premium: Personal';
		break;
	
	case 'Business':
		$plugin_name = 'Quiz Cat Premium: Business';
		break;
	
	default:
		$plugin_name = 'Quiz Cat';

}
define( 'FCA_QC_PLUGIN_NAME', $plugin_name);

function fca_qc_license() {
	
	$license_key = get_option( 'fca_qc_license_key' );
	
	$edd_updater = new EDD_SL_Plugin_Updater( 'https://fatcatapps.com/', FCA_QC_PLUGIN_FILE, array(
			'version'	=> FCA_QC_PLUGIN_VER,
			'license'	=> $license_key,
			'item_name' => FCA_QC_PLUGIN_NAME,
			'author'	=> 'Fatcat Apps',
			'url'		=> home_url()
		)
	);
	
}
add_action( 'admin_init', 'fca_qc_license' );

//register setting sub page   
function fca_qc_license_menu() {
	add_submenu_page(
		'edit.php?post_type=fca_qc_quiz',
		__('Settings', 'quiz-cat'),
		__('Settings', 'quiz-cat'),
		'manage_options',
		'quiz-cat-license',
		'fca_qc_license_page'
	);
}
add_action( 'admin_menu', 'fca_qc_license_menu' );

function fca_qc_license_page() {
	
	wp_enqueue_script('fca_qc_wysi_js_main', FCA_QC_PLUGINS_URL . '/includes/wysi/wysihtml.min.js', array(), FCA_QC_PLUGIN_VER, true );
	wp_enqueue_style('fca_qc_wysi_css', FCA_QC_PLUGINS_URL . '/includes/wysi/wysi.min.css', array(), FCA_QC_PLUGIN_VER );
	wp_enqueue_script('fca_qc_wysi_js', FCA_QC_PLUGINS_URL . '/includes/wysi/wysi.min.js', array( 'jquery', 'fca_qc_wysi_js_main' ), FCA_QC_PLUGIN_VER, true );		
	
	wp_enqueue_style('fca_qc_licensing_css', FCA_QC_PLUGINS_URL . '/includes/premium/licensing.css', array(), FCA_QC_PLUGIN_VER );
	wp_enqueue_script('fca_qc_licensing_js', FCA_QC_PLUGINS_URL . '/includes/premium/licensing.js', array( 'jquery', 'fca_qc_wysi_js_main' ), FCA_QC_PLUGIN_VER, true );		
	
	$admin_data = array (
		//SOME LOCALIZATION STRINGS FOR JAVASCRIPT STUFF
		'navigationWarning_string' => __( "You have entered new data on this page.  If you navigate away from this page without first saving your data, the changes will be lost.", 'quiz-cat'),
		'sureWarning_string' => 	 __( 'Are you sure?', 'quiz-cat'),
		'selectImage_string' => __('Select Image', 'quiz-cat' ),			
		'remove_string' =>  __('remove', 'quiz-cat'),
		'show_string' =>  __('show', 'quiz-cat'),
		'unused_string' =>  __('Unused', 'quiz-cat') . ':',
		'points_string' =>  __('Points', 'quiz-cat'),
		'question_string' =>  __('Question', 'quiz-cat'),
		'save_string' =>  __('Save', 'quiz-cat'),
		'preview_string' =>  __('Save & Preview', 'quiz-cat'),
		'on_string' =>  __('YES', 'quiz-cat'),
		'off_string' =>  __('NO', 'quiz-cat'),
		'debug' => FCA_QC_DEBUG,
		'stylesheet' => FCA_QC_PLUGINS_URL . '/includes/wysi/wysi.min.css'
	);
	 
	wp_localize_script( 'fca_qc_licensing_js', 'fcaQcAdminData', $admin_data );
	wp_localize_script( 'fca_qc_wysi_js', 'fcaQcAdminData', $admin_data );
			
	$error_msg = fca_qc_activate_license();
	$error_msg .= fca_qc_deactivate_license();
	$error_msg .= fca_qc_save_gdpr_settings();
	$license  = get_option( 'fca_qc_license_key' );
	$status	  = get_option( 'fca_qc_license_status', 'inactive' );
	
	$gdpr_checkbox = get_option( 'fca_qc_gdpr_checkbox' );
	$gdpr_locale = get_option( 'fca_qc_gdpr_locale' );
	$consent_headline = stripslashes_deep( get_option( 'fca_qc_consent_headline', "<p class='wysiwyg-text-align-center'>In order to comply with privacy regulations in the European Union we'll need you to provide consent before confirming you to our email list:</p>" ) );
	$consent_msg = stripslashes_deep( get_option( 'fca_qc_consent_msg' ) );
	
	?>

	<div class="wrap">
		<form method="post" id='fca_qc_settings_form'>
			<?php if ( $error_msg ) {
				echo	"<div class='notice error'>
							<p>$error_msg</p>
						</div>";
			} ?>

			<?php wp_nonce_field( 'fca_qc_license_nonce', 'fca_qc_license_nonce' ); ?>

			<h3>
				<?php _e('License', 'quiz-cat'); ?>
				<?php if( $status == 'valid' ) { ?>
					<span style="color: #fff; background: #7ad03a; font-size: 13px; padding: 4px 6px 3px 6px; margin-left: 5px;"><?php _e('ACTIVE', 'quiz-cat'); ?></span>
				<?php } elseif($status == 'expired' ) { ?>
					<span style="color: #fff; background: #dd3d36; font-size: 13px; padding: 4px 6px 3px 6px; margin-left: 5px;"><?php _e('EXPIRED', 'quiz-cat'); ?></span>
				<?php } else { ?>
					<span style="color: #fff; background: #dd3d36; font-size: 13px; padding: 4px 6px 3px 6px; margin-left: 5px;"><?php _e('INACTIVE.', 'quiz-cat'); ?></span>
				<?php } ?>
			</h3>

			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row" valign="top">
							<?php _e('License Key', 'quiz-cat'); ?>
						</th>
						<td>
							<input id="fca_qc_license_key" name="fca_qc_license_key" type="text" class="regular-text" value="<?php echo $license ?>" /><br/>
							<label class="description" for="fca_qc_license_key"><?php _e('Enter your license key', 'quiz-cat'); ?></label>
						</td>
					</tr>

					<tr valign="top">
						<th scope="row" valign="top">
							<?php _e('Activate License', 'quiz-cat'); ?>
						</th>
						<td>
							<?php if( $status == 'valid' ) { ?>
								<input type="submit" class="button-secondary" name="fca_qc_license_deactivate" value="<?php _e('Deactivate License', 'quiz-cat'); ?>"/>
							<?php } else { ?>
								<input type="submit" class="button-secondary" name="fca_qc_license_activate" value="<?php _e('Activate License', 'quiz-cat'); ?>"/>
							<?php } ?>
						</td>
					</tr>
					<?php if ( FCA_QC_PLUGIN_PACKAGE == 'Business' OR FCA_QC_PLUGIN_PACKAGE == 'Elite' OR FCA_QC_PLUGIN_PACKAGE == '{{QC-Edition}}' ) { ?>
					<tr>
						<th colspan='2'>
							<h3><?php _e( 'EU GDPR Compliance', 'quiz-cat') ?></h3>
						</th>
					</tr>
					<tr>
						<td colspan='2' style='font-style: normal; padding: 0;'>
							<?php _e( 'If you are collecting data on people in the EU, the GDPR requires consent for any marketing activities, and will store that consent. Enabling this setting below will let your subscribers give explicit consent.', 'quiz-cat') ?><br>
							<?php _e( 'Note that turning this feature on is only part of making your business GDPR compliant. We recommend consulting with a lawyer.', 'quiz-cat') ?>
						</td>
					</tr>
					<tr>
						<th><?php _e( 'EU GDPR Checkbox', 'quiz-cat') ?></th>
						<td>
							<div class='onoffswitch'>
								<input type='checkbox' class='onoffswitch-checkbox' id='fca_qc_gdpr_checkbox' style='display:none;' name='fca_qc_gdpr_checkbox' value="1" <?php checked( $gdpr_checkbox, 1 ); ?>></input>		
								<label class='onoffswitch-label' for='fca_qc_gdpr_checkbox'><span class='onoffswitch-inner'><span class='onoffswitch-switch'></span></span></label>
							</div>
							<?php _e( 'Enabling this will:', 'quiz-cat') ?><br><br>
							1. <?php _e( 'Add a checkbox, which is unchecked by default, to all existing & new forms. To increase conversions, the checkbox will show after your subscriber submits his email.', 'quiz-cat') ?><br>
							2. <?php _e( 'Log consent in the quiz CSV export file', 'quiz-cat') ?><br><br>
							<?php _e( 'Note: Your subscribers will only be sent onwards to your email provider, if they check the consent checkbox.', 'quiz-cat') ?>
						</td>
					</tr>
					<tr class='gdpr-setting'>
						<th><?php _e( 'Consent Headline', 'quiz-cat') ?></th>
						<td>
							<?php echo fca_qc_add_wysiwyg( $consent_headline, 'fca_qc_consent_headline' ) ?>
						</td>
					</tr>
					<tr class='gdpr-setting'>
						<th><?php _e( 'Consent Message', 'quiz-cat') ?></th>
						<td>
							<?php echo fca_qc_add_wysiwyg( $consent_msg, 'fca_qc_consent_msg' ) ?>
						</td>
					</tr>
					<tr class='gdpr-setting'>
						<th><?php _e( "Only show checkbox if subscriber's browser registers to the EU", 'quiz-cat') ?></th>
						<td>
							<div class='onoffswitch'>
								<input type='checkbox' class='onoffswitch-checkbox' id='fca_qc_gdpr_locale' style='display:none;' name='fca_qc_gdpr_locale' value="1" <?php checked( $gdpr_locale, 1 ); ?>></input>		
								<label class='onoffswitch-label' for='fca_qc_gdpr_locale'><span class='onoffswitch-inner'><span class='onoffswitch-switch'></span></span></label>
							</div>
							<?php _e( "Will only show the consent checkbox if your subscriber's browser's location setting is set to the EU. Note, this can't 100% guarantee that all EU residents will be caught, so use with caution.", 'quiz-cat' ) ?>
						</td>
					</tr>
					<tr>
						<td colspan='2' style='padding:0;'><button class='button button-primary' name='fca_qc_save' type='submit'><?php _e( 'Save', 'quiz-cat' ) ?></button></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</form>
	
	</div>
	<?php
}

/************************************
*	 Activating the license		   * 
************************************* */
function fca_qc_activate_license() {
	if( isset( $_POST['fca_qc_license_activate'] ) && isset( $_POST['fca_qc_license_key'] )  ) {
		// run a quick security check 
		if( !check_admin_referer( 'fca_qc_license_nonce', 'fca_qc_license_nonce' ) ) {
			return; // get out if we didn't click the Activate button
		}
		
		$license = fca_qc_sanitize_license( $_POST[ 'fca_qc_license_key' ] );
		
		$api_params = array(
			'edd_action'=> 'activate_license',
			'license'	=> $license,
			'item_name' => urlencode( FCA_QC_PLUGIN_NAME ), // the name of our product in EDD
			'url'		=> home_url()
		);

		// Call the API.
		$response = wp_remote_post( 'https://fatcatapps.com/', array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
			if ( is_wp_error( $response ) ) {
				$message = $response->get_error_message();
			} else {
				$message = __( 'An error occurred, please try again.' );
			}
		} else {

			// decode the license data
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );

			if ( false === $license_data->success ) {
			
				switch( $license_data->error ) {
					case 'expired' :
						$message = sprintf(
							__( 'Your license key expired on %s.' ),
							date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) )
						);
						break;
					case 'revoked' :
						$message = __( 'Your license key has been disabled.' );
						break;
					case 'missing' :
						$message = __( 'Invalid license.' );
						break;
					case 'invalid' :
					case 'site_inactive' :
						$message = __( 'Your license is not active for this URL.' );
						break;
					case 'item_name_mismatch' :
						$message = sprintf( __( 'This appears to be an invalid license key for %s.' ), FCA_QC_PLUGIN_NAME );
						break;
					case 'no_activations_left':
						$message = __( 'Your license key has reached its activation limit.' );
						break;
					default :
						$message = __( 'An error occurred, please try again.' );
						break;
				}

			}
		
		}
				
		// $license_data->license will be either "valid" or "invalid"
		update_option( 'fca_qc_license_status', $license_data->license );
		update_option( 'fca_qc_license_key', $license );
		
		// Check if anything passed on a message constituting a failure
		if ( !empty( $message ) ) {
			return $message;
		}
	}
	
	return false;

}
	
/************************************
* Deactivating the license
************************************/

function fca_qc_deactivate_license() {

	if( isset( $_POST['fca_qc_license_deactivate'] ) ) {

		// run a quick security check 
		if( ! check_admin_referer( 'fca_qc_license_nonce', 'fca_qc_license_nonce' ) ) {
			return; // get out if we didn't click the Activate button
		}

		// retrieve the license from the database
		$license = get_option( 'fca_qc_license_key' );

		// data to send in our API request
		$api_params = array( 
			'edd_action'=> 'deactivate_license', 
			'license'	=> $license,
			'item_name' => FCA_QC_PLUGIN_NAME, // the name of our product in EDD
			'url'		=> home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( 'https://fatcatapps.com/', array( 'body' => $api_params, 'timeout' => 15, 'sslverify' => false ) );
		
		// make sure the response came back okay
		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
					
			if ( is_wp_error( $response ) ) {
				$message = $response->get_error_message();
			} else {
				$message = __( 'An error occurred, please try again.' );
			}
		}
		

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		if( $license_data->license == 'deactivated' || $license_data->license == 'failed' ) {
			delete_option( 'fca_qc_license_status' );
			delete_option( 'fca_qc_license_key' );
		}
		if ( !empty( $message ) ) {
			return $message;
		}
	}
	
	return false;
}

//SAVE GDPR Settings
function fca_qc_save_gdpr_settings() {
	if( isset( $_POST['fca_qc_save'] ) ) {
		if( !check_admin_referer( 'fca_qc_license_nonce', 'fca_qc_license_nonce' ) ) {
			return; // invalid nonce
		}
	
		$gdpr_checkbox = !empty( $_POST['fca_qc_gdpr_checkbox'] ) ? true : false;
		update_option( 'fca_qc_gdpr_checkbox', $gdpr_checkbox );
		
		$gdpr_locale = !empty( $_POST['fca_qc_gdpr_locale'] ) ? true : false;
		update_option( 'fca_qc_gdpr_locale', $gdpr_locale );
			
		$consent_headline = !empty( $_POST['fca_qc_consent_headline'] ) ? wp_kses_post( $_POST['fca_qc_consent_headline'] ) : false;
		update_option( 'fca_qc_consent_headline', $consent_headline );
		
		$consent_msg = !empty( $_POST['fca_qc_consent_msg'] ) ? wp_kses_post( $_POST['fca_qc_consent_msg'] ) : false;
		update_option( 'fca_qc_consent_msg', $consent_msg );
	}
}

function fca_qc_sanitize_license( $key ) {
	$old = get_option( 'fca_qc_license_key' );
	if( $old && $old != $key ) {
		delete_option( 'fca_qc_license_status' ); // new license has been entered, so must reactivate
	}
	return htmlentities( trim($key) );
}

//LICENSE CHECK
function fca_qc_check_license() {
	
	$store_url = 'https://fatcatapps.com/';
	$item_name = FCA_QC_PLUGIN_NAME;
	$license = get_option( 'fca_qc_license_key' );
	$api_params = array(
		'edd_action' => 'check_license',
		'license' => $license,
		'item_name' => urlencode( $item_name ),
		'url' => home_url()
	);
	
	$response = wp_remote_post( $store_url, array( 'body' => $api_params, 'timeout' => 15, 'sslverify' => false ) );
	
  	if ( is_wp_error( $response ) ) {
		return false;
  	}

	$license_data = json_decode( wp_remote_retrieve_body( $response ) );
	
	update_option( 'fca_qc_license_status', $license_data->license );
	
}
add_action('fca_qc_license_check', 'fca_qc_check_license');

if( !wp_next_scheduled( 'fca_qc_license_check' ) ) {
	wp_schedule_event(time(), 'daily', 'fca_qc_license_check');
}