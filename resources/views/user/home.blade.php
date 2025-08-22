@extends('user.layouts.master-layout')

@section('content')
<!-- Home Slider Start -->
<section class="home_banner_01">
    <div class="home-carousel owl-theme owl-carousel">
        @foreach($slideShow as $slide)
            <div class="slide-item">
                <div class="image-layer">
                    <img loading="lazy" src="{{ asset('storage/uploads/slide_show/' . $slide->img_landscape) }}" alt="Slide Image">
                </div>
                <div class="auto-container">
                    <div class="row clearfix">
                        <div class="col-xl-8 col-lg-12 col-md-12 content-column">
                            <div class="content-box">
                                <h1 class="home-carousel-title">
                                    {!! $slide->title !!}
                                </h1>
                                <p class="home-carousel-text">{{ $slide->subtitle }}</p>
                                <div class="btn-box">
                                    {{-- <a href="#" class="animate-btn-style3">Get In Touch</a> --}}
                                    <a href="{{ $slide->url }}" class="animate-btn-style3">Get In Touch</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
<!-- Home Slider End -->
<!-- Service Section Area Start -->
<section class="service-section-style2 bg-no-repeat bg-cover bg-pos-cb pdt-70 pdb-40 pdb-lg-105" data-background="{{ asset('assets/user/images/bg/abs-bg8.png') }}">
    <div class="section-title text-center wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="title-box-center">
                        <h5 class="sub-title-line-bottom text-primary-color mrb-10">What We're Offering</h5>
                        <h2 class="title">Introduce Our Professional <span class="text-primary-color">Products</span> Area</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-6 col-xl-4">
                    <div class="service-style2">
                        <div class="service-item-thumb">
                            <img loading="lazy" class="img-full" src="{{ asset('storage/uploads/product/mid-temp-hi-gard.jpg') }}" alt="" />
                            <div class="service-item-icon">
                                <i class="webextheme-icon-013-sketch1"></i>
                            </div>
                            <div class="service-item-content">
                                <h6 class="service-categories">HI-GARD</h6>
                                <h4 class="service-title"><a href="{{ route('products.category', ['category_permalink' =>'hi-gard']) }}">Low, Mid, High Temperature</a></h4>
                                <div class="service-item-inner-icon">
                                    <i class="webextheme-icon-013-sketch1"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-4">
                    <div class="service-style2">
                        <div class="service-item-thumb">
                            <img loading="lazy" class="img-full" src="{{ asset('storage/uploads/product/carrier-pipe.jpg') }}" alt="" />
                            <div class="service-item-icon">
                                <i class="webextheme-icon-under-construction-1"></i>
                            </div>
                            <div class="service-item-content">
                                <h6 class="service-categories">TERRA-GARD</h6>
                                <h4 class="service-title"><a href="{{ route('products.category', ['category_permalink' =>'terra-gard']) }}">Piping System</a></h4>
                                <div class="service-item-inner-icon">
                                    <i class="webextheme-icon-under-construction-1"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-4">
                    <div class="service-style2">
                        <div class="service-item-thumb">
                            <img loading="lazy" class="img-full" src="{{ asset('storage/uploads/product/tunnel-ventilation-damper-3.png') }}" alt="" />
                            <div class="service-item-icon">
                                <i class="webextheme-icon-003-renovation1"></i>
                            </div>
                            <div class="service-item-content">
                                <h6 class="service-categories">DAMPER</h6>
                                <h4 class="service-title"><a href="{{ route('products.category', ['category_permalink' =>'damper']) }}">Tunnel Ventilation</a></h4>
                                <div class="service-item-inner-icon">
                                    <i class="webextheme-icon-003-renovation1"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mrt-35">
                <div class="col-xl-12 text-center">
                    <div class="service-load-more">
                        <h5 class="text">
                            Do You Want To explore more producs just <span><a href="{{ route('products.index') }}" class="text-underline text-primary-color">click here</a></span>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Service Section Area End -->

<!-- About Section Start -->
<section class="about-section pdb-110 pdt-110 pdb-105 ">
    <div class="custom-md-container">
        <div class="row">
            <div class="col-md-12 col-lg-10 col-xl-6 wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                <h5 class="side-line-left text-primary-color mrb-10">About Our Company</h5>
                <h2 class="mrb-25">{{ $about->title }}</h2>
                <p class="mrb-30">
                    {!! $about->description !!}
                </p>
                <div class="row mrb-40">
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <ul class="order-list primary-color">
                            <li>professional</li>
                            <li>good service</li>
                        </ul>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <ul class="order-list primary-color">
                            <li>certification</li>
                            <li>safety standards</li>
                        </ul>
                    </div>
                </div>
                <div class="row align-items-center mrb-lg-60 mrb-sm-0">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <a href="{{ route('about.index') }}" class="animate-btn-style2 mrb-sm-60">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-8 col-xl-6 wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                <div class="about-image-box-style2 dot-circle">
                    <img loading="lazy" class="about-image1 img-full js-tilt d-none d-md-block d-lg-block d-xl-block" style="width: 350px; height: 400px;" src="{{ asset('storage/uploads/about/' . $about->img2) }}" alt="" />
                    <img loading="lazy" class="about-image2 img-full" style="width: 430px; height: 560px;" src="{{ asset('storage/uploads/about/' . $about->img1) }}" alt="" />
                    <div class="call-us-now">
                        <h3 class="number mrt-0 text-white">20+</h3>
                        <p class="call-us-title mrb-0 text-white">Years Of Experiences</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Section End -->
<!-- why Choose Us Section Start -->
<section>
    <div class="container-fluid">
        <div class="row">
            <!-- Kolom Konten -->
            <div class="col-lg-12 col-xl-8 p-0">
                <div class="divider-gap bg-silver p-4">
                    <h2 class="mrb-25 text-center">Why choose our products ?</h2>

                    <div class="row">
                        <!-- Kolom kiri -->
                        <div class="col-md-6">
                            <div class="mrb-30 d-flex">
                                <div class="mrr-20">
                                    <img src="{{ asset('assets/user/images/suhu.png') }}" style="height: auto; width: 40px; max-width: none; display: block;">
                                </div>
                                <div class="icon-details">
                                    <h4 class="icon-box-title mrb-10">Wide Temperature Resistance</h4>
                                    <p>Engineered to withstand extreme hot and cold conditions without losing performance.</p>
                                </div>
                            </div>

                            <div class="mrb-30 d-flex">
                                <div class="mrr-20">
                                    <img src="{{ asset('assets/user/images/guard.png') }}" style="height: auto; width: 40px; max-width: none; display: block;">
                                </div>
                                <div class="icon-details">
                                    <h4 class="icon-box-title mrb-10">Durable & Long - Lasting</h4>
                                    <p>Crafted from premium materials for outstanding durability and long term reliability.</p>
                                </div>
                            </div>

                            <div class="mrb-30 d-flex">
                                <div class="mrr-20">
                                    <img src="{{ asset('assets/user/images/chart.png') }}" style="height: auto; width: 40px; max-width: none; display: block;">
                                </div>
                                <div class="icon-details">
                                    <h4 class="icon-box-title mrb-10">Superior Insulation Performance</h4>
                                    <p>Delivers excellent insulation for maximum energy efficiency and comfort.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom kanan -->
                        <div class="col-md-6">
                            <div class="mrb-30 d-flex">
                                <div class="mrr-20">
                                    <img src="{{ asset('assets/user/images/tools.png') }}" style="height: auto; width: 40px; max-width: none; display: block;">
                                </div>
                                <div class="icon-details">
                                    <h4 class="icon-box-title mrb-10">Easy to Install</h4>
                                    <p>Designed for quick, hassle-free installation with minimal effort.</p>
                                </div>
                            </div>

                            <div class="mrb-30 d-flex">
                                <div class="mrr-20">
                                    <img src="{{ asset('assets/user/images/ceklis.png') }}" style="height: auto; width: 40px; max-width: none; display: block;">
                                </div>
                                <div class="icon-details">
                                    <h4 class="icon-box-title mrb-10">Versatile Options Available in Class 0 and Class 1</h4>
                                    <p>Offered in flexible options that meet Class 0 and Class 1 Standards for diverse applications</p>
                                </div>
                            </div>

                            <div class="mrb-30 d-flex">
                                <div class="mrr-20">
                                    <img src="{{ asset('assets/user/images/suhu_air.png') }}" style="height: auto; width: 40px; max-width: none; display: block;">
                                </div>
                                <div class="icon-details">
                                    <h4 class="icon-box-title mrb-10">Moisture Protection</h4>
                                    <p>Effectively resists moisture to prevent damage and extend product lifespan</p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- row -->
                </div>
            </div>
            <!-- Kolom Gambar -->
            <div class="col-lg-12 col-xl-4 bg-cover" data-background="{{ asset('assets/user/images/bg/bg1.png') }}"></div>
        </div>
    </div>
</section>
<!-- why Choose Us Section End -->

<!-- News Section Start -->
<section class="bg-no-repeat bg-cover bg-pos-ct pdt-105" data-background="{{ asset('assets/user/images/bg/abs-bg1.png') }}">
    <div class="section-title mrb-55 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-8 col-md-12">
                    <div class="title-box-center">
                        <h5 class="side-line-left text-primary-color mrb-10">Latest Blog</h5>
                        <h2 class="mrb-25">News & <span class="text-primary-color">Updates </span></h2>
                        <p class="mrb-0 mrb-md-40">Stay Updated!
                            Follow our blog for regular updates on industry trends, project announcements, and more. Together, let’s build a better tomorrow.</p>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4 col-md-12 text-lg-end">
                    <a href="{{ route('news.index') }}" class="animate-btn-style2">All News</a>
                </div>
            </div>
        </div>
    </div>
    <div class="section-content mrb-80">
        <div class="container">
            <div class="row justify-content-center">
                @if ($news->isEmpty())
                    <div class="col-12 text-center">
                        <p class="mrb-0 mrb-md-40">News is not available</p>
                    </div>
                @else
                    @foreach ($news as $row)
                        <div class="col-md-6 col-lg-6 col-xl-4">
                            <div class="news-wrapper mrb-30">
                                <div class="news-thumb">
                                    @if ($row->img)
                                        <img loading="lazy" class="img-full" src="{{ asset('storage/uploads/news/' . $row->img) }}" alt="{{ $row->title }}">
                                    @else
                                        <img loading="lazy" class="img-full" src="{{ asset('storage/uploads/default/default.jpg') }}" alt="{{ $row->title }}">
                                    @endif
                                </div>
                                <div class="news-description">
                                    <h4 class="the-title"><a href="{{ route('news.show', Crypt::encrypt($row->id)) }}">{{ $row->title }}</a></h4>
                                    <p class="the-content">{{ \Illuminate\Support\Str::limit(strip_tags($row->description), 100, '...') }}</p>
                                    <div class="news-bottom-part">
                                        <div class="post-author">
                                            <div class="author-img">
                                                <a href="#">
                                                    <img loading="lazy" src="{{ asset('assets/user/images/admin.png') }}" class="rounded-circle" alt="#" />
                                                </a>
                                            </div>
                                            <span><a href="#">{{ $row->creator->name }}</a></span>
                                        </div>
                                        <div class="post-link">
                                            <span class="entry-date"><i class="far fa-calendar-alt mrr-10 text-primary-color"></i>
                                                {{ \Carbon\Carbon::parse($row->created_at)->format('d M, Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <!-- Call to Action Start -->
    <div class="call-to-action">
        <div class="container">
            <div class="call-to-action-inner">
                <div class="call-to-action-left">
                    <div class="call-to-action-icon">
                        <span class="webexflaticon base-icon-chat1"></span>
                    </div>
                    <div class="call-to-action-content">
                        <p class="call-to-action-sub-title">We are ready to help you</p>
                        <h3 class="call-to-action-title">Need Any Pipe Insulation Help?</h3>
                    </div>
                </div>
                <div class="call-to-action-btn-box mrt-md-30">
                    <a href="{{ route('contact.index') }}" class="animate-btn-style4">Contact With Us</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Call to Action End -->
</section>
<!-- News Section End -->

@yield('script')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> --}}
<script>
    $(document).ready(function () {
        $('.clients-carousel').owlCarousel({
            loop: true,
            margin: 80,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 3000,
            responsive: {
                0: { items: 2 },
                600: { items: 4 },
                1000: { items: 6 }
            }
        });
    });

</script>
@yield('script-bottom')

@endsection
