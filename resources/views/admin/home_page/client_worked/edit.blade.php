@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Home Page</li>
            <li class="breadcrumb-item">Client Worked</li>
            <li class="breadcrumb-item active">Edit Client Worked</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Edit Client Worked</h4>
        <a href="{{ route('admin.homepage.client_worked.index') }}" class="btn btn-secondary waves-effect">Back to Client Worked</a>
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
            <div class="card mb-6">
                <div class="card-body">
                    <form action="{{ route('admin.homepage.client_worked.update', $client_worked->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-4">
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name', $client_worked->name) }}" required/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label"> </label>
                            <div class="col-sm-4">
                                <img src="{{ asset('storage/uploads/client_worked/' . $client_worked->img) }}" width="200" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="img" />
                                <div class="form-text">* Best Resolution 1920x1280</div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
