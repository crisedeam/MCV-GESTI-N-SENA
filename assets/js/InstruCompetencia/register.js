document.addEventListener('DOMContentLoaded', function () {
    const progSelect = document.getElementById('COMPETxPROGRAMA_PROGRAMA_prog_id');
    const compSelect = document.getElementById('COMPETxPROGRAMA_COMPETENCIA_comp_id');

    if (progSelect && compSelect) {
        progSelect.addEventListener('change', function () {
            const progId = this.value;

            compSelect.innerHTML = '<option value="">Cargando competencias...</option>';
            compSelect.disabled = true;

            if (progId) {
                fetch(`?controller=Competencia&action=getByPrograma&prog_id=${progId}`)
                    .then(response => response.json())
                    .then(data => {
                        compSelect.innerHTML = '<option value="">Seleccione una competencia...</option>';
                        if (data.length > 0) {
                            data.forEach(comp => {
                                const option = document.createElement('option');
                                option.value = comp.id;
                                option.textContent = comp.nombre;
                                compSelect.appendChild(option);
                            });
                            compSelect.disabled = false;
                        } else {
                            compSelect.innerHTML = '<option value="">Aviso: Ninguna competencia asignada a este programa</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching competencias:', error);
                        compSelect.innerHTML = '<option value="">Error cargando competencias</option>';
                    });
            } else {
                compSelect.innerHTML = '<option value="">Primero seleccione un programa...</option>';
            }
        });
    }
});
