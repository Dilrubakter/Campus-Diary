@extends('layouts.layout')

@section('content')
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="page-banner ovbl-dark" style="background-image:url(assets/images/banner/banner2.jpg);">
            <div class="container">
                <div class="page-banner-entry">
                    <h1 class="text-white">Posts</h1>
                </div>
            </div>
        </div>
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <ul class="list-inline d-flex  align-items-center">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Posts</li>
                    </ul>
                    <div class="text-center">
                        <a href="{{ route('addPost') }}" class="btn">Add Posts</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <!-- contact area -->
        {{-- @php
            $data = json_decode($data, true);
        @endphp --}}
        <div class="content-block">
            <!-- Portfolio  -->
            <div class="section-area section-sp1 gallery-bx">
                <div class="container">
                    <div class="feature-filters clearfix center m-b40">
                        <ul class="filters" data-toggle="buttons">
                            <li data-filter="" class="btn active">
                                <input type="radio">
                                <a href="#"><span>All</span></a>
                            </li>
                            <li data-filter="happening" class="btn">
                                <input type="radio">
                                <a href="#"><span>Lost</span></a>
                            </li>
                            <li data-filter="upcoming" class="btn">
                                <input type="radio">
                                <a href="#"><span>Found</span></a>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix">
                        <ul id="masonry" style="list-style: none" class="ttr-gallery-listing magnific-image row">
                            @foreach ($data as $post)
                                <li
                                    class="action-card col-lg-6 col-md-6 col-sm-12 {{ $post['post_post_lost'] ? 'happening' : null }} {{ $post['posts_post_found'] ? 'upcoming' : null }}">
                                    <div class="event-bx m-b30">
                                        <div class="action-box">
                                            @if ($post['post_product_photo'])
                                                <img src="{{ $post['post_product_photo'] }}" alt="">
                                            @endif
                                        </div>
                                        <div class="info-bx d-flex">

                                            {{-- Format the date using Carbon --}}
                                            @php
                                                $createdAt = \Carbon\Carbon::parse($post['created_at']);
                                                $formattedDate = $createdAt->format('d'); // Get day of the month
                                                $formattedMonth = $createdAt->format('F'); // Get full month name
                                                $formattedTime = $createdAt->format('h:ia'); // Get time in 12-hour format
                                            @endphp

                                            <div class="event-time">
                                                <div class="event-date">{{ $formattedDate }}</div>
                                                <div class="event-month">{{ $formattedMonth }}</div>
                                            </div>
                                            <div class="event-info">
                                                <ul class="media-post">
                                                    <li><a href="#"><i class="fa fa-clock-o"></i>
                                                            {{ $formattedTime }}</a>
                                                    </li>
                                                    <li><a href=""><i class="fa fa-user"></i>
                                                            {{ $post['users']['name'] }}</a>
                                                    </li>
                                                </ul>
                                                <p>{{ $post['post_post_description'] }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="pagination d-flex justify-items-end" style="gap: 2rem; justify-content: end">
                            @if ($data->onFirstPage())
                                <a href="javascript:void(0)" class="btn btn-secondary disabled">Previous</a>
                            @else
                                <a href="{{ $data->previousPageUrl() }}" class="btn btn-primary">Previous</a>
                            @endif

                            @if ($data->hasMorePages())
                                <a href="{{ $data->nextPageUrl() }}" class="btn btn-primary">Next</a>
                            @else
                                <a href="javascript:void(0)" class="btn btn-secondary disabled">Next</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- contact area END -->
    </div>
@endsection
