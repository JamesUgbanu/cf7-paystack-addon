jQuery(document).ready(function ($) {
    
    document.addEventListener('wpcf7mailsent', function (event) {
        
        var data = {
            'action': 'cf7ps_paystack_charge',
        };

        jQuery.ajax({
            type: "GET",
            data: data,
            dataType: "json",
            async: false,
            url: ajax_object_cf7ps.ajax_url,
            xhrFields: {
                withCredentials: true
            },
            success: function (response) {
                window.location.replace(response.redirect_url);
            }
        });
        
    });
    
    
});