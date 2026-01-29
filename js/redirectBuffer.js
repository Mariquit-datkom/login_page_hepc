document.addEventListener("DOMContentLoaded", function() {
    if (typeof redirectConfig !== 'undefined') {
        setTimeout(function() {
            window.location.href = redirectConfig.url;
        }, redirectConfig.delay);
    }
});