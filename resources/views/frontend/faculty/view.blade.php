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
                    <h1 class="text-white">Faculty View</h1>
                </div>
            </div>
        </div>
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <ul class="list-inline d-flex  align-items-center">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('faculty') }}">Faculty</a></li>
                        <li>View</li>
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
                <section class="section about-section gray-bg" id="about">
                    <div class="container">
                        <div class="row align-items-center flex-row-reverse">
                            <div class="col-lg-6">
                                <div class="about-text go-to">
                                    <h3 class="dark-color mb-2">{{ $data['faculty_informations_first_name'] }}
                                        {{ $data['faculty_informations_last_name'] }}</h3>
                                    <h6 class="theme-color lead mt-5">{{ $data['faculty_informations_designations'] }}</h6>
                                    <p>{{ $data['faculty_informations_bio'] }}</p>
                                    <div class="row about-list">
                                        <div class="col-md-6">
                                            <div class="media">
                                                <label>Birthday</label>
                                                <p>{{ $data['faculty_informations_dob'] }}</p>
                                            </div>
                                            <div class="media">
                                                <label>Gender</label>
                                                <p>{{ $data['faculty_informations_gender'] }}</p>
                                            </div>
                                            <div class="media">
                                                <label>Room No</label>
                                                <p>{{ $data['faculty_informations_room'] }}</p>
                                            </div>
                                            <div class="media">
                                                <label>Contact</label>
                                                <p>{{ $data['faculty_informations_contact'] }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="media">
                                                <label>E-mail</label>
                                                <p>{{ $data['faculty_informations_email'] }}</p>
                                            </div>
                                            <div class="media">
                                                <label>Phone</label>
                                                <p>{{ $data['faculty_informations_contact'] ? $data['faculty_informations_contact'] : 'Null' }}
                                                </p>
                                            </div>
                                            <div class="media">
                                                <label>Faculty Type</label>
                                                <p>{{ $data['faculty_informations_faculty_type'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="about-avatar">
                                    <img src="{{ $data['faculty_informations_photo'] ? $data['faculty_informations_photo'] : 'https://bootdey.com/img/Content/avatar/avatar7.png' }}"
                                        title="" style="height: 250px; width: 400px; object-fit: cover"
                                        alt="">
                                </div>
                            </div>
                        </div>
                        <div class="bg mt-5">
                            <div class="text-gray-700">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <!-- Removed thead section as it was commented out in your original code -->
                                        <tbody>
                                            @foreach ($data['person_office_hour'] as $personOfficeHour)
                                                @foreach ($personOfficeHour['day'] as $day)
                                                    <tr>
                                                        <td class="">{{ $day['day_day'] }}</td>
                                                        @foreach ($day['faculty_office_hour'] as $officeHour)
                                                            <td class="border-bottom border-light py-3 px-4 pl-4">
                                                                <p class="text-dark">
                                                                    {{ date('h:iA', strtotime($officeHour['faculty_offie_hour_start_time'])) }}
                                                                    -
                                                                    {{ date('h:iA', strtotime($officeHour['faculty_offie_hour_end_time'])) }}
                                                                </p>
                                                                @if (!$officeHour['faculty_offie_hour_office_hour'])
                                                                    <p class="text-small">
                                                                        {{ $officeHour['faculty_offie_hour_subject_code'] }}
                                                                        <br>{{ $officeHour['faculty_offie_hour_room_no'] }}
                                                                    </p>
                                                                @else
                                                                    <p class="text-small">Office Hour</p>
                                                                @endif
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
