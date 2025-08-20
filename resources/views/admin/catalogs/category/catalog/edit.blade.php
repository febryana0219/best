@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Catalogs</li>
            <li class="breadcrumb-item">Category</li>
            <li class="breadcrumb-item">Catalog</li>
            <li class="breadcrumb-item active">Edit Catalog</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Edit Catalog</h4>
        <a href="{{ route('admin.catalog.category.catalog.index', $category->id) }}" class="btn btn-secondary waves-effect">Back to Catalog - {{ $category->name }}</a>
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
                    <form action="{{ route('admin.catalog.category.catalog.update', ['categoryId' => $category->id, 'id' => $catalog->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-4">
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name', $catalog->name) }}" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">File</label>
                            <div class="col-sm-4">
                                <a href="{{ asset('storage/uploads/catalog/' . $catalog->file) }}" target="_blank">{{ $catalog->file }}</a>
                                <input class="form-control" type="file" name="file" />
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
