# Diagramas de Flujo del Sistema

A continuación, se presentan los diagramas de flujo principales del **Sistema de Gestión de Ambientes SENA**, describiendo los procesos clave de autenticación, enrutamiento (RBAC) y la lógica de asignación.

## 1. Flujo de Autenticación (Login)

Este diagrama muestra cómo el sistema valida las credenciales y redirige a los usuarios según su rol.

```mermaid
graph TD
    A[Usuario ingresa a /login] --> B{¿Tiene sesión activa?}
    B -- Sí --> C[Redirigir al Inicio Sede/Home]
    B -- No --> D[Muestra Formulario de Login]

    D --> E[Usuario ingresa Correo, Password y Rol]
    E --> F[Envío POST a AuthController::authenticate]

    F --> G{Validar Rol}

    G -- Centro de Formación --> H[Consultar BD: CENTRO_FORMACION]
    G -- Coordinador --> I[Consultar BD: COORDINACION]
    G -- Instructor --> J[Consultar BD: INSTRUCTOR]

    H & I & J --> K{¿Usuario existe y Password coinciden?}

    K -- No --> L[Mostrar Error: Credenciales incorrectas]
    L --> D

    K -- Sí --> M[Crear Variables de Sesión usuario_id, rol, nombre]
    M --> N[Redirigir a Panel Principal de su Rol]
```

## 2. Flujo de Enrutamiento y Control de Acceso (RBAC)

Este diagrama explica cómo el archivo `routing.php` protege cada vista y controlador del sistema basándose en el rol del usuario conectado.

```mermaid
graph TD
    A[Petición: ?controller=X&action=Y] --> B[Punto de entrada: index.php]
    B --> C[Llamado a routing.php]

    C --> D{¿Existe sesión?}
    D -- No --> E{¿Controlador es Auth?}
    E -- No --> F[Forzar controller=Auth, action=login]
    E -- Sí --> G[Permitir acceso a Auth]

    D -- Sí --> H[Obtener 'rol' de la sesión actual]
    F --> G

    H --> I{¿Controlador existe en Lista Blanca?}
    I -- No --> J[Error: Controlador no válido]

    I -- Sí --> K{¿Rol tiene permiso para Controlador?}
    K -- No --> L[Redirigir a Home con error Unauthorized]

    K -- Sí --> M{¿Acción existe en Controlador?}
    M -- No --> N[Error: Acción no válida]

    M -- Sí --> O[Instanciar ControladorX]
    O --> P[Ejecutar Función Y del ControladorX]
    P --> Q[Renderizar Vista o JSON]
```

## 3. Flujo Principal de Asignación de Ambientes

Este es el proceso "Core" del sistema donde un Coordinador asigna un horario a un instructor, grupo y ambiente, evitando colisiones.

```mermaid
graph TD
    A[Coordinador en Vista de Asignación] --> B[Selecciona Ficha, Ambiente, Instructor y Competencia]
    B --> C[Selecciona Rango de Fechas / Horas]
    C --> D[Envío POST a AsignacionController::save]

    D --> E{Validar Disponibilidad en BD}

    E --> F{¿Ambiente ocupado en esa hora?}
    F -- Sí --> G[Rechazar: Conflicto de Ambiente]

    F -- No --> H{¿Instructor ocupado en esa hora?}
    H -- Sí --> I[Rechazar: Conflicto de Instructor]

    H -- No --> J{¿Ficha ocupada en esa hora?}
    J -- Sí --> K[Rechazar: Conflicto de Ficha]

    G & I & K --> L[Mostrar Alerta de Error al Coordinador]

    J -- No --> M[Crear registro en tabla ASIGNACION]
    M --> N[Crear registros en tabla DETALLExASIGNACION]
    N --> O[Asignación Exitosa]
    O --> P[Actualizar Calendario / Vista]
```
