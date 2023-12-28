@extends('layouts.layout')
@section('content')
    <!-- Content -->
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
                        <li>Alumni</li>
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
                        @foreach ($data as $club)
                            <div class="col-md-4 col-sm-6">
                                <div class="card-container">
                                    <img class="round"
                                        src="{{ $club['club_information_photo'] ? $club['club_information_photo'] : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4p3fXniF8kGykrPWxi2NAZQS5gFojmFB8RQ&usqp=CAU' }}"
                                        alt="user" />
                                    <h3>{{ $club['club_information_name'] }}</h3>
                                    <h6>{{ $club['club_information_short_name'] }}</h6>
                                    <div class="buttons">
                                        <a href="{{ route('clubs.view', ['id' => $club['club_information_uuid']]) }}"
                                            class="btn ">
                                            View
                                        </a>
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
        <!-- contact area END -->
    </div>
    <!-- Content END-->
@endsection

<style>
    .card-container {
        background-color: #f9f9f9;
        /* Lighter background color */
        border-radius: 10px;
        /* Increased border-radius for a softer look */
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
        /* Softer shadow */
        color: #333;
        /* Slightly darker text color for better readability */
        padding: 30px 20px;
        /* Adjusted padding for better spacing */
        width: 350px;
        max-width: 100%;
        text-align: center;
        transition: all 0.3s ease;
        /* Smooth transition */
    }

    .card-container .round {
        border: 3px solid #4e3282;
        /* Increased border width for a bolder look */
        border-radius: 50%;
        padding: 10px;
        width: 100px;
        /* Adjusted size for better consistency */
        height: 100px;
        object-fit: cover;
        /* Ensure the image covers the circle */
    }

    button.primary {
        background-color: #4e3282;
        border: none;
        /* Removed the border for a cleaner look */
        border-radius: 5px;
        /* Slightly rounded corners */
        color: #fff;
        /* White text for better contrast */
        font-family: 'Montserrat', sans-serif;
        font-weight: 500;
        padding: 12px 28px;
        /* Slightly adjusted padding for better button size */
        cursor: pointer;
        /* Pointer cursor for better interaction */
        transition: background-color 0.3s ease;
        /* Smooth background color transition */
    }

    button.primary:hover {
        background-color: #4e3282;
    }

    /* Add more styles if needed */
</style>
