function filterTable() {
    let input = document.getElementById("searchInput");
    let filter = input.value.toUpperCase();
    let programSelect = document.getElementById("programFilter");
    let programFilter = programSelect ? programSelect.value : "";
    let table = document.getElementById("dataTable");

    if (table) {
        let tr = table.getElementsByTagName("tr");
        for (let i = 1; i < tr.length; i++) {
            // Ignore empty state row if it exists
            if (tr[i].querySelector('.empty-table-message')) continue;

            let textValue = tr[i].textContent || tr[i].innerText;
            let rowProgram = tr[i].getAttribute("data-programa");

            let textMatch = textValue.toUpperCase().indexOf(filter) > -1;
            let programMatch = programFilter === "" || rowProgram === programFilter;

            if (textMatch && programMatch) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
