function updateReferralStatus(newStatus) {
    const referralId = document.getElementById('modalReferralId').value;

    if (confirm(`Are you sure you want to set this referral entry to ${newStatus}?`)) {
        // Send data to a PHP handler using Fetch API
        fetch('updateReferralStatus.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `ojt_referral_id=${referralId}&status=${newStatus}`
        })
        .then(response => response.text())
        .then(data => {
            alert('Status updated successfully!');
            location.reload(); // Refresh to show changes
        })
        .catch(error => console.error('Error:', error));
    }
}