@extends('user.layouts.master-layout')

@section('content')
<!-- Page Title Start -->
<section class="page-title-section" style="background-image: url('{{ asset('storage/uploads/bg/' . $bg->image) }}');">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb-area">
                    <h2 class="page-title">Project</h2>
                    <ul class="breadcrumbs-link">
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="active">Project</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page Title End -->

<!-- Project Section Start -->
<section class="pdt-105" data-background="{{ asset('assets/user/images/bg/abs-bg4.png') }}">
    <div class="section-content mb-5">
        <div class="container">

            <div id="project-filter" class="row pdb-25">
                <!-- Category Filter Start (Moved to Top) -->
                <div class="col-xl-12 text-center">
                    <!-- All Categories Button -->
                    <a href="{{ route('projects.index') }}" class="animate-btn-style2 btn-sm mrb-lg-50 {{ request('categoryPermalink') == null ? 'selected' : '' }}" type="button">All Categories</a>

                    <!-- Loop for categories -->
                    @foreach ($categories as $category)
                        <a href="{{ route('projects.index', $category->permalink) }}" class="animate-btn-style2 btn-sm mrb-lg-50 {{ request('categoryPermalink') == $category->permalink ? 'selected' : '' }}" type="button">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
                <!-- Category Filter End -->

                <!-- Search and Sort Start (Side by Side) -->
                <div class="col-xl-12 col-lg-12 col-md-12 pdt-15">
                    <div class="row text-center justify-content-center ">
                        <form class="col-xl-3 col-md-3" method="GET" action="{{ route('projects.index') }}" autocomplete="off">
                            <input type="text" name="search" class="form-control form-lg" placeholder="Search projects..." value="{{ request('search') }}">
                        </form>
                        <form class="col-xl-1 col-md-1" method="GET" action="{{ route('projects.index') }}" class="sort-form">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <input type="hidden" name="categoryPermalink" value="{{ $categoryPermalink }}">
                            <select name="sort" class="form-control custom-select-categories" onchange="this.form.submit()">
                                <option value="asc" {{ $sortOrder == 'asc' ? 'selected' : '' }}>A-Z</option>
                                <option value="desc" {{ $sortOrder == 'desc' ? 'selected' : '' }}>Z-A</option>
                            </select>
                        </form>
                    </div>

                </div>
                <!-- Search and Sort End -->
            </div>

            <!-- No Projects Found Message -->
            @if ($projects->isEmpty())
                <div class="row">
                    <div class="col-xl-12">
                        <p>There is no project found in here.</p>
                    </div>
                </div>
            @else
                <!-- Project Items Start -->
                <div class="row">
                    @foreach ($projects as $project)
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="project-item-style1 mrb-30">
                                <div class="project-item-thumb">
                                    @if ($project->image)
                                        <img loading="lazy" class="img-full" src="{{ asset('storage/uploads/quality_control/' . $project->image) }}" alt="{{ $project->name }}">
                                    @else
                                        <img loading="lazy" class="img-full" src="{{ asset('storage/uploads/default/default.jpg') }}" alt="{{ $project->name }}">
                                    @endif
                                    <div class="project-item-link-icon">
                                        {{-- <a href="#" data-toggle="modal" data-target="#passwordModal" data-permalink="{{ $project->permalink }}" data-password="{{ $project->password_access }}"><i class="base-icon-next"></i></a> --}}
                                        <a href="{{ route('projects.detail', $project->permalink) }}"><i class="base-icon-next"></i></a>
                                    </div>
                                    <div class="project-item-details">
                                        <h6 class="project-item-category">{{ $project->category->name }}</h6>
                                        <h4 class="project-item-title" style="color: #fff">{{ $project->name }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Project Items End -->
            @endif

            <!-- Pagination Start -->
            <div class="row">
                <div class="col-xl-12">
                    <nav class="pagination-nav pdt-30">
                        <ul class="pagination-list">
                            <!-- Previous Page Link -->
                            @if ($projects->onFirstPage())
                                <li class="pagination-left-arrow disabled">
                                    <a href="#"><i class="fa fa-angle-left"></i></a>
                                </li>
                            @else
                                <li class="pagination-left-arrow">
                                    <a href="{{ $projects->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a>
                                </li>
                            @endif

                            <!-- Page Numbers -->
                            @foreach ($projects->getUrlRange(1, $projects->lastPage()) as $page => $url)
                                <li class="{{ $page == $projects->currentPage() ? 'active' : '' }}">
                                    <a href="{{ $url }}" class="page-numbers">{{ $page }}</a>
                                </li>
                            @endforeach

                            <!-- Next Page Link -->
                            @if ($projects->hasMorePages())
                                <li class="pagination-right-arrow">
                                    <a href="{{ $projects->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a>
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

    <!-- Testimonials Section Start -->
    <section class="testimonial-style2-section pdt-105 pdb-105 bg-no-repeat bg-cover bg-pos-cb" data-background="{{ asset('assets/user/images/bg/abs-bg6.png') }}">
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
        <div class="section-content">
          <div class="container">
            <div class="clients-carousel owl-carousel owl-theme">
                @foreach ($clients as $client)
                    <div class="client-item">
                        <img loading="lazy" src="{{ asset('storage/uploads/client_worked/' . $client->img) }}" alt="{{ $client->name }}" style="width: 191px; margin-right: 30px;">
                    </div>
                @endforeach
            </div>
          </div>
        </div>
      </section>
      <!-- Testimonials Section End -->
</section>
<!-- Project Section End -->

@yield('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
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
