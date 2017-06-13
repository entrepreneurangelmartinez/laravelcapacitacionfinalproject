<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Acerca del proyecto final

Este proyecto final contiene todo lo visto durante la capacitación de Laravel nivel intermedio-preavanzado

En los siguientes enlaces se encuentran los repositorios de la capacitación de php y laravel:

- [PHP](https://github.com/entrepreneurangelmartinez/PHPparamisAlumnos).
- [Laravel capacitación](https://github.com/entrepreneurangelmartinez/laravelcapacitacion).

## Levantar nuestro proyecto base y configurarlo

Se genera un nuevo proyecto laravel con el siguiente comando:

**Laravel new laravelfp**

Una vez instalado los componentes y el proyecto como tal, se procede a crear una base de datos con el nombre:

**laravelfp**

## Configurando vistas 

Procedemos a realizar las migraciones base


**php artisan migrate**

Procedemos a utilizar el componente de autorización

**php artisan make:auth**

Ahora creamos nuestra área de administrador:

- **Crear nueva carpeta admin**
  - **index.blade.php**
- **Crear nueva carpeta posts**
  - **create.blade.php**
  - **edit.blade.php**
  - **index.blade.php**
- **Crear  nueva carpeta users**
  - **create.blade.php**
  - **edit.blade.php**
  - **index.blade.php**
- **Crear nueva carpeta categories**
  - **create.blade.php**
  - **index.blade.php**
  - **edit.blade.php**

## Migración de la tabla **users**

**php atisan make:migration add_role_id_to_users_table --table=users**

**Up**

**Schema::table('users', function (Blueprint $table) {
            //
            $table->integer("role_id")->index()->unsigned()->nullable();
            $table->integer('is_active')->default(0);
        });**

**Down**

**Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('role_id');
            $table->dropColumn('is_active');
        });**

Se procede a generar la migracion de la tabla de roles y su modelo

**php artisan make:model Role -m**

**Up**

** Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });**

