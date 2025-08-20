@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Catalog</li>
            <li class="breadcrumb-item">Product</li>
            <li class="breadcrumb-item active">Order By Category</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Order By Category</h4>
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

    <div class="row mb-4">
        <label class="col-sm-2 col-form-label">Select Category <span class="text-danger">*</span></label>
        <div class="col-sm-4">
            <form method="GET" action="{{ route('admin.catalog.product.order') }}">
            <select name="category_id" id="category" class="form-control" onchange="this.form.submit()">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </form>
        </div>
    </div>

    <!-- Sortable List -->
    @if($products->isNotEmpty())
        <form action="{{ route('admin.catalog.product.order.update') }}" method="POST">
            @csrf
            <div class="card mb-4">
                <div class="card-body">
                    <ul id="sortable" class="list-group list-group-flush">
                        @foreach($products as $row)
                            <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $row->category_id }}">
                                {{ $row->name }}
                                <input type="hidden" name="order[]" value="{{ $row->id }}">
                                <i class="mdi mdi-drag text-muted"></i>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
        </form>
    @endif
</div>
@endsection
