@extends('layouts.admin')

@section('content')
<h1>User</h1>

<table class="table">
    <thead>
      <tr>
        <th>Id</th>
        
        <th>Photo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Created</th>
        <th>Updated</th>
      </tr>
    </thead>
    <tbody>
    @if($users)
    @foreach($users as $user)
     <tr>
        <td>{{$user->id}}</td>
        

        {{-- Verificar qye exista una imagen por cada usuario --}}
        {{-- Implementando un accesor --}}
        <td><img height="50px" width="50px" src='{{$user->photo ? $user->photo->file : "no user photo"}}'/></td>
        {{-- <td>{{$user->name}}</td> --}}

        <td><a href="{{route('users.edit',$user->id)}}">{{$user->name}}</a></td>

        <td>{{$user->email}}</td>
        {{-- Nota:Si esta nulo el id de referencia manda una excepción --}}
        <td>{{$user->role ? $user->role->name : 'User has no role' }}</td>
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