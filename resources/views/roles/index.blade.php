@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Role List</h2>
        </div>
        <div class="float-right m-2">
            @can('role-create')
            <a class="btn btn-primary" href="{{ route('roles.create') }}"> Create New Role</a>
            @endcan
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
        <th width="280px">Action</th>
    </tr>

    @if($roles->isEmpty())
    <tr>
        <td colspan="3" class="text-center">No records found</td>
    </tr>
    @else
    @foreach ($roles as $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            <a href="{{ route('roles.show',$role->id) }}"><i class="fa fa-eye"></i></a>
            @can('role-edit')
            <a href="{{ route('roles.edit',$role->id) }}"><i class="fa fa-edit"></i></a>
            @endcan

            @can('role-delete')
            <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"><i class="fa fa-trash"></i></button>
            </form>
            @endcan
        </td>
    </tr>
    @endforeach
    @endif
</table>

{!! $roles->links() !!}

@endsection