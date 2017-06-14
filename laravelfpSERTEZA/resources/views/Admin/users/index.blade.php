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