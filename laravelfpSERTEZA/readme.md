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

**Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });**

## Configuración de relación y entrada de datos

Se configura la relación en el model de User

**Up**

**public function role(){
        return $this->belongsTo('App\Role');
    }**

Se verifica su funcionamiento en /home registrando un nuevo usuario

## Probando relacion con Tinker

Activamos la interfaz de tinker con el siguiente comando:

**php artisan tinker**

Generamos un nuevo objeto

**$user=App\User::find(1)**

Podemos acceder ahora a la relación con Role

**$user->role**

Nos debe generar como salida la relación

**App\User::create(['name'=>'Consultant','email'=>'amartinezb@advanced-consulting.biz','passwor
d'=>'Progangelo1'])**

Cerramos Tinker

## Controlador administrativo y rutas

Generamos la ruta prefabricada de Laravel

**Route::resource('admin/users', 'UserController');**

Generamos el controlador para nuestra nueva ruta con artisan

**php artisan make:controller --resource AdminUsersController**

## Instalación de NodeJs

Descargamos el binario para la arquitectura que nos corresponde y se instala como cualquier binario de windows

Se procede a verificar si se instalo correctamente  con el siguiente comando:

**node -v**

## Intalación de gulp y assets

Se ejecuta el siguiente comando:

**npm install --global gulp**
**npm install --save-dev gulp**



**npm install**

**npm install -g gulp**

**npm install laravel-elixir --save-dev**

**npm install laravel-elixir-vue-2 --save-dev**

**npm install --save laravel-elixir-webpack-official**

Si existe algún problema seguimos con la guía oficial de Gulp 

Se procede a crear un archivo gulpfile.js

Si se crea un contenido por defecto se comenta y se pone el siguiente:

**var elixir=require('laravel-elixir');

elixir(function(mix){
  mix.sass('app.scss')
});**

Se procede a descargar los assets correspondientes

- [Assets](https://1drv.ms/u/s!AgKVrL2TyVOSmxVJ0D6np9QqdRp1).

Dentro traen 3 carpetas:

Se colocan en la carpeta resources/assets

-  **css**   
-  **js**

Se coloca dentro de la carpeta public

-  **fonts**

Generamos dos métodos dentro de nuestro archivo gulpfile.js

<code>.styles([
        'libs/blog-post.css',
        'libs/bootstrap.css',
        'libs/font-awesome.css',
        'libs/metisMenu.css',
        'libs/sb-admin-2.css'
    ], './public/css/libs.css')

    .scripts([
        'libs/jquery.js',
        'libs/bootstrap.js',
        'libs/metisMenu.js',
        'libs/scripts.js',
        'libs/sb-admin-2.js'
    ], './public/js/libs.js')</code>

Ejecutamos gulp para revisar que todo este correcto

**gulp**

## Creando el master page del area Administrable

Descargamos la plantilla base y la colocamos en el index del area admin


- [Layout Administrador](https://1drv.ms/u/s!AgKVrL2TyVOSmxfvjFkNru8zZD0h)


Generamos una nueva ruta

```php
Route::get('/admin', function($id) {
    //
    return view('admin.index');
})->name('admins');
```

## Modificando masterpage administrable para corregir el body

Se modifica el archivo /resources/assets/sass/app.scss

```css
#admin-page{
    padding-top:0px;
}
```

Se ejecuta **gulp** para actualizar app.css

## Listando usuarios

modificamos el controlador de User

```php
use App\User;
 public function index()
    {
        //
        // Obtenemos a los usuarios
         $users = User::all();
        return view('admin.users.index',compact('users'));
    }
```

modificamos la vista
```php
 @if($users)
    @foreach($users as $user)
     <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        {{-- <td>{{$user->created_at}}</td>
        <td>{{$user->updated_at}}</td> --}}
        {{-- Con formato para humanos --}}
        <td>{{$user->created_at->diffForHumans()}}</td>
        <td>{{$user->updated_at->diffForHumans()}}</td>
      </tr>
    @endforeach
    @endif
```
