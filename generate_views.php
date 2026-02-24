<?php
// Generador de vistas
$models = [
    'Sede' => [
        'id' => 'sede_id', 'fields' => [
            ['name' => 'sede_nombre', 'label' => 'Nombre de la Sede', 'type' => 'text']
        ]
    ],
    'CentroFormacion' => [
        'id' => 'cent_id', 'fields' => [
            ['name' => 'cent_nombre', 'label' => 'Nombre del Centro', 'type' => 'text']
        ]
    ],
    'Coordinacion' => [
        'id' => 'coord_id', 'fields' => [
            ['name' => 'coord_nombre', 'label' => 'Nombre Coordinación', 'type' => 'text'],
            ['name' => 'CENTRO_FORMACION_cent_id', 'label' => 'Centro Formación', 'type' => 'fk', 'fk_model' => 'CentroFormacion', 'fk_id' => 'cent_id', 'fk_name' => 'cent_nombre']
        ]
    ],
    'Ambiente' => [
        'id' => 'amb_id', 'fields' => [
            ['name' => 'amb_nombre', 'label' => 'Nombre del Ambiente', 'type' => 'text'],
            ['name' => 'SEDE_sede_id', 'label' => 'Sede', 'type' => 'fk', 'fk_model' => 'Sede', 'fk_id' => 'sede_id', 'fk_name' => 'sede_nombre']
        ]
    ],
    'Competencia' => [
        'id' => 'comp_id', 'fields' => [
            ['name' => 'comp_nombre_corto', 'label' => 'Nombre Corto', 'type' => 'text'],
            ['name' => 'comp_nombre_unidad_competencia', 'label' => 'Unidad Competencia', 'type' => 'text'],
            ['name' => 'comp_horas', 'label' => 'Horas', 'type' => 'number']
        ]
    ],
    'Programa' => [
        'id' => 'prog_codigo', 'fields' => [
            ['name' => 'prog_denominacion', 'label' => 'Denominación', 'type' => 'text'],
            ['name' => 'prog_tipo', 'label' => 'Tipo de Programa', 'type' => 'select', 'options' => ['Tecnólogo', 'Técnico', 'Especialización']],
            ['name' => 'TIT_PROGRAMA_titpro_id', 'label' => 'Título', 'type' => 'fk', 'fk_model' => 'TituloPrograma', 'fk_id' => 'titpro_id', 'fk_name' => 'titpro_nombre']
        ]
    ],
    'TituloPrograma' => [
        'id' => 'titpro_id', 'fields' => [
            ['name' => 'titpro_nombre', 'label' => 'Nombre del Título', 'type' => 'text']
        ]
    ],
    'Instructor' => [ // Nota: falta la 's' de instructor en el modelo, lo mantengo así
        'id' => 'inst_id', 'fields' => [
            ['name' => 'inst_nombre', 'label' => 'Nombre', 'type' => 'text'],
            ['name' => 'inst_apellido', 'label' => 'Apellido', 'type' => 'text'],
            ['name' => 'inst_correo', 'label' => 'Correo', 'type' => 'text'],
            ['name' => 'inst_telefono', 'label' => 'Teléfono', 'type' => 'text'],
            ['name' => 'CENTRO_FORMACION_cent_id', 'label' => 'Centro Formación', 'type' => 'fk', 'fk_model' => 'CentroFormacion', 'fk_id' => 'cent_id', 'fk_name' => 'cent_nombre']
        ]
    ],
    'Ficha' => [
        'id' => 'fich_id', 'fields' => [
            ['name' => 'PROGRAMA_prog_id', 'label' => 'Programa', 'type' => 'fk', 'fk_model' => 'Programa', 'fk_id' => 'prog_codigo', 'fk_name' => 'prog_denominacion'],
            ['name' => 'INSTRUCTOR_ins_id_lider', 'label' => 'Instructor Líder', 'type' => 'fk', 'fk_model' => 'Instructor', 'fk_id' => 'inst_id', 'fk_name' => 'inst_nombre'],
            ['name' => 'fich_jornada', 'label' => 'Jornada', 'type' => 'select', 'options' => ['Diurna', 'Nocturna', 'Mixta']],
            ['name' => 'COORDINACION_coord_id', 'label' => 'Coordinación', 'type' => 'fk', 'fk_model' => 'Coordinacion', 'fk_id' => 'coord_id', 'fk_name' => 'coord_nombre']
        ]
    ]
];

$basePath = "c:/xampp/htdocs/mvc-gestion-de-ambientes/views/";

foreach ($models as $modelName => $data) {
    
    // Preparar el bloque PHP de requerimientos al inicio del archivo si hay selects
    $phpHeader = "";
    $fks = array_filter($data['fields'], function($f) { return $f['type'] === 'fk'; });
    if (count($fks) > 0) {
        $phpHeader .= "<?php\n";
        foreach ($fks as $fk) {
            $phpHeader .= "require_once 'models/{$fk['fk_model']}.php';\n";
            $phpHeader .= "\${$fk['fk_model']}List = {$fk['fk_model']}::all();\n";
        }
        $phpHeader .= "?>\n";
    }

    foreach (['register', 'updateshow'] as $view) {
        $isUpdate = $view === 'updateshow';
        $title = $isUpdate ? "Actualizar $modelName" : "Registrar $modelName";
        $subtitle = $isUpdate ? "Modifique los detalles de este registro." : "Ingrese los detalles requeridos.";
        $buttonText = $isUpdate ? "Actualizar $modelName" : "Guardar $modelName";
        $icon = "fa-file-signature";
        $actionUrl = $isUpdate ? "?controller={$modelName}&action=update" : "?controller={$modelName}&action=save";

        $html = $phpHeader;
        $html .= "<div class='view-container'>
    <div class='breadcrumb'>
        <span style='text-transform: uppercase;'>Administración</span>
        <i class='fa-solid fa-chevron-right' style='font-size: 10px;'></i>
        <a href='?controller={$modelName}&action=index' style='color: #39A900; text-decoration: none; font-weight: 700; text-transform: uppercase;'>{$title}</a>
    </div>

    <div class='view-header' style='margin-bottom: 0;'>
        <div class='view-title-block'>
            <h1>{$title}</h1>
            <p>{$subtitle}</p>
        </div>
    </div>

    <div class='form-container'>
        <div class='form-side-panel'>
            <div class='panel-header'>
                <i class='fa-solid {$icon}'></i>
                <h3>" . ($isUpdate ? "Edición" : "Registro") . "</h3>
                <p>Complete la información solicitada en el formulario para {$modelName}.</p>
            </div>
        </div>

        <div class='form-main-panel'>
            <form action='{$actionUrl}' method='POST'>
                <div class='form-grid'>
";
        // Always add the ID field
        $valId = $isUpdate ? "value='1'" : ""; // Dummy value for update view
        $readonlyId = $isUpdate ? "readonly style='background-color: #f8fafc;'" : "";
        $html .= "                    <div class='form-group full-width'>
                        <label for='{$data['id']}'>ID / Identificador</label>
                        <input type='number' id='{$data['id']}' name='{$data['id']}' class='form-control' placeholder='Ej: 1' $valId $readonlyId>
                    </div>\n";

        foreach ($data['fields'] as $field) {
            $val = $isUpdate ? "value='Ejemplo'" : "";
            $html .= "                    <div class='form-group full-width'>\n";
            $html .= "                        <label for='{$field['name']}'>{$field['label']}</label>\n";
            
            if ($field['type'] === 'fk') {
                $html .= "                        <select id='{$field['name']}' name='{$field['name']}' class='form-control'>\n";
                $html .= "                            <option value=''>Seleccione...</option>\n";
                $html .= "                            <?php foreach(\${$field['fk_model']}List as \$item): ?>\n";
                $getterId = "get" . ucfirst($field['fk_id']);
                $getterName = "get" . ucfirst($field['fk_name']);
                $html .= "                                <option value='<?= \$item->{$getterId}() ?>'><?= \$item->{$getterName}() ?></option>\n";
                $html .= "                            <?php endforeach; ?>\n";
                $html .= "                        </select>\n";
            } elseif ($field['type'] === 'select') {
                $html .= "                        <select id='{$field['name']}' name='{$field['name']}' class='form-control'>\n";
                foreach ($field['options'] as $opt) {
                    $html .= "                            <option value='{$opt}'>{$opt}</option>\n";
                }
                $html .= "                        </select>\n";
            } else {
                $html .= "                        <input type='{$field['type']}' id='{$field['name']}' name='{$field['name']}' class='form-control' $val>\n";
            }
            $html .= "                    </div>\n";
        }

        $html .= "                </div>

                <div class='form-actions'>
                    <a href='?controller={$modelName}&action=index' class='btn-secondary' style='text-decoration: none;'>Cancelar</a>
                    <button type='submit' class='btn-success'>
                        <i class='fa-regular fa-floppy-disk'></i> {$buttonText}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>";

        $filepath = $basePath . $modelName . '/' . $view . '.php';
        file_put_contents($filepath, $html);
    }
}

echo "Generación completada.";
