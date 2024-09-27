@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Role</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
        </div>
    </div>
</div>

<form action="{{ route('roles.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
                @error('name')
                <span style='color : red'>{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <strong>Permission:</strong>
            <div class="form-group">
                @foreach($permission as $value)
                <label>
                    <input type="checkbox" name="permission[]" value="{{ $value->id }}" class="name">
                    {{ $value->name }}
                </label>
                <br />
                @endforeach

                @error('permission')
                <span style='color : red'>{{$message}}</span>
                @enderror
            </div>
        </div>

        <input type="hidden" name="guard_name" value='web'>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>

@endsection