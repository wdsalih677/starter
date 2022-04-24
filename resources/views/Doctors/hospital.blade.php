@extends('layouts.app')
@section('content')
<div class="container">
    <div class="alert alert-success">
        <h3>Hospitals</h3>
    </div>
    <br>
    @if (Session::has('sucess'))
            <div class="alert alert-success">
                {{ Session::get('sucess') }}
            </div>
    @endif
    <br>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">Address</th>
            <th scope="col">Option</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($hospitals) && $hospitals->count())
                
            
            @foreach($hospitals as $hospital)
            <tr>
            <th scope="row">{{$hospital -> id}}</th>
            <td>{{$hospital -> name}}</td>
            <td>{{$hospital -> address}}</td>
            <td>
                <a href="{{ route('hosptal.doctor' , $hospital -> id)}}" class="btn btn-success">Doctor</a>
                <a href="{{ route('hosptal.delete' , $hospital -> id)}}" class="btn btn-danger">Delete</a>
            </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@stop