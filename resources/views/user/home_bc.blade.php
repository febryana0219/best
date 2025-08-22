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
            <div class="col-lg-12 col-xl-6 bg-cover" data-background="{{ asset('assets/user/images/bg/pipe-installation.jpg') }}"></div>
            <div class="col-lg-12 col-xl-6 p-0">
                <div class="divider-gap bg-silver">
                    <h2 class="mrb-25">Why You Choose Us?</h2>
                    <p class="mrb-40 mrb-sm-60">At PT. Best Insulation Indonesia, we're more than just builders — we're partners in bringing your vision to life. Here's why clients trust us.</p>
                    <div class="icon-box-two mrb-30">
                        <div class="icon bg-primary-color f-left">
                            <span class="webexflaticon webextheme-icon-architect-2"></span>
                        </div>
                        <div class="icon-details">
                            <h4 class="icon-box-title mrb-10">Expertise You Can Trust</h4>
                            <p>With 20+ years of industry experience, we deliver precision, quality, and attention to detail in every project</p>
                        </div>
                    </div>
                    <div class="icon-box-two mrb-30">
                        <div class="icon bg-primary-color f-left">
                            <span class="webexflaticon webextheme-icon-architect-4"></span>
                        </div>
                        <div class="icon-details">
                            <h4 class="icon-box-title mrb-10">On-Time, On-Budget Delivery</h4>
                            <p>Our commitment to efficiency ensures your project is completed on schedule and within budget, without compromising quality</p>
                        </div>
                    </div>
                    <div class="icon-box-two mrb-30">
                        <div class="icon bg-primary-color f-left">
                            <span class="webexflaticon webextheme-icon-interior"></span>
                        </div>
                        <div class="icon-details">
                            <h4 class="icon-box-title mrb-10">Safety and Sustainability</h4>
                            <p>We prioritize the safety of our team and the environment by adhering to the highest standards in sustainable construction</p>
                        </div>
                    </div>
                    <div class="icon-box-two">
                        <div class="icon bg-primary-color f-left">
                            <span class="webexflaticon webextheme-icon-team-1"></span>
                        </div>
                        <div class="icon-details">
                            <h4 class="icon-box-title mrb-10">Customer-Centric Approach</h4>
                            <p>Your satisfaction is our priority. We listen, collaborate, and tailor our services to meet your unique needs</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- why Choose Us Section End -->

<!-- Working Steps Section Start -->
<section class="working-process-section bg-secondary-color bg-no-repeat bg-cover bg-pos-cb pdt-150 pdb-115" data-background="{{ asset('assets/user/images/bg/abs-bg4.png') }}" data-overlay-dark="2">
<div class="section-title text-center wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
    <div class="container">
    <div class="row">
        <div class="col"></div>
            <div class="col-md-12 col-lg-10 col-xl-6">
                <div class="title-box">
                    <h5 class="text-primary-color mrb-10">How We Works</h5>
                    <h2 class="text-white mrb-10">Our Easy Working Steps</h2>
                    <div class="big-text">Working</div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
</div>
<div class="section-content">
    <div class="container">
        <div class="working-process-wrapper">
            <div class="working-process-shape">
                <img loading="lazy" src="{{ asset('assets/user/images/bg/working-process-shape.png') }}" alt="" />
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="process-item mrb-md-40">
                        <div class="process-icon-box">
                            <div class="process-icon">
                                <span class="webexflaticon webextheme-icon-office-1"></span>
                            </div>
                            <div class="process-count"></div>
                        </div>
                        <div class="process-details">
                            <h4 class="process-title">Visit Project</h4>
                            <p class="process-text">Understand your needs, and evaluate possibilities, ensuring delivering tailored construction solutions</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="process-item mrb-md-40">
                        <div class="process-icon-box">
                            <div class="process-icon">
                                <span class="webexflaticon webextheme-icon-architect-1"></span>
                            </div>
                            <div class="process-count"></div>
                        </div>
                        <div class="process-details">
                            <h4 class="process-title">Planning Design</h4>
                            <p class="process-text">Gather key details, understand your vision, and integrate them into the planning and design process</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="process-item mrb-md-40">
                        <div class="process-icon-box">
                            <div class="process-icon">
                                <span class="webexflaticon webextheme-icon-measure"></span>
                            </div>
                            <div class="process-count"></div>
                        </div>
                        <div class="process-details">
                            <h4 class="process-title">Project Sketch</h4>
                            <p class="process-text">We gather essential information to create accurate project sketches that align with your vision</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="process-item mrb-md-40 mrb-sm-0">
                        <div class="process-icon-box">
                            <div class="process-icon">
                                <span class="webexflaticon webextheme-icon-interior"></span>
                            </div>
                            <div class="process-count"></div>
                        </div>
                        <div class="process-details">
                            <h4 class="process-title">Start Working</h4>
                            <p class="process-text">Bringing your vision to life with precision, quality, and timely execution</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- Working Steps Section End -->

<!-- Clients Worked Section Start -->
<section class="clients-worked-section pdt-105 pdb-105" data-background="{{ asset('assets/user/images/bg/abs-bg6.png') }}">
    <div class="section-title text-center wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="title-box-center">
                    <h5 class="sub-title-line-bottom text-primary-color mrb-10">Client's</h5>
                    <h2 class="title">Who We've <span class="text-primary-color">Worked</span> With</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="clients-carousel owl-carousel owl-theme">
            @foreach ($clients as $client)
                <div class="client-item">
                    <img loading="lazy" src="{{ asset('storage/uploads/client_worked/' . $client->img) }}" alt="{{ $client->name }}" style="width: 191px; margin-right: 30px;">
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Clients Worked Section End -->

<!-- Project Section Start -->
<section class="bg-secondary-color bg-no-repeat bg-cover bg-pos-cb pdt-105" data-background="{{ asset('assets/user/images/bg/abs-bg3.png') }}" data-overlay-dark="4">
    <div class="section-title mrb-60 mrb-md-15 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-8 col-lg-7 col-md-12">
                    <div class="title-box-center">
                        <h5 class="side-line-left text-primary-color mrb-10">Our Projects</h5>
                        <h2 class="text-white mrb-md-40 mrb-sm-30">
                            Our Outstanding <br />
                            <span class="text-primary-color">Latest Proejcts</span> & Works
                        </h2>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 pdt-50 col-md-12 text-lg-end">
                    {{-- <a href="{{ route('projects.index') }}" class="animate-btn-style2" style="color: #fff;">All Projects</a> --}}
                    <p class="text-white mrb-0 mrb-md-40 body-font-size">Here are some of our most recent and remarkable projects that showcase our expertise, innovation, and commitment to quality</p>
                </div>
            </div>
        </div>
    </div>
    <div class="section-content">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="project-item-style1-wrapper mrr--300">
                        <div class="owl-carousel projects_5col">
                            @foreach ($projects as $project)
                                <div class="project-item-style1">
                                    <div class="project-item-thumb">
                                        @if ($project->image)
                                            <img loading="lazy" class="img-full" src="{{ asset('storage/uploads/quality_control/' . $project->image)}}" alt="{{ $project->name}}" />
                                        @else
                                            <img loading="lazy" class="img-full" src="{{ asset('storage/uploads/default/default.jpg') }}" alt="{{ $project->name }}">
                                        @endif
                                        <div class="project-item-link-icon">
                                            {{-- <a href="#" data-toggle="modal" data-target="#passwordModal"
                                               data-permalink="{{ $project->permalink }}"
                                               data-password="{{ $project->password_access }}">
                                                <i class="base-icon-next"></i>
                                            </a> --}}
                                            <a href="{{ route('projects.detail', $project->permalink) }}"><i class="base-icon-next"></i></a>
                                        </div>
                                        <div class="project-item-details">
                                            <h6 class="project-item-category">{{ $project->category->name }}</h6>
                                            <h4 class="project-item-title"><a href="{{ route('projects.detail', $project->permalink) }}">{{ $project->name }}</a></h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Project Section End -->

<!-- Funfact Section Start -->
<section class="funfact-section pdt-50 pdb-25 pdt-sm-80 pdb-sm-65">
    <div class="funfact-section-obj1">
        <img loading="lazy" src="{{ asset('assets/user/images/objects/funfact-obj1.png') }}" alt="" />
    </div>
    <div class="funfact-section-obj2">
        <img loading="lazy" src="{{ asset('assets/user/images/objects/funfact-obj2.png') }}" alt="" />
    </div>
    <div class="funfact-section-obj3">
        <img loading="lazy" src="{{ asset('assets/user/images/objects/funfact-obj3.png') }}" alt="" />
    </div>
    <div class="section-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="800ms">
                    <div class="funfact">
                        <div class="funfact-icon">
                            <span class="webexflaticon base-icon-162-briefcase-2"></span>
                        </div>
                        <h2 class="count-box">
                            <span data-stop="864" data-speed="2500" class="count-text">00</span>
                        </h2>
                        <h5 class="title">Projects Succeed</h5>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="800ms">
                    <div class="funfact">
                        <div class="funfact-icon">
                            <span class="webexflaticon base-icon-101-like-1"></span>
                        </div>
                        <h2 class="count-box">
                            <span data-stop="3450" data-speed="2500" class="count-text">00</span>
                        </h2>
                        <h5 class="title">Satisfied Clients</h5>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="800ms">
                    <div class="funfact">
                        <div class="funfact-icon">
                            <span class="webexflaticon webextheme-icon-architect-4"></span>
                        </div>
                        <h2 class="count-box">
                            <span data-stop="84" data-speed="2500" class="count-text">00</span>
                        </h2>
                        <h5 class="title">Professional Engineers</h5>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="800ms">
                    <div class="funfact">
                        <div class="funfact-icon">
                            <span class="webexflaticon base-icon-037-creativity"></span>
                        </div>
                        <h2 class="count-box">
                            <span data-stop="20" data-speed="2500" class="count-text">00</span>
                        </h2>
                        <h5 class="title">Year Of Experience</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Funfact Section End -->

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
