@extends('user.layouts.master-layout')

@section('content')
<!-- Page Title Start -->
<section class="page-title-section" style="background-image: url('{{ asset('storage/uploads/bg/' . $bg->image) }}');">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb-area">
                    <h2 class="page-title">{{ $category->name ?? 'All Products' }}</h2>
                    <ul class="breadcrumbs-link">
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="active">{{ isset($category->name) ? 'Product':'All Products' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page Title End -->

<!-- Product Listing Section Start -->
<section class="team-section pdt-105 pdb-80" data-background="{{ asset('assets/user/images/bg/abs-bg6.png') }}">
    <div class="section-content">
        <div class="container">
            <div class="row">
                @foreach ($products as $row)
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="team-block-style1 mrb-30">
                            <div class="team-upper-part">
                                @if ($row->defaultImage)
                                    <img loading="lazy" class="img-full" src="{{ asset('storage/uploads/product/' . $row->defaultImage->img) }}" alt="{{ $row->name }}">
                                @else
                                    <img loading="lazy" class="img-full" src="{{ asset('storage/uploads/default/default.jpg') }}" alt="{{ $row->name }}">
                                @endif
                            </div>
                            <div class="team-bottom-part">
                                <h4 class="team-title mrb-5">
                                    <a href="{{ route('products.show', ['category_permalink' => $row->category->permalink, 'product_permalink' => $row->permalink]) }}">
                                        {{ $row->name }}
                                    </a>
                                </h4>
                                <h6 class="designation">{{ $row->subtitle }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Product Listing Section End -->

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
@endsection
