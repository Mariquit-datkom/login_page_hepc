document.addEventListener('DOMContentLoaded', function() {
    const searchField = document.getElementById('search-field');
    const entriesSelect = document.getElementById('entries-select');
    const requestItems = Array.from(document.querySelectorAll('.request-item'));
    const listTable = document.querySelector('.list-table'); // Reference to the container
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const pageInfo = document.getElementById('pageInfo');

    let currentPage = 1;

    function updateTable() {
        const searchTerm = searchField.value.toLowerCase();
        const entriesPerPage = entriesSelect.value === 'all' ? requestItems.length : parseInt(entriesSelect.value);

        // 1. Filter items based on search
        const filteredItems = requestItems.filter(item => {
            // Using innerText to catch all content, or customize to specific fields
            return item.innerText.toLowerCase().includes(searchTerm);
        });

        // 2. Handle "No results found" logic
        let noResultsMsg = document.querySelector('.no-requests');
        if (filteredItems.length === 0) {
            if (!noResultsMsg) {
                noResultsMsg = document.createElement('p');
                noResultsMsg.className = 'no-requests';
                noResultsMsg.style.cssText = 'padding: 20px; text-align: center; color: #666; width: 100%;';
                noResultsMsg.textContent = 'No matching requests found.';
                listTable.appendChild(noResultsMsg);
            }
        } else if (noResultsMsg) {
            noResultsMsg.remove();
        }

        // 3. Calculate pagination
        const totalPages = Math.ceil(filteredItems.length / entriesPerPage) || 1;
        if (currentPage > totalPages) currentPage = 1;

        const startIndex = (currentPage - 1) * entriesPerPage;
        const endIndex = startIndex + entriesPerPage;

        // 4. Show/Hide items
        requestItems.forEach(item => item.style.display = 'none'); 
        
        filteredItems.forEach((item, index) => {
            if (index >= startIndex && index < endIndex) {
                item.style.display = 'flex';
            }
        });

        // 5. Update UI Controls
        pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;
        prevBtn.disabled = (currentPage === 1);
        nextBtn.disabled = (currentPage === totalPages || filteredItems.length === 0);
    }

    // Event Listeners
    searchField.addEventListener('input', () => {
        currentPage = 1;
        updateTable();
    });

    entriesSelect.addEventListener('change', () => {
        currentPage = 1;
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