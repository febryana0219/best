@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item active"></li>
            <li class="breadcrumb-item">Quality Control</li>
            <li class="breadcrumb-item">Project</li>
            <li class="breadcrumb-item active">Project Detail</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Project Detail for {{ $projectHeader->name }}</h4>
        <div>
            <a href="{{ route('admin.qc.project.project_detail.create', $projectHeader->id) }}" class="btn btn-primary waves-effect me-2">+ Add Project Detail</a>
            <a href="{{ route('admin.qc.project.index') }}" class="btn btn-secondary waves-effect">Bact to Project</a>
        </div>
    </div>

    <!-- Search form -->
    <form action="{{ route('admin.qc.project.project_detail.index', $projectHeader->id) }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Search..." value="{{ request()->input('search') }}">
            <button class="btn btn-secondary" type="submit">Search</button>
        </div>
    </form>

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
                        <th width="20%">Project Header</th>
                        <th>Item Code</th>
                        <th>No Production</th>
                        <th>Date</th>
                        <th>Detail Image</th>
                        <th width="12%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($projectDetail as $row)
                    <tr>
                        <td valign="top">{{ $no++ }}</td>
                        <td valign="top">{{ $projectHeader->name }}</td>
                        <td valign="top">{{ $row->equipment_code }}</td>
                        <td valign="top">{{ $row->production_number }}</td>
                        <td valign="top">{{ $row->date->format('d-m-Y') }}</td>
                        <td valign="top">
                            <a href="{{ route('admin.qc.project.project_detail_image.index', $row->id) }}" class="btn btn-info btn-sm" title="Project Detail">Detail Image</a>
                        </td>
                        <td valign="top">
                            <a href="{{ route('admin.qc.project.project_detail.edit', [$projectHeader->id, $row->id]) }}" class="btn btn-warning btn-sm" title="Edit"><i class="ri-edit-line"></i></a>
                            <button class="btn btn-dark btn-sm" title="Delete" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                onclick="setDeleteFormAction('{{ route('admin.qc.project.project_detail.destroy',  [$projectHeader->id, $row->id]) }}')">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $projectDetail->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
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
                    Are you sure you want to delete this project detail?
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
