@extends('user.layouts.master-layout')

@section('content')
<!-- Page Title Start -->
<section class="page-title-section" style="background-image: url('{{ asset('storage/uploads/bg/' . $bg->image) }}');">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb-area">
                    <h2 class="page-title">{{ $project->name }}</h2>
                    <ul class="breadcrumbs-link">
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="active">Project Detail</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page Title End -->

<!-- Project Detail Section Start -->
<section class="pdt-105 pdb-80" data-background="{{ asset('assets/user/images/bg/abs-bg6.png') }}">
    <div class="section-content">
        <div class="container">
            <div class="row mb-4">
                <div class="col-xl-12">
                    <h3>{{ $project->name }}</h3>
                    <h5>{{ $project->category->name }}</h5>
                    {{-- <a href="{{ $previousUrl }}">
                        <i class="fa fa-arrow-left"></i> Back
                    </a> --}}
                </div>
            </div>

            <!-- Filter Section for Project Details -->
            <form method="GET" action="{{ route('projects.show', $project->permalink) }}" autocomplete="off">
                <div class="row mb-4">
                    <!-- Search Input -->
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <input type="text" name="search" class="form-control form-lg" placeholder="Search details..." value="{{ request('search') }}">
                    </div>

                    <!-- Month Filter -->
                    <div class="col-xl-2 col-lg-3 col-md-4">
                        <select name="month" class="form-control form-lg" onchange="this.form.submit()">
                            <option value="all" {{ request('month') == 'all' ? 'selected' : '' }}>All</option>
                            @foreach (range(1, 12) as $month)
                                <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($month)->format('F') }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Year Filter -->
                    <div class="col-xl-2 col-lg-3 col-md-4">
                        <select name="year" class="form-control form-lg" onchange="this.form.submit()">
                            <option value="all" {{ request('year') == 'all' ? 'selected' : '' }}>All</option>
                            @foreach (range(2020, now()->year) as $year)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-xl-1 col-lg-2 col-md-3">
                        <button type="submit" class="animate-btn-style1 btn-sm">Search</button>
                    </div>
                </div>
            </form>

            <!-- Project Details Table -->
            <div class="row">
                <div class="col-xl-12">
                    <table class="table table-hover">
                        <thead style="background-color: #212529; color: #fff;">
                            <tr>
                                <th>No</th>
                                <th>Project Name</th>
                                <th>Equipment Code</th>
                                <th>No. Production</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projectDetails as $index => $detail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $project->name }}</td>
                                    <td>
                                        <a href="{{ route('projects.show.details', Crypt::encrypt($detail->id)) }}" class="text-primary">
                                            {{ $detail->equipment_code }}
                                        </a>
                                    </td>
                                    <td>{{ $detail->production_number }}</td>
                                    <td>{{ $detail->date->format('d-m-Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination Start -->
            <div class="row">
                <div class="col-xl-12">
                    <nav class="pagination-nav pdt-30">
                        <ul class="pagination-list">
                            <!-- Previous Page Link -->
                            @if ($projectDetails->onFirstPage())
                                <li class="pagination-left-arrow disabled">
                                    <a href="#"><i class="fa fa-angle-left"></i></a>
                                </li>
                            @else
                                <li class="pagination-left-arrow">
                                    <a href="{{ $projectDetails->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a>
                                </li>
                            @endif

                            <!-- Page Numbers -->
                            @foreach ($projectDetails->getUrlRange(1, $projectDetails->lastPage()) as $page => $url)
                                <li class="{{ $page == $projectDetails->currentPage() ? 'active' : '' }}">
                                    <a href="{{ $url }}" class="page-numbers">{{ $page }}</a>
                                </li>
                            @endforeach

                            <!-- Next Page Link -->
                            @if ($projectDetails->hasMorePages())
                                <li class="pagination-right-arrow">
                                    <a href="{{ $projectDetails->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a>
                                </li>
                            @else
                                <li class="pagination-right-arrow disabled">
                                    <a href="#"><i class="fa fa-angle-right"></i></a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Pagination End -->
        </div>
    </div>
</section>
<!-- Project Detail Section End -->
@endsection
