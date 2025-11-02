<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>



## Pasos para deployarlo

- Clonar proyecto
- En la consola, ingresar a la carpeta con cd nombre_del_proyecto
- Copiar archivo .env.example y nombrarlo .env

```bash
cp .env.example .env
```
- Luego, verificar el archivo .env para validar que la base de datos que se especifica en mysql *no exista en tu mysql*. Si ya existe, cambiarle el nombre y colocar los paràmetros correctos de conexiòn a la base de datos

- Verificar y modificar la siguiente lìnea del archivo .env
```bash
SESSION_DRIVER=database
```

- Por:
```bash
SESSION_DRIVER=file
```

- Esto lo hacemos para no guardar sesiones de laravel en base de datos.

- Instalar dependencias con

```bash
composer install
```

- Luego, generar clave de la aplicacion con
```bash
php artisan key:generate
```

- Despuès, ejecutar las migraciones y los seeders para crear la estructura de la base de datos y llenar datos por defecto

```bash
php artisan migrate --seed
```
- Acepten crear la base de datos automàticamente

- Ahora debemos instalar las dependencias js con npm. Para esto, *abrir una nueva ventana de consola dentro del repositorio* y ejecutaremos lo siguiente:

```bash
npm install
```

- Ahora, en esa nueva ventana de consola, ejecutamos 


```bash
npm run dev
```


- Finalmente, regresamos a la primera ventana de consola donde ejecutamos las migraciones y levantar el servidor con
```bash
php artisan serve
```

- Y listo. Deberìamos tener dos consolas: en una se està ejecutando el servicio de php artisan serve y en el otro, el servicio de npm run dev
- Abrir el navegador y digitar:

```bash
localhost:8000/login

Usuario: admin
Contraseña: admin123

Usuario: common
Contraseña: common123
```