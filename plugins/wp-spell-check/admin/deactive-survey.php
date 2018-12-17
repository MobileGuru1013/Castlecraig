<?php
	/*
	 * WP Spell Check Class to create a deactivation survey
	 */
	 
	 
	 class wpsc_deactivation {
	 
		public $api = 'https://www.wpspellcheck.com/api/deactivate.php';
		//public $theme_name;
		//public $theme_parent;
		
		public function __construct() {
			$theme = wp_get_theme();
			
			//$this->theme_name = $theme->name;
			//$this->theme_parent = $theme->parent_name;
		
			//Initialize JS, CSS, and HTML
			add_action( 'admin_print_scripts', array($this, 'run_js'), 20 );
			add_action( 'admin_print_scripts', array($this, 'run_css') );
			add_action( 'admin_footer', array($this, 'create_form') );
		}
		
		public function is_plugins_page() {
			$current_page = get_current_screen(); //Get current page
			
			if ( empty($current_page) ) return false;
			
			//Check if current page is the plugin page for single or multi site
			if ( in_array( $current_page->id, array( 'plugins', 'plugins-network' ), true ) ) {
				return true;
			} else {
				return false;
			}
		}
		
		public function run_js() {
			if ( ! $this->is_plugins_page() ) return;
			
			global $wp_version;
			?>
			<script type="text/javascript">
				jQuery(function($){
					var link = $('#the-list').find('[data-slug="wp-spell-check"] span.deactivate a');
					var popup = $('#wpsc_survey_modal');
					var wpsc_form = popup.find('form');
					isOpen = false;
					
					//Bring up survey when attempting to deactivate plugin
					link.on('click', function(event) {
						event.preventDefault();
						popup.css('display', 'table');
						isOpen = true;
					});
					
					//Deactive plugin as normal when they click skip survey link
					wpsc_form.on('click', '.wpsc_skip_survey', function(event) {
						event.preventDefault();
						location.href = link.attr('href');
					});
					
					wpsc_form.on('click', '.wpsc_give_feedback', function(event) {
						event.preventDefault();
						window.open("https://wordpress.org/support/plugin/wp-spell-check/reviews/", "_blank");
						location.href = link.attr('href');
					});
					
					$(document).keyup(function(event) {
						if (27 === event.keyCode && isOpen) {
							popup.hide();
							isOpen = false;
							link.focus();
						}
					});
				});
			</script>
			<?php
		}
		
		public function run_css() {
			if ( ! $this->is_plugins_page() ) return;
			
			?>
			<style type="text/css">
				.wpsc_survey_modal {
				display: none;
				table-layout: fixed;
				position: fixed;
				z-index: 9999;
				width: 100%;
				height: 100%;
				text-align: center;
				font-size: 14px;
				top: 0;
				left: 0;
				background: rgba(0,0,0,0.8);
			}
			.wpsc_survey_wrapper {
				display: table-cell;
				vertical-align: middle;
			}
			.wpsc_survey_form {
				background-color: #fff;
				max-width: 550px;
				margin: 0 auto;
				padding: 30px;
				text-align: center;
			}
			.wpsc_deactivate_survey .error {
				display: block;
				color: red;
				margin: 0 0 10px 0;
			}
			.wpsc_survey_title {
				display: block;
				font-size: 18px;
				font-weight: 700;
				text-transform: uppercase;
				border-bottom: 1px solid #ddd;
				padding: 0 0 18px 0;
				margin: 0 0 18px 0;
			}
			.wpsc_survey_desc {
				display: block;
				font-weight: 600;
				margin: 0 0 18px 0;
			}
			.wpsc_survey_label {
				display: block;
				margin: 10px;
			}
			.wpsc_survey_option {
				margin: 0 0 10px 0;
			}
			.wpsc_survey_option_input {
				margin-right: 10px !important;
			}
			.wpsc_survey_option_details, .wpsc-contact-form {
				display: none;
				width: 90%;
				margin: 10px 0 0 30px;
			}
			.wpsc_survey_footer {
				margin-top: 18px;
			}
			.wpsc_survey_sending {
				display: none;
				margin: 0 0 10px;
			}
			.wpsc_survey_footer button {
				background: green!important;
				border-color: #006a00!important;
				box-shadow: 0 1px #006a00!important;
				text-shadow: 1px 1px 1px #006a00!important;
			}
			</style>
			
			<?php
		}
		
		
		public function create_form() {
			if ( ! $this->is_plugins_page() ) return;
			
			$numbers = range(1,4);
			shuffle($numbers);
			
			?>
			<div class="wpsc_survey_modal" id="wpsc_survey_modal">
				<div class="wpsc_survey_wrapper">
						<form class="wpsc_survey_form">
						<span class="wpsc_survey_title">Plugin Feedback</span>
						<div style="text-align: center; font-weight: bold; font-size: 18px; line-height: 24px;">Can you support us by giving us a review?</div>
						<br><a class="wpsc_give_feedback" href="https://wordpress.org/support/plugin/wp-spell-check/reviews/" target="_blank" style="display: block;"><button style="padding: 5px 15px;font-weight: bold;margin: 5px 10px;border: 1px solid #008200;font-size: 18px;">Yes, I will support you</button></a>
						<a class="wpsc_skip_survey" href="#" style="color: #b9b9b9; font-size: 12px; text-decoration: none;">Skip & Deactivate</a>
					</form>
				</div>
			</div>
		<?php
		}
	 
	 }
?>