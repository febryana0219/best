@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Contact</li>
            <li class="breadcrumb-item">Contact Address</li>
            <li class="breadcrumb-item active">Edit Address</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Edit Address</h4>
    </div>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                <div class="card-body">
                    <form action="{{ route('admin.contact.address.update', $contactAddress->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="name" value="{{ $contactAddress->name }}" required/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="editor" name="address" style="height: 60px">{{ $contactAddress->address }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Longitude</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="longitude" value="{{ $contactAddress->longitude }}" required/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Latitude</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="latitude" name="latitude" value="{{ $contactAddress->latitude }}" required/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Publish</label>
                            <div class="col-sm-2">
                                <select class="form-select" id="publish" name="publish" required/>
                                    <option value="1" {{ $contactAddress->publish ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ !$contactAddress->publish ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.contact.address.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

