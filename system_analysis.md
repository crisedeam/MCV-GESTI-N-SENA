# Análisis Exhaustivo del Sistema de Gestión de Ambientes - SENA

## 1. Visión General de la Arquitectura

El sistema está construido bajo un patrón **MVC (Modelo-Vista-Controlador)** puro y artesanal en **PHP 8** sin depender de frameworks de terceros como Laravel o Symfony. Esto proporciona un control absoluto sobre el flujo de ejecución y un rendimiento muy ligero, mitigando el "overhead" de librerías innecesarias.

### Componentes Principales:

- **Enrutador Central (`routing.php`)**: Funciona como un "Front Controller" que intercepta todas las peticiones web, gestiona las sesiones y aplica una capa de Autorización basada en Roles (RBAC).
- **Punto de Entrada (`index.php`)**: Gestiona el layout global de la aplicación (Sidebar, CSS, scripts principales) e incluye al enrutador de forma dinámica para cargar las vistas específicas.
- **Gestor de Conexión (`connection.php`)**: Implementa un patrón Singleton manual para conectarse a **MySQL** vía **PDO**, garantizando el uso de sentencias preparadas para prevenir inyecciones SQL.

---

## 2. Análisis del Esquema de Base de Datos (`ProgSENA`)

El modelo relacional está altamente normalizado y pensado para la escalabilidad de la gestión educativa del SENA. Contiene 13 tablas principales enfocadas en cuatro dominios:

### 2.1 Dominio Físico y Administrativo

- **`SEDE` y `AMBIENTE`**: Relación 1:N. Una sede posee múltiples ambientes físicos. El código del ambiente se maneja como un `VARCHAR(5)` permitiendo nomenclaturas estándar.
- **`CENTRO_FORMACION` y `COORDINACION`**: Un Centro de Formación supervisa múltiples coordinaciones operativas.

### 2.2 Dominio Educativo y Planes de Estudio

- **`TITULO_PROGRAMA` y `PROGRAMA`**: Agrupación de programas por nivel técnico/tecnólogo.
- **`COMPETENCIA` y `COMPETxPROGRAMA`**: Modelado N:M que permite que un programa comparta competencias iguales con otros programas. Esta es una optimización clave del modelo.

### 2.3 Dominio Operativo (El Núcleo del Sistema)

- **`INSTRUCTOR`**: Contiene la información de contacto y credenciales de acceso (con contraseñas hasheadas en Bcrypt) de los docentes. Relacionado al `CENTRO_FORMACION`.
- **`FICHA`**: Representa a los grupos de aprendices. Actúa como el puente entre el `PROGRAMA`, un `INSTRUCTOR` líder de ficha y una `COORDINACION`.
- **`INSTRU_COMPETENCIA`**: Aval técnico. Define si un instructor está rigurosamente capacitado para dictar una `COMPETENCIA` específica dentro de un `PROGRAMA`.

### 2.4 El Eje de Control: Asignaciones

- **`ASIGNACION` y `DETALLExASIGNACION`**: Implementa el agendamiento. `ASIGNACION` vincula a un Instructor, un Ambiente, una Competencia y una Ficha dentro de un rango de fechas de contrato. `DETALLExASIGNACION` define las horas y días exactos en la semana dentro de esa vigencia.

---

## 3. Análisis de Seguridad y Control de Acceso (RBAC)

La seguridad se centraliza en `routing.php`. El sistema maneja 3 roles jerárquicos:

1.  **Centro_Formacion (Súper Administrador)**: Tiene permisos absolutos sobre la infraestructura (crear sedes, ambientes, programas y coordinadores).
2.  **Coordinador (Gestor Operativo)**: Configura la oferta educativa. Asigna instructores a fichas en ambientes específicos. **No puede** modificar información de Sedes o Programas, sólo operar con los existentes.
3.  **Instructor (Usuario Final)**: Permisos de lectura. Solo puede consultar su propio horario (calendario) y ver qué fichas le han sido asignadas.

_Mecanismos Defensivos:_

- **White-Listing**: Las peticiones por URL genéricas son filtradas por un array restrictivo (`$controllers`). Si una solicitud no coincide, es rechazada.
- **Sesiones Estrictas**: Intentar acceder a un controlador sin sesión redirige automáticamente al login (`AuthController`).

---

## 4. Análisis de Controladores y Modelos

El código backend sigue el principio de **Responsabilidad Única**.

- **Validaciones Re robustas**: En controladores como `AsignacionController.php`, antes de guardar en la base de datos, el sistema valida:
  1.  Que no existan fechas invertidas (`fecha_ini > fecha_fin`).
  2.  Que la vigencia semanal no se superponga (máximo 7 días por detalle lógico).
  3.  Llamadas al método transaccional `checkDuplicate` en el Modelo para evitar cruces (Ej. Mismo instructor, mismo ambiente en la misma ficha simultáneamente).
- **Modelos Orientados a Objetos**: Cada tabla de la BBDD es instanciada en memoria con `Getters` y `Setters`. Las consultas evitan el "N+1 Problem" al emplear `JOIN`s eficientes dentro del método `all()` para traer nombres correlacionados (Ej. Traer "nombre_instructor" en lugar de "inst_id").

---

## 5. Análisis del Frontend y UI/UX

La interfaz de usuario es moderna y muy dinámica, construida íntegramente con HTML/CSS/JS (Vanilla).

- **Diseño Card-Based (Grid UI)**: El sistema abandona listados aburridos por un dashboard visual. Las listas maestras (Sedes, Fichas, Ambientes) se presentan como tarjetas en forma de cuadrícula (Grid), haciendo que la lectura sea amigable.
- **Modo Oscuro (Dark Theme)**: Implementación nativa mediante variables de CSS (Custom Properties). El estado del tema se guarda en el `LocalStorage` del navegador, brindando persistencia de experiencia mediante el evento de un toggle button (`#themeToggleBtn`).
- **Responsividad Nativa**: Utiliza Media Queries intensamente en `assets/css/main.css` y `assets/css/views.css`. Incluye una versión móvil del Sidebar accesible por un botón estilo hamburguesa que usa un _overlay_.
- **Interactividad y Calendarios**: Integración robusta de **FullCalendar** en las vistas `calendar.php` para visualizar las horas asignadas en formato de semana/mes al estilo Google Calendar.

---

## 6. Oportunidades de Mejora / Deuda Técnica (Technical Debt)

Tras el análisis de código profundo, se sugieren las siguientes mejoras futuras:

1.  **Migrar el Frontend JS a Módulos**: Parte del JS y código híbrido en las vistas podría ser movido a archivos JS separados por dominio y cargados como `type="module"`, para reducir la mezcla en algunas vistas.
2.  **Manejo de Transacciones Globales Explicitas**: En operaciones donde se inserta una matriz (`ASIGNACION` + `DETALLExASIGNACION`), sería óptimo encerrar los bucles `while` dentro de bloques `try { $db->beginTransaction(); ... $db->commit(); } catch() { $db->rollBack(); }` para evitar inconsistencias si el servidor falla a la mitad del proceso.
3.  **Namespace en PHP**: Iniciar las clases con espaciado de nombres `namespace App\Controllers;` evitaría choques de clases o el uso intensivo de `require_once` cada vez.
4.  **Sistema de Login para Diferentes Tablas**: Actualmente `AuthController` divide la búsqueda de credenciales consultando en 3 tablas diferentes (`CENTRO`, `COORDINACION`, `INSTRUCTOR`). Una mejora sería unificar el control de credenciales en una sola tabla genérica tipo `USUARIOS_SISTEMA` y de allí generar los FK a los roles, simplificando significativamente el AuthController.

**Conclusión:**
El sistema presenta una arquitectura altamente robusta, ideal para un entorno académico. Su modelo de datos atiende la casuística de horarios complejos del SENA de manera meticulosa y eficaz, y la UI ofrece una apariencia premium sin inflar el peso de carga del software.
