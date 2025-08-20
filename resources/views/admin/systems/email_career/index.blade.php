@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Systems</li>
            <li class="breadcrumb-item active">Email Career</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Email Career</h4>
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

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table" width="100%">
                <thead>
                    <tr>
                        <th>From Name</th>
                        <th>Host</th>
                        <th>Port</th>
                        <th>Sender Email</th>
                        <th>Sender Password</th>
                        <th>Encryption</th>
                        <th>From Address</th>
                        <th>HRD Email</th>
                        <th width="12%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td valign="top">{{ $email->mail_from_name }}</td>
                        <td valign="top">{{ $email->mail_host }}</td>
                        <td valign="top">{{ $email->mail_port }}</td>
                        <td valign="top">{{ $email->mail_username }}</td>
                        <td valign="top">{{ $email->mail_password }}</td>
                        <td valign="top">{{ $email->mail_encryption }}</td>
                        <td valign="top">{{ $email->mail_from_address }}</td>
                        <td valign="top">{{ $email->mail_hrd }}</td>
                        <td valign="top">
                            <a href="{{ route('admin.system.email_career.edit', $email->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="ri-edit-line"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

