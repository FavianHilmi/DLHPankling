document.getElementById('select-all').addEventListener('click', function() {
    const checkboxes = document.querySelectorAll('.status-checkbox');
    checkboxes.forEach(checkbox => {
        if (checkbox.getAttribute('data-status') === 'Sedang Diajukan') {
            checkbox.checked = this.checked;
        } else {
            checkbox.checked = false; // Pastikan yang bukan "Sedang Diajukan" tidak dicentang
        }
    });
});
