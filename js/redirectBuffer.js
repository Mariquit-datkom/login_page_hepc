//Adds a slight buffer time to display confirmation message
document.addEventListener("DOMContentLoaded", function() {
    if (typeof redirectConfig !== 'undefined') {
        setTimeout(function() {
            window.location.href = redirectConfig.url;
        }, redirectConfig.delay);
    }
});