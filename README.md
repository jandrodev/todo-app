# Todo App

## Explicación

¡Bienvenido/a! Para la realización de este ejercicio se ha elegido el siguiente stack:

- Laravel 10 (backend).
- Vue 3 (frontend).
- Mysql 8 (base de datos).
- Inertia (librería de enrutamiento del lado del cliente).
- Vite 4 (compilador para frontend).
- Quasar 2 (librería de componentes para Vue).
- Laravel pint (configurado con preset PSR12).

## Setup

Una vez descargado el proyecto de Github, y realizadas las tareas según el entorno local elegido (de ser necesarias),
debemos crear una base de datos local. Copiamos el archivo .env.example y lo renombramos a .env, cambiando las variables
correspondientes a nuestra base de datos:

```bash
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

A continuación instalamos los paquetes de backend:

```bash
composer install
```

Después será necesario setear nuestra key local para Laravel:

```bash
php artisan key:generate
```

Lo siguiente es correr las migraciones. El proyecto cuenta con una hidratación ficticia de tareas (8), que se pueden
ejecutar o no:

```bash
php artisan migrate
php artisan migrate --seed (si se desean correr los seeders)
```

Una vez hecho esto instalamos los paquetes de frontend (en el ejemplo de usa npm, pero sería lo mismo si se usa Yarn u
otro gestor):

```bash
npm install
```

Ya solo nos quedaría compilar los archivos del frontend:

```bash
npm run dev
```
