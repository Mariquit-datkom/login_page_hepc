
let isNavigating = false;

if (window.performance && window.performance.getEntriesByType('navigation').length) {
    const navType = window.performance.getEntriesByType('navigation')[0].type;
    if (navType === 'reload') {
        isNavigating = true;
    }
}

document.addEventListener('click', function(event) {
    if (event.target.closest('a') || event.target.closest('button')) {
        isNavigating = true;
    }
});

document.addEventListener('submit', function(event) {
    isNavigating = true;
});

window.addEventListener('pagehide', function (event) {
    if (!isNavigating && !event.persisted) {
        navigator.sendBeacon('logout.php');
    }
});