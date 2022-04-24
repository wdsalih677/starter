@extends('layouts.app')
@section('content')
<div class="container">
    <div class="alert alert-danger">
        <h3>Doctors</h3>
    </div>
    <br><br>
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
            <th scope="col">Title</th>
            <th scope="col">Option</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctors as $doctor)
            <tr>
            <th scope="row">{{$doctor -> id}}</th>
            <td>{{$doctor -> name}}</td>
            <td>{{$doctor -> title}}</td>
            <td>
                <a href="{{ route('doctor.services', $doctor -> id) }}" class="btn btn-success">Doctor Services</a>
                {{-- <a href="{{ route('delete.doctor' ,$doctor -> id ) }}" class="btn btn-danger">Delete</a> --}}
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop