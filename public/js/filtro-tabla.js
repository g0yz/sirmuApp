document.addEventListener('DOMContentLoaded', function () {
    const table = document.querySelector('table');
    const rows = table.querySelectorAll('tbody tr');
    const thead = table.querySelector('thead');
    let activeFilterRow = null;
    let activeColIndex = null;

    // Manejar clic en iconos de filtro
    document.querySelectorAll('.filter-icon').forEach(icon => {
        icon.addEventListener('click', () => {
            const colIndex = parseInt(icon.getAttribute('data-col'), 10);

            // Si se hace clic nuevamente en el mismo filtro → quitarlo y resetear tabla
            if (activeFilterRow && activeColIndex === colIndex) {
                activeFilterRow.remove();
                activeFilterRow = null;
                activeColIndex = null;
                rows.forEach(r => r.style.display = '');
                return;
            }

            // Si ya hay un filtro abierto, lo eliminamos antes de crear otro
            if (activeFilterRow) {
                activeFilterRow.remove();
                activeFilterRow = null;
                rows.forEach(r => r.style.display = '');
            }

            // Crear la fila de filtros
            const filterRow = document.createElement('tr');
            filterRow.classList.add('filter-row');
            const thCount = thead.querySelectorAll('th').length;

            for (let i = 0; i < thCount; i++) {
                const cell = document.createElement('th');

                if (i === colIndex) {
                    const input = document.createElement('input');
                    input.type = 'text';
                    input.placeholder = 'Filtrar...';
                    input.classList.add('filter-inline');
                    cell.appendChild(input);

                    // Escuchar la escritura del usuario
                    input.addEventListener('keyup', () => {
                        const term = input.value.toLowerCase();
                        rows.forEach(row => {
                            const cells = row.querySelectorAll('td');
                            const text = cells[colIndex]?.innerText.toLowerCase() ?? '';
                            row.style.display = text.includes(term) ? '' : 'none';
                        });
                    });

                    // Enfocar automáticamente
                    setTimeout(() => input.focus(), 50);
                }

                filterRow.appendChild(cell);
            }

            // Insertar la fila debajo del encabezado principal
            thead.appendChild(filterRow);
            activeFilterRow = filterRow;
            activeColIndex = colIndex;
        });
    });
});
