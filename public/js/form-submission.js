$(document).ready(function () {
    $('#clientCreateForm').submit(function (event) {
        event.preventDefault();

        var action = $(this).attr('action');
        var method = $(this).attr('method');
        var csrf = $('meta[name="csrf-token"]').attr('content');
        var accessToken = $('meta[name="access-token"]').attr('content');
        var headers = {
            'Authorization': 'Bearer ' + accessToken,
            'X-CSRF-TOKEN': csrf
        };

        // Perform API call
        $.ajax({
            url: action,
            method: method,
            data: $(this).serialize(),
            headers: headers,
            success: function (response) {
                // Close modal
                $('#clientCreateModal').modal('hide');

                // Add the new client to the select dropdown
                $('#clientDropdown').append($('<option>', {
                    value: response.data.id,
                    text: response.data.name
                }));

                // Automatically select the new client
                $('#clientDropdown').val(response.data.id);

                // Refresh the Selectric dropdown to update its options
                // $('#clientDropdown').selectric('refresh');
                //
                // $("#clientDropdown").selectric('select', response.data.id);
            },
            error: function (error) {
                var errors = error.responseJSON.errors;
                var keys = Object.keys(errors);
                $('#apiErrorAlert').removeClass('d-none').text(errors[keys[0]][0]);
            }
        });
    });
});
