@extends('user.layouts.master-layout')

@section('content')
<!-- Page Title Start -->
<section class="page-title-section" style="background-image: url('{{ asset('storage/uploads/bg/' . $bg->image) }}');">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb-area">
                    <h2 class="page-title">{{ $product->name }}</h2>
                    <ul class="breadcrumbs-link">
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="active">Product Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page Title End -->

<!-- Service Details Section Start -->
<section class="service-details-page pdt-110 pdb-110 pdb-lg-75">
    <div class="container">
        <div class="row mb-4">
            <div class="col-xl-12">
                <a href="{{ $previousUrl }}">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="row">
            <!-- Main Content -->
            <div class="col-xl-8 col-lg-7">
                <div class="service-detail-text">
                    <!-- Always Visible: Title and Subtitle -->
                    <h3 class="mrb-15">{{ $product->name }}</h3>
                    <p class="about-text-block mrb-40">{{ $product->subtitle }}</p>

                    <!-- Product Detail Section -->
                    <div id="product-detail-section">
                        <div class="img-container" style="float: left; margin-right: 20px; max-width: 30%;">
                            <img loading="lazy" class="img-fluid" id="main-image" src="{{ asset('storage/uploads/product/' . ($product->defaultImage->img ?? 'default/default.jpg')) }}" alt="{{ $product->name }}" style="max-width: 100%; height: auto;" />
                        </div>
                        <p class="mrb-40">{!! $product->description !!}</p>
                        @if($product->video)
                        <p class="mrb-35">
                            <strong>Product Video:</strong>
                        </p>
                        <iframe width="100%" height="450" src="{{ $product->video }}" frameborder="0" allowfullscreen></iframe>
                        @endif
                    </div>

                    <!-- Project Section -->
                    <div id="project-section" style="display: none;">
                        <h4 class="mrb-20">Related Projects</h4>
                        <ul>
                            @foreach($product->projects as $project)
                                <li>
                                    {{ $project->title }}
                                </li>
                            @endforeach
                        </ul>
                        @if($product->projects->isEmpty())
                            <p>No related projects found for this product.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-xl-4 col-lg-5 sidebar-right">
                <!-- Navigation Menu -->
                <div class="service-nav-menu mrb-30">
                    <div class="service-link-list">
                        <ul>
                            <li class="active" id="product-detail-tab">
                                <a href="javascript:void(0);" onclick="showSection('product-detail-section', this)">
                                    <i class="fa fa-chevron-right"></i> Product Detail
                                </a>
                            </li>
                            <li id="project-tab">
                                <a href="javascript:void(0);" onclick="showSection('project-section', this)">
                                    <i class="fa fa-chevron-right"></i> Project
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Image Selector (Only in Product Detail) -->
                <div id="image-selector-section">
                    <div class="sidebar-widget">
                        <h4 class="mrb-40 widget-title">Click on an image to view it:</h4>
                        <div class="need-help-contact">
                            <div class="image-selector">
                                @foreach($product->images as $image)
                                    <img loading="lazy" src="{{ asset('storage/uploads/product/' . $image->img) }}" alt="Product Image" style="width: 60px; height: 60px; margin-right: 10px; cursor: pointer;" onclick="changeImage('{{ asset('storage/uploads/product/' . $image->img) }}')" />
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Service Details Section End -->

@yield('script')
<script>
    // Function to change the main image
    function changeImage(imageSrc) {
        var mainImage = document.getElementById('main-image');
        mainImage.src = imageSrc;
    }

    // Function to toggle sections
    function showSection(sectionId, element) {
        // Hide both sections
        document.getElementById('product-detail-section').style.display = 'none';
        document.getElementById('project-section').style.display = 'none';
        document.getElementById('image-selector-section').style.display = 'none';

        // Show the selected section
        document.getElementById(sectionId).style.display = 'block';

        // If showing Product Detail, ensure Image Selector is visible
        if (sectionId === 'product-detail-section') {
            document.getElementById('image-selector-section').style.display = 'block';
        }

        // Remove active class from both tabs
        document.getElementById('product-detail-tab').classList.remove('active');
        document.getElementById('project-tab').classList.remove('active');

        // Add active class to the clicked tab
        element.parentElement.classList.add('active');
    }
</script>
@yield('script-bottom')

@endsection
