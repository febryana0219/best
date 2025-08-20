@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Systems</li>
            <li class="breadcrumb-item active">Newsletter</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Newsletter</h4>
    </div>

    <!-- Search form -->
    <form action="{{ route('admin.system.newsletter.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Search..." value="{{ request()->input('search') }}">
            <button class="btn btn-secondary" type="submit">Search</button>
        </div>
    </form>

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>
                            <a href="?sort_field=email&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}">
                                Email
                                @if ($sortField == 'email')
                                    @if ($sortDirection == 'asc')
                                        <i class="ri-arrow-up-line"></i>
                                    @else
                                        <i class="ri-arrow-down-line"></i>
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="?sort_field=created_at&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}">
                                Created At
                                @if ($sortField == 'created_at')
                                    @if ($sortDirection == 'asc')
                                        <i class="ri-arrow-up-line"></i>
                                    @else
                                        <i class="ri-arrow-down-line"></i>
                                    @endif
                                @endif
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = ($messages->currentPage() - 1) * $messages->perPage() + 1;
                    @endphp
                    @foreach ($messages as $row)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->created_at->format('d-m-Y H:i:s') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $messages->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
