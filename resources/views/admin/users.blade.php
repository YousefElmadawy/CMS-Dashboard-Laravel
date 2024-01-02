@extends('admin.admin_master')
@section('admin')
<div class="d-flex justify-content-between">
    <h3>welcome : {{Auth::user()->name}} </h3>
    <h3>total of users : {{count($users)}} </h3>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Created at</th>
        </tr>
    </thead>

   
   <tbody>
        @php($i=1)
        @foreach ($users as $user)
        <tr>
            <td scope="row"> {{$i++}} </td>
            <td> {{$user->name}} </td>
            <td>{{$user->email}}</td>
            {{-- <td>{{$user->created_at->diffForHumans()}}</td> --}}
           <td> {{Carbon\carbon::parse($user->created_at)->diffForHumans()}} </td>

        </tr>
        @endforeach
    </tbody>
</table>

@endsection