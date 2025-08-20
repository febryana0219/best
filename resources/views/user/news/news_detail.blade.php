
@extends('user.layouts.master-layout')

@section('content')
<!-- Page Title Start -->
<section class="page-title-section" style="background-image: url('{{ asset('storage/uploads/bg/' . $bg->image) }}');">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb-area">
                    <h2 class="page-title">{{ $news->title }}</h2>
                    <ul class="breadcrumbs-link">
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="active">News Detail</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page Title End -->
<!-- News Section Start -->
<section class="bg-pos-ct pdt-105" data-background="{{ asset('assets/user/images/bg/abs-bg6.png') }}">
    <div class="section-content mrb-80">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-7">
                    <div class="single-news-details news-wrapper mrb-20">
                        <div class="single-news-content">
                            <div class="news-thumb">
                                @if ($news->img)
                                    <img loading="lazy" class="img-full" src="{{ asset('storage/uploads/news/' . $news->img) }}" alt="{{ $news->title }}">
                                @else
                                    <img loading="lazy" class="img-full" src="{{ asset('storage/uploads/default/default.jpg') }}">
                                @endif
                            </div>
                            <div class="news-description mrb-35">
                            <h4 class="the-title"><a href="#">{{ $news->title }}</a></h4>
                            <div class="news-bottom-part">
                                <div class="post-author">
                                    <div class="author-img">
                                        <a href="#">
                                            <img loading="lazy" src="{{ asset('assets/user/images/admin.png') }}" class="rounded-circle" alt="#" />
                                        </a>
                                    </div>
                                    <span><a href="#">{{ $news->creator->name }}</a></span>
                                    </div>
                                    <div class="post-link">
                                    <span class="entry-date"><i class="far fa-calendar-alt mrr-10 text-primary-color"></i>{{ \Carbon\Carbon::parse($news->created_at)->format('d M, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="entry-content">
                            <p class="mrb-35" align="justify">{{ $news->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- News Section End -->

@endsection
