$(document).ready(function() {
    $('.selectgroup-input-radio').each(function() {
        var button = $(this);
        button.removeClass(button.siblings('.selectgroup-button').data('class'));
        if (button.is(':checked')) {
            button.siblings('.selectgroup-button').addClass(button.siblings('.selectgroup-button').data('class'));
        }
    });

    $('.selectgroup-input-radio').on('change', function() {
        removeBackgroundClass();
        var button = $(this);
        if (button.is(':checked')) {
            button.siblings('.selectgroup-button').addClass(button.siblings('.selectgroup-button').data('class'));
        }
    });
});

function removeBackgroundClass() {
    $('.selectgroup-input-radio').each(function() {
        $(this).siblings('.selectgroup-button').removeClass($(this).siblings('.selectgroup-button').data('class'));
    });
}
