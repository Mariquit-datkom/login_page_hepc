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

document.addEventListener('DOMContentLoaded', function() {
    const searchField = document.getElementById('search-field');
    const entriesSelect = document.getElementById('entries-select');
    const requestItems = document.querySelectorAll('.request-item');

    function filterTable() {
        const searchTerm = searchField.value.toLowerCase();
        const maxEntries = entriesSelect.value === 'all' ? Infinity : parseInt(entriesSelect.value);
        
        let visibleCount = 0;

        requestItems.forEach(item => {
            // Get data from attributes or text content
            const subject = item.getAttribute('data-subject') || item.querySelector('.req-subject').textContent.toLowerCase();
            const matchesSearch = subject.includes(searchTerm);

            if (matchesSearch && visibleCount < maxEntries) {
                item.style.display = 'flex'; // Show item
                visibleCount++;
            } else {
                item.style.display = 'none'; // Hide item
            }
        });

        // Handle "No results found" view
        const noResultsMsg = document.querySelector('.no-requests');
        if (visibleCount === 0 && searchTerm !== "") {
            if (!noResultsMsg) {
                const msg = document.createElement('p');
                msg.className = 'no-requests';
                msg.style.cssText = 'padding: 20px; text-align: center; color: #666; width: 100%;';
                msg.textContent = 'No matching requests found.';
                document.querySelector('.list-table').appendChild(msg);
            }
        } else if (noResultsMsg) {
            noResultsMsg.remove();
        }
    }

    // Event Listeners
    searchField.addEventListener('input', filterTable);
    entriesSelect.addEventListener('change', filterTable);
});

document.addEventListener('DOMContentLoaded', function() {
    const searchField = document.getElementById('search-field');
    const entriesSelect = document.getElementById('entries-select');
    const requestItems = Array.from(document.querySelectorAll('.request-item'));
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const pageInfo = document.getElementById('pageInfo');

    let currentPage = 1;

    function updateTable() {
        const searchTerm = searchField.value.toLowerCase();
        const entriesPerPage = entriesSelect.value === 'all' ? requestItems.length : parseInt(entriesSelect.value);

        // 1. Filter items first based on search
        const filteredItems = requestItems.filter(item => {
            return item.innerText.toLowerCase().includes(searchTerm);
        });

        // 2. Calculate pagination
        const totalPages = Math.ceil(filteredItems.length / entriesPerPage) || 1;
        
        // Reset to page 1 if current page is out of bounds (happens on new search)
        if (currentPage > totalPages) currentPage = 1;

        const startIndex = (currentPage - 1) * entriesPerPage;
        const endIndex = startIndex + entriesPerPage;

        // 3. Show/Hide items
        requestItems.forEach(item => item.style.display = 'none'); // Hide all first
        
        filteredItems.forEach((item, index) => {
            if (index >= startIndex && index < endIndex) {
                item.style.display = 'flex';
            }
        });

        // 4. Update UI Controls
        pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;
        prevBtn.disabled = (currentPage === 1);
        nextBtn.disabled = (currentPage === totalPages);
    }

    // Event Listeners
    searchField.addEventListener('input', () => {
        currentPage = 1; // Reset to page 1 when typing
        updateTable();
    });

    entriesSelect.addEventListener('change', () => {
        currentPage = 1; // Reset to page 1 when changing limit
        updateTable();
    });

    prevBtn.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            updateTable();
        }
    });

    nextBtn.addEventListener('click', () => {
        currentPage++;
        updateTable();
    });

    updateTable();
});