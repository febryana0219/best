@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Systems</li>
            <li class="breadcrumb-item active">Social Link</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Social Link</h4>
        <div>
            <a href="{{ route('admin.system.social_link.create') }}" class="btn btn-primary waves-effect me-2">+ Add Social Link</a>
            <a href="{{ route('admin.system.social_link.order') }}" class="btn btn-info waves-effect">Social Link Order</a>
        </div>
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

    <div id="alertContainer"></div>

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table" width="100%">
                <thead>
                    <tr>
                        <th width="2%">No</th>
                        <th width="10%">Name</th>
                        <th width="15%">Icon</th>
                        <th>URL</th>
                        <th width="5%">Publish</th>
                        <th width="12%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($socialLink as $row)
                    <tr>
                        <td valign="top">{{ $no++ }}</td>
                        <td valign="top">{{ $row->name }}</td>
                        <td valign="top">{{ $row->icon }}</td>
                        <td valign="top" style="word-break: break-word; white-space: normal;">{{ $row->link }}</td>
                        <td valign="top" align="center" style="text-align: center;">
                            <div class="form-check form-switch mb-2" style="display: flex; justify-content: center;">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked{{ $row->id }}" {{ $row->publish ? 'checked' : '' }} onchange="updateStatus({{ $row->id }}, this.checked, '{{ route('admin.system.social_link.publish', ':id') }}', 'publish')">
                            </div>
                        </td>
                        <td valign="top">
                            <a href="{{ route('admin.system.social_link.edit', $row->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="ri-edit-line"></i></a>
                            <form action="{{ route('admin.system.social_link.destroy', $row->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-dark btn-sm"><i class="ri-delete-bin-line" title="Delete"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

