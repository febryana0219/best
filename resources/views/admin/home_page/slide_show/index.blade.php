@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Home Page</li>
            <li class="breadcrumb-item active">Slide Show</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Slide Show</h4>
        <div>
            <a href="{{ route('admin.homepage.slide_show.create') }}" class="btn btn-primary waves-effect me-2">+ Add Slide Show</a>
            <a href="{{ route('admin.homepage.slide_show.order') }}" class="btn btn-info waves-effect">Slide Show Order</a>
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
                        <th width="15%">Image</th>
                        <th width="20%">Title</th>
                        <th width="20%">Sub Title</th>
                        <th>URL</th>
                        <th width="7%">Publish</th>
                        <th width="12%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($slide_show as $row)
                    <tr>
                        <td valign="top">{{ $no++ }}</td>
                        <td valign="top">
                            <img src="{{ asset('storage/uploads/slide_show/' . $row->img_landscape) }}" width="150" alt="Landscape Image">
                        </td>
                        <td valign="top">{!! $row->title !!}</td>
                        <td valign="top">{{ $row->subtitle }}</td>
                        <td valign="top">{{ $row->url }}</td>
                        <td valign="top" align="center" style="text-align: center;">
                            <div class="form-check form-switch mb-2" style="display: flex; justify-content: center;">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked{{ $row->id }}" {{ $row->publish ? 'checked' : '' }} onchange="updateStatus({{ $row->id }}, this.checked, '{{ route('admin.homepage.slide_show.publish', ':id') }}', 'publish')">
                            </div>
                        </td>
                        <td valign="top">
                            <a href="{{ route('admin.homepage.slide_show.edit', $row->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="ri-edit-line"></i></a>
                            <button class="btn btn-dark btn-sm" title="Delete" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                onclick="setDeleteFormAction('{{ route('admin.homepage.slide_show.destroy', $row->id) }}')">
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
                    Are you sure you want to delete this slide show?
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
