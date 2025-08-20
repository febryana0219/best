@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Manage Static Page</li>
            <li class="breadcrumb-item active">About</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">About</h4>
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
                        <th width="20%">Title</th>
                        <th width="40%">Description</th>
                        <th>Image 480x565</th>
                        <th>Image 425x300</th>
                        <th width="7%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($about as $row)

                    <tr>
                        <td valign="top" style="word-break: break-word; white-space: normal;">{!! $row->title !!}</td>
                        <td valign="top" style="word-break: break-word; white-space: normal;">{!! $row->description !!}</td>
                        <td valign="top">
                            <img src="{{ asset('storage/uploads/about/' . $row->img1) }}" width="150" alt="480x565">
                        </td><td valign="top">
                            <img src="{{ asset('storage/uploads/about/' . $row->img2) }}" width="150" alt="425x300">
                        </td>
                        <td valign="top" align="center">
                            <a href="{{ route('admin.static_page.about.edit', $row->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="ri-edit-line"></i></a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
