@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Systems</li>
            <li class="breadcrumb-item active"><a href="#">SEO</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">SEO</h4>
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

    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                <div class="card-body">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Home Page</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="about-tab" data-bs-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="false">About Page</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact Page</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="prodouct-tab" data-bs-toggle="tab" href="#prodouct" role="tab" aria-controls="prodouct" aria-selected="false">Product Page</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="auth-distrib-tab" data-bs-toggle="tab" href="#auth-distrib" role="tab" aria-controls="auth-distrib" aria-selected="false">Authorized Distributors</a>
                        </li>
                    </ul>

                    <form action="{{ route('admin.system.seo.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="tab-content" id="myTabContent">
                            <!-- home tab -->
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row mb-4">
                                    <label class="col-sm-2 control-label">Home Meta Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="home_meta_title" class="form-control"
                                               value="{{ old('home_meta_title', $seoData['home_meta_title']->value ?? '') }}"/>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 control-label">Home Meta Keyword</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="home_meta_keyword" class="form-control"
                                               value="{{ old('home_meta_keyword', $seoData['home_meta_keyword']->value ?? '') }}"/>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 control-label">Home Meta Description</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="home_meta_description" class="form-control"
                                               value="{{ old('home_meta_description', $seoData['home_meta_description']->value ?? '') }}"/>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 control-label">Home Title</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="home_title" class="form-control"
                                               value="{{ old('home_title', $seoData['home_title']->value ?? '') }}"/>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 control-label">Home Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="editor" name="home_description" style="height: 100px">{{ old('home_description', $seoData['home_description']->value ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- about tab -->
                            <div class="tab-pane fade show" id="about" role="tabpanel" aria-labelledby="about-tab">
                                <div class="row mb-4">
                                    <label class="col-sm-2 control-label">About Meta Title</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="about_meta_title" class="form-control"
                                               value="{{ old('about_meta_title', $seoData['about_meta_title']->value ?? '') }}"/>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 control-label">About Meta Keyword</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="about_meta_keyword" class="form-control"
                                               value="{{ old('about_meta_keyword', $seoData['about_meta_keyword']->value ?? '') }}"/>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 control-label">About Meta Description</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="about_meta_description" class="form-control"
                                               value="{{ old('about_meta_description', $seoData['about_meta_description']->value ?? '') }}"/>
                                    </div>
                                </div>
                            </div>

                            <!-- contact tab -->
                            <div class="tab-pane fade show" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="row mb-4">
                                    <label class="col-sm-2 control-label">Contact Meta Title</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="contact_meta_title" class="form-control"
                                               value="{{ old('contact_meta_title', $seoData['contact_meta_title']->value ?? '') }}"/>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 control-label">Contact Meta Keyword</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="contact_meta_keyword" class="form-control"
                                               value="{{ old('contact_meta_keyword', $seoData['contact_meta_keyword']->value ?? '') }}"/>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 control-label">Contact Meta Description</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="contact_meta_description" class="form-control"
                                               value="{{ old('contact_meta_description', $seoData['contact_meta_description']->value ?? '') }}"/>
                                    </div>
                                </div>
                            </div>

                            <!-- prodouct tab -->
                            <div class="tab-pane fade show" id="prodouct" role="tabpanel" aria-labelledby="prodouct-tab">
                                <div class="row mb-4">
                                    <label class="col-sm-2 control-label">Product Meta Title</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="product_meta_title" class="form-control"
                                               value="{{ old('product_meta_title', $seoData['product_meta_title']->value ?? '') }}"/>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 control-label">Product Meta Keyword</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="product_meta_keyword" class="form-control"
                                               value="{{ old('product_meta_keyword', $seoData['product_meta_keyword']->value ?? '') }}"/>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 control-label">Product Meta Description</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product_meta_description" class="form-control"
                                               value="{{ old('product_meta_description', $seoData['product_meta_description']->value ?? '') }}"/>
                                    </div>
                                </div>
                            </div>

                            <!-- autherized distributor tab -->
                            <div class="tab-pane fade show" id="auth-distrib" role="tabpanel" aria-labelledby="auth-distrib-tab">
                                <div class="row mb-4">
                                    <label class="col-sm-2 control-label">Authorized Distributors Meta Title</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="authorized_meta_title" class="form-control"
                                               value="{{ old('authorized_meta_title', $seoData['authorized_meta_title']->value ?? '') }}"/>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 control-label">Authorized Distributors Meta Keyword</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="authorized_meta_keyword" class="form-control"
                                               value="{{ old('authorized_meta_keyword', $seoData['authorized_meta_keyword']->value ?? '') }}"/>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 control-label">Authorized Distributors Meta Description</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="authorized_meta_description" class="form-control"
                                               value="{{ old('authorized_meta_description', $seoData['authorized_meta_description']->value ?? '') }}"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
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
                    Are you sure you want to delete this product image?
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
