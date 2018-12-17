(function ($) {
    //$(".widget_polylang li.lang-item-bg a").text("BG");
    //$(".widget_polylang li.lang-item-en a").text("EN");
    
    $('.mobile_menu_button').on('click', function() {
        $(this).toggleClass('expanded');
    });
    // Search toggle
    $('body').click(function () {
        $('.search_form_wrapper').css('display','none');
        $('.search_toggle_wrapper .search_toggle').removeClass('active');
    });
      
      $('.search_wrapper').click(function(event){
        event.stopPropagation();
    });
    
    $('.search_toggle_wrapper .search_toggle').on('click', function(e) {
        e.preventDefault();
        $(this).toggleClass('active');
        $('.search_form_wrapper').toggleClass('active');
        $('.search_form_wrapper').slideToggle("fast","swing");
        $('.search_form_wrapper.active input[type="search"]').focus();

    });
    
})(jQuery);


jQuery(document).ready(function(){
        //Mobile menu button toggle actions
        jQuery("button.navbar-toggle").click(function(event) {
            jQuery(this).parent().parent().children(".navbar-collapse").toggleClass('in');
            jQuery(".search_form_wrapper").toggleClass('opened');
            jQuery(this).toggleClass('opened');
            jQuery(".touchevents #menu-main-menu > li.dropdown").removeClass("open");
            
        });
        
        //classic devices
        jQuery(".no-touchevents #menu-main-menu > li.dropdown > a.dropdown-toggle").hover(function(event) {
            jQuery(".no-touchevents #menu-main-menu > li.dropdown").not(this).parent().removeClass("open");
            jQuery(this).parent().addClass("open");
        });
        jQuery('.no-touchevents #menu-main-menu > li.dropdown').mouseenter(function() {
                if(!jQuery(this).hasClass('open')) { // Keeps it open when hover it again
                    jQuery(this).addClass('open');
                }
        });
        
        jQuery('.no-touchevents #menu-main-menu > li.dropdown').mouseleave(function(){
                jQuery(this).removeClass('open');        
        });
        
         jQuery('.no-touchevents #menu-main-menu > li.dropdown > ul.dropdown-menu').mouseenter(function(){
                if(!jQuery(this).hasClass('open')) { // Keeps it open when hover it again  
                    jQuery(this).addClass('open');
                }  
        });
        
        jQuery('.no-touchevents #menu-main-menu > li.dropdown > ul.dropdown-menu').mouseleave(function(){
                jQuery(this).removeClass('open');
        });
    
        // Touch devices: 1st click, add "open" class, preventing the location change. 2nd click will go through.
        jQuery(".touchevents #menu-main-menu > li.dropdown > a.dropdown-toggle").click(function(event) {
            // Perform a reset - Remove the "open" class on all other menu items
            jQuery(".touchevents #menu-main-menu > li.dropdown > a").not(this).parent().removeClass("open");
            jQuery(this).parent().toggleClass("open");
            if (jQuery(this).parent().hasClass("open")) {
                event.preventDefault();
            }
        });
        // Add curent dropdown link text to h3 dropdown menu title
        jQuery(".touchevents #menu-main-menu > li.dropdown > a.dropdown-toggle").click(function(event) {
            // Asign title from dropdown toggle link to H3 title in Dropdown menu
            var dropdown_link = jQuery( this ).html();
            jQuery(this).clone().appendTo(".dropdown.open .mobileparentTitle");
        });
        // Add curent dropdown link text to h3 dropdown menu title
        jQuery(".touchevents #menu-main-menu > li.dropdown > ul.dropdown-menu a.mobilebackLink").click(function(e) {
            e.preventDefault();
            // Remove title from dropdown H3 title in Dropdown menu
            jQuery("h3.mobileparentTitle").html('');
            jQuery(this).parent().parent().removeClass('open');
        });
});