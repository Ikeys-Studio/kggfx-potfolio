document.addEventListener("DOMContentLoaded", () => {
  const input = document.getElementById("searchInput");
  input.addEventListener("keyup", function () {
    const filter = input.value.toLowerCase();
    const rows = document.querySelectorAll("#visitorsTable tbody tr");
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(filter) ? "" : "none";
    });
  });

  window.downloadCSV = function () {
    const rows = document.querySelectorAll("table tr");
    let csv = [];

    rows.forEach(row => {
      const cols = row.querySelectorAll("td, th");
      const rowData = [...cols].map(col => `"${col.textContent.trim()}"`);
      csv.push(rowData.join(","));
    });

    const csvContent = csv.join("\n");
    const blob = new Blob([csvContent], { type: "text/csv" });
    const url = URL.createObjectURL(blob);

    const a = document.createElement("a");
    a.setAttribute("href", url);
    a.setAttribute("download", "visitors.csv");
    a.click();
  };
});