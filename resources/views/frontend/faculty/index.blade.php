@extends('layouts.layout')
@section('content')
    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="page-banner ovbl-dark" style="background-image:url(assets/images/banner/banner2.jpg);">
            <div class="container">
                <div class="page-banner-entry">
                    <h1 class="text-white">Faculty</h1>
                </div>
            </div>
        </div>
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <ul class="list-inline d-flex  align-items-center">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Faculty</li>
                    </ul>
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
                    <div class="row ">

                        @foreach ($data as $faculty)
                            <div class="col-md-4 col-sm-6">
                                <div class="card shadow">
                                    <!-- Header Image -->
                                    <img style="object-fit: cover; height: 140px"
                                        src="https://images.unsplash.com/photo-1549880338-65ddcdfd017b?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ"
                                        class="card-img-top" alt="Mountain">

                                    <div class="position-relative border-4 border-white rounded-circle overflow-hidden"
                                        style="width: 128px; height: 128px; margin-top: -64px; margin-left: auto; margin-right: auto;">
                                        <img src="{{ $faculty['faculty_informations_photo'] ? $faculty['faculty_informations_photo'] : 'https://bootdey.com/img/Content/avatar/avatar1.png' }}"
                                            class="position-absolute top-50 start-50 translate-middle"
                                            style="width: 128px; height: 128px; object-fit: cover;"
                                            alt="Woman looking front">
                                    </div>

                                    <!-- Profile Details -->
                                    <div class="text-center mt-3">
                                        <h2 class="fw-bold mb-0">{{ $faculty['faculty_informations_first_name'] }}
                                            {{ $faculty['faculty_informations_last_name'] }}</h2>
                                        <p class="text-muted ">{{ $faculty['faculty_informations_designations'] }}</p>
                                    </div>

                                    <!-- Follow Button -->
                                    <div class="text-center mb-3">
                                        <a href="{{ route('faculty.view', ['id' => $faculty['faculty_informations_uuid']]) }}"
                                            class="btn btn-primary">View</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    {{-- <div class="row">
                        <!-- Single Advisor-->
                        @foreach ($data as $datas)
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="single_advisor_profile wow fadeInUp" data-wow-delay="0.2s"
                                    style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                    <!-- Team Thumb-->
                                    <div class="advisor_thumb"><img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                            alt="">
                                        <!-- Social Info-->
                                        <div class="social-info"><a href="#"><i class="fa fa-facebook"></i></a><a
                                                href="#"><i class="fa fa-twitter"></i></a><a href="#"><i
                                                    class="fa fa-linkedin"></i></a></div>
                                    </div>
                                    <!-- Team Details-->
                                    <div class="single_advisor_details_info">
                                        <h6>{{ $datas->first_name }} {{ $datas->last_name }}</h6>
                                        <p class="designation">{{ $datas->designations }}</p>
                                        <p class="designation text-primary">{{ $datas->current_working_company }}</p>
                                        <p class="designation text-primary">{{ $datas->current_location }}</p>
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
                    </div> --}}
                </div>

            </div>
        </div>
        <!-- contact area END -->
    </div>
    <!-- Content END-->
@endsection
