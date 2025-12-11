document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("table").forEach((table) => {
        table.querySelectorAll("th[data-sortable]").forEach((th) => {
            const trigger = th.querySelector("a");
            if (!trigger) return;

            let ascending = true;

            trigger.addEventListener("click", (e) => {
                e.preventDefault();

                const tbody = table.querySelector("tbody");
                const rows = Array.from(tbody.querySelectorAll("tr"));
                const index = Array.from(th.parentNode.children).indexOf(th);
                const type = th.dataset.sortable;

                rows.sort((a, b) => {
                    const cellA =
                        a.children[index]
                            .querySelector("span")
                            ?.textContent.trim() ||
                        a.children[index].textContent.trim();
                    const cellB =
                        b.children[index]
                            .querySelector("span")
                            ?.textContent.trim() ||
                        b.children[index].textContent.trim();

                    if (type === "number") {
                        const numA = parseFloat(cellA) || 0;
                        const numB = parseFloat(cellB) || 0;
                        return ascending ? numA - numB : numB - numA;
                    } else {
                        return ascending
                            ? cellA.localeCompare(cellB)
                            : cellB.localeCompare(cellA);
                    }
                });

                tbody.append(...rows);
                ascending = !ascending;
            });
        });
    });
});
