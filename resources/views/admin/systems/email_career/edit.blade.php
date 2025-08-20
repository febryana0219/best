@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Systems</li>
            <li class="breadcrumb-item">Email Career</li>
            <li class="breadcrumb-item active">Edit Email Career</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Edit Email Career</h4>
        <a href="{{ route('admin.system.email_career.index') }}" class="btn btn-secondary waves-effect">Back to Email Career</a>
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
                    <form action="{{ route('admin.system.email_career.update', $email->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">From Name</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="mail_from_name" placeholder="From Address" value="{{ old('mail_from_name', $email->mail_from_name) }}" required/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Host</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="mail_host" placeholder="Host" value="{{ old('mail_host', $email->mail_host) }}" required/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Port</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="mail_port" placeholder="Port" value="{{ old('mail_port', $email->mail_port) }}" required/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Sender Email</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="mail_username" placeholder="Sender Email" value="{{ old('mail_username', $email->mail_username) }}" required/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Sender Password</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="mail_password" placeholder="Sender Password" value="{{ old('mail_password', $email->mail_password) }}" required/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Ecryption</label>
                            <div class="col-sm-2">
                                <select class="form-select" name="mail_encryption" required/>
                                    <option value="ssl" {{ $email->mail_encryption ? 'selected' : '' }}>ssl</option>
                                    <option value="tls" {{ !$email->mail_encryption ? 'selected' : '' }}>tls</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">From Address</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="mail_from_address" placeholder="From Address" value="{{ old('mail_from_address', $email->mail_from_address) }}" required/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">HRD Email</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="mail_hrd" placeholder="HRD Email" value="{{ old('mail_hrd', $email->mail_hrd) }}" required/>
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
