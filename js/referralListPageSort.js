document.addEventListener('DOMContentLoaded', function() {
    const searchField = document.getElementById('search-field');
    const entriesSelect = document.getElementById('entries-select');
    const referralItems = Array.from(document.querySelectorAll('.referral-item'));
    const listTable = document.querySelector('.list-table'); 
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const pageInfo = document.getElementById('pageInfo');

    let currentPage = 1;

    function updateTable() {
        const searchTerm = searchField.value.toLowerCase();
        const entriesPerPage = entriesSelect.value === 'all' ? referralItems.length : parseInt(entriesSelect.value);

        // Filter based on ID or Status text
        const filteredItems = referralItems.filter(item => {
            return item.innerText.toLowerCase().includes(searchTerm);
        });

        let noResultsMsg = document.querySelector('.no-referrals');
        if (filteredItems.length === 0) {
            if (!noResultsMsg) {
                noResultsMsg = document.createElement('p');
                noResultsMsg.className = 'no-referrals';
                noResultsMsg.style.cssText = 'padding: 20px; text-align: center; color: #666; width: 100%;';
                noResultsMsg.textContent = 'No matching referral entries found.';
                listTable.appendChild(noResultsMsg);
            }
        } else if (noResultsMsg) {
            noResultsMsg.remove();
        }

        const totalPages = Math.ceil(filteredItems.length / entriesPerPage) || 1;
        if (currentPage > totalPages) currentPage = 1;

        const startIndex = (currentPage - 1) * entriesPerPage;
        const endIndex = startIndex + entriesPerPage;

        referralItems.forEach(item => item.style.display = 'none'); 
        
        filteredItems.forEach((item, index) => {
            if (index >= startIndex && index < endIndex) {
                item.style.display = 'flex';
            }
        });

        pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;
        prevBtn.disabled = (currentPage === 1);
        nextBtn.disabled = (currentPage === totalPages || filteredItems.length === 0);
    }

    searchField.addEventListener('input', () => { currentPage = 1; updateTable(); });
    entriesSelect.addEventListener('change', () => { currentPage = 1; updateTable(); });
    prevBtn.addEventListener('click', () => { if (currentPage > 1) { currentPage--; updateTable(); } });
    nextBtn.addEventListener('click', () => { currentPage++; updateTable(); });

    updateTable();
});