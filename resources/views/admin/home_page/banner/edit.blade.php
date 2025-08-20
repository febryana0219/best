@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Home Page</li>
            <li class="breadcrumb-item active">Banner</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Banner</h4>
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

    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                <div class="card-body">
                    <form action="{{ route('admin.homepage.banner.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @foreach ($tiles as $index => $tile)
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label"> </label>
                                <div class="col-sm-4">
                                    <img src="{{ asset('storage/uploads/content/' . $tile['picture']->value) }}" alt="Tile {{ $index }} Picture" class="img-thumbnail mb-3" width="100" />
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label">Tile {{ $index }} Picture</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="file" name="picture[{{ $index }}]" />
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label">Tile {{ $index }} Title</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="title[{{ $index }}]" value="{{ $tile['title']->value }}" placeholder="Title for Tile {{ $index }}" />
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label">Tile {{ $index }} Button</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="button[{{ $index }}]" value="{{ $tile['button']->value }}" placeholder="Button for Tile {{ $index }}" />
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label">Tile {{ $index }} Link</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="link[{{ $index }}]" value="{{ $tile['link']->value }}" placeholder="Link for Tile {{ $index }}" />
                                </div>
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
