@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Quality Control</li>
            <li class="breadcrumb-item">Project</li>
            <li class="breadcrumb-item active">Edit Project</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Edit Project</h4>
        <a href="{{ route('admin.qc.project.index') }}" class="btn btn-secondary waves-effect">Back to Project</a>
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
                    <form action="{{ route('admin.qc.project.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Project Name <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="name" class="form-control" placeholder="Project Name" value="{{ old('name', $project->name) }}" required/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Project Date <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <input type="date" name="project_date" class="form-control" value="{{ old('project_date', $project->project_date) }}" required />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Client <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="client" class="form-control" placeholder="Client" value="{{ old('client', $project->client) }}" required/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Product </label>
                            <div class="col-sm-4">
                                <input type="text" name="product" class="form-control" placeholder="Product" value="{{ old('product', $project->product) }}"/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Project Info <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="project_info" placeholder="Project Info" rows="7" required>{{ old('project_info', $project->project_info) }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Category <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach ($category as $c)
                                        <option value="{{ $c->id }}" {{ old('category_id', $project->category_id ?? '') == $c->id ? 'selected' : '' }}>
                                            {{ $c->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Current Image</label>
                            <div class="col-sm-4">
                                @if($project->image)
                                    <img src="{{ asset('storage/uploads/quality_control/' . $project->image) }}" width="200" alt="Current Image" />
                                @else
                                    <p>No image uploaded.</p>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Select New Image</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="image" />
                                <div class="form-text">* Best Resolution 400x475</div>
                                <small class="form-text text-muted">Leave blank if you do not want to change the image.</small>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Password <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="password" class="form-control" placeholder="Password" value="{{ old('password', $project->password) }}" required/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Publish <span class="text-danger">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-select" id="publish" name="publish" required>
                                    <option value="1" {{ old('publish', $project->publish) == '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('publish', $project->publish) == '0' ? 'selected' : '' }}>No</option>
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
