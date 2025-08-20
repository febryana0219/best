@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Catalogs</li>
            <li class="breadcrumb-item">Category</li>
            <li class="breadcrumb-item active">Add Category</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Add Category</h4>
        <a href="{{ route('admin.catalog.category.index') }}" class="btn btn-secondary waves-effect">Back to Category</a>
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
                    <form action="{{ route('admin.catalog.category.store') }}" method="POST">
                        @csrf

                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Category Name</label>
                            <div class="col-sm-4">
                                <input type="text" name="name" class="form-control" placeholder="Category Name" />
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
