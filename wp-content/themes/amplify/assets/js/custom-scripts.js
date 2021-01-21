(function( $ ) {
	//Form labels
	$('.wpcf7-form input, .mc4wp-form input, .mc4wp-form select, .wpcf7-form select').focusin(function() {
		$(this).closest('.wpcf7-form-control-wrap').prevAll('label').addClass('focused');
		$(this).prev('label').addClass('focused');
    }); 
    
    $('input[type=checkbox][name*=fast-track]').change(function() {
        if ($(this).is(':checked')) {
            $('.wpcf7-form .extra-form').removeClass('hidden');
        }
        else {
            $('.wpcf7-form .extra-form').addClass('hidden');
        }
    });
    $('.wpcf7-form .extra-form').addClass('hidden');


    /* Match card heights */
    $(window).load(function() {
        //match the card heights
        resizeCards(true);
    });

 
    //breakpoints are
    var small = 767;
    var resizeTimer;

    $(window).on('resize', function(e) {

    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {

        // resizing has "stopped"
        var width = $(window).width();

            resizeCards(false);
       
                
    }, 250);

    });

    
    

})( jQuery );

function resizeCards(setTallest) {
    var $cards = jQuery('.card .elementor-widget-container');
    var cardheight = 0;
    jQuery('.card').each(function() {
        jQuery(this).find('.elementor-widget-container').height('auto');
        var height = jQuery(this).find('.elementor-widget-container').height();
        if (cardheight < height) {
            cardheight = height;
            if (setTallest) {
                $cards.removeClass('tallest');
                jQuery(this).find('.elementor-widget-container').addClass('tallest');
                
            }
        }
    });

    if (cardheight > 0) {
        $cards.height(cardheight);
        jQuery('.card .elementor-widget-container.tallest').height('auto');
        console.log("Cards resized");
    }
}