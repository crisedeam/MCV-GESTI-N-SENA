<?php
// =======================================================
// LISTA BLANCA DE CONTROLADORES Y ACCIONES
// =======================================================
// Esta es una medida de seguridad. Solo las combinaciones que escribas aquí
// van a poder ser ejecutadas por la URL. Si alguien intenta entrar a un controlador
// o acción inventada, el sistema lo bloqueará.
$controllers = [
    'Sede' => ['index', 'register', 'save', 'show', 'updateshow', 'update', 'delete', 'details'],
    'CentroFormacion' => ['index', 'register', 'save', 'show', 'updateshow', 'update', 'delete', 'details'],
    'Coordinacion' => ['index', 'register', 'save', 'show', 'updateshow', 'update', 'delete', 'details'],
    'Ambiente' => ['index', 'register', 'save', 'show', 'updateshow', 'update', 'delete', 'details'],
    'Programa' => ['index', 'register', 'save', 'show', 'updateshow', 'update', 'delete', 'details'],
    'TituloPrograma' => ['index', 'register', 'save', 'show', 'updateshow', 'update', 'delete', 'details'],
    'Competencia' => ['index', 'register', 'save', 'show', 'updateshow', 'update', 'delete', 'details', 'getByPrograma'],
    'Instructor' => ['index', 'register', 'save', 'show', 'updateshow', 'update', 'delete', 'details', 'fichas'],
    'Ficha' => ['index', 'register', 'save', 'show', 'updateshow', 'update', 'delete', 'details'],
    // Nuevos
    'Auth' => ['login', 'authenticate', 'logout'],
    'Home' => ['index'], // En caso de que haya un Home genérico
    'Asignacion' => ['index', 'register', 'save', 'show', 'updateshow', 'update', 'delete', 'details', 'getInstructoresByCompetencia', 'calendar', 'getEventosByInstructor'],
    'DetalleAsignacion' => ['index', 'register', 'save', 'show', 'updateshow', 'update', 'delete', 'details'],
    'InstruCompetencia' => ['index', 'register', 'save', 'show', 'updateshow', 'update', 'delete', 'details'],
    'CompetxPrograma' => ['index', 'register', 'save', 'show', 'updateshow', 'update', 'delete']
];

// =======================================================
// OBTENER LA RUTA SOLICITADA POR LA URL
// =======================================================
$controller = $_GET['controller'] ?? 'Auth'; // Por defecto mandamos al Login si no hay sesión
$action = $_GET['action'] ?? 'login';

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirigir al login si no hay sesión y no estamos en Auth
if (!isset($_SESSION['usuario_id']) && $controller !== 'Auth') {
    $controller = 'Auth';
    $action = 'login';
}

// Redirigir al home (Sede por ahora) si ya hay sesión y estamos intentando ir a Auth/login
if (isset($_SESSION['usuario_id']) && $controller === 'Auth' && ($action === 'login' || $action === 'authenticate')) {
    $controller = 'Sede'; // O Home si tuviéramos
    $action = 'index';
}

// =======================================================
// PROTECCIÓN DE ACCESO POR ROLES (RBAC)
// =======================================================
$rol = $_SESSION['rol'] ?? '';

// Dependiendo del rol, definimos qué controladores tienen permitidos
$permisos = [
    'centro_formacion' => ['Sede', 'CentroFormacion', 'Coordinacion', 'Ambiente', 'Programa', 'TituloPrograma', 'Competencia', 'Instructor', 'Auth', 'Home'],
    'coordinador' => ['Auth', 'Home', 'CompetxPrograma', 'Ficha', 'InstruCompetencia', 'Asignacion', 'DetalleAsignacion', 'Competencia', 'Instructor'], // Se le da acceso a Competencia e Instructor temporalmente para las peticiones AJAX si es necesario
    'instructor' => ['Auth', 'Home', 'Asignacion', 'Instructor']
];

if (array_key_exists($controller, $controllers)) {
    $permisos_rol = $permisos[$rol] ?? ['Auth'];
    // Verificar si el rol actual tiene permiso de acceder a este controlador
    if (in_array($controller, $permisos_rol)) {
        if (in_array($action, $controllers[$controller])) {
            call($controller, $action);
        } else {
            echo "<h2 style='text-align: center; color: red;'>Error: Acción no válida</h2>";
        }
    } else {
        // Redirigir al inicio o mostrar alerta si intenta entrar a un módulo prohibido
        header('Location: ?controller=Home&action=index&error=unauthorized');
        exit;
    }
} else {
    echo "<h2 style='text-align: center; color: red;'>Error: Controlador no válido</h2>";
}


// =======================================================
// EL CORAZÓN DEL ENRUTADOR: LA FUNCIÓN CALL
// =======================================================
// Se encarga de instanciar el controlador y llamar la función.
function call($controller, $action) {
    
    $controllerName = $controller . 'Controller';
    $controllerPath = 'controllers/' . $controllerName . '.php';
    
    // Verificamos si el archivo de controlador ya lo construiste
    if(file_exists($controllerPath)) {
        require_once($controllerPath); // Traemos el controlador
        
        switch ($controller) {
            case 'Sede':
                require_once('models/Sede.php');
                $controllerObj = new SedeController();
                break;
            case 'CentroFormacion':
                require_once('models/CentroFormacion.php');
                $controllerObj = new CentroFormacionController();
                break;
            case 'Coordinacion':
                require_once('models/Coordinacion.php');
                $controllerObj = new CoordinacionController();
                break;
            case 'Ambiente':
                require_once('models/Ambiente.php');
                $controllerObj = new AmbienteController();
                break;
            case 'Programa':
                require_once('models/Programa.php');
                $controllerObj = new ProgramaController();
                break;
            case 'TituloPrograma':
                require_once('models/TituloPrograma.php');
                $controllerObj = new TituloProgramaController();
                break;
            case 'Competencia':
                require_once('models/Competencia.php');
                $controllerObj = new CompetenciaController();
                break;
            case 'Instructor':
                require_once('models/Instructor.php');
                $controllerObj = new InstructorController();
                break;
            case 'Ficha':
                require_once('models/Ficha.php');
                $controllerObj = new FichaController();
                break;
            case 'Auth':
                $controllerObj = new AuthController();
                break;
            case 'Home':
                $controllerObj = new HomeController();
                break;
            case 'Asignacion':
                require_once('models/Asignacion.php');
                $controllerObj = new AsignacionController();
                break;
            case 'DetalleAsignacion':
                require_once('models/DetalleAsignacion.php');
                $controllerObj = new DetalleAsignacionController();
                break;
            case 'InstruCompetencia':
                require_once('models/InstruCompetencia.php');
                $controllerObj = new InstruCompetenciaController();
                break;
            case 'CompetxPrograma':
                require_once('models/CompetxPrograma.php');
                $controllerObj = new CompetxProgramaController();
                break;
            default:
                die("Controlador no definido en el switch de routing.php.");
        }
        
        // Magia de PHP: Llama dinámicamente al método. Si $action es 'save', ejecuta $controllerObj->save()
        if (method_exists($controllerObj, $action)) {
            $controllerObj->{$action}();
        } else {
            echo "<h2 style='text-align: center; color: red;'>El método {$action} no existe en {$controllerName}</h2>";
        }

    } else {
        // MODO "HÍBRIDO" (Mientas terminas de hacer todos los Controladores)
        // Como tú me dijiste que vas a hacer los controladores solito, esta parte
        // temporal permitirá que las Vistas que aún no tienen controlador sigan mostrándose
        if ($action === 'index') {
            $action = 'show'; // Mostramos 'show' internamente cuando piden 'index'
        }
        $viewPath = "views/{$controller}/{$action}.php";
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            echo "<div style='text-align: center; padding: 40px;'><h2 style='color: #6b7280; margin-bottom: 8px;'>Vista en construcción</h2><p style='color: #9ca3af;'>La vista para <strong>{$controller}/{$action}</strong> aún no está disponible.</p></div>";
        }
    }
}
?>
