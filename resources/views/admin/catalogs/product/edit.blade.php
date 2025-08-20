@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Catalog</li>
            <li class="breadcrumb-item">Product</li>
            <li class="breadcrumb-item active">Edit Product</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Edit Product</h4>
        <a href="{{ route('admin.catalog.product.index') }}" class="btn btn-secondary waves-effect">Back to Product</a>
    </div>

    @if (session('success'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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

    <div id="alertContainer"></div>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                <div class="card-body">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="product-details-tab" data-bs-toggle="tab" href="#product-details" role="tab" aria-controls="product-details" aria-selected="true">Product Details</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="images-tab" data-bs-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="false">Images</a>
                        </li>
                    </ul>

                    <form action="{{ route('admin.catalog.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                        <input type="hidden" id="action_type" name="action_type" value="save">

                        <div class="tab-content mt-3" id="myTabContent">
                            <div class="tab-pane fade" id="product-details" role="tabpanel" aria-labelledby="product-details-tab">
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">Product Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" placeholder="Product Name" required/>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">Subtitle <span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $product->subtitle) }}" placeholder="Subtitle" required/>
                                        <div class="form-text">* Max 60 characters</div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">Category <span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <select class="form-select" id="category_id" name="category_id" required>
                                            <option value="">Select Category</option>
                                            @foreach ($category as $row)
                                                <option value="{{ $row->id }}"{{ (isset($product) && $product->category_id == $row->id) ? 'selected' : '' }}>
                                                    {{ $row->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">Description <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="editor" name="description" style="height: 60px" required>{{ old('description', $product->description) }}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">Video </label>
                                    <div class="col-sm-4">
                                        <input type="text" name="video" class="form-control" value="{{ old('video', $product->video) }}" placeholder="Link Video" />
                                        <div class="form-text">* Link Youtube</div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">Publish <span class="text-danger">*</span></label>
                                    <div class="col-sm-2">
                                        <select class="form-select" id="publish" name="publish" required/>
                                        <option value="1" {{ $product->publish ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ !$product->publish ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="images" role="tabpanel" aria-labelledby="images-tab">
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-4">
                                        <input type="file" class="form-control" name="img" />
                                        <div class="form-text">* Best Resolution 1000x1000</div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label"> </label>
                                    <div class="col-sm-10">
                                        @if ($product->images()->count() > 0)
                                            <div class="row">
                                                @foreach ($product->images as $image)
                                                    <div class="col-md-3 mb-3">
                                                        <div class="card">
                                                            <div class="d-flex justify-content-center align-items-center" style="height: 150px;">
                                                                <img src="{{ asset('storage/uploads/product/' . $image->img) }}" alt="{{ $product->name }}" class="img-fluid" width="150" height="150">
                                                            </div>
                                                            <div class="card-body text-center">
                                                                <a href="#" class="btn {{ $image->as_default ? 'btn-success' : 'btn-secondary' }} btn-sm"
                                                                    title="{{ $image->as_default ? 'Is Default' : 'Set Default' }}"
                                                                    onclick="updateStatus({{ $image->id }}, {{ $image->as_default ? 'false' : 'true' }}, '{{ route('admin.catalog.product.product_image.default', ':id') }}', 'as_default')">
                                                                        <i class="ri-check-line"></i>
                                                                </a>
                                                                <a href="#" class="btn {{ $image->publish ? 'btn-info' : 'btn-secondary' }} btn-sm"
                                                                    title="{{ $image->publish ? 'Is Publish' : 'Set Publish' }}"
                                                                    onclick="updateStatus({{ $image->id }}, {{ $image->publish ? 'false' : 'true' }}, '{{ route('admin.catalog.product.product_image.publish', ':id') }}', 'publish')">
                                                                        <i class="ri-eye-line"></i>
                                                                </a>
                                                                <button class="btn btn-dark btn-sm" title="Delete" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                                    onclick="setDeleteFormAction('{{ route('admin.catalog.product.product_image.destroy', $image->id) }}'); event.preventDefault();">
                                                                    <i class="ri-delete-bin-line"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" onclick="document.getElementById('action_type').value='save';">Save</button>
                            <button type="submit" class="btn btn-info" onclick="document.getElementById('action_type').value='save_exit';">Save & Exit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Confirmation -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"> <!-- Add modal-dialog-centered class -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product image?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" action="" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
