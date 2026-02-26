document.addEventListener('DOMContentLoaded', function () {
    const compSelect = document.getElementById('COMPETENCIA_comp_id');
    const instSelect = document.getElementById('INSTRUCTOR_inst_id');

    if (compSelect && instSelect) {
        compSelect.addEventListener('change', function () {
            const compId = this.value;

            // Reset and disable instructor select while loading
            instSelect.innerHTML = '<option value="">Cargando instructores...</option>';
            instSelect.disabled = true;

            if (compId) {
                fetch(`?controller=Asignacion&action=getInstructoresByCompetencia&comp_id=${compId}`)
                    .then(response => response.json())
                    .then(data => {
                        instSelect.innerHTML = '<option value="">Seleccione Instructor...</option>';
                        if (data.length > 0) {
                            data.forEach(inst => {
                                const option = document.createElement('option');
                                option.value = inst.id;
                                option.textContent = inst.nombre;
                                instSelect.appendChild(option);
                            });
                            instSelect.disabled = false;
                        } else {
                            instSelect.innerHTML = '<option value="">Aviso: Ningún instructor avalado vigente</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching instructors:', error);
                        instSelect.innerHTML = '<option value="">Error cargando instructores</option>';
                    });
            } else {
                instSelect.innerHTML = '<option value="">Primero seleccione una Competencia...</option>';
            }
        });
    }
});
