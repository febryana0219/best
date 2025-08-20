@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Contact</li>
            <li class="breadcrumb-item active">Contact Whatsapp</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Contact Whatsapp</h4>
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
            <form id="action-form" action="{{ route('admin.contact.whatsapp.update') }}" method="POST">
                @csrf
                @method('PUT')

                <table class="table">
                    <thead>
                        <tr>
                            <th>Whatsapp Number</th>
                            <th>Last Update</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="contact_whatsapp" placeholder="Whatsapp Number" value="{{ old('contact_whatsapp', $whatsapp->value) }}" required>
                            </td>
                            <td>{{ $whatsapp->updated_at->format('d-m-Y H:i:s') }}</td>
                            <td>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
@endsection
