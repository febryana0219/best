@extends('admin.layouts.master-layout')

@section('title', 'Catalogs - ' . $category->name)

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Catalogs</li>
            <li class="breadcrumb-item">Category</li>
            <li class="breadcrumb-item active">Catalog</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Catalog for {{ $category->name }}</h4>
        <div>
            <a href="{{ route('admin.catalog.category.catalog.create', $category->id) }}"class="btn btn-primary waves-effect me-2">+ Add Catalog</a>
            <a href="{{ route('admin.catalog.category.index') }}" class="btn btn-secondary waves-effect">Bact to Category</a>
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

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table" width="100%">
                <thead>
                    <tr>
                        <th width="7%">No</th>
                        <th width="15%">Name</th>
                        <th>File</th>
                        <th width="12%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($catalogs as $catalog)
                    <tr>
                        <td valign="top">{{ $no++ }}</td>
                        <td valign="top">{{ $catalog->name }}</td>
                        <td valign="top">
                            <a href="{{ asset('storage/uploads/catalog/' . $catalog->file) }}" target="_blank">{{ $catalog->file }}</a>
                        </td>
                        <td>
                            <a href="{{ route('admin.catalog.category.catalog.edit', [$category->id, $catalog->id]) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="ri-edit-line"></i>
                            </a>
                            <button class="btn btn-dark btn-sm" title="Delete" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                onclick="setDeleteFormAction('{{ route('admin.catalog.category.catalog.destroy', [$category->id, $catalog->id]) }}')">
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this catalog?
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

