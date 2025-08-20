@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Quality Control</li>
            <li class="breadcrumb-item">Project</li>
            <li class="breadcrumb-item">Detail Image</li>
            <li class="breadcrumb-item active">Edit Detail Image</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Edit Detail Image</h4>
        <a href="{{ route('admin.qc.project.detail_image.index', $projectId) }}" class="btn btn-secondary waves-effect">Back To Detail Image</a>
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
                    <form action="{{ route('admin.qc.project.detail_image.update', ['projectId' => $projectId, 'id' => $detailImage->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Image Name <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="name" class="form-control" placeholder="Project Name" value="{{ old('name', $detailImage->name) }}" required/>
                            </div>
                        </div>
                        @if($detailImage->img)
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label">Current Image</label>
                                <div class="col-sm-4">
                                    <img src="{{ asset('storage/uploads/project_image/' . $detailImage->img) }}" alt="Current Image" width="150">
                                </div>
                            </div>
                        @endif
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Select Image</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="img" />
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
