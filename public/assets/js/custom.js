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

