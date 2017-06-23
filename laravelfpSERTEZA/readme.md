<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>


## Créditos

<center>

Capacitación y elaboración del proyecto final por el Ingeniero en Sistemas Computacionales Angel Jesús Martínez Frías

<a href="https://www.facebook.com/ISCNGEL"><img src="http://www.riversidefilm.org/wp-content/uploads/2017/04/RIFF_Social_FB.png" width="50px" height="50px" alt="License"></a>
</center>

## Empresa a la que se le brindo los servicios de capacitación de personal

SERTEZA

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


```javascript
.styles([
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
    ], './public/js/libs.js')

```

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

## Modificando el index a un mejor formato

```php
@extends('layouts.admin')

@section('content')
<h1>User</h1>

<table class="table">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Role</th>
        <th>Active</th>
        <th>Created</th>
        <th>Updated</th>
      </tr>
    </thead>
    <tbody>
    @if($users)
    @foreach($users as $user)
     <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        {{-- Nota:Si esta nulo el id de referencia manda una excepción --}}
        <td>{{$user->role->name}}</td>
        {{-- Nota:Ejecutando operador ternario para condición --}}
        <td>{{$user->is_active ==1 ? 'Active' : 'Inactive'}}</td>
        {{-- <td>{{$user->created_at}}</td>
        <td>{{$user->updated_at}}</td> --}}
        {{-- Con formato para humanos --}}
        <td>{{$user->created_at->diffForHumans()}}</td>
        <td>{{$user->updated_at->diffForHumans()}}</td>
      </tr>
    @endforeach
    @endif
    </tbody>
  </table>

@endsection()
```

## Creando usuarios e integrando el motor de vistas

modificamos el controlador de User en la acción create

```php
public function create()
    {
        //
        return view('admin.users.create');
    }
```

modificamos la vista admin.users.create
```php
@extends('layouts.admin')

@section('content')
<h1>Create users</h1>
@endsection()
```

descargamos con composer el empaquetado colectivo de html

```php
composer require laravelcollective/html
```

Realizamos la configuración correspondiente en congfig/app.php

en los providers se añade el collective

```php
Collective\Html\HtmlServiceProvider::class
```

Procedemos a generar un formulario base para crear usuarios

```php
@extends('layouts.admin')

@section('content')


    <h1>Create Users</h1>


     {!! Form::open(['method'=>'POST', 'action'=> 'AdminUsersController@store']) !!}


      <div class="form-group">
             {!! Form::label('name', 'Name:') !!}
             {!! Form::text('name', null, ['class'=>'form-control'])!!}
       </div>

         <div class="form-group">
            {!! Form::submit('Create User', ['class'=>'btn btn-primary']) !!}
         </div>

       {!! Form::close() !!}


    {{-- @include('includes.form_error') --}}



 @stop
```

## Creando campos y probando el formulario

En el controlador permitimos obtener todo el request y presentarlo

```php
public function store(Request $request)
    {
        //
        return $request->all();
    }
```

Acción create
```php
 public function create()
    {
        //Obtenemos todos los roles y enviamos en un viewbag
        $roles = Role::pluck('name','id')->all();
        // $roles = array_pluck(, 'developer.name', 'developer.id');
        return view('admin.users.create',compact('roles'));
    }
```

Vista admin/users/create.blade.php

```php
@extends('layouts.admin')




@section('content')


    <h1>Create Users</h1>


     {!! Form::open(['method'=>'POST', 'action'=> 'AdminUsersController@store','files'=>true]) !!}


      <div class="form-group">
             {!! Form::label('name', 'Name:') !!}
             {!! Form::text('name', null, ['class'=>'form-control'])!!}
       </div>

         <div class="form-group">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::email('email', null, ['class'=>'form-control'])!!}
       </div>

        <div class="form-group">
            {!! Form::label('role_id', 'Role:') !!}
            {!! Form::select('role_id', [''=>'Choose Options'] + $roles , null, ['class'=>'form-control'])!!}
        </div>


        <div class="form-group">
            {!! Form::label('is_active', 'Status:') !!}
            {!! Form::select('is_active', array(1 => 'Active', 0=> 'Not Active'), 0 , ['class'=>'form-control'])!!}
         </div>


        <div class="form-group">
            {!! Form::label('photo_id', 'Photo:') !!}
            {!! Form::file('photo_id', null, ['class'=>'form-control'])!!}
         </div>



        <div class="form-group">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', ['class'=>'form-control'])!!}
         </div>


         <div class="form-group">
            {!! Form::submit('Create User', ['class'=>'btn btn-primary']) !!}
         </div>


       {!! Form::close() !!}



 @stop
```

## Campo de validacion y generar un request customizable

Generamos un request para mediante artisan

```php
php artisan make:request UsersCreateRequest
```

modificamos el valor de retorno de authorize a true

```php
 public function authorize()
    {
        return true;
    }
```

ponemos las reglas, para que todos los campos sean requeridos

```php
public function rules()
    {
        return [
            //
            'name'=>'required',
            'email'=>'required',
            'role_id'=>'required',
            'is_active'=>'required',
            'password'=>'required'
        ];
    }
```

en el controlador AdminUsersController.php cambiamos el request por default al nuestro

```php
public function store(UsersRequest $request)
    {
        //
        return $request->all();
    }
```

Se genera un nuevo usuario y observamos como recarga la página y no recupera los datos. Esto se debe a que activamos la validación.

## Mostrando errores e incluyendolo con blade

Verificamos que exista errores en el request, si los hay lo despliega como una alerta.

```php
  @if(count($errors)>0)
    <div class="alert alert-danger">
    <ul>
    @foreach($errors->all() as $error)
    <li>
    {{$error}}
    </li>
    @endforeach
    </ul>
    </div>
    @endif
```

Para mejorar el performance se genera un nuevo archivo como vista parcial de errores

includes/form_error.blade.php

dentro de la vista...

```php
 @include('includes.form_error')
```

dentro del form_error

```php
  @if(count($errors)>0)
    <div class="alert alert-danger">
    <ul>
    @foreach($errors->all() as $error)
    <li>
    {{$error}}
    </li>
    @endforeach
    </ul>
    </div>
    @endif
```

## Agregando la característica de subir archivos al formulario

Hacemos una migración para permitir que los usuarios puedan almacenar archivos

```php
php artisan make:migration add_photo_id_to_users --table=users

 public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('photo_id');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('photo_id');
        });
    }

    php artisan migrate
```
Intentamos crear un nuevo usuario y observamos como ahora nos representa el archivo como una matriz

Dentro del modelo de Users agregamos en la matriz de fillable a is_active y role_id

Generamos el modelo y la migración para almacenar las Fotos

```php
php artisan make:model Photo -m
```

Agregamos el campo de la ruta del archivo

```php
public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file');
            $table->timestamps();
        });
    }

    php artisan migrate
```

Se procede a modificar el campo rellenable para file en el modelo Photo

```php
protected $fillable=['file'];
```

Generamos la relación entre el usuario y la foto

Modificamos el modelo User

```php
public function photo(){
        return $this->belongsTo('App\Photo');
    }
```

## Creando hipervinculos dinamicos (Hard code)

En nuestro template layouts/admin.blade.php tenemos enlaces hard codeados, por los que si existe un cambio, se modifica la ruta.

Para solucionar este problema lo pasamos como una variable con un el identificador correspondiente
![bad idea](http://cinescopia.com/wp-content/uploads/2011/03/CAK3TA39CA869IOXCAAJTGK2CAGQYJOYCAMGVEORCA05QVRCCAOO0Z5MCAHM679YCA21VWCOCAKPA1NMCATCX897CAMI2PXACAITFZYVCADI605WCACI75QJCAL8A0BTCASYMZ57CA6759WF.jpg)

Mala idea:

```php
<a href="/users">All Users</a>
```

![good idea](http://cinescopia.com/wp-content/uploads/2011/03/images.jpg)

Buena idea

```blade
<a href="{{route('users.index')}}">All Users</a>
```

## Persistencia de datos al guardar la foto del usuario

Modificamos el controlador de Users

```php
public function store(UsersRequest $request)
    {
        //

        // return $request->all();
        //Persistiendo los datos para crearlos

        if(trim($request->password) == ''){

            $input = $request->except('password');

        } else{


            $input = $request->all();

            $input['password'] = bcrypt($request->password);

        }



        if($file = $request->file('photo_id')) {


            $name = time() . $file->getClientOriginalName();


            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);


            $input['photo_id'] = $photo->id;


        }


        User::create($input);
        
        return redirect('/admin/users');
        
    }
```

## Mostrando las fotos por cada usuario usando un accesor

Editamos la vista users/index.blade.php, agregando el parametro de foto en la tabla

```php
<th>Photo</th>

{{-- Verificar qye exista una imagen por cada usuario --}}
{{-- Implementando un accesor --}}
 <td><img height="50px" width="50px" src='/images/{{$user->photo ? $user->photo->file : "no user photo"}}'/></td>
```
Se procede a implementar el accsesor dentro del modelo Photo

```php
protected $uploads='/images/';

    public function getFileAttribute($photo)
    {
        return $this->uploads . $photo;
    }


    {{-- Implementando un accesor --}}
        <td><img height="50px" width="50px" src='{{$user->photo ? $user->photo->file : "no user photo"}}'/></td>
```

## Editando usuarios

Editamos la función edit($id) del AdminUsersController


```php
 public function edit($id)
    {
        //
        $user= User::findOrFail($id);

        //Anexando los roles a la vista

        $roles = Role::pluck('name','id')->all();

        return view('admin.users.edit',compact('user','roles'));
    }
```


Generamos nuestro formulario, tomamos como base el de creación de un usuario

```php
@extends('layouts.admin')

@section('content')


    <h1>Edit User</h1>
{{-- //Realizamos un model binding de este forumulario --}}

     {!! Form::open(['method'=>'PATCH', 'action'=> ['AdminUsersController@update',$user->id],'files'=>true]) !!}
{{-- {!! Form::model($user['method'=>'POST', 'action'=> 'AdminUsersController@store','files'=>true]) !!} --}}

      <div class="form-group">
             {!! Form::label('name', 'Name:') !!}
             {!! Form::text('name', null, ['class'=>'form-control'])!!}
       </div>

         <div class="form-group">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::email('email', null, ['class'=>'form-control'])!!}
       </div>

        <div class="form-group">
            {!! Form::label('role_id', 'Role:') !!}
            {!! Form::select('role_id', [''=>'Choose Options'] + $roles , null, ['class'=>'form-control'])!!}
        </div>


        <div class="form-group">
            {!! Form::label('is_active', 'Status:') !!}
            {!! Form::select('is_active', array(1 => 'Active', 0=> 'Not Active'), 0 , ['class'=>'form-control'])!!}
         </div>


        <div class="form-group">
            {!! Form::label('photo_id', 'Photo:') !!}
            {!! Form::file('photo_id', null, ['class'=>'form-control'])!!}
         </div>



        <div class="form-group">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', ['class'=>'form-control'])!!}
         </div>


         <div class="form-group">
            {!! Form::submit('Create User', ['class'=>'btn btn-primary']) !!}
         </div>


       {!! Form::close() !!}


    @include('includes.form_error')
  

 @stop
```

## Convirtiendo en un model el envio de datos del formulario Edit

```php
{!! Form::model($user,['method'=>'PATCH', 'action'=> ['AdminUsersController@update',$user->id],'files'=>true]) !!}
```

## Mostrando imagenes y estatus en el formulario Edit

Se procede a modificar el valor por defecto a nulo del estatus

```php
{!! Form::select('is_active', array(1 => 'Active', 0=> 'Not Active'), null , ['class'=>'form-control'])!!}
``` 

```php
@extends('layouts.admin')

@section('content')

<div class="col-sm-3">

<img src="{{$user->photo ? $user->photo->file : 'http://newsinamerica.com/pdcc/wp-content/themes/imagpress-themes/lib/img/400x400.gif'}}" alt="" class="img-responsive img-rounded">
</div>

<div class="col-sm-9">

    <h1>Edit User</h1>
{{-- //Realizamos un model binding de este forumulario --}}

     {!! Form::model($user,['method'=>'PATCH', 'action'=> ['AdminUsersController@update',$user->id],'files'=>true]) !!}
{{-- {!! Form::model($user['method'=>'POST', 'action'=> 'AdminUsersController@store','files'=>true]) !!} --}}

      <div class="form-group">
             {!! Form::label('name', 'Name:') !!}
             {!! Form::text('name', null, ['class'=>'form-control'])!!}
       </div>

         <div class="form-group">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::email('email', null, ['class'=>'form-control'])!!}
       </div>

        <div class="form-group">
            {!! Form::label('role_id', 'Role:') !!}
            {!! Form::select('role_id', [''=>'Choose Options'] + $roles , null, ['class'=>'form-control'])!!}
        </div>


        <div class="form-group">
            {!! Form::label('is_active', 'Status:') !!}
            {!! Form::select('is_active', array(1 => 'Active', 0=> 'Not Active'), null , ['class'=>'form-control'])!!}
         </div>


        <div class="form-group">
            {!! Form::label('photo_id', 'Photo:') !!}
            {!! Form::file('photo_id', null, ['class'=>'form-control'])!!}
         </div>



        <div class="form-group">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', ['class'=>'form-control'])!!}
         </div>


         <div class="form-group">
            {!! Form::submit('Create User', ['class'=>'btn btn-primary']) !!}
         </div>


       {!! Form::close() !!}
       </div>
    @include('includes.form_error')
  

 @stop
```

## Visualizando errores en el formulario de edición

Modificamos el request de update

```php
public function update(UsersRequest $request, $id)
    {
        //
        return "Hola";
    }
```

## Actualizando datos

```php
//Se valida y crea una nueva foto asignable

public function update(UsersRequest $request, $id)
    {
        //Actualizando datos

        $user =User::findOrFail($id);

        $input = $request->all();
        
        if($file=$request->file('photo_id'))
        {
            $name=time() . $file ->getClientOriginalName();

            $file->move('images',$name); 

            $photo=Photo::create(['file'=>$name]);   

            $input['photo_id']=$photo->id;
        }

        $user->update($input);
        
        return redirect()->route('users.index');
    }
```

## Modificando el Request para evitar la actualización en todo momento del password mientras editamos

Se genera un nuevo request UsersEditRequest

```php
php artisan make:request UsersEditRequest

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //En este Request no incluimos como obligatorio el password
         return [
            //
            'name'=>'required',
            'email'=>'required',
            'role_id'=>'required',
            'is_active'=>'required'
        ];
    }
}
```

Modifcamos el controlador para que evitar un problema de integridad con la contraseña

```php
  $user = User::findOrFail($id);


        if(trim($request->password) == ''){

            $input = $request->except('password');

        } else{


            $input = $request->all();

            $input['password'] = bcrypt($request->password);

        }




        if($file = $request->file('photo_id')){


            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);


            $input['photo_id'] = $photo->id;


        }



        $user->update($input);
```

## Seguridad

Es muy importante determinar el acceso del contenido, para esto Laravel nos brinda la generación de middlewares.

Generamos un middleware para nuestro usuario Admin

```php
php artisan make:middleware Admin
```

Agregamos al kernel "Kernel.php" nuestro middleware

```php
protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'admin' =>\App\Http\Middleware\Admin::class,
    ];
```

Generamos una agrupación de rutas que se veran afectadas por el middleware

```php
Route::group(['middleware'=> 'admin'], function()
{
    Route::resource('admin/users', 'AdminUsersController');
});
```

Generamos un método para la verificación de acceso del Administrador en el modelo User.php

```php
public function isAdmin(){
        if($this->role->name == "Administrator")
        {
            return true;
        }
        return false;
    }
```

Modificamos el handle dentro del middleware Admin.php para usar la autenticación

```php
namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {
            if(Auth::user()->isAdmin())
            {
                return $next($request);
            }
        }
        
        //Si el usuario no esta logueado redirigimos a un error 404

        return redirect("/");
    }
}
```

Por último modificamos el LoginController para redireccionar a nuestra área administrativa y agregamos en nuestro template el nombre de usuario.

```php
protected $redirectTo = '/admin/users';


 {{Auth::user()->name}}
```

## Borrar usuario

Se agrega un nuevo formulario para el request al momento del borrado

```php
 {!! Form::open(['method'=>'DELETE', 'action'=> ['AdminUsersController@destroy', $user->id]]) !!}
       <div class="form-group">
       {!! Form::submit('Delete user', ['class'=>'btn btn-danger col-sm-6']) !!}
       </div>
{!! Form::close() !!}
```

En AdminUsersController se procede a realizar el borrado mediante Eloquent

```php
 public function destroy($id)
    {
        //
        User::findOrFail($id)->delete();

        return redirect()->route('users.index');
    }
```

## Ejecutando mensajes de retroalimentación (Flash messages)

Se anexa un mensaje con el metodo flash de la fachada Session

```php
public function destroy($id)
    {
        //
        User::findOrFail($id)->delete();

        Session::flash('deleted_user', 'The user has been deleted');

        return redirect()->route('users.index');
    }
```

Después agregamos en la vista de redireccionamiento la condición que dispara el valor de la sesión

```php
@if(Session::has('deleted_user'))
<p class="alert alert-danger">{{session('deleted_user')}}</p>
@endif
```

## Borrando las imagenes

Hasta el momento, solo se borra los datos de los usuarios a nivel de base de datos, pero en la carpeta persiste la existencia de la imagen que se guardo.

Para realizar el borrado de imagen se recomienda ampliamente el uso del método unlink, que es propio de php.

Refactorizando el código:

```php
public function destroy($id)
    {
        //

        $user=User::findOrFail($id);

        unlink(public_path() . $user->photo->file);
        
        $user->delete();

        Session::flash('deleted_user', 'The user has been deleted');

        return redirect()->route('users.index');
    }
```

## **Posts**

## Definiendo rutas

Anexamos al grupo de rutas de administrador a los posts

```php
Route::group(['middleware'=> 'admin'], function()
{
    Route::resource('admin/users', 'AdminUsersController');

    Route::resource('admin/posts','AdminPostsController');
});
```

Generamos un controlador mediante artisan y andamiaje

```php
php artisan make:controller --resource AdminPostsController
```

Reemplazamos el hard code por rutas dinámicas en el layout admin.blade.php

```php
 <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i> Posts<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('posts.index')}}">All Posts</a>
                            </li>

                            <li>
                                <a href="/posts/create">Create Post</a>
                            </li>

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
```

En los controladores solo hacemos el enrutamiento a la vista

```php
 public function index()
    {
        //
        return view('admin.posts.index');
    }
```
## Generando Modelo y migración de la entidad Post

```php
php artisan make:model Post -m
```

Modificamos la migración a los atributos que requerimos

```php
  public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();
            $table->integer('photo_id')->unsigned()->index();
            $table->string('title');
            $table->text('body');
            $table->timestamps();
        });
    }
```

aplicamos la migración

```php
php artisan migrate
```
## Mostrando Posts

Implementamos Tinker para generar y hacer pruebas para crear nuestros primeros posts.

```php
$post=App\Post::create(['title'=>'my first post','body'=>'I love Laravel and my Consultant Angel Martínez n_n']);
```

Nos saldra el siguiente mensaje

```php
php artisan tinker
Psy Shell v0.8.6 (PHP 5.6.30 ÔÇö cli) by Justin Hileman
>>> $post=App\Post::create(['title'=>'my first post','body'=>'I love Laravel and my Consultant Ang
el Martínez n_n']);
Illuminate\Database\Eloquent\MassAssignmentException with message 'title'
>>>
```

Esto quiere decir que nuestros atributos aún no estan con permiso para ser rellenados.

Agregamos los valores necesarios a nuestro modelo

```php
protected $fillable = [
        'user_id',
        'category_id',
        'photo_id',
        'title',
        'body'
    ];
```

```php
$post=App\Post::create(['title'=>'my first post','body'=>'I love Laravel and my consultant Angel Martinez','user_id'=>'1','category_id'=>'1','photo_id'=>'1'])
```

Modificamos el index de AdminPostsController

```php
public function index()
    {
        //
         $posts=Post::all();
        return view('admin.posts.index',compact('posts'));
    }
```

Modificamos la vist /posts/index.blade.php

```php
@extends('layouts.admin')
@section('content')
<h1>Posts</h1>
<table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>User</th>
        <th>Category</th>
        <th>Photo</th>
        <th>Title</th>
        <th>Body</th>
        <th>Created</th>
        <th>Updated</th>
      </tr>
    </thead>
    <tbody>
    @if($posts)
    @foreach($posts as $post)
      <tr>
        <td>{{$post->id}}</td>
        <td>{{$post->user_id}}</td>
        <td>{{$post->category_id}}</td>
        <td>{{$post->photo_id}}</td>
        <td>{{$post->title}}</td>
        <td>{{$post->body}}</td>
        <td>{{$post->created_at}}</td>
        <td>{{$post->updated_at}}</td>
      </tr>
       @endforeach
       @endif
    </tbody>
  </table>
@stop
```

## Estableciendo las relaciones que tienen los Posts

Primero establecemos la relacion uno  a muchos Para un **usuario**

```php
   public function posts(){
        return $this->hasMany('App\Post');
    }
```

Ahora se establece la relación entre los **Post** y el usuario

```php
public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }
```

Modificamos la vista index para obtener el nombre del usuario

```php
<td>{{$post->user->name}}</td>
```
