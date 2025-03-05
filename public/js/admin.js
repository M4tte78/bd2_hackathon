document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("search-employee");
    searchInput.addEventListener("keyup", function() {
        let filter = searchInput.value.toLowerCase();
        let rows = document.querySelectorAll(".employee-table tbody tr");

        rows.forEach(row => {
            let name = row.cells[2].textContent.toLowerCase();
            let prenom = row.cells[3].textContent.toLowerCase();
            row.style.display = (name.includes(filter) || prenom.includes(filter)) ? "" : "none";
        });
    });
});
