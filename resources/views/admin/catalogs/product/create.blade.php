@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Catalog</li>
            <li class="breadcrumb-item">Product</li>
            <li class="breadcrumb-item active">Add Product</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Add Product</h4>
        <a href="{{ route('admin.catalog.product.index') }}" class="btn btn-secondary waves-effect">Back to Product</a>
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
                    <!-- Tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="product-details-tab" data-bs-toggle="tab" href="#product-details" role="tab" aria-controls="product-details" aria-selected="true">Product Details</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="images-tab" data-bs-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="false">Images</a>
                        </li>
                    </ul>

                    <div class="tab-content mt-3" id="myTabContent">
                        <div class="tab-pane fade show active" id="product-details" role="tabpanel" aria-labelledby="product-details-tab">
                            <form action="{{ route('admin.catalog.product.store') }}" method="POST">
                                @csrf
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">Product Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="name" class="form-control" placeholder="Product Name" required/>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">Subtitle <span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="subtitle" class="form-control" placeholder="Subtitle" required/>
                                        <div class="form-text">* Max 60 characters</div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">Category <span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <select class="form-select" id="category_id" name="category_id" required>
                                            <option value="">Select Category</option>
                                            @foreach ($category as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">Description <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="editor" name="description" style="height: 60px"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">Video </label>
                                    <div class="col-sm-4">
                                        <input type="text" name="video" class="form-control" placeholder="Link Video" />
                                        <div class="form-text">* Link Youtube</div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">Publish <span class="text-danger">*</span></label>
                                    <div class="col-sm-2">
                                        <select class="form-select" id="publish" name="publish" required>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                            <h5 class="mt-3">Product Images</h5>
                            <p><span class="text-danger">* Images can be uploaded after saving product details.</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
