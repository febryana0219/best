@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Quality Control</li>
            <li class="breadcrumb-item active">Project</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Project</h4>
        <div>
            <a href="{{ route('admin.qc.project.create') }}" class="btn btn-primary waves-effect me-2">+ Add Project</a>
        </div>
    </div>

    <!-- Search form -->
    <form action="{{ route('admin.qc.project.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Search..." value="{{ request()->input('search') }}">
            <button class="btn btn-secondary" type="submit">Search</button>
        </div>
    </form>

    @if (session('success') || session('error'))
        <div class="alert alert-{{ session('success') ? 'success' : 'danger' }} alert-dismissible fade show" role="alert">
            {{ session('success') ?? session('error') }}
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
            <table class="table" width="120%">
                <thead>
                    <tr>
                        {{-- <th width="7%">No</th> --}}
                        <th>Image</th>
                        <th>Project Name</th>
                        {{-- <th>Project Date</th>
                        <th>Client</th>
                        <th>Product</th> --}}
                        <th>Category</th>
                        <th>Password</th>
                        <th>Publish</th>
                        <th>Project Detail</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($project as $row)
                    <tr class="text-nowrap">
                        {{-- <td valign="top">{{ $no++ }}</td> --}}
                        <td valign="top" align="center">
                            @if ($row->image)
                                <img src="{{ asset('storage/uploads/quality_control/' . $row->image) }}" alt="{{ $row->name }}" width="150">
                            @else
                                <img src="{{ asset('storage/uploads/default/default.jpg') }}" alt="No image available" width="100">
                            @endif
                        </td>
                        <td valign="top">{{ $row->name }}</td>
                        {{-- <td valign="top">
                            {{ $row->project_date ? \Carbon\Carbon::parse($row->project_date)->format('d-m-Y') : '' }}
                        </td>
                        <td valign="top">{{ $row->client }}</td>
                        <td valign="top">{{ $row->product }}</td> --}}
                        <td valign="top">{{ $row->category->name }}</td>
                        <td valign="top">{{ $row->password }}</td>
                        <td valign="top" align="center" style="text-align: center;">
                            <div class="form-check form-switch mb-2" style="display: flex; justify-content: center;">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked{{ $row->id }}" {{ $row->publish ? 'checked' : '' }} onchange="updateStatus({{ $row->id }}, this.checked, '{{ route('admin.qc.project.publish', ':id') }}', 'publish')">
                            </div>
                        </td>
                        <td valign="top">
                            <a href="{{ route('admin.qc.project.detail_image.index', $row->id) }}" class="btn btn-info btn-sm" title="Project Detail"><i class="ri-file-image-line"></i></a>
                            <a href="{{ route('admin.qc.project.project_detail.index', $row->id) }}" class="btn btn-info btn-sm" title="Project Detail"><i class="ri-file-list-line"></i></a>
                        </td>
                        <td valign="top">
                            <a href="{{ route('admin.qc.project.edit', $row->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="ri-edit-line"></i></a>
                            <button class="btn btn-dark btn-sm" title="Delete" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                onclick="setDeleteFormAction('{{ route('admin.qc.project.destroy', $row->id) }}')">
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
        {{ $project->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
    </div>

    <!-- Modal Delete Confirmation -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this project?
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
