# Prueba práctica php

_Prueba PHP Laravel_
1. Desarrollar un crud; Consumiendo un ApiRest (cualquiera).
2. Crear un servicio web y consumirlo con Js (Vuejs o ReactJs).

## Comenzando 🚀

_Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas._

_Puedes empezar clonando el proyecto con el siguiente comando._

```
git clone https://github.com/carlos-chacon/prueba-tecnica-crud.git
```

```
cd prueba-tecnica-crud/
```

_Esta aplicación esta construida, en el backend con php (Laravel Lumen) y en el frontend con Vue.js_


## Pre-requisitos 📋

- [Docker](https://www.docker.com/)
- [Node.js](https://nodejs.org/en/download/)


## Instalación 🔧

_Para la instalación del proyecto y después de haber clonado el repositorio seguiremos los siguientes pasos:_

### Backend php
#### Usando Contenedor Docker:

- _Nos ubicamos en el directorio backend_

```bash
cd backend
```

- _Creamos una copia del archivos de variables Laravel_

```sh
cp .env.example .env
```

- _Poner en marcha los contenedor docker. Se levantaran los contenedores php, nginx y el espacio de trabajo donde esta el código php_

```sh
docker-compose up -d
```

#### Instalación y configuración proyecto php (Laravel Lumen):

- _Estando en el directorio backend ejecutamos los siguiente comandos:_

```sh
docker exec -it app_crud sh
```

- _Dentro del shell, ejecutamos los siguientes comandos:_

```sh
composer install
```
```sh
php artisan migrate
```
```sh
exit
```

- _Después de realizar los pasos anterior los servicios (php) quedan expuestos en **http://localhost:8080/** ._
    _Existen cinco servicios (CRUD de productos):_
    1. _Obtener el listado de todo los productos (GET): **http://localhost:8080/api/products?page={numPage}&q={textoBuscar}**_
    2. _Obtener un producto (GET): **http://localhost:8080/api/products/{id}**_
    3. _Crear un producto (POST): **http://localhost:8080/api/products**_
    4. _Actualizar un producto (PUT): **http://localhost:8080/api/products/{id}**_
    5. _Borrar un producto (DELETE): **http://localhost:8080/api/products/{id}**_


### Frontend Vue.js

_Nos ubicamos en el directorio frontend de la raíz del proyecto, y ejecutamos los siguientes comandos:_

```sh
cd ..
```
```sh
cd frontend/
```
```sh
npm install
```

_Comando para ejecutar el frontend en modo desarrollo:_
```sh
npm run dev
```

_El sitio web queda expuesto en **http://127.0.0.1:5173/**_

## Construido con 🛠️

* [Laravel Lumen](https://lumen.laravel.com/) - Framework php
* [Vue.js](https://vuejs.org/) - Framework Javascript
* [Docker](https://www.docker.com/)

## Autor ✒️


* **Carlos Chacón** - *Trabajo Inicial* - [carlos-chacon](https://github.com/carlos-chacon)

---