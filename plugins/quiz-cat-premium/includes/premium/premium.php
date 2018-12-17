<?php
	
// BASIC SECURITY
defined( 'ABSPATH' ) or die( 'Unauthorized Access!' );

//ADD THE QUIZ TYPE SELECT META BOX
function fca_qc_add_premium_metaboxes( $post ) {

	add_meta_box( 
		'fca_qc_quiz_type_meta_box',
		__( 'Quiz Type', 'quiz-cat' ),
		'fca_qc_render_quiz_type_meta_box',
		null,
		'normal',
		'high'
	);
		
	add_meta_box( 
	'fca_qc_add_personality_result_meta_box',
		__( 'Personality Results', 'quiz-cat' ),
		'fca_qc_render_personality_add_result_meta_box',
		null,
		'normal',
		'high'
	);
	
	add_meta_box( 
		'fca_qc_personality_questions_meta_box',
		__( 'Personality Questions', 'quiz-cat' ),
		'fca_qc_render_personality_questions_meta_box',
		null,
		'normal',
		'high'
	);
	
	add_meta_box( 
		'fca_qc_appearance_meta_box',
		__( 'Appearance', 'quiz-cat' ),
		'fca_qc_render_appearance_metabox',
		null,
		'normal',
		'default'
	);
	
	add_meta_box( 
		'fca_qc_social_sharing_meta_box',
		__( 'Social Media Sharing', 'quiz-cat' ),
		'fca_qc_render_social_sharing_metabox',
		null,
		'normal',
		'default'
	);
			
}
add_action( 'add_meta_boxes_fca_qc_quiz', 'fca_qc_add_premium_metaboxes', 12, 1 );

//RENDER APPEARANCE METABOX
function fca_qc_render_appearance_metabox ( $post ) {
	$appearance = get_post_meta ( $post->ID, 'quiz_cat_appearance', true );
	
	$button_color = empty( $appearance['button_color'] ) ? '#58afa2' : $appearance['button_color'];
	$button_hover_color = empty( $appearance['button_hover_color'] ) ? '#3c7d73' : $appearance['button_hover_color'];
	$button_border_color = empty( $appearance['button_border_color'] ) ? '#3c7d73' : $appearance['button_border_color'];
	$answer_hover_color = empty( $appearance['answer_hover_color'] ) ? '#8dc8bf' : $appearance['answer_hover_color'];
	
	echo "<table class='fca_qc_setting_table'>";
		echo "<tr>";
			echo "<th>";
				echo "<label class='fca_qc_admin_label fca_qc_admin_settings_label' for='fca_qc_button_color'>" . __('Button Color', 'quiz-cat') . "</label>";
			echo "</th>";
			echo "<td>";
				echo "<input type='text' class='fca_qc_colorpicker' name='fca_qc_button_color' value='$button_color'>";
			echo "</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<th>";
				echo "<label class='fca_qc_admin_label fca_qc_admin_settings_label' for='fca_qc_button_hover_color'>" . __('Button Hover Color', 'quiz-cat') . "</label>";
			echo "</th>";
			echo "<td>";
				echo "<input type='text' class='fca_qc_colorpicker' name='fca_qc_button_hover_color' value='$button_hover_color'>";
			echo "</td>";
		echo "</tr>";
			echo "<tr>";
			echo "<th>";
				echo "<label class='fca_qc_admin_label fca_qc_admin_settings_label' for='fca_qc_button_border_color'>" . __('Button Border Color', 'quiz-cat') . "</label>";
			echo "</th>";
			echo "<td>";
				echo "<input type='text' class='fca_qc_colorpicker' name='fca_qc_button_border_color' value='$button_border_color'>";
			echo "</td>";
		echo "</tr>";
			echo "<tr>";
			echo "<th>";
				echo "<label class='fca_qc_admin_label fca_qc_admin_settings_label' for='fca_qc_answer_hover_color'>" . __('Answer Hover Color', 'quiz-cat') . "</label>";
			echo "</th>";
			echo "<td>";
				echo "<input type='text' class='fca_qc_colorpicker' name='fca_qc_answer_hover_color' value='$answer_hover_color'>";
			echo "</td>";
		echo "</tr>";
	echo "</table>";	
	
}


//RENDER THE ADD QUESTION META BOX
function fca_qc_render_personality_questions_meta_box( $post ) {
		
	$questions = get_post_meta ( $post->ID, 'quiz_cat_questions', true );
	
	echo "<p class='fca_qc_quiz_instructions'>" . __('Add your questions and match the answers to your personalities. Drag to re-order.', 'quiz-cat') . "</p>";
	echo "<div class='fca_qc_sortable_questions'>";
		if ( empty ( $questions ) ) {
			
			echo fca_qc_render_personality_question( array(), 1 );
			
		} else {
			
			$counter = 1;
			
			forEach ( $questions as $question ) {
				
				echo fca_qc_render_personality_question( $question, $counter );
				$counter = $counter + 1;
				
			}		
		}	
	echo "</div>";
	echo "<button type='button' title='" . __( 'Add a new Question', 'quiz-cat') . "' id='fca_qc_add_personality_question_btn' class='button-secondary fca_qc_add_btn' ><span class='dashicons dashicons-plus' style='vertical-align: text-top;'></span>" .__('Add', 'quiz-cat') . "</button>";
	
}

// RENDER A QUESTION META BOX
// INPUT: ARRAY->$question [QUESTION, ANSWER, IMG, HINT, WRONG1, WRONG2, WRONG3]
// OUTPUT: HTML 
function fca_qc_render_personality_question( $question, $question_number ) {
	
	global $post;
	
	if ( empty ( $question ) ) {
		$question = array(
			'question' => '',
			'img' => '',
			'hint' => '',
			'answers' => '',
			'id' => '{{ID}}',
		);
	}
	
	$question['id'] = empty( $question['id'] ) ? '{{ID}}' : $question['id'];
	
	$results = get_post_meta ( $post->ID, 'quiz_cat_results', true );
	
	$results = empty ( $results ) ? array() : $results;
	$options = array();
	
	forEach ( $results as $result ) {
		$result['id'] = empty ( $result['id'] ) ? '{{ID}}' : $result['id'];
		$options[$result['id']] = $result['title'];
	}
	
	$html = "<div class='fca_qc_question_item fca_qc_personality_question_item fca_qc_deletable_item' id='fca_qc_question_$question_number'>";
		$html .= "<input class='fca_qc_id' value='" . $question['id'] . "' type='hidden' >";
		$html .= fca_qc_add_delete_button();
		$html .= "<h3 class='fca_qc_question_label'><span class='fca_qc_quiz_heading_question_number'>" . __('Question', 'quiz-cat') . ' ' . $question_number . ": </span><span class='fca_qc_quiz_heading_text'>". $question['question'] . "</span></h3>";
			$html .= "<div class='fca_qc_question_input_div'>";
				$html .= "<div class='fca_qc_question_header_div'>";
					$html .= "<table class='fca_qc_inner_setting_table'>";
						$html .= "<tr>";
							$html .= "<th>" . __('Image', 'quiz-cat') . "</th>";
							$html .= '<td>' . fca_qc_add_image_input( $question['img'], "" ) . '</td>';
						$html .= "</tr>";
						$html .= "<tr>";
							$html .= "<th>" . __('Description', 'quiz-cat') . "</th>";
							$html .= "<td><textarea placeholder='" . __('e.g. Do you like Catnip?', 'quiz-cat') . "' class='fca_qc_question_texta fca_qc_question_text' >" . $question['question']  ."</textarea></td>";
						$html .= "</tr>";
					$html .= "</table>";
				$html .= "</div>";
				
				$answers = empty ($question['answers']) ? array(array(),array()) : $question['answers'];
				$answer_number = 1;
				forEach ( $answers as $answer ) {
					$html .= fca_qc_render_personality_answer( $answer, $options, $question_number, $answer_number );
					$answer_number++;
				}
				
				$html .= "<a class='fca_qc_add_personality_answer_btn'>" . __('Add Answer', 'quiz-cat') ."</a>";
			$html .= "</div >";
	$html .= "</div >";
	
	return $html;

}

//RENDER THE ADD RESULT META BOX
function fca_qc_render_personality_add_result_meta_box( $post ) {
			
	$results = get_post_meta ( $post->ID, 'quiz_cat_results', true );
	
	echo "<p class='fca_qc_quiz_instructions'>" . __('First, set up your personalities.', 'quiz-cat') . "</p>";
	echo "<div class='fca_qc_personality_results'>";
		if ( empty ( $results ) ) {
			
			echo fca_qc_render_personality_result( array() );
			
		} else {
			
			forEach ( $results as $result ) {
				
				echo fca_qc_render_personality_result( $result );
							
			}		
		}
	echo "</div>";	
	echo "<button type='button' title='" . __( 'Add a new Personality Result', 'quiz-cat') . "'  id='fca_qc_add_personality_result_btn' class='button-secondary fca_qc_add_btn' ><span class='dashicons dashicons-plus' style='vertical-align: text-top;'></span>" . __('Add', 'quiz-cat') . "</button>";

}
// RENDER A PERSONALITY ANSWER
// INPUT: ARRAY->$ANSWER (ANSWER, IMG, ARRAY(RESULT) ), INT|STRING->$result_number
// OUTPUT: HTML 
function  fca_qc_render_personality_answer( $answer, $options, $question_number, $answer_number ) {

	$html = '';

	$answer['answer'] = empty ( $answer['answer'] ) ? '' : $answer['answer'];
	$answer['results'] = empty ( $answer['results'] ) ? array() : $answer['results'];
	$answer['img'] = empty ( $answer['img'] ) ? '' : $answer['img'];
	$answer['id'] = empty ( $answer['id'] ) ? '{{ID}}' : $answer['id'];
	
	$placeholder = $answer_number == 1 ? __('e.g. Yes', 'quiz-cat') :  __('e.g. No', 'quiz-cat');
	$html .= "<div class='fca_qc_answer_input_div fca_qc_deletable_item'>";
		$html .= "<input class='fca_qc_id' value='" . $answer['id'] . "' type='hidden' >";
		if ( $answer_number == 1 ) {
			$html .= "<h4>" . __('Answer', 'quiz-cat') . "</h4>";
		} else {
			$html .= "<h4>" . __('Answer', 'quiz-cat') . fca_qc_add_delete_button() . '</h4>';
		}
		$html .= "<table class='fca_qc_inner_setting_table'>";
			$html .= "<tr>";
				$html .= "<th>" . __('Image', 'quiz-cat') . "</th>";
				$html .= "<td>" . fca_qc_add_image_input( $answer['img'], "" ) . "</td>";
			$html .= "</tr>";
			$html .= "<tr>";
				$html .= "<th>" . __('Text', 'quiz-cat') . "</th>";
				$html .= "<td>" . "<textarea placeholder='$placeholder' class='fca_qc_question_texta fca_qc_personality_question_texta' >" . $answer['answer']  ."</textarea></td>";
			$html .= "</tr>";
			$html .= "<tr>";
				$html .= "<th>" . __('Personality', 'quiz-cat') . fca_qc_tooltip( __('Assign one (or more than one) personalities to this answer. At the end of the quiz, the personality with the most points will show on the results page.', 'quiz-cat') ) . "</th>";
				$html .= "<td>" . fca_qc_add_multiselect ( "", $options,  $answer['results'] ) . '</td>';
			$html .= "</tr>";
		$html .= "</table>";
	
	$html .= "</div>";	
	
	return $html;
}

// RENDER A RESULT META BOX
// INPUT: ARRAY->$result (TITLE, DESC, IMG), INT|STRING->$result_number
// OUTPUT: HTML
function fca_qc_render_personality_result( $result ) {
	
	if ( empty ( $result ) ) {
		$result = array(
			'title' => __('Grumpy Cat', 'quiz-cat'),
			'desc' => '',
			'img' => '',
			'id' => '{{ID}}',
			'url' => '',
			'tags' => '',
			'groups' => array()
		);
	}
	$result['id'] = empty ( $result['id'] ) ? '{{ID}}' : $result['id'];
	$result['url'] = empty ( $result['url'] ) ? '' : $result['url'];
	$result['tags'] = empty ( $result['tags'] ) ? '' : $result['tags'];
	$result['groups'] = empty ( $result['groups'] ) ? array() : $result['groups'];
	
	$html = "<div class='fca_qc_result_item fca_qc_personality_result_item fca_qc_deletable_item''>";
		$html .= "<input class='fca_qc_id' name='personality_result_id[]' value='" . $result['id'] . "' type='hidden' >";
		$html .= fca_qc_add_delete_button();
		$html .= "<h3 class='fca_qc_result_label'><span class='fca_qc_result_score_title'>" . $result['title'] . "</span></h3>";
		
		$html .= "<div class='fca_qc_result_input_div'>";
			$html .= "<table class='fca_qc_inner_setting_table'>";
				$html .= "<tr>";
					$html .= "<th>" . __('Result Title', 'quiz-cat') . "</th>";
					$html .= "<td><input placeholder='" . __('Title', 'quiz-cat') . "' type='text' class='fca_qc_text_input fca_qc_quiz_result fca_qc_personality_result_input' name='fca_qc_personality_quiz_result_title[]' value='" . htmlspecialchars( $result['title'], ENT_QUOTES ) . "'></input></td>";
				$html .= "</tr>";
				$html .= "<tr class='fca_qc_result_row_default'>";
					$html .= "<th>" . __('Image', 'quiz-cat') . "</th>";
					$html .= "<td>" . fca_qc_add_image_input( $result['img'], 'fca_qc_personality_quiz_result_image_src[]' ) . "</td>";
				$html .= "</tr>";
				$html .= "<tr class='fca_qc_result_row_default'>";
					$html .= "<th>" . __('Description', 'quiz-cat') . "</th>";
					$html .= "<td>" . fca_qc_add_wysiwyg( $result['desc'], 'fca_qc_personality_quiz_result_description[]' ) . "</td>";
				$html .= "</tr>";
				$html .= "<tr class='fca_qc_result_row_url'>";
					$html .= "<th>" . __('Redirect URL', 'quiz-cat') . "</th>";
					$html .= "<td><input type='url' placeholder='" . __('http://mycoolsite.com/grumpy-cat', 'quiz-cat') . "' class='fca_qc_url_input' name='fca_qc_personality_quiz_result_url[]' value='" . $result['url'] . "'></input></td>";
				$html .= "</tr>";
				
				if ( function_exists( 'fca_qc_add_tag_div' ) ) {
					$html .= fca_qc_add_tag_div( 'personality_results', $result['tags'] );
					
					$html .= "<tr class='fca_qc_mailchimp_api_settings'>";	
					
						$html .= "<th>";
							$html .= "<label class='fca_qc_admin_label fca_qc_admin_settings_label' for='fca_qc_personality_quiz_result_mailchimp_groups'>" . __('Interest Groups', 'quiz-cat') . fca_qc_tooltip( __("If you use MailChimp Groups opt-in feature, select one or more interest groups quiz takers should be added to.  Optional.", 'quiz-cat') ) ."</label>";
						$html .= "</th>";
							
						$html .= "<td style='line-height: normal;'>";
							$html .= "<span style='display: none;' class='fca_qc_icon dashicons dashicons-image-rotate fca_qc_spin'></span>";
							$html .= '<select style="width: 300px; border: 1px solid #ddd; border-radius: 0;" data-placeholder="&#8681; ' . __('Select Interest Groups (Optional)', 'quiz-cat') . ' &#8681;" class="fca_qc_multiselect fca_qc_mailchimp_groups" id="fca_qc_personality_quiz_result_mailchimp_groups" multiple="multiple" name="fca_qc_personality_quiz_result_mailchimp_groups[][]">';
								if ( !empty ( $result['groups'] ) ) {
									
									forEach ( $result['groups'] as $group ) {
										$html .= "<option value='$group' selected='selected' >" . __('Loading...', 'quiz-cat') . "</option>";
									}
									unset ( $group );
								}
							$html .= '</select>';
						$html .= "</td>";
					$html .= "</tr>";
				}
				
			$html .= "</table>";
		$html .= '</div>';
	$html .= "</div>";
	
	return $html;
	
}

function fca_qc_add_multiselect( $name, $options, $selected = array(), $hidden = false ) {

	$hidden = $hidden ? "fca_select2_hidden" : '';

	$html = "<select name='$name' data-placeholder='&#8681; " . __('Click to match answer to personality results', 'quiz-cat') . " &#8681;' multiple='multiple' style='width: 100%; border: 1px solid #ddd; border-radius: 0;' class='fca_qc_multiselect $hidden'>";
		forEach ( $options as $key => $value ) {
			if ( in_array($key, $selected) ) {
				$html .= "<option value='$key' selected='selected'>$value</option>";
			} else {
				$html .= "<option value='$key'>$value</option>";
			}
		}
	
	$html .= "</select>";
	
	return $html;
}

//RENDER THE QUIZ TYPE SELECT META BOX + INCLUDE PREMIUM ASSETS(?)
function fca_qc_render_quiz_type_meta_box( $post ) {
	
	$settings = get_post_meta ( $post->ID, 'quiz_cat_settings', true );
	$quiz_type = empty ( $settings['quiz_type'] ) ? '' : $settings['quiz_type'];
	
	wp_enqueue_script( 'fca_qc_select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js', array(), FCA_QC_PLUGIN_VER, true );
	wp_enqueue_style( 'fca_qc_select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css', array(), FCA_QC_PLUGIN_VER );
	
	wp_enqueue_style('wp-color-picker');
	wp_enqueue_script('wp-color-picker');
	
	$premium_dependencies = array( 'fca_qc_select2', 'fca_qc_admin_js', 'wp-color-picker', 'fca_qc_wysi_js_main', 'fca_qc_wysi_js', 'jquery','jquery-ui-core', 'jquery-ui-tooltip');
	
	if ( FCA_QC_DEBUG ) {
		wp_enqueue_script( 'fca_qc_admin_premium_js', FCA_QC_PLUGINS_URL . '/includes/premium/js/admin-premium.js', $premium_dependencies, FCA_QC_PLUGIN_VER, true );
		wp_enqueue_style( 'fca_qc_admin_premium_css', FCA_QC_PLUGINS_URL . '/includes/premium/css/admin-premium.css', array(), FCA_QC_PLUGIN_VER );
	} else {
		wp_enqueue_script( 'fca_qc_admin_premium_js', FCA_QC_PLUGINS_URL . '/includes/premium/js/admin-premium.min.js', $premium_dependencies, FCA_QC_PLUGIN_VER, true );
		wp_enqueue_style( 'fca_qc_admin_premium_css', FCA_QC_PLUGINS_URL . '/includes/premium/css/admin-premium.min.css', array(), FCA_QC_PLUGIN_VER );
	}
		
	$premium_data = array (
		//A TEMPLATE DIV OF THE QUESTION AND RESULT DIVS, SO WE CAN ADD MORE OF THEM VIA JAVASCRIPT
		'personalityQuestionDiv' => fca_qc_render_personality_question( array(), '{{QUESTION_NUMBER}}' ),
		'personalityResultDiv' 	=> 	fca_qc_render_personality_result( array() ),
		'personalityAnswerDiv' 	=> 	fca_qc_render_personality_answer( array(), array(), '{{QUESTION_NUMBER}}', '{{ANSWER_NUMBER}}' ),
		'quizType' => $quiz_type,
		'post_id' => $post->ID,
		'nonce' => wp_create_nonce('fca_qc_ajax_nonce'),
		'ajaxurl' => admin_url('admin-ajax.php'),
		'debug' => FCA_QC_DEBUG,
	); 

	wp_localize_script( 'fca_qc_admin_premium_js', 'premiumData', $premium_data ); 
	
	
	echo "<div id='fca-quiz-select'>";
		//ADD A HIDDEN QUIZ TYPE INPUT
		echo "<div id='fca-quiz-select-wrapper'>";
			echo "<input type='hidden' name='fca_qc_quiz_type' id='fca_qc_quiz_type' value='$quiz_type'>";
			echo '<h2>' . __( 'Choose your quiz type', 'quiz-cat' ) . '</h2>';
			
			echo "<div class='fca-quiz-select-option'>";
				echo '<h3>' . __( 'Test', 'quiz-cat' ) . '</h3>';
				echo '<p>' . __( "Test a person's knowledge.", 'quiz-cat' ) . '</br>';
				echo __( "Each question has one correct answer.", 'quiz-cat' ) . '</p>';
				echo "<p class='fca_qc_info_span'>" . __( "e.g.:", 'quiz-cat' ) . '<br>';
				echo __( "How much do you know about Star Wars?", 'quiz-cat' ) . '<br>';
				echo __( "Can you pass a U.S. citizenship test?", 'quiz-cat' ) . '</p>';
				echo "<button class='button-primary button fca-qc-quiz-select-btn' id='fca-quiz-select-multiplechoice' type='button'>" . __( "Build a Test", 'quiz-cat' ) . "</button>";
			echo "</div>";
			
			echo "<div class='fca-quiz-select-option'>";
				echo '<h3>' . __( 'Personality', 'quiz-cat' ) . '</h3>';
				echo '<p>' . __( "Determine a person's personality or preference.", 'quiz-cat' ) . '<br>';
				echo __( " There are no right or wrong answers.", 'quiz-cat' ) . '</p>';
				echo "<p class='fca_qc_info_span'>" . __( "e.g.:", 'quiz-cat' ) . '<br>';
				echo __( "Which Star Wars character are you?", 'quiz-cat' ) . '<br>';
				echo __( "Which WordPress host is right for you?", 'quiz-cat' ) . '</p>';
				echo "<button class='button-primary button fca-qc-quiz-select-btn' id='fca-quiz-select-personality' type='button'>" . __( "Build a Personality Quiz", 'quiz-cat' ) . "</button>";
			echo "</div>";
		echo "</div>";
	echo "</div>";
}

//SAVE POST (PERSONALITY / PREMIUM)
function fca_qc_save_personality_results( $post_id ) {
	
	$results = array();
		
	//SAVING RESULTS
	$n = empty ( $_POST['fca_qc_personality_quiz_result_title'] ) ? 0 : count ( $_POST['fca_qc_personality_quiz_result_title'] );
	
	for ( $i = 0; $i < $n ; $i++ ) {
		$results[$i]['title'] = empty ( $_POST['fca_qc_personality_quiz_result_title'][$i] ) ? '' : fca_qc_kses_html( $_POST['fca_qc_personality_quiz_result_title'][$i] );
		$results[$i]['desc'] = empty ( $_POST['fca_qc_personality_quiz_result_description'][$i] ) ? '' : fca_qc_kses_html( $_POST['fca_qc_personality_quiz_result_description'][$i] );
		$results[$i]['img'] = empty ( $_POST['fca_qc_personality_quiz_result_image_src'][$i] ) ? '' : fca_qc_sanitize_text( $_POST['fca_qc_personality_quiz_result_image_src'][$i] );
		$results[$i]['id'] = empty ( $_POST['personality_result_id'] ) ? -1 : fca_qc_sanitize_text( $_POST['personality_result_id'][$i] );
		$results[$i]['url'] = empty ( $_POST['fca_qc_personality_quiz_result_url'][$i] ) ? '' : fca_qc_sanitize_text( $_POST['fca_qc_personality_quiz_result_url'][$i] );
		$results[$i]['tags'] = empty ( $_POST['fca_qc_personality_results_tags'][$i] ) ? '' : fca_qc_sanitize_text( $_POST['fca_qc_personality_results_tags'][$i] );
		$results[$i]['groups'] = empty ( $_POST['fca_qc_personality_quiz_result_mailchimp_groups'][$i] ) ? array() : fca_qc_sanitize_text( $_POST['fca_qc_personality_quiz_result_mailchimp_groups'][$i] );

	}
	
	update_post_meta ( $post_id, 'quiz_cat_results', $results );

}

function fca_qc_save_appearance_settings ( $post_id ) {
	//SAVING SETTINGS
	$settings = array (
		'fca_qc_button_color'	=> 'button_color',
		'fca_qc_button_hover_color'	=> 'button_hover_color',
		'fca_qc_button_border_color'	=> 'button_border_color',
		'fca_qc_answer_hover_color'	=> 'answer_hover_color',
	);
	
	forEach ( $settings as $key => $value ) {
		$settings[$value] = empty ( $_POST[$key] ) ? '' : fca_qc_sanitize_text( $_POST[$key] );
	}
		
	update_post_meta ( $post_id, 'quiz_cat_appearance', $settings );

}

function fca_qc_save_quiz_settings_premium( $post_id ) {
	
	$settings = array();
	
	//SAVING SETTINGS
	$fields = array (
		'fca_qc_hide_answers_until_end'	=> 'hide_answers',
		'fca_qc_shuffle_question_order'	=> 'shuffle_questions',
		'fca_qc_show_restart_button'	=> 'restart_button',
		'fca_qc_enable_social_share'	=> 'show_sharing',
		'fca_qc_enable_facebook_share'	=> 'show_facebook',
		'fca_qc_enable_twitter_share'	=> 'show_twitter',
		'fca_qc_enable_pinterest_share'	=> 'show_pinterest',
		'fca_qc_enable_email_share'		=> 'show_email',
		'fca_qc_explanations'			=> 'explanations',
		'fca_qc_result_mode'			=> 'result_mode',		
		'fca_qc_quiz_type'				=> 'quiz_type',
	);

	
	forEach ( $fields as $key => $value ) {
		$settings[$value] = empty ( $_POST[$key] ) ? '' : fca_qc_sanitize_text( $_POST[$key] );
	}
		
	update_post_meta ( $post_id, 'quiz_cat_settings', $settings );
	
}

//SOCIAL MEDIA SHARING SETTINGS METABOX
function fca_qc_render_social_sharing_metabox( $post ) {
	
	global $pagenow;
	
	$settings = get_post_meta ( $post->ID, 'quiz_cat_settings', true );
	$show_sharing = empty ( $settings['show_sharing'] ) ? '' : "checked='checked'";
	$show_facebook = empty ( $settings['show_facebook'] ) ? '' : "checked='checked'";
	$show_twitter = empty ( $settings['show_twitter'] ) ? '' : "checked='checked'";
	$show_email = empty ( $settings['show_email'] ) ? '' : "checked='checked'";
	$show_pinterest = empty ( $settings['show_pinterest'] ) ? '' : "checked='checked'";

	//DEFAULT SOME THINGS ON IF ITS A NEW POST
	
	if ( $pagenow == 'post-new.php' ) {
		$show_sharing = $show_facebook = $show_twitter = $show_email = $show_pinterest = "checked='checked'";
	}
	
	echo "<p style='font-style:italic;'>" . __("Facebook recommends images at least 200x200 pixels in size, and file size smaller than 8 megabytes.", 'quiz-cat') . "</p>"; 

	echo "<table class='fca_qc_setting_table'>";
		echo "<tr>";
			echo "<th>";
				echo "<label class='fca_qc_admin_label fca_qc_admin_settings_label' for='fca_qc_enable_social_share'>" . __('Enable social sharing buttons', 'quiz-cat') . fca_qc_tooltip( __('Adds social sharing buttons to your results page', 'quiz-cat') ) . "</label>";
			echo "</th>";
			echo "<td>";
				echo "<div class='onoffswitch'>";
					echo "<input type='checkbox' class='onoffswitch-checkbox' id='fca_qc_enable_social_share' style='display:none;' name='fca_qc_enable_social_share' $show_sharing></input>";		
				echo "<label class='onoffswitch-label' for='fca_qc_enable_social_share'><span class='onoffswitch-inner'><span class='onoffswitch-switch'></span></span></label>";
				echo "</div>";
			echo "</td>";
		echo "</tr>";
		
		//FACEBOOK
		echo "<tr id='fca_qc_enable_facebook_wrap'>";
			echo "<th>";
				echo "<label class='fca_qc_admin_label fca_qc_admin_settings_label' for='fca_qc_enable_facebook_share'>" . __('Facebook', 'quiz-cat') . "</label>";
			echo "</th>";
			echo "<td>";
				echo "<div class='onoffswitch'>";
					echo "<input type='checkbox' class='onoffswitch-checkbox' id='fca_qc_enable_facebook_share' style='display:none;' name='fca_qc_enable_facebook_share' $show_facebook></input>";		
				echo "<label class='onoffswitch-label' for='fca_qc_enable_facebook_share'><span class='onoffswitch-inner'><span class='onoffswitch-switch'></span></span></label>";
				echo "</div>";
			echo "</td>";
		echo "</tr>";
		
		//TWITTER
		echo "<tr id='fca_qc_enable_twitter_wrap'>";
			echo "<th>";
				echo "<label class='fca_qc_admin_label fca_qc_admin_settings_label' for='fca_qc_enable_twitter_share'>" . __('Twitter', 'quiz-cat') . "</label>";
			echo "</th>";
			echo "<td>";
				echo "<div class='onoffswitch'>";
					echo "<input type='checkbox' class='onoffswitch-checkbox' id='fca_qc_enable_twitter_share' style='display:none;' name='fca_qc_enable_twitter_share' $show_twitter></input>";		
				echo "<label class='onoffswitch-label' for='fca_qc_enable_twitter_share'><span class='onoffswitch-inner'><span class='onoffswitch-switch'></span></span></label>";
				echo "</div>";
			echo "</td>";
		echo "</tr>";
			
		//PINTEREST
		echo "<tr id='fca_qc_enable_pinterest_wrap'>";
			echo "<th>";
				echo "<label class='fca_qc_admin_label fca_qc_admin_settings_label' for='fca_qc_enable_pinterest_share'>" . __('Pinterest', 'quiz-cat') . "</label>";
			echo "</th>";
			echo "<td>";
				echo "<div class='onoffswitch'>";
					echo "<input type='checkbox' class='onoffswitch-checkbox' id='fca_qc_enable_pinterest_share' style='display:none;' name='fca_qc_enable_pinterest_share' $show_pinterest></input>";		
				echo "<label class='onoffswitch-label' for='fca_qc_enable_pinterest_share'><span class='onoffswitch-inner'><span class='onoffswitch-switch'></span></span></label>";
				echo "</div>";
			echo "</td>";
		echo "</tr>";
		
		//EMAIL
		echo "<tr id='fca_qc_enable_email_wrap'>";
			echo "<th>";
				echo "<label class='fca_qc_admin_label fca_qc_admin_settings_label' for='fca_qc_enable_email_share'>" . __('Email', 'quiz-cat') . "</label>";
			echo "</th>";
			echo "<td>";
				echo "<div class='onoffswitch'>";
					echo "<input type='checkbox' class='onoffswitch-checkbox' id='fca_qc_enable_email_share' style='display:none;' name='fca_qc_enable_email_share' $show_email></input>";		
				echo "<label class='onoffswitch-label' for='fca_qc_enable_email_share'><span class='onoffswitch-inner'><span class='onoffswitch-switch'></span></span></label>";
				echo "</div>";
			echo "</td>";
		echo "</tr>";
	echo "</table>";	


}

function fca_qc_add_share_results( $text, $quiz_id, $quiz_text_strings ) {
	
	global $post;

	$quiz_settings = get_post_meta ( $quiz_id, 'quiz_cat_settings', true );
	
	$html = '';
	
	if ( !empty( $quiz_settings['show_sharing'] ) ) {
		
		$show_fb = empty ( $quiz_settings['show_facebook'] ) ? false : true;
		$show_twit = empty ( $quiz_settings['show_twitter'] ) ? false : true;
		$show_email = empty ( $quiz_settings['show_email'] ) ? false : true;
		$show_pin = empty ( $quiz_settings['show_pinterest'] ) ? false : true;
				
		if ( $show_fb OR $show_twit OR $show_email OR $show_pin ) {

			$post_meta = get_post_meta ( $quiz_id, 'quiz_cat_meta', true );
			$description = !empty ( $post_meta['desc'] ) ? $post_meta['desc'] : '';
			$post_url = get_permalink( $post );

			$share_string = fca_qc_share_string( $quiz_id, $quiz_text_strings );

			$pin_svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28"><path d="M14.02 1.57c-7.06 0-12.784 5.723-12.784 12.785S6.96 27.14 14.02 27.14c7.062 0 12.786-5.725 12.786-12.785 0-7.06-5.724-12.785-12.785-12.785zm1.24 17.085c-1.16-.09-1.648-.666-2.558-1.22-.5 2.627-1.113 5.146-2.925 6.46-.56-3.972.822-6.952 1.462-10.117-1.094-1.84.13-5.545 2.437-4.632 2.837 1.123-2.458 6.842 1.1 7.557 3.71.744 5.226-6.44 2.924-8.775-3.324-3.374-9.677-.077-8.896 4.754.19 1.178 1.408 1.538.49 3.168-2.13-.472-2.764-2.15-2.683-4.388.132-3.662 3.292-6.227 6.46-6.582 4.008-.448 7.772 1.474 8.29 5.24.58 4.254-1.815 8.864-6.1 8.532v.003z"></path></svg>';
			$fb_svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 29"><path d="M26.4 0H2.6C1.714 0 0 1.715 0 2.6v23.8c0 .884 1.715 2.6 2.6 2.6h12.393V17.988h-3.996v-3.98h3.997v-3.062c0-3.746 2.835-5.97 6.177-5.97 1.6 0 2.444.173 2.845.226v3.792H21.18c-1.817 0-2.156.9-2.156 2.168v2.847h5.045l-.66 3.978h-4.386V29H26.4c.884 0 2.6-1.716 2.6-2.6V2.6c0-.885-1.716-2.6-2.6-2.6z"/></svg>';
			$twitter_svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28"><path d="M24.253 8.756C24.69 17.08 18.297 24.182 9.97 24.62a15.093 15.093 0 0 1-8.86-2.32c2.702.18 5.375-.648 7.507-2.32a5.417 5.417 0 0 1-4.49-3.64c.802.13 1.62.077 2.4-.154a5.416 5.416 0 0 1-4.412-5.11 5.43 5.43 0 0 0 2.168.387A5.416 5.416 0 0 1 2.89 4.498a15.09 15.09 0 0 0 10.913 5.573 5.185 5.185 0 0 1 3.434-6.48 5.18 5.18 0 0 1 5.546 1.682 9.076 9.076 0 0 0 3.33-1.317 5.038 5.038 0 0 1-2.4 2.942 9.068 9.068 0 0 0 3.02-.85 5.05 5.05 0 0 1-2.48 2.71z"/></svg>';
			$email_svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28"><path d="M20.11 26.147c-2.335 1.05-4.36 1.4-7.124 1.4C6.524 27.548.84 22.916.84 15.284.84 7.343 6.602.45 15.4.45c6.854 0 11.8 4.7 11.8 11.252 0 5.684-3.193 9.265-7.398 9.3-1.83 0-3.153-.934-3.347-2.997h-.077c-1.208 1.986-2.96 2.997-5.023 2.997-2.532 0-4.36-1.868-4.36-5.062 0-4.75 3.503-9.07 9.11-9.07 1.713 0 3.7.4 4.6.972l-1.17 7.203c-.387 2.298-.115 3.3 1 3.4 1.674 0 3.774-2.102 3.774-6.58 0-5.06-3.27-8.994-9.304-8.994C9.05 2.87 3.83 7.545 3.83 14.97c0 6.5 4.2 10.2 10 10.202 1.987 0 4.09-.43 5.647-1.245l.634 2.22zM16.647 10.1c-.31-.078-.7-.155-1.207-.155-2.572 0-4.596 2.53-4.596 5.53 0 1.5.7 2.4 1.9 2.4 1.44 0 2.96-1.83 3.31-4.088l.592-3.72z"/></svg>';

			$html .= "<div class='fca_qc_social_share' style='display:none;'>";
				
				$html .= "<h3>" . $quiz_text_strings['share_results'] . "</h3>";
				
				if ( $show_fb ) {
					$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
					$u  = urlencode ( add_query_arg( 'fca_qc_result', "$quiz_id-", $url ) );

					$html .= "<a class='fca_qc_share_link' id='fca_qc_share_link_facebook' href='https://www.facebook.com/sharer/sharer.php?u=$u' target='_blank'>";
					$html .= "$fb_svg<span class='fca_qc_share_name'>" . $quiz_text_strings['share'] . "</span>";
					$html .= "</a>";
				}
				
				if ( $show_twit ) {
					$html .= "<a class='fca_qc_share_link' id='fca_qc_share_link_twitter' data-sharestring='$share_string' href='https://twitter.com/intent/tweet?url=$post_url&text=' target='_blank'>";
					$html .= "$twitter_svg<span class='fca_qc_share_name'>" . $quiz_text_strings['tweet'] . "</span>";
					$html .= "</a>";
				}
				
				if ( $show_pin ) {
					$html .= "<a class='fca_qc_share_link' id='fca_qc_share_link_pinterest' data-sharestring='$share_string' href='http://pinterest.com/pin/create/button/?url=$post_url&description=' target='_blank'>";
					$html .= "$pin_svg<span class='fca_qc_share_name'>" . $quiz_text_strings['pin'] . "</span>";
					$html .= "</a>";
				}

				if ( $show_email ) {
					$html .= "<a class='fca_qc_share_link' id='fca_qc_share_link_email' data-sharestring='$share_string' href='mailto:example@example.com?body=$post_url&subject=' target='_blank'>";
					$html .= "$email_svg<span class='fca_qc_share_name'>" . $quiz_text_strings['email'] . "</span>";
					$html .= "</a>";
				}
							
			$html .= "</div>";
		}
	} 
	
	return $text . $html;
}

add_filter( 'fca_qc_result_filter', 'fca_qc_add_share_results', 10, 3);

function fca_qc_answer_mode_toggle( $mode ) {
	
	//convert free settings to premium
	if ( empty( $mode ) ) {
		$mode = 'after';
	} else if ( $mode == 'on' ) {
		$mode = 'end';
	}
	
	$toggles = array(
		array(
			'id' => 'after',
			'name' => __( 'After Question', 'quiz-cat' ),
		),
		array(
			'id' => 'end',
			'name' => __( 'End of Quiz', 'quiz-cat' ),
		),
		array(
			'id' => 'hide',
			'name' => __( 'Never', 'quiz-cat' ),
		)
	);
	
	echo "<th>";
		echo "<label class='fca_qc_admin_label fca_qc_admin_settings_label' for='fca_qc_hide_answers_until_end'>" . __('Show correct answer', 'quiz-cat') . "</label>";
	echo "</th>";
	echo "<td>";
	echo "<div class='radio-toggle'>";
		
		forEach ( $toggles as $toggle ) {
			if ( $toggle['id'] == $mode ) {
				echo "<label class='selected'>";
				echo $toggle['name'];
				echo '<input class="qc_radio_input" name="fca_qc_hide_answers_until_end" type="radio" value="'.$toggle['id'].'" checked /></label>';
			} else {
				echo "<label>";
				echo $toggle['name'];
				echo '<input class="qc_radio_input" name="fca_qc_hide_answers_until_end" type="radio" value="'.$toggle['id'].'" /></label>';
			}
		}
	echo "</div>";
	
}

//RESULTS HOOK (ADD FACEBOOK OPEN GRAPH TAGS)
function fca_qc_results_hook() {

	if ( isSet( $_GET['fca_qc_result'] ) ) {
		$parts = explode( '-', sanitize_text_field( $_GET['fca_qc_result'] ), 2 );
		$post_id = isSet( $parts[0] ) ? intVal( $parts[0] ) : false;
		$result_id = isSet( $parts[1] ) ? intVal( $parts[1] ) : false;
		$quiz_results = get_post_meta( $post_id, 'quiz_cat_results', true );
		$quiz_meta = get_post_meta( $post_id, 'quiz_cat_meta', true );
		$image = !empty ( $quiz_meta['desc_img_src'] ) ? $quiz_meta['desc_img_src'] : FCA_QC_PLUGINS_URL . '/assets/quizcat-240x240.png';
		$desc = isSet ( $quiz_meta['desc'] ) ? $quiz_meta['desc'] : '';
		$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$title = isSet ( $_GET['fca_qc_title'] ) ? fca_qc_share_string( $post_id, '', sanitize_text_field( $_GET['fca_qc_title'] ) ) : fca_qc_share_string( $post_id, '' );

		if ( isSet( $quiz_results[ $result_id ] ) ) {
			$image = !empty( $quiz_results[ $result_id ]['img'] ) ? $quiz_results[ $result_id ]['img'] : $image;
			$desc = !empty( $quiz_results[ $result_id ]['desc'] ) ? $quiz_results[ $result_id ]['desc'] : $desc;
			$title = !empty( $quiz_results[ $result_id ]['title'] ) ? fca_qc_share_string ( $post_id, '',  $quiz_results[ $result_id ]['title'] ) : $title;
			$url = add_query_arg( 'fca_qc_result', "$post_id-$result_id", $url );
		}
		
		ob_start();?>
		<meta property="og:url" content="<?php echo $url ?>" />
		<meta property="fb:app_id" content="860704900727407" />
		<meta property="og:type" content="website" /> 
		<meta property="og:title" content="<?php echo htmlentities( strip_tags( $title ) ) ?>" />
		<meta property="og:description" content="<?php echo htmlentities( strip_tags( $desc ) ) ?>" />
		<meta property="og:image" content="<?php echo $image ?>" />
		<?php echo ob_get_clean();
			
	}
}	
add_action( 'wp_head', 'fca_qc_results_hook', 1 );