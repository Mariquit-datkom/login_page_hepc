function showRequestDetails(data, fullName) {
    const modal = document.getElementById('requestModal');
    
    // Fill in the data
    document.getElementById('modalRequestNo').value = data.request_no;
    document.getElementById('modalSubject').innerText = data.request_subject;
    document.getElementById('modalDate').innerText = data.request_date;
    document.getElementById('modalSubmittedBy').innerText = data.submitted_by + " - " + fullName;
    document.getElementById('modalMainRequest').innerText = data.request_main || "No details provided.";
    
    // Status Badge Setup
    const statusBadge = document.getElementById('modalStatus');
    statusBadge.innerText = data.request_status;
    statusBadge.className = 'status-badge ' + data.request_status.toLowerCase();

    // ... inside showRequestDetails(data, fullName) ...

    const attachmentSection = document.getElementById('attachmentSection');
    const attachmentContainer = document.getElementById('modalAttachment');

    // Checks if the string exists and isn't just whitespace
    if (data.request_attachment && data.request_attachment.trim() !== "") {
        
        // Splits and filters out any empty strings (caused by trailing commas)
        const fileArray = data.request_attachment.split(',').map(f => f.trim()).filter(f => f !== "");

        if (fileArray.length > 0) {
            attachmentSection.style.display = 'block'; // Show the whole row
            
            const folderName = data.request_no_display;
            attachmentContainer.innerHTML = fileArray.map(fileName => `
                <div class="attachment-item">
                    <a href="uploads/${folderName}/${fileName}" target="_blank" class="attachment-link">
                        <i class="fas fa-file-download"></i> ${fileName}
                    </a>
                </div>
            `).join('');
        } else {
            attachmentSection.style.display = 'none'; // Hide if array is empty after filtering
        }
    } else {
        attachmentSection.style.display = 'none'; // Hide if column is NULL or empty string
    }

    // Show the modal
    modal.style.display = 'block';
}

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

function closeModal() {
    document.getElementById('requestModal').style.display = 'none';
}

// Close if user clicks outside the box
window.onclick = function(event) {
    const modal = document.getElementById('requestModal');
    if (event.target == modal) {
        closeModal();
    }
}