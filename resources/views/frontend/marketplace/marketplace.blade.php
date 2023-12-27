@extends('layouts.layout')

@section('content')
    {{-- @php
        $data = json_decode($data, true); // Convert JSON string to PHP array
    @endphp --}}
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="page-banner ovbl-dark" style="background-image:url(assets/images/banner/banner3.jpg);">
            <div class="container">
                <div class="page-banner-entry">
                    <h1 class="text-white">Marketplace</h1>
                </div>
            </div>
        </div>
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <ul class="list-inline d-flex  align-items-center">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Marketplace</li>
                    </ul>
                    <div class="text-center">
                        <a href="{{ route('marketplace.add-product') }}" class="btn">Add Product</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <!-- inner page banner END -->
        <div class="content-block">
            <!-- About Us -->
            <div class="section-area section-sp1">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-12 m-b30">
                            <div class="widget courses-search-bx placeani">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Search Marketplace</label>
                                        <input name="dzName" type="text" required class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="widget widget_archive">
                                <h5 class="widget-title style-1">All Courses</h5>
                                <ul>
                                    @foreach ($category as $item)
                                        <li class="active"><a href="">{{ $item->marketplace_category_name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8 col-sm-12">
                            <div class="row">
                                @foreach ($data as $marketplace)
                                    <div class="col-md-6 col-lg-6 col-sm-6 m-b30">
                                        <div class="cours-bx">
                                            <div class="action-box img">
                                                @if ($marketplace['marketplace_product_photo'])
                                                    <img class="cover"
                                                        src="{{ $marketplace['marketplace_product_photo'] }}"
                                                        alt="">
                                                @else
                                                    <img class="cover" src="{{ asset('assets/images/blank.png') }}"
                                                        alt="">
                                                @endif
                                            </div>
                                            <div class="text-bx pt-4 text-center">
                                                <h6>{{ $marketplace['marketplace_product_name'] }}</h6>
                                            </div>
                                            <div class="text-bx text-center">
                                                <span>{{ $marketplace['marketplace_product_description'] }}</span>
                                            </div>
                                            @if ($marketplace['category'] != null)
                                                <div class="text-bx text-center pt-10">
                                                    <span class="">
                                                        {{ $marketplace['category']['marketplace_category_name'] }}</p
                                                            class="text-">
                                                </div>
                                            @endif
                                            <div class="cours-more-info">
                                                <div style="width: 100%">
                                                    <div class="event-info">
                                                        <ul class="media-post py-3 d-flex justify-content-between px-3">
                                                            <li><a href="mailto:{{ $marketplace['users']['email'] }}"><i
                                                                        class="fa fa-envelope"></i>
                                                                    {{ $marketplace['users']['email'] }}</a>
                                                            </li>
                                                            <li><a href=""><i class="fa fa-user"></i>
                                                                    {{ $marketplace['users']['name'] }}</a>
                                                            </li>
                                                        </ul>
                                                        <h5 style="text-align: center">$120</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

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
        </div>
        <!-- contact area END -->

    </div>
@endsection
