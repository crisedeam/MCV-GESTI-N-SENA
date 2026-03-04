# Documentación del Sistema de Gestión de Ambientes - SENA

## 1. Introducción

El **Sistema de Gestión de Ambientes (SENA)** es una aplicación web diseñada para la planificación, asignación y administración eficiente de los recursos físicos (ambientes) e instructores del Servicio Nacional de Aprendizaje. Fue desarrollada utilizando un patrón arquitectónico **MVC (Modelo-Vista-Controlador)** en PHP puro (Vanilla), sin frameworks pesados, garantizando un rendimiento óptimo y una separación estricta de responsabilidades.

## 2. Arquitectura del Proyecto

El proyecto implementa un patrón **MVC** tradicional:

- **Modelos (`/models`)**: Clases que interactúan directamente con la base de datos (MySQL). Contienen las consultas SQL (CRUD y consultas complejas).
- **Controladores (`/controllers`)**: Contienen la lógica de negocio. Reciben las peticiones del usuario, validan datos, llaman a los Modelos necesarios y cargan las Vistas correspondientes.
- **Vistas (`/views`)**: Interfaces de usuario (HTML mezclado con PHP para datos dinámicos).
- **Enrutador (`routing.php`)**: Actúa como el Front Controller. Define una "lista blanca" de controladores y acciones permitidas, e implementa el **Control de Acceso Basado en Roles (RBAC)** antes de instanciar un controlador.
- **Punto de Entrada (`index.php`)**: Carga recursos globales (CSS, scripts de UI), maneja el layout general (sidebar, topbar) e incluye al enrutador.

## 3. Estructura de Base de Datos

La base de datos relacional (`ProgSENA`) consta de las siguientes entidades principales que modelan la estructura educativa del SENA:

### Entidades de Organización Física

- **SEDE**: Representa una instalación física general.
- **AMBIENTE**: Aulas, laboratorios o recursos asignables (relacionado a una SEDE).

### Entidades Académicas

- **TITULO_PROGRAMA**: Categorías de programas (Ej. Tecnólogo, Técnico).
- **PROGRAMA**: Programa de formación ofertado (relacionado a TITULO_PROGRAMA).
- **COMPETENCIA**: Resultadas de aprendizaje/materias impartidas.
- **COMPETxPROGRAMA**: Tabla puente que asocia competencias a un programa estructurado.
- **FICHA**: Un grupo específico de aprendices (relacionado a PROGRAMA).

### Entidades de Usuarios y Gestión

- **CENTRO_FORMACION**: Actúa como superadministrador supremo o entidad macro.
- **COORDINACION**: Usuario con rol de coordinador (gestiona asignaciones y fichas).
- **INSTRUCTOR**: Usuario docente.

### Entidades Asignación (El "Core" del sistema)

- **ASIGNACION**: Representa la vinculación temporal en la que un **Instructor** dicta una **Competencia** a una **Ficha** en un **Ambiente** determinado.
- **DETALLExASIGNACION**: Especifica las horas y fechas exactas de dicha asignación.
- **INSTRU_COMPETENCIA**: Define qué competencias está capacitado para impartir cada instructor.

## 4. Perfiles y Permisos (RBAC)

El sistema gestiona accesos mediante 3 roles principales definidos en `routing.php`:

1. **CENTRO_FORMACION (Super Admin)**: Acceso a todos los módulos (`Sede`, `CentroFormacion`, `Coordinacion`, `Ambiente`, `Programa`, etc.).
2. **COORDINADOR**: Tiene control operativo. Puede gestionar asignaciones, revisar perfiles de instructores y detalles de competencias (`Asignacion`, `Ficha`, `InstruCompetencia`, etc.). No puede crear o eliminar infraestructuras (como Sedes).
3. **INSTRUCTOR**: Acceso restringido (Solo-lectura). Solo puede acceder a su propia agenda en el calendario, ver las fichas que le fueron asignadas y revisar su panel de inicio.

## 5. Tecnologías Utilizadas

- **Backend**: PHP 8 (Orientado a Objetos - MVC).
- **Base de Datos**: MySQL via PDO (Prepared Statements).
- **Frontend / UI**:
  - HTML5, CSS3, JavaScript Vanilla.
  - Diseño _Responsive_ basado en un sistema de tarjetas (Cards).
  - Integración de **Modo Oscuro/Claro** gestionado por LocalStorage.
  - Tipografías: Google Fonts (Outfit).
  - Íconos: FontAwesome.
- **Librerías Adicionales**:
  - [FullCalendar](https://fullcalendar.io/): Renderizado del calendario de horarios interactivo y asignador de turnos.

## 6. Flujo de Trabajo y Seguridad

1. **Autenticación**: Validación de credenciales a través de `AuthController.php`. Las contraseñas están fuertemente cifradas en base de datos.
2. **Autorización**: Intervención de `routing.php` que corta cualquier ejecución si la sesión o el rol intentan acceder a una acción (`$_GET['action']`) no contemplada en la lista blanca de `$permisos`.
3. **Control de Conflictos**: El modelo de `ASIGNACION` está diseñado (usando triggers y cruce de validaciones de backend) para prevenir simultaneidad de cruces, es decir: prohibe asignar el mismo ambiente o el mismo instructor a dos fichas diferentes exactamente en la misma fecha y hora.

## 7. Instrucciones para Desarrollo Local

Para desplegar este ambiente en local para futuros cambios:

1. Activar Apache y MySQL en XAMPP/WAMP.
2. Crear una BBDD en phpMyAdmin e importar el archivo `base.sql`.
3. Configurar las credenciales en `connection.php`.
4. Ingresar al index vía `http://localhost/mvc-gestion-de-ambientes`.

_Las credenciales por defecto insertadas en la BD son `centro@sena.edu.co`, `coordinador@sena.edu.co` e `instructor@sena.edu.co`._
