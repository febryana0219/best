@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Systems</li>
            <li class="breadcrumb-item active">Administrator</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Administrator</h4>
        <div>
            <a href="{{ route('admin.system.administrator.create') }}" class="btn btn-primary waves-effect me-2">+ Add Administrator</a>
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
                        <th width="7%">No</th>
                        <th>Email</th>
                        <th width="15%">Name</th>
                        <th width="7%">Active</th>
                        <th width="12%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($administrator as $row)
                    <tr>
                        <td valign="top">{{ $no++ }}</td>
                        <td valign="top">{{ $row->email }}</td>
                        <td valign="top">{{ $row->name }}</td>
                        <td valign="top" align="center" style="text-align: center;">
                            <div class="form-check form-switch mb-2" style="display: flex; justify-content: center;">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked{{ $row->id }}" {{ $row->active ? 'checked' : '' }} onchange="updateStatus({{ $row->id }}, this.checked, '{{ route('admin.system.administrator.active', ':id') }}', 'active')">
                            </div>
                        </td>
                        <td valign="top">
                            <a href="{{ route('admin.system.administrator.edit', $row->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="ri-edit-line"></i></a>
                            <button class="btn btn-dark btn-sm" title="Delete" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                onclick="setDeleteFormAction('{{ route('admin.system.administrator.destroy', $row->id) }}')">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Delete Confirmation -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"> <!-- Add modal-dialog-centered class -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this administrator?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" action="" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
