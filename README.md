# Guía de Restaurantes 🍽️

## Descripción del Proyecto

Este proyecto consiste en la creación de un sitio web que actúa como una **guía de restaurantes** en nuestra ciudad, inspirado en el diseño y funcionalidad de **Restopolitan**. Utilizando el framework **Laravel**, la aplicación permite a los usuarios buscar restaurantes y filtrar por varios criterios como el tipo de cocina, valoración, y precio. Además, cuenta con funcionalidades avanzadas como la gestión de restaurantes por parte de administradores, sistema de valoraciones de usuarios y notificaciones por correo electrónico.

> **Objetivo**: Aprender a desarrollar aplicaciones web con **Laravel**.

## Funcionalidades 🚀

### Funcionalidades Mínimas

- **Búsqueda de restaurantes** por:
  - Precio medio de la carta 💵.
  - Valoración de los usuarios ⭐⭐⭐⭐⭐.
  - Tipo de cocina 🍕🍣🥗 (índia, vegana, tradicional, italiana, etc.).
  - Cada restaurante tiene al menos una **fotografía** 📸.
  
- **Gestión de Usuarios**:
  - Dos tipos de usuarios: **Administrador** y **Usuario Estándar**.
  - Los usuarios pueden **registrarse** y **loguearse** para utilizar la guía.

- **Gestión de Restaurantes por Administradores**:
  - CRUD de restaurantes (Crear, Editar, Eliminar) 🛠️.
  - Filtros para visualizar y buscar restaurantes por múltiples criterios (precio, valoración, etc.) 🔍.
  - Se valora el uso de **AJAX** para realizar el CRUD y los filtros sin recargar la página.

### Funcionalidades Avanzadas ⚙️

- Notificación por **correo electrónico** ✉️ al gerente del restaurante cuando se realicen cambios en su información por parte del administrador.
- **Formulario de valoración de restaurantes** por parte de los usuarios registrados. La puntuación se realiza mediante imágenes (como estrellas o corazones) 💖.
- Los usuarios pueden dejar **comentarios** 📝 junto a su valoración.

## Requisitos Técnicos 🖥️

- **PHP** (versión >= 7.4).
- **Composer** para gestionar las dependencias de Laravel.
- **MySQL** para la base de datos.
  
## Cómo Entrar 🚪

Para acceder al proyecto en tu entorno local, sigue estos pasos:

1. **Clonar el repositorio**:

   ```git clone https://github.com/Escalopedo/M12_RESTOPOLITAN.git```

2. **Iniciar Laravel**:

   ```php artisan serve```

3. **Migraciones**:

   ```bash
php artisan migrate 

4. **Seeders**:

   ```bash
php artisan db:seed

5. **Credenciales**:

Todos los usuarios tienen qweQWE123 de contraseña.
