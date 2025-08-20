@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Home Page</li>
            <li class="breadcrumb-item">Slide Show</li>
            <li class="breadcrumb-item active">Edit Slide Show</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Edit Slide Show</h4>
        <a href="{{ route('admin.homepage.slide_show.index') }}" class="btn btn-secondary waves-effect">Back to Slide Show</a>
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
                    <form action="{{ route('admin.homepage.slide_show.update', $slide_show->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-4">
                                <input type="text" name="title" class="form-control" placeholder="Title" value="{{ old('name', $slide_show->title) }}" required/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Sub Title</label>
                            <div class="col-sm-4">
                                <input type="text" name="subtitle" class="form-control" placeholder="Sub Title" value="{{ old('name', $slide_show->subtitle) }}" required/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">URL</label>
                            <div class="col-sm-4">
                                <input type="text" name="url" class="form-control" placeholder="URL" value="{{ old('name', $slide_show->url) }}" />
                                <div class="form-text">* https://</div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label"> </label>
                            <div class="col-sm-4">
                                <img src="{{ asset('storage/uploads/slide_show/' . $slide_show->img_landscape) }}" width="200" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="img_landscape" />
                                <div class="form-text">* Best Resolution 1920x1280</div>
                            </div>
                        </div>
                        {{-- <div class="row mb-4">
                            <label class="col-sm-2 col-form-label"> </label>
                            <div class="col-sm-4">
                                <img src="{{ asset('storage/uploads/slide_show/' . $slide_show->img_portrait) }}" width="100" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Image Portrait</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="img_portrait" />
                            </div>
                        </div> --}}

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
