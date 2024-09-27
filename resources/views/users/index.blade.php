@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>User List</h2>
        </div>
        <div class="float-right m-2">
            <a class="btn btn-primary" href="{{ route('users.create') }}"> Create New User</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Roles</th>
        <th width="280px">Action</th>
    </tr>
    @if($users->isEmpty())
    <tr>
        <td colspan="4" class="text-center">No records found</td>
    </tr>
    @else
    @foreach ($users as $user)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            @if(!empty($user->getRoleNames()))
            @foreach($user->getRoleNames() as $v)
            <label class="badge badge-success">{{ $v }}</label>
            @endforeach
            @endif
        </td>
        <td>
            <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                <a href="{{ route('users.show',$user->id) }}"><i class="fa fa-eye"></i></a>
                <a href="{{ route('users.edit',$user->id) }}"><i class="fa fa-edit"></i></a>
                @csrf
                @method('DELETE')
                <button type="submit"><i class="fa fa-trash"></i></button>
            </form>
        </td>
    </tr>
    @endforeach
    @endif
</table>

{!! $users->links() !!}

@endsection