document.addEventListener('DOMContentLoaded', function() {
    const searchField = document.getElementById('search-field');
    const entriesSelect = document.getElementById('entries-select');
    const listContainer = document.querySelector('.list-table');
    const internItems = Array.from(document.querySelectorAll('.intern-item'));
    
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const pageInfo = document.getElementById('pageInfo');

    let currentPage = 1;

    function updateInternTable() {
        const searchTerm = searchField.value.toLowerCase();
        const entriesPerPage = entriesSelect.value === 'all' ? internItems.length : parseInt(entriesSelect.value);

        const filteredItems = internItems.filter(item => {
            return item.innerText.toLowerCase().includes(searchTerm);
        });

        const totalPages = Math.ceil(filteredItems.length / entriesPerPage) || 1;
        
        if (currentPage > totalPages) currentPage = 1;

        const startIndex = (currentPage - 1) * entriesPerPage;
        const endIndex = startIndex + entriesPerPage;

        internItems.forEach(item => item.style.display = 'none'); 
        
        filteredItems.forEach((item, index) => {
            if (index >= startIndex && index < endIndex) {
                item.style.display = 'flex'; 
            }
        });

        updateNoResultsMessage(filteredItems.length, searchTerm);
        
        pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;
        prevBtn.disabled = (currentPage === 1);
        nextBtn.disabled = (currentPage === totalPages || filteredItems.length === 0);
    }

    function updateNoResultsMessage(count, term) {
        let noResultsMsg = document.querySelector('.no-match-found');
        
        if (count === 0 && term !== "") {
            if (!noResultsMsg) {
                noResultsMsg = document.createElement('p');
                noResultsMsg.className = 'no-match-found';
                noResultsMsg.style.cssText = 'padding: 20px; text-align: center; color: #666; width: 100%;';
                noResultsMsg.textContent = `No interns found matching "${term}"`;
                listContainer.appendChild(noResultsMsg);
            }
        } else if (noResultsMsg) {
            noResultsMsg.remove();
        }
    }

    searchField.addEventListener('input', () => {
        currentPage = 1; 
        updateInternTable();
    });

    entriesSelect.addEventListener('change', () => {
        currentPage = 1; 
        updateInternTable();
    });

    prevBtn.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            updateInternTable();
        }
    });

    nextBtn.addEventListener('click', () => {
        const searchTerm = searchField.value.toLowerCase();
        const filteredCount = internItems.filter(item => item.innerText.toLowerCase().includes(searchTerm)).length;
        const entriesPerPage = entriesSelect.value === 'all' ? internItems.length : parseInt(entriesSelect.value);
        const totalPages = Math.ceil(filteredCount / entriesPerPage);

        if (currentPage < totalPages) {
            currentPage++;
            updateInternTable();
        }
    });

    updateInternTable();
});