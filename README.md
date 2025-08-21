# SirmuApp

Aplicación web desarrollada en **Laravel** como parte de la materia de Desarrollo de Software.  
El sistema incluye autenticación de usuarios y gestión de roles (Administrador, Técnico, Auditor, Encargado).

---

# Instalación en Windows (XAMPP)
https://www.apachefriends.org/es/index.html

Abrir PowerShell o CMD y ejecutar los siguientes comandos **uno por uno**:

```powershell
# Instalar PHP (si no lo tenés)
Set-ExecutionPolicy Bypass -Scope Process -Force; `
[System.Net.ServicePointManager]::SecurityProtocol = `
[System.Net.ServicePointManager]::SecurityProtocol -bor 3072; `
iex ((New-Object System.Net.WebClient).DownloadString('https://php.new/install/windows/8.4'))

# Instalar Laravel Installer
composer global require laravel/installer

# Clonar el repositorio
git clone https://github.com/g0yz/sirmuApp.git
cd sirmuApp

# Instalar dependencias PHP y Node
composer install
npm install

# Crear archivo .env a partir del ejemplo
cp .env.example .env

# Configurar variables de entorno en .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=sirmu_db
# DB_USERNAME=root
# DB_PASSWORD=

# Generar clave de aplicación
php artisan key:generate

# Crear la base de datos en phpMyAdmin
# CREATE DATABASE sirmu_db;

# Ejecutar migraciones
php artisan migrate

# Levantar servidor de desarrollo
php artisan serve
