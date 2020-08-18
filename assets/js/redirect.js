jQuery(document).ready(function ($) {
    
    document.addEventListener('wpcf7mailsent', function (event) {
        var inputs = event.detail.inputs;
        let email;

        for ( var i = 0; i < inputs.length; i++ ) {
            if ( 'your-email' == inputs[i].name ) {
            email = inputs[i].value;
            break;
            }
        }

        var data = {
            'action': 'cf7ps_paystack_charge',
            'id': event.detail.contactFormId,
            'email': email,
        };

        jQuery.ajax({
            type: "POST",
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