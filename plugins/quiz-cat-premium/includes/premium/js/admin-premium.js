/* jshint asi: true */
jQuery(document).ready(function($){
	
	$('#editor-nav').click()
	//SET META BOXES BASED ON POST TYPE
	if ( premiumData.quizType == 'pt' ) {
		$('#fca_qc_quiz_type_meta_box').hide()
		$('#fca_qc_questions_meta_box, #fca_qc_add_result_meta_box').hide()
		$('#fca_qc_answer_mode_tr').hide()
		$('#fca_qc_add_personality_result_meta_box, #fca_qc_personality_questions_meta_box').show()
		$('#fca_qc_hints_toggle_tr').hide()
	} else if ( premiumData.quizType == 'mc' )  {
		$('#fca_qc_quiz_type_meta_box').hide()
		$('#fca_qc_add_personality_result_meta_box, #fca_qc_personality_questions_meta_box').hide()
		$('#fca_qc_questions_meta_box, #fca_qc_add_result_meta_box').show()
		$('#fca_qc_answer_mode_tr').show()
		$('#fca_qc_hints_toggle_tr').show()
		
	} else {
		$('#fca_qc_quiz_type_meta_box').show()
	}

	
	//ADD SELECT2
	fca_qc_add_select2( $('.fca_qc_multiselect') )
	
	//ADD COLORPICKERS
	$('.fca_qc_colorpicker').wpColorPicker()
	
	//SET RESULTS?
	setResultIDs()
	
	////////////////
	// ON CLICK EVENT HANDLERS
	////////////////
	
	add_result_personality_result_text_handlers()
	attach_add_answer_button_handlers()
	
	var question_number = $( '.fca_qc_personality_question_item' ).length
	var result_number = $('.fca_qc_personality_result_item ').length
	
	//THE ADD QUESTION BUTTON
	$( '#fca_qc_add_personality_question_btn' ).click(function() {
		
		question_number = question_number + 1
		$( '.fca_qc_question_input_div' ).hide()
		var div_to_append = premiumData.personalityQuestionDiv.replace(/{{QUESTION_NUMBER}}/g, question_number)
		div_to_append = div_to_append.replace(/{{ID}}/g, fca_qc_new_GUID() )
		$(this).siblings( '.fca_qc_sortable_questions' ).append(div_to_append)
		
		add_drag_and_drop_sort()
		add_question_heading_text_handlers()
		add_question_and_result_click_toggles()
		attach_delete_button_handlers()
		attach_add_answer_button_handlers()
		attach_image_upload_handlers()
		fca_qc_add_select2( $('.fca_qc_multiselect') )
		add_result_personality_result_text_handlers()
		setQuestionNumbers( $(this).siblings( '.fca_qc_sortable_questions' ) )
	})
	
	//THE ADD RESULT BUTTON
	$( '#fca_qc_add_personality_result_btn' ).click(function() {
		
		result_number = result_number + 1
		$( '.fca_qc_result_input_div' ).hide()
		var div_to_append = premiumData.personalityResultDiv.replace('{{RESULT_NUMBER}}', result_number )
		div_to_append = div_to_append.replace(/{{RESULT_NUMBER}}/g, result_number )
		div_to_append = div_to_append.replace(/{{ID}}/g, fca_qc_new_GUID() )
		
		$(this).siblings('.fca_qc_personality_results').append(div_to_append)
		
		fca_attach_wysiwyg()
		add_drag_and_drop_sort()
		add_result_heading_text_handlers()
		add_question_and_result_click_toggles()
		attach_delete_button_handlers()
		attach_image_upload_handlers()
		add_result_personality_result_text_handlers()
		add_tag_handlers()
		fca_qc_add_select2( $('.fca_qc_multiselect') )
		$('.fca_qc_result_mode_input').trigger('input')
		set_result_tag_visibility()
		$('#fca_qc_mailing_list').change()
	})
	
	//THE ADD ANSWER BUTTON
	function attach_add_answer_button_handlers() {
		var $ = jQuery
		$('.fca_qc_add_personality_answer_btn').unbind( 'click' )
		
		//THE ADD ANSWER BUTTON
		$( '.fca_qc_add_personality_answer_btn' ).click(function() {
			
			var answer_number = $(this).siblings('.fca_qc_answer_input_div').length + 1
			
			var question_number = $(this).closest('.fca_qc_question_item').attr('id').replace(/[^0-9.]/g, "")
		
			var div_to_append = premiumData.personalityAnswerDiv.replace(/{{ANSWER_NUMBER}}/g, answer_number )
			div_to_append = div_to_append.replace(/{{QUESTION_NUMBER}}/g, question_number )
			div_to_append = div_to_append.replace(/{{ID}}/g, fca_qc_new_GUID() )
			
			$(this).before(div_to_append)
			attach_delete_button_handlers()
			add_result_personality_result_text_handlers()
			attach_image_upload_handlers()
			fca_qc_add_select2( $('.fca_qc_multiselect') )
		})
	}
	
	//SOCIAL SHARING SWITCH
	$( '#fca_qc_enable_social_share' ).change(function() {
		if ( this.checked ) {
			$('#fca_qc_enable_facebook_wrap, #fca_qc_enable_twitter_wrap, #fca_qc_enable_email_wrap, #fca_qc_enable_pinterest_wrap').show('fast')
			$('#fca_qc_enable_facebook_share, #fca_qc_enable_twitter_share, #fca_qc_enable_email_share, #fca_qc_enable_pinterest_share').prop( 'checked', true ) 
		} else {
			$('#fca_qc_enable_facebook_share, #fca_qc_enable_twitter_share, #fca_qc_enable_email_share, #fca_qc_enable_pinterest_share').prop( 'checked', false )
			$('#fca_qc_enable_facebook_wrap, #fca_qc_enable_twitter_wrap, #fca_qc_enable_email_wrap, #fca_qc_enable_pinterest_wrap').hide('fast')			
		}		
	})
	
	if ( $( '#fca_qc_enable_social_share' ).is(':checked') ) {
		$('#fca_qc_enable_facebook_wrap, #fca_qc_enable_twitter_wrap, #fca_qc_enable_email_wrap, #fca_qc_enable_pinterest_wrap').show('fast')
	} else {
		$('#fca_qc_enable_facebook_wrap, #fca_qc_enable_twitter_wrap, #fca_qc_enable_email_wrap, #fca_qc_enable_pinterest_wrap').hide('fast')		
	}
	
		
	//THE SELECT QUIZ SCREEN BUTTONS
	$('#fca-quiz-select-multiplechoice').click(function(e){
		$('#fca_qc_quiz_type').val('mc')
		$('#fca_qc_quiz_type_meta_box').hide()
		$('#fca_qc_add_personality_result_meta_box, #fca_qc_personality_questions_meta_box').hide()
		$('#fca_qc_answer_mode_tr').show()
		$('#fca_qc_questions_meta_box, #fca_qc_add_result_meta_box').show()
		$('#fca_qc_hints_toggle_tr').show()
	})

	$('#fca-quiz-select-personality').click(function(e){
		$('#fca_qc_quiz_type').val('pt')
		$('#fca_qc_quiz_type_meta_box').hide()
		$('#fca_qc_questions_meta_box, #fca_qc_add_result_meta_box').hide()
		$('#fca_qc_answer_mode_tr').hide()
		$('#fca_qc_add_personality_result_meta_box, #fca_qc_personality_questions_meta_box').show()
		$('#fca_qc_hints_toggle_tr').hide()
	})
	
	//MAILCHIMP API CHANGE EVENT
	$('#fca_qc_api_key').bind('input', function(e){
		var $this_button = $(this)
		var api_key = $this_button.val()
		var delivery_center =  api_key.split('-')
		var provider = $('#fca_qc_provider').val()
				
		if ( api_key !== '' && delivery_center[1] && provider == 'mailchimp' && $( '#fca_qc_capture_emails:checked' ).length == 1 ) {
			//might be valid API key, lets check
			$this_button.siblings('.fca_qc_icon').removeClass('dashicons-no dashicons-yes')
			$this_button.siblings('.fca_qc_icon').addClass('dashicons-image-rotate fca_qc_spin')
			$this_button.siblings('.fca_qc_icon').css('display', 'inline-block')
			
			$.ajax({
					url: premiumData.ajaxurl,
					type: 'POST',
					data: {
						api_key: api_key,
						nonce: premiumData.nonce,
						post_id: premiumData.post_id,
						action: 'fca_qc_get_mailchimp_lists'
					}
				}).done( function( returnedData ) {

					$this_button.siblings('.fca_qc_icon').removeClass('dashicons-image-rotate fca_qc_spin')
										
					if ( returnedData && $('#fca_qc_provider').val() == 'mailchimp') {
						$this_button.siblings('.fca_qc_icon').addClass('dashicons-yes')
						$this_button.data('validated', 1)
						$('.fca_qc_mailchimp_api_settings').show('fast')
						update_lists( returnedData, $('#fca_qc_mailing_list') )
						//update groups list
						$('#fca_qc_mailing_list').change()

					} else {
						$this_button.siblings('.fca_qc_icon').addClass('dashicons-no')
						$this_button.data('validated', 0)
						$('.fca_qc_mailchimp_api_settings').hide()
					}
					set_result_tag_visibility()
				})
			
		} else {
			$(this).siblings('.fca_qc_icon').removeClass('dashicons-image-rotate fca_qc_spin dashicons-yes')
			$(this).siblings('.fca_qc_icon').addClass('dashicons-no')
			$(this).siblings('.fca_qc_icon').show()
		}
	}).trigger('input')
	
	//MADMIMI API CHANGE EVENT
	$('#fca_qc_madmimi_key').bind('input', function(e){
		var $this_button = $(this)
		var api_key = $this_button.val()
		var email = $('#fca_qc_madmimi_email').val()
		var provider = $('#fca_qc_provider').val()
			
		if ( email && api_key !== '' && provider == 'madmimi' && $( '#fca_qc_capture_emails:checked' ).length == 1 ) {
			//might be valid API key, lets check
			$this_button.siblings('.fca_qc_icon').removeClass('dashicons-no dashicons-yes')
			$this_button.siblings('.fca_qc_icon').addClass('dashicons-image-rotate fca_qc_spin')
			$this_button.siblings('.fca_qc_icon').css('display', 'inline-block')
			
			$.ajax({
					url: premiumData.ajaxurl,
					type: 'POST',
					data: {
						api_key: api_key,
						email: email,
						nonce: premiumData.nonce,
						post_id: premiumData.post_id,
						action: 'fca_qc_get_madmimi_lists'
					}
				}).done( function( returnedData ) {

					$this_button.siblings('.fca_qc_icon').removeClass('dashicons-image-rotate fca_qc_spin')
										
					if ( returnedData && $('#fca_qc_provider').val() == 'madmimi') {
						$this_button.siblings('.fca_qc_icon').addClass('dashicons-yes')
						$this_button.data('validated', 1)
						$('.fca_qc_madmimi_api_settings').show('fast')
						update_lists( returnedData, $('#fca_qc_madmimi_mailing_list') )
					} else {
						$this_button.siblings('.fca_qc_icon').addClass('dashicons-no')
						$this_button.data('validated', 0)
						$('.fca_qc_madmimi_api_settings').hide()
					}
					set_result_tag_visibility()
				})
			
		} else {
			$(this).siblings('.fca_qc_icon').removeClass('dashicons-image-rotate fca_qc_spin dashicons-yes')
			$(this).siblings('.fca_qc_icon').addClass('dashicons-no')
			$(this).siblings('.fca_qc_icon').show()
		}
	}).trigger('input')
	
	//CAMPAIGNMONITOR API CHANGE EVENT
	$('#fca_qc_campaignmonitor_key').bind('input', function(e){
		var $this_button = $(this)
		var api_key = $this_button.val()
		var client_id = $('#fca_qc_campaignmonitor_id').val()
		var provider = $('#fca_qc_provider').val()
			
		if ( client_id && api_key !== '' && provider == 'campaignmonitor' && $( '#fca_qc_capture_emails:checked' ).length == 1 ) {
			//might be valid API key, lets check
			$this_button.siblings('.fca_qc_icon').removeClass('dashicons-no dashicons-yes')
			$this_button.siblings('.fca_qc_icon').addClass('dashicons-image-rotate fca_qc_spin')
			$this_button.siblings('.fca_qc_icon').css('display', 'inline-block')
			
			$.ajax({
					url: premiumData.ajaxurl,
					type: 'POST',
					data: {
						'api_key': api_key,
						'client_id': client_id,
						'nonce': premiumData.nonce,
						'post_id': premiumData.post_id,
						'action': 'fca_qc_get_campaignmonitor_lists'
					}
				}).done( function( returnedData ) {

					$this_button.siblings('.fca_qc_icon').removeClass('dashicons-image-rotate fca_qc_spin')
										
					if ( returnedData && $('#fca_qc_provider').val() == 'campaignmonitor') {
						$this_button.siblings('.fca_qc_icon').addClass('dashicons-yes')
						$this_button.data('validated', 1)
						$('.fca_qc_campaignmonitor_api_settings').show('fast')
						update_lists( returnedData, $('#fca_qc_campaignmonitor_mailing_list') )
					} else {
						$this_button.siblings('.fca_qc_icon').addClass('dashicons-no')
						$this_button.data('validated', 0)
						$('.fca_qc_campaignmonitor_api_settings').hide()
					}
					set_result_tag_visibility()
				})
			
		} else {
			$(this).siblings('.fca_qc_icon').removeClass('dashicons-image-rotate fca_qc_spin dashicons-yes')
			$(this).siblings('.fca_qc_icon').addClass('dashicons-no')
			$(this).siblings('.fca_qc_icon').show()
		}
	}).trigger('input')	
	
	//CONVERTKIT API CHANGE EVENT
	$('#fca_qc_convertkit_key').bind('input', function(e){
		var $this_button = $(this)
		var api_key = $this_button.val()
		var provider = $('#fca_qc_provider').val()
			
		if ( api_key !== '' && provider == 'convertkit' && $( '#fca_qc_capture_emails:checked' ).length == 1 ) {
			//might be valid API key, lets check
			$this_button.siblings('.fca_qc_icon').removeClass('dashicons-no dashicons-yes')
			$this_button.siblings('.fca_qc_icon').addClass('dashicons-image-rotate fca_qc_spin')
			$this_button.siblings('.fca_qc_icon').css('display', 'inline-block')
			
			$.ajax({
					url: premiumData.ajaxurl,
					type: 'POST',
					data: {
						'api_key': api_key,
						'nonce': premiumData.nonce,
						'post_id': premiumData.post_id,
						'action': 'fca_qc_get_convertkit_lists'
					}
				}).done( function( returnedData ) {

					$this_button.siblings('.fca_qc_icon').removeClass('dashicons-image-rotate fca_qc_spin')
										
					if ( returnedData && $('#fca_qc_provider').val() == 'convertkit') {
						$this_button.siblings('.fca_qc_icon').addClass('dashicons-yes')
						$this_button.data('validated', 1)
						$('.fca_qc_convertkit_api_settings').show('fast')
						update_lists( returnedData, $('#fca_qc_convertkit_mailing_list') )
					} else {
						$this_button.siblings('.fca_qc_icon').addClass('dashicons-no')
						$this_button.data('validated', 0)
						$('.fca_qc_convertkit_api_settings').hide()
					}
					set_result_tag_visibility()
				})
			
		} else {
			$(this).siblings('.fca_qc_icon').removeClass('dashicons-image-rotate fca_qc_spin dashicons-yes')
			$(this).siblings('.fca_qc_icon').addClass('dashicons-no')
			$(this).siblings('.fca_qc_icon').show()
		}
	}).trigger('input')
	
	//GETRESPONSE API CHANGE EVENT
	$('#fca_qc_getresponse_key').bind('input', function(e){
		var $this_button = $(this)
		var api_key = $this_button.val()
		var provider =  $('#fca_qc_provider').val()
				
		if ( api_key !== '' && provider == 'getresponse' && $( '#fca_qc_capture_emails:checked' ).length == 1 ) {
			//might be valid API key, lets check
			$this_button.siblings('.fca_qc_icon').removeClass('dashicons-no dashicons-yes')
			$this_button.siblings('.fca_qc_icon').addClass('dashicons-image-rotate fca_qc_spin')
			$this_button.siblings('.fca_qc_icon').css('display', 'inline-block')
			
			$.ajax({
					url: premiumData.ajaxurl,
					type: 'POST',
					data: {
						api_key: api_key,
						nonce: premiumData.nonce,
						post_id: premiumData.post_id,
						action: 'fca_qc_get_getresponse_lists'
					}
				}).done( function( returnedData ) {

					$this_button.siblings('.fca_qc_icon').removeClass('dashicons-image-rotate fca_qc_spin')
										
					if ( returnedData && $('#fca_qc_provider').val() == 'getresponse' ) {
						$this_button.siblings('.fca_qc_icon').addClass('dashicons-yes')
						$this_button.data('validated', 1)
						$('.fca_qc_getresponse_api_settings').show('fast')
						update_lists( returnedData, $('#fca_qc_getresponse_mailing_list') )
					} else {
						$this_button.siblings('.fca_qc_icon').addClass('dashicons-no')
						$this_button.data('validated', 0)
						$('.fca_qc_getresponse_api_settings').hide()
					}
					set_result_tag_visibility()
				})
			
		} else {
			$(this).siblings('.fca_qc_icon').removeClass('dashicons-image-rotate fca_qc_spin dashicons-yes')
			$(this).siblings('.fca_qc_icon').addClass('dashicons-no')
			$(this).siblings('.fca_qc_icon').show()
		}
	}).trigger('input')
	
	//AWEBER API CHANGE EVENT
	$('#fca_qc_aweber_key').bind('input', function(e){
		var $this_button = $(this)
		var api_key = $this_button.val()
		var provider =  $('#fca_qc_provider').val()
				
		if ( api_key !== '' && provider == 'aweber' && $( '#fca_qc_capture_emails:checked' ).length == 1 ) {
			//might be valid API key, lets check
			$this_button.siblings('.fca_qc_icon').removeClass('dashicons-no dashicons-yes')
			$this_button.siblings('.fca_qc_icon').addClass('dashicons-image-rotate fca_qc_spin')
			$this_button.siblings('.fca_qc_icon').css('display', 'inline-block')
			
			$.ajax({
					url: premiumData.ajaxurl,
					type: 'POST',
					data: {
						api_key: api_key,
						nonce: premiumData.nonce,
						post_id: premiumData.post_id,
						action: 'fca_qc_get_aweber_lists'
					}
				}).done( function( returnedData ) {

					$this_button.siblings('.fca_qc_icon').removeClass('dashicons-image-rotate fca_qc_spin')
										
					if ( returnedData && $('#fca_qc_provider').val() == 'aweber' ) {
						$this_button.siblings('.fca_qc_icon').addClass('dashicons-yes')
						$this_button.data('validated', 1)
						$('.fca_qc_aweber_api_settings').show('fast')
						update_lists( returnedData, $('#fca_qc_aweber_mailing_list') )
					} else {
						$this_button.siblings('.fca_qc_icon').addClass('dashicons-no')
						$this_button.data('validated', 0)
						$('.fca_qc_aweber_api_settings').hide()
					}
					set_result_tag_visibility()
				})
			
		} else {
			$(this).siblings('.fca_qc_icon').removeClass('dashicons-image-rotate fca_qc_spin dashicons-yes')
			$(this).siblings('.fca_qc_icon').addClass('dashicons-no')
			$(this).siblings('.fca_qc_icon').show()
		}
	}).trigger('input')
	
	//ACTIVECAMPAIGN API CHANGE EVENT
	$('#fca_qc_activecampaign_key').bind('input', function(e){
		var $this_button = $(this)
		var api_url = $('#fca_qc_activecampaign_url').val()
		var api_key = $this_button.val()
		var provider =  $('#fca_qc_provider').val()
				
		if ( api_key !== '' && provider == 'activecampaign' && $( '#fca_qc_capture_emails:checked' ).length == 1 ) {
			//might be valid API key, lets check
			$this_button.siblings('.fca_qc_icon').removeClass('dashicons-no dashicons-yes')
			$this_button.siblings('.fca_qc_icon').addClass('dashicons-image-rotate fca_qc_spin')
			$this_button.siblings('.fca_qc_icon').css('display', 'inline-block')
			
			$.ajax({
					url: premiumData.ajaxurl,
					type: 'POST',
					data: {
						api_url: api_url,
						api_key: api_key,
						nonce: premiumData.nonce,
						post_id: premiumData.post_id,
						action: 'fca_qc_get_activecampaign_lists'
					}
				}).done( function( returnedData ) {

					$this_button.siblings('.fca_qc_icon').removeClass('dashicons-image-rotate fca_qc_spin')
										
					if ( returnedData && $('#fca_qc_provider').val() == 'activecampaign' ) {
						$this_button.siblings('.fca_qc_icon').addClass('dashicons-yes')
						$this_button.data('validated', 1)
						$('.fca_qc_activecampaign_api_settings').show('fast')
						update_lists( returnedData, $('#fca_qc_activecampaign_mailing_list') )
					} else {
						$this_button.siblings('.fca_qc_icon').addClass('dashicons-no')
						$this_button.data('validated', 0)
						$('.fca_qc_activecampaign_api_settings').hide()
					}
					set_result_tag_visibility()
				})
			
		} else {
			$(this).siblings('.fca_qc_icon').removeClass('dashicons-image-rotate fca_qc_spin dashicons-yes')
			$(this).siblings('.fca_qc_icon').addClass('dashicons-no')
			$(this).siblings('.fca_qc_icon').show()
		}
	}).trigger('input')
	
	//DRIP API CHANGE EVENT
	$('#fca_qc_drip_key').bind('input', function(e){
		var $this_button = $(this)
		var client_id = $('#fca_qc_drip_id').val()
		var api_key = $this_button.val()
		var provider =  $('#fca_qc_provider').val()
		
		if ( api_key !== '' && provider == 'drip' && $( '#fca_qc_capture_emails:checked' ).length == 1 ) {
			//might be valid API key, lets check
			$this_button.siblings('.fca_qc_icon').removeClass('dashicons-no dashicons-yes')
			$this_button.siblings('.fca_qc_icon').addClass('dashicons-image-rotate fca_qc_spin')
			$this_button.siblings('.fca_qc_icon').css('display', 'inline-block')
			
			$.ajax({
					url: premiumData.ajaxurl,
					type: 'POST',
					data: {
						client_id: client_id,
						api_key: api_key,
						nonce: premiumData.nonce,
						post_id: premiumData.post_id,
						action: 'fca_qc_get_drip_lists'
					}
				}).done( function( returnedData ) {
					
					
					$this_button.siblings('.fca_qc_icon').removeClass('dashicons-image-rotate fca_qc_spin')
										
					if ( returnedData && $('#fca_qc_provider').val() == 'drip' ) {
						$this_button.siblings('.fca_qc_icon').addClass('dashicons-yes')
						$this_button.data('validated', 1)
						$('.fca_qc_drip_api_settings').show('fast')
						update_lists( returnedData, $('#fca_qc_drip_mailing_list') )
					} else {
						$this_button.siblings('.fca_qc_icon').addClass('dashicons-no')
						$('.fca_qc_drip_api_settings').hide()
					}
					set_result_tag_visibility()
				})
			
		} else {
			$(this).siblings('.fca_qc_icon').removeClass('dashicons-image-rotate fca_qc_spin dashicons-yes')
			$(this).siblings('.fca_qc_icon').addClass('dashicons-no')
			$(this).siblings('.fca_qc_icon').show()
		}
	}).trigger('input')
	
	//TAGS
	function create_tag( name, $target ) {
		if ( typeof (name) === 'string' && name ) {
			var html = '<span class="fca-qc-tag-wrapper"><span class="dashicons dashicons-dismiss fca-qc-tag-delete"></span><span class="fca-qc-tag">' + name.trim() + '</span></span>'
			$target.siblings('.tag-div').append( html )
			add_delete_tag_handlers()
		}
	}
	
	function update_tags_hidden_input() { 
		$('.fca_qc_tag_hidden_input').each(function( index, el ){
			var tagList = ''
			$(el).siblings('.tag-div').find('.fca-qc-tag').each(function(){
				tagList += $(this).html() + ', '
			})
			$(this).val(tagList.slice(0, tagList.length - 2))
		})
	}
	
	function add_delete_tag_handlers() {
		$('.fca-qc-tag-delete').unbind('click')
		$('.fca-qc-tag-delete').click(function(){
			$(this.parentNode).remove()
			update_tags_hidden_input()
		})
	}	
	
	function load_tags() {
		$('.fca_qc_tag_hidden_input').each(function(){
			var tags = $(this).val().split(', ')
			for (var i = 0, len = tags.length; i < len; i++) {
				create_tag(tags[i], $(this) )
			}
		})
	}
	load_tags()
	
	//THE ADD RESULT BUTTON
	$( '#fca_qc_add_result_btn' ).click(function() {
		add_tag_handlers()
		$('.fca_qc_result_mode_input').trigger('input')
		set_result_tag_visibility()
		fca_qc_add_select2( $('.fca_qc_multiselect') )
		$('#fca_qc_mailing_list').change()

	})
	
	//CHECK IF A PROVIDER WITH TAGS IS SET OTHERWISE HIDE THEM
	function set_result_tag_visibility() {
		
		if ( $('#fca_qc_capture_emails').prop('checked') ) {
			var tagApi = ['drip', 'aweber', 'activecampaign', 'convertkit' ].indexOf( $('#fca_qc_provider').val() ) !== -1
			var hasKey = $('#fca_qc_convertkit_key').data('validated') === 1 ||$('#fca_qc_aweber_key').data('validated') === 1 || $('#fca_qc_activecampaign_key').data('validated') === 1 || $('#fca_qc_drip_key').data('validated') === 1
			if ( tagApi && hasKey ) {
				$('.fca_qc_results_api_settings, .fca_qc_personality_results_api_settings').show()
				
				$('.fca_qc_tag_info').show()
				if ( $('#fca_qc_provider').val() === 'convertkit' ) {
					$('.fca_qc_tag_info').not('.fca_qc_convertkit_tag_info').hide()
				} else {
					$('.fca_qc_convertkit_tag_info').hide()
				}
			} else {
				$('.fca_qc_results_api_settings, .fca_qc_personality_results_api_settings').hide()
			}
		
			//MAILCHIMP TOO
			if ( $('#fca_qc_api_key').data('validated') === 1 && $('#fca_qc_provider').val() === 'mailchimp' ) {
				$('.fca_qc_mailchimp_api_settings').show()
			} else {
				$('.fca_qc_mailchimp_api_settings').hide()
			}
		} else {
			$('.fca_qc_results_api_settings, .fca_qc_personality_results_api_settings').hide()
			$('.fca_qc_mailchimp_api_settings').hide()
		}
	}
	
	//ADD TAG EVENT HANDLERS
	function add_tag_handlers() {
		$('.fca_qc_add_tag_btn').unbind('click')
		$('.fca_qc_add_tag_btn').click(function(){
			var input = $(this).siblings('.fca_qc_tag_input').val()
			var tags = input.split(',')
			for (var i = 0, len = tags.length; i < len; i++) {
				create_tag( tags[i], $(this).siblings('.fca_qc_tag_hidden_input') )
			}
			$(this).siblings('.fca_qc_tag_input').val('')
			update_tags_hidden_input()
		})
		
		$('.fca_qc_add_tag_btn').unbind('keyup')
		$('.fca_qc_tag_input').keyup(function(e){
			if( e.keyCode == 13 || e.keyCode == 176 )	{
				e.preventDefault()
				$(this).siblings('.fca_qc_add_tag_btn').click()
				return false
			}
		})
		
		//QUIZ_RESULT AND QUIZ_NAME CLICK HANDLERS
		$('.fca_qc_add_quiz_result_tag').unbind('click')
		$('.fca_qc_add_quiz_result_tag').click(function(e){
			e.preventDefault
			create_tag( '{{quiz_result}}', $(this).parent().siblings('.fca_qc_tag_hidden_input') )
			update_tags_hidden_input()
			return false
			
		})
		
		//QUIZ_RESULT AND QUIZ_NAME CLICK HANDLERS
		$('.fca_qc_add_quiz_name_tag').unbind('click')
		$('.fca_qc_add_quiz_name_tag').click(function(e){
			e.preventDefault
			create_tag( '{{quiz_name}}', $(this).parent().siblings('.fca_qc_tag_hidden_input') )
			update_tags_hidden_input()
			return false
		})
	}
	add_tag_handlers()
	

	
	//PROVIDER CHANGE EVENT - HIDE UNSELECTED ONES
	$('#fca_qc_provider').change(function(e){
		var provider = $(this).val()
		
		$('.fca_qc_mailchimp_setting_row').hide()
		$('.fca_qc_zapier_setting_row').hide()
		$('.fca_qc_getresponse_setting_row').hide()
		$('.fca_qc_convertkit_setting_row').hide()
		$('.fca_qc_aweber_setting_row').hide()
		$('.fca_qc_activecampaign_setting_row').hide()
		$('.fca_qc_drip_setting_row').hide()
		$('.fca_qc_mailchimp_api_settings').hide()
		$('.fca_qc_madmimi_setting_row').hide()
		$('.fca_qc_campaignmonitor_setting_row').hide()
		$('.fca_qc_localwp_setting_row').hide()
		
		switch ( provider ) {
			
			case 'mailchimp':
				$('.fca_qc_mailchimp_setting_row').show('fast')
				$('#fca_qc_api_key').trigger('input')
				if ( $('#fca_qc_api_key').data('validated') === 1 ) {
					$('.fca_qc_mailchimp_api_settings').show()
				} else {
					$('.fca_qc_mailchimp_api_settings').hide()
				}
				
				break;
				
			case 'madmimi':
				$('.fca_qc_madmimi_setting_row').show('fast')
				$('#fca_qc_madmimi_key').trigger('input')
				if ( $('#fca_qc_madmimi_key').data('validated') === 1 ) {
					$('.fca_qc_madmimi_api_settings').show()
				} else {
					$('.fca_qc_madmimi_api_settings').hide()
				}
				
				break;	
				
			case 'campaignmonitor':
				$('.fca_qc_campaignmonitor_setting_row').show('fast')
				$('#fca_qc_campaignmonitor_key').trigger('input')
				if ( $('#fca_qc_campaignmonitor_key').data('validated') === 1 ) {
					$('.fca_qc_campaignmonitor_api_settings').show()
				} else {
					$('.fca_qc_campaignmonitor_api_settings').hide()
				}
				
				break;
			
			case 'zapier':
				$('.fca_qc_zapier_setting_row').show('fast')
				set_result_tag_visibility()
				break;
			
			case 'getresponse':
				$('.fca_qc_getresponse_setting_row').show('fast')
				$('#fca_qc_getresponse_key').trigger('input')
				if ( $('#fca_qc_getresponse_key').data('validated') === 1 ) {
					$('.fca_qc_getresponse_api_settings').show()
				} else {
					$('.fca_qc_getresponse_api_settings').hide()
				}
				break;
				
			case 'convertkit':
				$('.fca_qc_convertkit_setting_row').show('fast')
				$('#fca_qc_convertkit_key').trigger('input')
				if ( $('#fca_qc_convertkit_key').data('validated') === 1 ) {
					$('.fca_qc_convertkit_api_settings').show()
				} else {
					$('.fca_qc_convertkit_api_settings').hide()
				}
				break;
			
			case 'aweber':
				$('.fca_qc_aweber_setting_row').show('fast')
				$('#fca_qc_aweber_key').trigger('input')
				if ( $('#fca_qc_aweber_key').data('validated') === 1 ) {
					$('.fca_qc_aweber_api_settings').show()
				} else {
					$('.fca_qc_aweber_api_settings').hide()
				}
				break;
				
			case 'activecampaign':
				$('.fca_qc_activecampaign_setting_row').show('fast')
				$('#fca_qc_activecampaign_key').trigger('input')
				if ( $('#fca_qc_activecampaign_key').data('validated') === 1 ) {
					$('.fca_qc_activecampaign_api_settings').show()
				} else {
					$('.fca_qc_activecampaign_api_settings').hide()
				}
				break;
				
			case 'drip':
				$('.fca_qc_drip_setting_row').show('fast')
				$('#fca_qc_drip_key').trigger('input')
				if ( $('#fca_qc_drip_key').data('validated') === 1 ) {
					$('.fca_qc_drip_api_settings').show()
				} else {
					$('.fca_qc_drip_api_settings').hide()
				}
				break;
				
			case 'localwp':
				$('.fca_qc_localwp_setting_row').show('fast')

				break;
		}
		
	})
	
	//MAILING LIST CHANGE EVENT - UPDATE GROUPS
	$('#fca_qc_mailing_list').change(function(e){
		
		var api_key = $('#fca_qc_api_key').val()
		var list_id = $(this).val()
		if ( api_key && list_id ) {
			
			$('.fca_qc_mailchimp_groups').siblings('.fca_qc_icon').show()
			
			$.ajax({
					url: premiumData.ajaxurl,
					type: 'POST',
					data: {
						api_key: api_key,
						nonce: premiumData.nonce,
						list_id: list_id,
						action: 'fca_qc_get_mailchimp_groups'
					}
				}).done( function( returnedData ) {
					$('.fca_qc_mailchimp_groups').siblings('.fca_qc_icon').hide()
					if ( returnedData ) {
						update_lists( returnedData, $('.fca_qc_mailchimp_groups') )
					}
				})
		}

	}).change()

	//LEAD CAPTURE TOGGLE SWITCH
	$( '#fca_qc_capture_emails' ).change(function(){
		if ( this.checked ) {
			$(this).closest('table').find('tr').not('#fca_qc_lead_capture_toggle_tr, .fca_qc_mailchimp_setting_row').show('fast')
			$('#fca_qc_provider').change()
			//run the provider change event to hide/show the correct provider table rows			
		} else {
			$(this).closest('table').find('tr').not('#fca_qc_lead_capture_toggle_tr').hide('fast')
		}
		set_result_tag_visibility()
	}).change()
	
	//RESULT MODE TOGGLE
	$('.fca_qc_result_mode_input').on('input change', function() {
		if ( $(this).prop('checked') ) {
			var mode = $(this).val()
			if ( mode === 'redirect' ) {
				$('.fca_qc_result_row_url').show()
				$('.fca_qc_result_row_default').hide()
			} else {
				$('.fca_qc_result_row_url').hide()
				$('.fca_qc_result_row_default').show()
			}
		}
	}).trigger('input')
	
	//EXPLANATION/HINT ENABLE TOGGLE
	$('#fca_qc_explanations').change( function() {
		if ( $(this).prop('checked') ) {
			$('.fca_qc_hint_tr').show()
		} else {
			$('.fca_qc_hint_tr').hide()
		}
	}).change()

}) //END DOCUMENT READY

///////////////////
// FUNCTIONS
///////////////////

//ADD/UPDATE MAILING LIST SELECT
function update_lists( lists, $target ) {
	var $ = jQuery
	
	lists = $.parseJSON( lists )
	$target.each(function(){
		var selected = $(this).val()
		if ( !selected ) {
			//set to 'not set' if its empty/undefined/etc
			selected = 'not-set'
		}
		$(this).children('option').remove()
		
		for ( var i = 0; i < lists.length; i++ ) {
			var newOption = ''
			if ( selected.indexOf( lists[i].id ) !== -1 ) {
				newOption = "<option value='" + lists[i].id + "' selected='selected' >" + lists[i].name + "</option>";
			} else {
				newOption = "<option value='" + lists[i].id + "'>" + lists[i].name + "</option>";
			}
			$(this).append(newOption)	
		}
	})

}

//SET RESULT IDs
function setResultIDs(){
	var $ = jQuery

	$('.fca_qc_id').each(function() {
		if ( $(this).val() === '' || $(this).val() == '{{RESULT_ID}}' || $(this).val() == '{{ID}}' ) {
			$(this).attr( 'value', fca_qc_new_GUID() )
		}
	})
}

//MAKES RESULT HEADINGS AUTOMATICALLY UPDATE PERSONALITY MULTISELECTS 
function add_result_personality_result_text_handlers() {
	var $ = jQuery
	$('.fca_qc_personality_result_input').unbind( 'change' )

	$( '.fca_qc_personality_result_input' ).change( function() {
		$result_inputs = $( '.fca_qc_personality_result_input' )
		
		$('.fca_qc_multiselect').not('.fca_qc_mailchimp_groups').each(function(){
			var previous_selected_values = []
			$select = $(this)
			
			$select.children(':selected').each(function( index, value ){
				previous_selected_values.push( $(value).val() )
			})

			$select.children('option').remove()
			
			var n = 0
			$result_inputs.each(function(){
				var guid = $( this ).closest('.fca_qc_personality_result_item').find('.fca_qc_id').val()
				if ( previous_selected_values.indexOf( guid ) != -1 ) {
					//FOUND IN PREVIOUS ONES
					$select.append('<option selected="selected" value="' + guid + '">' + $( this ).val()+ '</option>')
				} else {
					$select.append('<option value="' + guid + '">' + $( this ).val() + '</option>')
				}
				n++				
			})
		})
		
	}).change()

}

//ADD SELECT2
function fca_qc_add_select2( $selector ) {
	var $ = jQuery
	
	$selector.each(function(){
		if ( typeof ( $(this).select2() ) !== 'object' ) {
			$(this).select2()
			if ( $(this).hasClass('fca_select2_hidden') ) {
				$(this).next().hide()
			} 
		}
	})

}