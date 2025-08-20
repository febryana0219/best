@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Manage Static Page</li>
            <li class="breadcrumb-item">News</li>
            <li class="breadcrumb-item active">Edit News</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Edit News</h4>
        <a href="{{ route('admin.static_page.news.index', ['page' => request('page')]) }}" class="btn btn-secondary waves-effect">Back to News</a>
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
                    <form action="{{ route('admin.static_page.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Title <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <input type="hidden" name="updated_by" value="{{ session('user_id') }}">
                                <input type="text" name="title" class="form-control" placeholder="Title" value="{{ old('title', $news->title) }}" required/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Description <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description" rows="7" required>{{ old('description', $news->description) }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label"> </label>
                            <div class="col-sm-4">
                                <img src="{{ asset('storage/uploads/news/' . $news->img) }}" width="200" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="img"/>
                                <div class="form-text">* Best Resolution 860x500</div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Publish <span class="text-danger">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-select" id="publish" name="publish" required>
                                    <option value="1" {{ old('publish', $news->publish) == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('publish', $news->publish) == 0 ? 'selected' : '' }}>No</option>
                                </select>
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
