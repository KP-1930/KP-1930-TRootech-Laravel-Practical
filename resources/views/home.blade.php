@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @php
            $userCount = \App\Models\User::where('is_admin', '!=', 1)->count();
            $roleCount = \Spatie\Permission\Models\Role::count();
            @endphp
            <div class="card">
                @if(auth()->user()->is_admin == 1)
                <div class="card-header">{{ __('Admin Dashboard') }}</div>
                @else
                <div class="card-header">{{ __('User Dashboard') }}</div>
                @endif
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            @if(Auth::user()->hasRole('admin'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('users.index')}}">Manage Users <span class="badge bg-primary">{{ $userCount }}</span></a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('roles.index')}}">Manage Roles <span class="badge bg-primary">{{ $roleCount }}</span></a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <p class="text-center"><strong>{{ Auth::user()->name }}</strong> {{ __('logged in!') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection