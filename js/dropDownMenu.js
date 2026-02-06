//User icon drop down menu for log out
const avatarBtn = document.getElementById('user-avatar-btn');
const dropdown = document.getElementById('user-avatar-dropdown');

avatarBtn.onclick = function(event) {
    dropdown.classList.toggle('show');
    event.stopPropagation();
}

window.onclick = function(event) {
    if (!event.target.matches('.user-avatar')) {
        if (dropdown.classList.contains('show')) {
            dropdown.classList.remove('show');
        }
    }
}