@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Systems</li>
            <li class="breadcrumb-item">Administrator</li>
            <li class="breadcrumb-item active">Edit Administrator</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Edit Administrator</h4>
        <a href="{{ route('admin.system.administrator.index') }}" class="btn btn-secondary waves-effect">Back to Administrator</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                <div class="card-body">
                    <form action="{{ route('admin.system.administrator.update', $administrator->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-4">
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $administrator->name) }}" placeholder="Name" required>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-4">
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $administrator->email) }}" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-4">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Confirm Password</label>
                            <div class="col-sm-4">
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
