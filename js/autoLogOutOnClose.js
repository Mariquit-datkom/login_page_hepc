window.addEventListener('visibilitychange', function() {
    
        if (document.visibilityState === 'hidden') {
            navigator.sendBeacon('logout.php');
        }
    });