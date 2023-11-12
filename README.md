# Monoma Challenge

## Paso a Paso de instalación del proyecto

Clone el proyecto de 

```sh
git clone https://github.com/adriandutra/monorama.git monoma
```
```sh
cd monoma/
```

Copie el archivo .env
```sh
cp .env.example .env
```

Actualice las variables de entorno .env
```dosini
APP_NAME="Monoma"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=monoma
DB_USERNAME=middleware
DB_PASSWORD=middl3w4r3

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```


Ejecute docker-compose para iniciar los contenedores
```sh
docker-compose up -d
```


Accediendo al contenedor
```sh
docker-compose exec app bash
```

Ejecutando migration en el contenedor
```sh
docker-compose exec app bash
```
```sh
php artisan migrate:refresh --seed
```


Instale las dependencias del proyecto
```sh
composer install
```


Genere la key del proyecto Laravel
```sh
php artisan key:generate
```


Acceso al proyecto
[http://localhost:8000](http://localhost:8000)