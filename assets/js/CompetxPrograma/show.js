function filterTable() {
    let input = document.getElementById("searchInput");
    let filter = input.value.toUpperCase();
    let table = document.getElementById("dataTable");
    if (table) {
        let tr = table.getElementsByTagName("tr");
        for (let i = 1; i < tr.length; i++) {
            let textValue = tr[i].textContent || tr[i].innerText;
            if (textValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
