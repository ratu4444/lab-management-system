"use strict";

//  AUTO HIDE ALERT
setTimeout(function() {
    $('.alert').alert('close');
}, 5000);

function animateValue(element, value, duration) {
    element.text(0);
    var endValue = parseInt(value.replace(/\D/g, ''));
    var startTimestamp = null;

    function step(timestamp) {
        if (!startTimestamp) startTimestamp = timestamp;
        var progress = timestamp - startTimestamp;
        var progressPercentage = Math.min(progress / duration, 1);
        var animatedValue = Math.ceil(progressPercentage * endValue);
        element.text(animatedValue);
        if (progress < duration) {
            requestAnimationFrame(step);
        } else {
            element.text(value); // Set the final formatted value
        }
    }
    requestAnimationFrame(step);
}

function validateDates(startElement, endElement) {
    const startDate = new Date(startElement.val());
    const endDate = new Date(endElement.val());

    if (startDate > endDate) {
        endElement[0].setCustomValidity('Invalid');
    } else {
        endElement[0].setCustomValidity('');
    }
}

function modifyCompletionPercentage(statusValue, percentageElement, configStatuses) {
    switch (parseInt(statusValue)) {
        case configStatuses.Pending:
            percentageElement.val(0).attr('readonly', 'readonly');
        break;
        case configStatuses.Completed:
            percentageElement.val(100).attr('readonly', 'readonly');
        break;
        case configStatuses.Canceled:
            percentageElement.attr('readonly', 'readonly');
        break;
        default:
            percentageElement.removeAttr('readonly');
    }
}

function cloneField(elementSelector, inputSelector, containerSelector) {
    var elements = $(elementSelector);
    var clonedElement = elements.first().clone();

    clonedElement.find('input[type="text"], input[type="number"]').val('');
    clonedElement.find('input[type="checkbox"]').prop('checked', true);

    checkboxAction(clonedElement, elementSelector, inputSelector, true);

    clonedElement.find('input').each(function(index, element) {
        var clonedElementName = $(element).attr('name').replace(/\[\d+\]/g, '[' + elements.length + ']');
        $(element).attr('name', clonedElementName);
    });

    clonedElement.find('.datepicker').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'YYYY-MM-DD',
        }
    });

    $(containerSelector).append(clonedElement);
}

function checkboxAction(checkbox, elementSelector, inputSelector, isNew = false) {
    const isChecked = isNew || checkbox.is(':checked');
    const inputField = checkbox.closest(elementSelector).find(inputSelector);

    inputField.find('input[data-required="true"]').attr('required', isChecked);
    inputField.find('input').attr('disabled', !isChecked);
    inputField.find('label span').toggle(isChecked);
}

