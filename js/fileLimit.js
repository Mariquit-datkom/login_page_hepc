function validateFileLimit(input) {
    const existingCount = parseInt(document.getElementById('existing-file-count').value) || 0;
    const newFilesCount = input.files.length;
    const totalCount = existingCount + newFilesCount;
    const maxLimit = 5;

    if (totalCount > maxLimit) {
        alert(`Limit exceeded! You already have ${existingCount} file(s) uploaded. ` + 
              `You can only add ${maxLimit - existingCount} more, but you selected ${newFilesCount}.`);
        
        // Clear the input so they have to pick a valid amount
        input.value = ""; 
    }
}