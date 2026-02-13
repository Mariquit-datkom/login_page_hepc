document.addEventListener('DOMContentLoaded', function() {
    const removeCheckboxes = document.querySelectorAll('input[name="remove_files[]"]');
    const countInput = document.getElementById('existing-file-count');

    removeCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const fileItem = this.closest('.file-item');
            let currentCount = parseInt(countInput.value);
            
            if (this.checked) {
                currentCount--;
                if (fileItem) fileItem.classList.add('marked-for-removal');
            } else {
                currentCount++;
                if (fileItem) fileItem.classList.remove('marked-for-removal');
            }
            countInput.value = currentCount;
            
            console.log("Updated file count: " + countInput.value);
        });
    });
});