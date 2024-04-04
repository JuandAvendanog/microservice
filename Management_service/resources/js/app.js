// resources/js/app.js

$(document).ready(function() {
    $('#place-order-btn').click(function() {
        $.ajax({
            url: '/place-order', 
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

