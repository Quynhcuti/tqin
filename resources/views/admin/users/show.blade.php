@extends('admin.layouts.master')
@section('title')
    Chi tiết người dùng
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Chi tiết người dùng: {{ $users->name }}</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row g-0">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold text-danger">Id: {{ $users->id }}</h5>
                        <h5 class="card-title font-weight-bold text-danger">Name: {{ $users->username }}</h5>
                        <h5 class="card-title font-weight-bold text-danger">Name: {{ $users->fullname }}</h5>
                        <p class="card-text">
                            <span class="font-weight-bold text-capitalize">Email:</span>
                            {{ $users->email }}
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold text-capitalize">role:</span>
                            @if ($users->role == 'user')
                                <span class="badge btn btn-primary">User</span>
                            @else
                                <span class="badge btn btn-danger">Admin</span>
                            @endif
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold text-capitalize">created_at:</span>
                            {{ date('d/m/Y', strtotime($users->created_at)) }}
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold text-capitalize">updated_at:</span>
                            {{ date('d/m/y', strtotime($users->updated_at)) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('users.index') }}" class="badge btn btn-danger p-3">Quay lại</a>
    </div>
@endsection