function updateRequestStatus(newStatus) {
    const requestId = document.getElementById('modalRequestNo').value;

    if (confirm(`Are you sure you want to set this request to ${newStatus}?`)) {
        // Send data to a PHP handler using Fetch API
        fetch('updateRequestStatus.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `request_no=${requestId}&status=${newStatus}`
        })
        .then(response => response.text())
        .then(data => {
            alert('Status updated successfully!');
            location.reload(); // Refresh to show changes
        })
        .catch(error => console.error('Error:', error));
    }
}