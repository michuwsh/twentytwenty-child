/**
 * 
 * Custom Java Script to template child
 * 
 */


 jQuery(document ).ready( function() {

    jQuery('#get_posts').click(function() {
      
        jQuery.ajax({

            url: '/wp-admin/admin-ajax.php',
            data: {
                action: "tt_child_get_posts",
            },

            success: function( response ) {

                response = jQuery.parseJSON( response );
                console.log(response);

            }

        });

    });

});