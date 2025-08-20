@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Manage Static Page</li>
            <li class="breadcrumb-item active">Page Header</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Page Header</h4>
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
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Show on Footer</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($static_page as $row)

                    <tr>
                        <td valign="top">{{ $no++ }}</td>
                        <td valign="top">
                            <img src="{{ asset('storage/uploads/pages/' . $row->img) }}" width="250">
                        </td>
                        <td valign="top">{{ $row->name }}</td>
                        <td valign="top" align="center" style="text-align: center;">
                            <div class="form-check form-switch mb-2" style="display: flex; justify-content: center;">
                                <input class="form-check-input" type="checkbox"
                                id="flexSwitchCheckChecked{{ $row->id }}" {{ $row->show_footer ? 'checked' : '' }}
                                onchange="updateStatus({{ $row->id }}, this.checked, '{{ route('admin.static_page.page_header.update_show_footer', ':id') }}', 'show_footer')">
                            </div>
                        </td>
                        <td valign="top" align="center">
                            <a href="{{ route('admin.static_page.page_header.edit', $row->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="ri-edit-line"></i></a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
