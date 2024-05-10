jQuery(document).ready(function($) {
    $('#search-user-form').on('submit', function(event) {
        event.preventDefault();

        var user_id = $('#user-id').val();

        $.ajax({
            url: ajax_object.ajax_url, // Use the AJAX URL provided by WordPress
            type: 'POST',
            data: {
                action: 'search_user_data',
                user_id: user_id
            },
            success: function(response) {
                console.log(response); // Debugging statement

                if (response.success) {
                    $('#search-results').html('<p>Wins: ' + response.data.wins + ' with racket: ' + response.data.racket + '</p>'); // Display user data if found
                } else {
                    $('#search-results').html('<p>' + response.data + '</p>'); // Display error message
                }
            }
        });
    });

    $('#update-user-form').on('submit', function(event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: ajax_object.ajax_url, // Use the AJAX URL provided by WordPress
            type: 'POST',
            data: {
                action: 'update_user_data',
                form_data: formData
            },
            success: function(response) {
                console.log(response); // Debugging statement

                if (response.success) {
                    $('#update-results').html('<p>' + response.data + '</p>'); // Display success message
                } else {
                    $('#update-results').html('<p>' + response.data + '</p>'); // Display error message
                }
            }
        });
    });
});
