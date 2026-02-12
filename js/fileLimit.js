function checkFileLimit(input) {
    if (input.files.length > 5) {
        alert("You can only upload a maximum of 5 files.");
        input.value = ""; // Clear the selection
    }
}