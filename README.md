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

APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:vbSjWM++uf6YCK0JFr8NTwC4hSnn4lMPhJMHxNceTNc=
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sirmuapp_db
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
# CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"


# Generar clave de aplicación
php artisan key:generate

# Crear la base de datos en phpMyAdmin
# CREATE DATABASE sirmu_db;

# Ejecutar migraciones
php artisan migrate

# Levantar servidor de desarrollo
php artisan serve
