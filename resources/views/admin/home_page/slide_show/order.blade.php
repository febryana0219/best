@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Home Page</li>
            <li class="breadcrumb-item">Slide Show</li>
            <li class="breadcrumb-item active">Slide Show Order</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Slide Show Order</h4>
        <a href="{{ route('admin.homepage.slide_show.index') }}" class="btn btn-secondary waves-effect">Back to Slide Show</a>
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

    <!-- Sortable List -->
    <form action="{{ route('admin.homepage.slide_show.order.update') }}" method="POST">
        @csrf
        <div class="card mb-4">
            <div class="card-body">
                <ul id="sortable" class="list-group list-group-flush">
                    @foreach($slide_show as $row)
                        <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $row->id }}">
                            {{ $row->subtitle }}
                            <input type="hidden" name="order[]" value="{{ $row->id }}">
                            <i class="mdi mdi-drag text-muted"></i>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
    </form>
</div>

@endsection
