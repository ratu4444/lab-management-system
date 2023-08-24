function selectButtonBgChange(selectGroupInputRadio) {
    $(selectGroupInputRadio).each(function() {
        var button = $(this);
        button.removeClass(button.siblings('.selectgroup-button').data('class'));
        if (button.is(':checked')) {
            button.siblings('.selectgroup-button').addClass(button.siblings('.selectgroup-button').data('class'));
        }
    });

    $(selectGroupInputRadio).on('change', function() {
        removeBackgroundClass(selectGroupInputRadio);
        var button = $(this);
        if (button.is(':checked')) {
            button.siblings('.selectgroup-button').addClass(button.siblings('.selectgroup-button').data('class'));
        }
    });
}

function removeBackgroundClass(selectGroupInputRadio) {
    $(selectGroupInputRadio).each(function() {
        $(this).siblings('.selectgroup-button').removeClass($(this).siblings('.selectgroup-button').data('class'));
    });
}
