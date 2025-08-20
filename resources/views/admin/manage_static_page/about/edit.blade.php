@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Manage Static Page</li>
            <li class="breadcrumb-item">About</li>
            <li class="breadcrumb-item active">Edit About</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Edit About</h4>
    </div>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                <div class="card-body">
                    <form action="{{ route('admin.static_page.about.update', $about->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-4">
                                <input type="text" name="title" class="form-control" placeholder="Title" value="{{ old('title', $about->title) }}" required/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description" placeholder="Description" rows="7" required>{{ old('description', $about->description) }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label"> </label>
                            <div class="col-sm-4">
                                <img src="{{ asset('storage/uploads/about/' . $about->img1) }}" width="200" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Image 480x565</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="img1" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label"> </label>
                            <div class="col-sm-4">
                                <img src="{{ asset('storage/uploads/about/' . $about->img2) }}" width="200" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Image 425x300</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="img2" />
                            </div>
                        </div>

                        <!-- Button Group Aligned to the Right -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-2">Update</button>
                            <a href="{{ route('admin.static_page.about.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
