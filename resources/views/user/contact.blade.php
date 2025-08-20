@extends('user.layouts.master-layout')

@section('content')
<!-- Page Title Start -->
<section class="page-title-section" style="background-image: url('{{ asset('storage/uploads/bg/' . $bg->image) }}');">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb-area">
                    <h2 class="page-title">Contact Us</h2>
                    <ul class="breadcrumbs-link">
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="active">Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page Title End -->
<!-- Contact Section Start -->
<section class="contact-section pdt-105 pdb-105 bg-no-repeat bg-cover bg-pos-cb" data-background="{{ asset('assets/user/images/bg/abs-bg6.png') }}">
    <div class="container">
        <div class="row mrb-80">
            <div class="col-md-12 col-lg-12 col-xl-4">
                <h5 class="side-line-left text-primary-color mrt-0 mrb-5">pt_best_logo.pnguch</h5>
                <h2 class="faq-title mrb-30">Have Any Questions?</h2>
                <ul class="social-list list-lg list-primary-color list-flat mrb-lg-60 clearfix">
                    @foreach ($spSocialLink as $sl)
                        <li>
                            <a href="{{ $sl->link }}" target="_blank"><i class="{{ $sl->icon }}"></i></a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-12 col-lg-12 col-xl-8">
                <div class="row">
                    <div class="col-lg-12 col-xl-12">
                        <div class="contact-block d-flex mrb-30">
                            <div class="contact-icon">
                                <i class="base-icon-map"></i>
                            </div>
                            <div class="contact-details mrl-30">
                                <h5 class="icon-box-title mrb-10">Address</h5>
                                <p class="mrb-0">{!! $address->value !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6">
                        <div class="contact-block d-flex mrb-30">
                            <div class="contact-icon">
                                <i class="base-icon-094-email-2"></i>
                            </div>
                            <div class="contact-details mrl-30">
                                <h5 class="icon-box-title mrb-10">Email</h5>
                                <p class="mrb-0">{!! $spEmail->value !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6">
                        <div class="contact-block d-flex mrb-30">
                            <div class="contact-icon">
                                <i class="base-icon-phone-2"></i>
                            </div>
                            <div class="contact-details mrl-30">
                                <h5 class="icon-box-title mrb-10">Phone Number</h5>
                                <p class="mrb-0">{!! $phone->value !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="contact-form">
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

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mrb-25">
                                    <input type="text" name="name" placeholder="Name" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mrb-25">
                                    <input type="email" name="email" placeholder="Email" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mrb-25">
                                    <input type="text" name="subject" placeholder="Subject" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mrb-25">
                                    <textarea rows="5" name="message" placeholder="Messages" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <button type="submit" class="animate-btn-style3 btn-md mrb-lg-60">Submit Now</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-6">
                <!-- Google Map Start -->
                <div class="mapouter fixed-height">
                    <div class="gmap_canvas">
                        <iframe
                            src="https://www.google.com/maps?q={{ $contactAddress->longitude }},{{ $contactAddress->latitude }}&output=embed"
                            width="600"
                            height="450"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                        <a href="https://www.whatismyip-address.com"></a>
                    </div>
                </div>
                <!-- Google Map End -->
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->
@endsection
