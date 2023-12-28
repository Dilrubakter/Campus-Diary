@extends('layouts.layout')
@section('content')
    @php
        $data = json_decode($data, true); // Convert JSON string to PHP array
    @endphp
    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="page-banner ovbl-dark" style="background-image:url(assets/images/banner/banner2.jpg);">
            <div class="container">
                <div class="page-banner-entry">
                    <h1 class="text-white">Club View</h1>
                </div>
            </div>
        </div>
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <ul class="list-inline d-flex  align-items-center">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('clubs') }}">Club</a></li>
                        <li>View</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <!-- contact area -->
        <div class="content-block">
            <!-- Portfolio  -->
            <div class="section-area section-sp1 gallery-bx">
                <section class="section about-section gray-bg" id="about">
                    <div class="container">
                        <div class="row align-items-center flex-row-reverse">
                            <div class="col-lg-6">
                                <div class="about-text go-to">
                                    <h3 class="dark-color mb-2">{{ $data['club_information_name'] }}</h3>
                                    <h6 class="theme-color lead mt-5">{{ $data['club_information_short_name'] }}</h6>
                                    <p>{{ $data['club_information_overview'] }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="about-avatar">
                                    <img src="{{ $data['club_information_photo'] ? $data['club_information_photo'] : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4p3fXniF8kGykrPWxi2NAZQS5gFojmFB8RQ&usqp=CAU' }}"
                                        title="" style="height: 250px; width: 400px; object-fit: cover"
                                        alt="">
                                </div>
                            </div>
                        </div>
                        <div class="bg mt-5">
                            <div class="row">
                                @foreach ($data['panel_members'] as $panelMember)
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex flex-column align-items-center text-center">
                                                    @if ($panelMember['club_information_panel_members_photo'])
                                                        <img src="{{ $panelMember['club_information_panel_members_photo'] }}"
                                                            class="rounded-circle" width="150" height="300">
                                                    @else
                                                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                                            alt="Admin" class="rounded-circle" width="150">
                                                    @endif
                                                    <div class="mt-3">
                                                        <h4>{{ $panelMember['club_information_panel_members_name'] }}
                                                        </h4>
                                                        <p>{{ $panelMember['club_information_panel_members_designation'] }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </section>


                {{-- <div class="container">
                    <div class="row ">



                    </div>
                </div> --}}
            </div>
        </div>
        <!-- contact area END -->
    </div>
    <!-- Content END-->
@endsection
