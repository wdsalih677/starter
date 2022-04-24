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
            <th scope="col">Option</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($services)&&$services -> count() > 0)
            @foreach($services as $service)
            <tr>
            <th scope="row">{{$service -> id}}</th>
            <td>{{$service -> name}}</td>
            <td>
                <a href="" class="btn btn-danger">Delete</a>
                {{-- <a href="{{ route('delete.doctor' ,$doctor -> id ) }}" class="btn btn-danger">Delete</a> --}}
            </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <form action="{{ route('save.services') }}" method="POST">
        @csrf
        <label class="form-label">Select Doctors</label>
        <select name="doctor_id" class="form-control">
            @foreach ($doctors as $doctor)
            <option value="{{ $doctor -> id }}">{{ $doctor -> name }}</option> 
            @endforeach
        </select>
        <br>
        <label class="form-label">Select Services</label>
        <select name="services_id[]" class="form-control" multiple>
            @foreach ($allServices as $allService)
            <option value="{{ $allService -> id }}">{{ $allService -> name }}</option> 
            @endforeach
        </select>
        <br>
        <button class="btn btn-primary">Save</button>
    </form>
</div>
@stop