const searchInput = document.getElementById("searchInput");
const table = document.getElementById("classTable");
const rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");

searchInput.addEventListener("keyup", function () {
    const keyword = this.value.toLowerCase();

    for (let i = 0; i < rows.length; i++) {
        let found = false;
        const cells = rows[i].getElementsByTagName("td");

        for (let j = 0; j < cells.length; j++) {
            if (cells[j].innerText.toLowerCase().includes(keyword)) {
                found = true;
                break;
            }
        }

        rows[i].style.display = found ? "" : "none";
    }
});
