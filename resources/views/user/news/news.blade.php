
@extends('user.layouts.master-layout')

@section('content')
<!-- Page Title Start -->
<section class="page-title-section" style="background-image: url('{{ asset('storage/uploads/bg/' . $bg->image) }}');">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb-area">
                    <h2 class="page-title">News</h2>
                    <ul class="breadcrumbs-link">
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="active">News</li>
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
            <div class="row justify-content-center">
                @if ($news->isEmpty())
                    <div class="col-12 text-center">
                        <h4 class="text-muted">News is not available</h4>
                    </div>
                @else
                    @foreach ($news as $row)
                        <div class="col-md-6 col-lg-6 col-xl-4">
                            <div class="news-wrapper mrb-30">
                                <div style="width: 100%; height: 250px; overflow: hidden; border-radius: 5px;">
                                    @if ($row->img)
                                        <img loading="lazy" class="img-full news-img"
                                            src="{{ asset('storage/uploads/news/' . $row->img) }}"
                                            alt="{{ $row->title }}">
                                    @else
                                        <img loading="lazy" class="img-full news-img"
                                            src="{{ asset('storage/uploads/default/default.jpg') }}"
                                            alt="{{ $row->title }}">
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

            @if (!$news->isEmpty())
                <!-- Pagination Start -->
                <div class="row">
                    <div class="col-xl-12">
                        <nav class="pagination-nav pdt-30">
                            <ul class="pagination-list">
                                <!-- Previous Page Link -->
                                @if ($news->onFirstPage())
                                    <li class="pagination-left-arrow disabled">
                                        <a href="#"><i class="fa fa-angle-left"></i></a>
                                    </li>
                                @else
                                    <li class="pagination-left-arrow">
                                        <a href="{{ $news->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a>
                                    </li>
                                @endif

                                <!-- Page Numbers -->
                                @foreach ($news->getUrlRange(1, $news->lastPage()) as $page => $url)
                                    <li class="{{ $page == $news->currentPage() ? 'active' : '' }}">
                                        <a href="{{ $url }}" class="page-numbers">{{ $page }}</a>
                                    </li>
                                @endforeach

                                <!-- Next Page Link -->
                                @if ($news->hasMorePages())
                                    <li class="pagination-right-arrow">
                                        <a href="{{ $news->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a>
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
            @endif
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

@endsection
