@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit New User</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>
</div>



<form action="{{route('users.update',$user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="Name">
                @error('name')
                <span style='color : red'>{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="email" value="{{ $user->email }}" name="email" class="form-control" placeholder="Email">
                @error('email')
                <span style='color : red'>{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="password" name="password" value="{{ $user->password }}" disabled class="form-control" placeholder="Password">
                @error('password')
                <span style='color : red'>{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role:</strong>
                <select name="roles" class="form-control" multiple>
                    @foreach($roles as $key => $value)
                    <option value="{{ $key }}" @if(in_array($key, $userRole)) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
                @error('role')
                <span style='color : red'>{{$message}}</span>
                @enderror
            </div>
        </div>

        <input type="hidden" name="is_admin" value='0'>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>

@endsection