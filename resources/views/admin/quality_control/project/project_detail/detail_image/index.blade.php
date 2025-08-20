@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item active"></li>
            <li class="breadcrumb-item">Quality Control</li>
            <li class="breadcrumb-item">Project</li>
            <li class="breadcrumb-item">Project Detail</li>
            <li class="breadcrumb-item active">Project Detail Image</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Project Detail Image for {{ $projectDetail->equipment_code }}</h4>
        <div>
            <a href="{{ route('admin.qc.project.project_detail_image.create', $projectDetail->id) }}" class="btn btn-primary waves-effect me-2">+ Add Detail Image</a>
            <a href="{{ route('admin.qc.project.project_detail.index', $projectDetail->project_id) }}" class="btn btn-secondary waves-effect">Back to Project Detail</a>
        </div>
    </div>

    <!-- Search form -->
    <form action="{{ route('admin.qc.project.project_detail_image.index', $projectDetail->id) }}" method="GET" class="mb-3">
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
                        <th width="20%">Equipment Code</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th width="10%">Order Id</th>
                        <th width="12%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($detailImage as $row)
                    <tr>
                        <td valign="top">{{ $no++ }}</td>
                        <td valign="top">{{ $projectDetail->equipment_code }}</td>
                        <td valign="top">{{ $row->name }}</td>
                        <td valign="top" align="center">
                            @if ($row->img)
                                <img src="{{ asset('storage/uploads/quality_control_detail/' . $row->img) }}" alt="{{ $row->name }}" width="150">
                            @else
                                <img src="{{ asset('storage/uploads/default/default.jpg') }}" alt="No image available" width="100">
                            @endif
                        </td>
                        <td valign="top">{{ $row->order_id }}</td>
                        <td valign="top">
                            <a href="{{ route('admin.qc.project.project_detail_image.edit', [$projectDetail->id, $row->id]) }}" class="btn btn-warning btn-sm" title="Edit"><i class="ri-edit-line"></i></a>
                            <button class="btn btn-dark btn-sm" title="Delete" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                onclick="setDeleteFormAction('{{ route('admin.qc.project.project_detail_image.destroy',  [$projectDetail->id, $row->id]) }}')">
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
        {{ $detailImage->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
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
