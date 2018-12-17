jQuery( document ).ready(function($){
	//GDPR TOGGLE
	
	//SET TRANSLATIONS FOR ON/OFF SWITCHES
	$( '.onoffswitch-inner' ).each( function(){
		$(this).attr('data-content-on', fcaQcAdminData.on_string )
		$(this).attr('data-content-off', fcaQcAdminData.off_string )
	})
	
	$('#fca_qc_gdpr_checkbox').change( function(e){
		var $thisTable = $(this).closest('table')
		if ( this.checked ) {
			$thisTable.find('tr.gdpr-setting').show()
		} else {
			$thisTable.find('tr.gdpr-setting').hide()
		}
	}).change()
	
	$('#fca_qc_settings_form').submit( function(e){
		if( $('#fca_qc_gdpr_checkbox').attr('checked') && $( $('[name="fca_qc_consent_msg"]').val() ).text() == ''  ) {
			alert( 'GDPR checkbox is enabled but the consent statement is blank.  Please add a consent statement to enable this feature.' )
			return false			
		} else {
			return true
		}
		
	})
	
})