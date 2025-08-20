@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Systems</li>
            <li class="breadcrumb-item active">Edit Social Link</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Edit Social Link</h4>
        <a href="{{ route('admin.system.social_link.index') }}" class="btn btn-secondary waves-effect">Back to Social Link</a>
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
                    <form action="{{ route('admin.system.social_link.update', $socialLink->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name', $socialLink->name) }}" required/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Icon</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="icon" placeholder="Icon" value="{{ old('name', $socialLink->icon) }}" required/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">URL</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="link" placeholder="URL" value="{{ old('name', $socialLink->link) }}" required/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Publish</label>
                            <div class="col-sm-2">
                                <select class="form-select" id="publish" name="publish" required/>
                                    <option value="1" {{ $socialLink->publish ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ !$socialLink->publish ? 'selected' : '' }}>No</option>
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
