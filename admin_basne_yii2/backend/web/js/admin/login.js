/**
 * 
 */
jQuery(document).ready(function() {
    jQuery('.forgot-psw').hide();
    jQuery('#link-forgot-psw').click(function() {
            jQuery('.forgot-psw').slideToggle(1000);
            jQuery('.forgot-psw #msg').html('&nbsp;');
        }
    );
});