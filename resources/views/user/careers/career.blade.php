
@extends('user.layouts.master-layout')

@section('content')
<!-- Page Title Start -->
<section class="page-title-section" style="background-image: url('{{ asset('storage/uploads/bg/' . $bg->image) }}');">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb-area">
                    <h2 class="page-title">Career</h2>
                    <ul class="breadcrumbs-link">
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="active">Career</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page Title End -->
<!-- Job Application Section Start -->
<section class="blog-single-news pdt-105 pdb-105" data-background="{{ asset('assets/user/images/bg/abs-bg6.png') }}">
    <div class="container">
        <div class="col-md-12 col-lg-12 col-xl-6">
            <h5 class="side-line-left text-primary-color mrt-0">&nbsp;</h5>
            <h3 class="faq-title">Job Application</h3>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="single-news-details news-wrapper mrb-20">
                    <div class="single-news-content">
                        <div class="comments-area">
                            <div class="reply-form mrt-40">
                                @if (session('success'))
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
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

                                <form action="{{ route('career.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group mrb-20">
                                                <input type="text" name="first_name" placeholder="First Name" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mrb-20">
                                                <input type="text" name="last_name" placeholder="Last Name" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mrb-20">
                                                <input type="email" name="email" placeholder="Email" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mrb-20">
                                                <textarea rows="8" name="cover_letter" placeholder="Cover Letter" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mrb-20">
                                                <input type="file" name="cv" placeholder="CV" class="form-control" />
                                                <div class="form-text">* The resume is expected to be in PDF format.</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group mrb-0">
                                                <button type="submit" class="animate-btn-style3">Apply Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <p class="form-message"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4" style="margin-top: 42px;">
                <div class="mapouter fixed-height">
                    <img src="{{ asset('assets/user/images/hiring.jpg') }}">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Job Application Section End -->
@endsection


