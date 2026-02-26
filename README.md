# Sistema de Gestión de Ambientes - SENA

## 🏢 Sobre el Proyecto

El **Sistema de Gestión de Ambientes** es una aplicación web desarrollada con el patrón de arquitectura **MVC (Modelo-Vista-Controlador)** en PHP puro (Vanilla). Su propósito principal es facilitar al Servicio Nacional de Aprendizaje (SENA) la planificación, asignación y administración eficiente de los recursos de formación físicos (ambientes) e instructores.

## ✨ Características Principales

- **Arquitectura MVC Limpia:** Separación estricta de responsabilidades entre modelos de datos, controladores de negocio y vistas de interfaz de usuario.
- **Gestión Multi-Nivel:** Administración completa (CRUD) de:
  - Sedes y Centros de Formación
  - Ambientes de Aprendizaje (Aulas, Talleres, Laboratorios)
  - Programas de Formación y Competencias
  - Fichas e Instructores
- **Motor de Asignación Avanzado:**
  - Sistema de asignación de horarios interactivo y visual.
  - Vistas de calendario (vía FullCalendar) interactivo para Instructores y Coordinadores.
  - Validación de conflictos de horarios (misma hora, mismo ambiente, mismo instructor).
- **Control de Roles Integrado:**
  - **Coordinador:** Acceso total, capacidad de asignar y modificar los horarios.
  - **Instructor:** Acceso de sólo lectura a su agenda personal, tablero con sus fichas asignadas y horas correspondientes.
- **Diseño UI/UX Moderno:**
  - Sistema de tarjetas (Cards) minimalista e intuitivo.
  - Tema Claro/Oscuro dinámico (Dark Mode con switch).
  - Interfaz totalmente _Responsive_ adaptada para escritorio y dispositivos móviles.
- **Seguridad:**
  - Enrutamiento protegido `AuthMiddleware` en cada petición.
  - Evita asignaciones duplicadas a través de validación estricta en el servidor.
  - Tablas de Auditoría (Triggers en Bases de Datos) para trazabilidad de creación y eliminación de agendas.

## 🛠️ Tecnologías Empleadas

- **Backend:** PHP 8+ (Estilo Orientado a Objetos - MVC)
- **Base de Datos:** MySQL (PDO - Prepared Statements)
- **Frontend:** HTML5, CSS3, JavaScript Vanilla
- **Librerías Adicionales:**
  - [FullCalendar](https://fullcalendar.io/) (Renderizado de calendarios interactivos)
  - [FontAwesome](https://fontawesome.com/) (Íconos UI vectoriales)
  - [Google Fonts](https://fonts.google.com/) (Tipografía 'Outfit')

## 🚀 Instalación y Despliegue Local

1. **Clonar el repositorio:**

   ```bash
   git clone https://github.com/crisedeam/MCV-GESTI-N-SENA.git
   ```

2. **Configurar el entorno del servidor local:**
   - Instala [XAMPP](https://www.apachefriends.org/es/index.html) o cualquier servidor equivalente (WAMP, Laragon, etc).
   - Mueve o clona la carpeta del proyecto a tu directorio público web (por ejemplo: `C:\xampp\htdocs\mvc-gestion-de-ambientes`).

3. **Configurar la Base de Datos:**
   - Abre tu cliente MySQL favorito (ej. phpMyAdmin desde `http://localhost/phpmyadmin`).
   - Crea una base de datos en blanco.
   - Importa el archivo `base.sql` (y luego las tablas de configuración adicionales como `auditoria_asignacion.sql` si las deseas) que se encuentran en la raíz del proyecto.

4. **Conexión de Base de Datos:**
   - Edita el archivo de conexión si tus credenciales locales son distintas, este suele estar en `connection.php` o similar en la raíz/carpeta `models`.

   ```php
   // connection.php (Ejemplo)
   $mysqlConnect = "mysql:host=localhost;dbname=nombre_tu_base_de_datos;charset=utf8";
   $usuario = "root";
   $contraseña = "";
   ```

5. **Acceder a la aplicación:**
   - Abre tu navegador y dirígete a: `http://localhost/mvc-gestion-de-ambientes`

## 👨‍💻 Equipo de Desarrollo y Propósito

Este proyecto corresponde al desarrollo práctico y tecnológico impulsado por las áreas de gestión y sistemas del **SENA**. Su misión es erradicar el uso manual cruzado de horarios en formatos estáticos y automatizar la reserva de aulas de acuerdo a las fichas en curso de manera gráfica y administrable.

## 📝 Licencia

Este proyecto es una iniciativa interna o académica. Todos los derechos reservados al autor primario y al Servicio Nacional de Aprendizaje SENA.
