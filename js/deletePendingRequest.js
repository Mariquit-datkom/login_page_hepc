function deletePendingRequest() {
    const requestNo = document.getElementById('modalRequestNo').value;
    const deletedStatus = "Deleted";

    if (confirm(`Are you sure you want to delete this request?`)) {
        fetch('deletePendingRequest.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `request_no=${requestNo}&status=${deletedStatus}`
        })
        .then(response => response.text())
        .then(data => {
            alert('Request deleted successfully!');
            location.reload(); // Refresh to show changes
        })
        .catch(error => console.error('Error:', error));
    }
}