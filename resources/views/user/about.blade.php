@extends('user.layouts.master-layout')

@section('content')
<!-- Page Title Start -->
<section class="page-title-section" style="background-image: url('{{ asset('storage/uploads/bg/' . $bg->image) }}');">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb-area">
                    <h2 class="page-title">About Our Company</h2>
                    <ul class="breadcrumbs-link">
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="active">About</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page Title End -->
<!-- About Section Start -->
<section class="about-section pdt-105 pdb-150 bg-no-repeat bg-cover bg-pos-cb" data-background="{{ asset('assets/user/images/bg/abs-bg3.png') }}" data-overlay-light="4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8 col-xl-6 wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                <div class="about-image-box-style1 about-side-line mrr-60 mrr-lg-0">
                    <figure class="about-image1 js-tilt d-none d-md-block d-lg-block d-xl-block">
                        <img loading="lazy" class="img-full" src="{{ asset('storage/uploads/about/' . $about->img2) }}" alt="" />
                    </figure>
                    <figure class="about-image2">
                        <img loading="lazy" class="img-full" src="{{ asset('storage/uploads/about/' . $about->img1) }}" alt="" />
                    </figure>
                </div>
            </div>
            <div class="col-md-12 col-lg-10 col-xl-6 wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                <h5 class="side-line-left subtitle text-primary-color">About Our Company</h5>
                <h2 class="mrb-45 mrb-lg-35">{{ $about->title }}</h2>
                <p class="about-text-block mrb-40" align="justify" style="font-size: 14pt">{!! $about->description !!}</p>
                <div class="row mrb-30 mrb-lg-40">
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <ul class="order-list primary-color">
                            <li>professional</li>
                            <li>good service</li>
                        </ul>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <ul class="order-list primary-color">
                            <li>certification</li>
                            <li>safety standards</li>
                        </ul>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-xl-7 col-lg-7 col-md-6 col-sm-6">
                        <div class="featured-icon-box mrb-15">
                            <div class="featured-icon">
                                <i class="webexflaticon webextheme-icon-architect-4"></i>
                            </div>
                            <div class="featured-content">
                                <h4 class="featured-title">Expertise You Can Trust</h4>
                                <p class="featured-desc">We deliver precision, quality, and attention to detail in every project</p>
                            </div>
                        </div>
                        <div class="featured-icon-box mrb-sm-40">
                            <div class="featured-icon">
                                <i class="webexflaticon base-icon-158-employee-2"></i>
                            </div>
                            <div class="featured-content">
                                <h4 class="featured-title">Customer-Centric Approach</h4>
                                <p class="featured-desc mrb-0">We listen, collaborate, and tailor our services to meet your unique needs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-6 col-sm-6">
                        <div class="experience">
                            <p class="experience-text">We have more than years of experience</p>
                            <h4 class="experience-year">20+</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Section End -->
<!-- Offer Section Start -->
<section class="bg-secondary-color bg-no-repeat bg-cover bg-pos-cb pdt-105 pdb-105" data-background="{{ asset('assets/user/images/bg/abs-bg4.png') }}" data-overlay-dark="4">
    <div class="section-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-10 col-xl-6 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="800ms">
                    <h5 class="side-line-left text-primary-color mrb-10">What We Offer</h5>
                    <h2 class="text-white mrb-30 mrb-sm-30">
                        Our Company <span class="text-primary-color">Make You<br /> </span>Feel More Confident
                    </h2>
                    <p class="text-white mrb-40">We believe in building more than just structures—we build trust, reliability, and peace of mind. Our commitment to delivering excellence ensures that every project is completed with precision, quality, and attention to detail. With years of experience and a team of skilled professionals, we guarantee that your vision will be brought to life seamlessly</p>
                    <div class="video-block mrb-lg-60">
                        <div class="video-link">
                            <a class="video-popup" href="https://www.youtube.com/"><i class="base-icon-play1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-10 col-xl-6 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="800ms">
                    <div class="shine-effect">
                        <img loading="lazy" class="img-full" src="{{ asset('assets/user/images/bg/choose-us.jpg') }}" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Offer Section End -->
@endsection
