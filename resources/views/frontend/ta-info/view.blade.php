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
                    <h1 class="text-white">TA Info View</h1>
                </div>
            </div>
        </div>
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <ul class="list-inline d-flex  align-items-center">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('ta-list') }}">TA List</a></li>
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

                <div class="container">
                    <div class="main-body">
                        <div class="row gutters-sm">
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin"
                                                class="rounded-circle" width="150">

                                            <div class="mt-3">
                                                <h4>{{ $data['ta_informations_first_name'] }}
                                                    {{ $data['ta_informations_last_name'] }}</h4>
                                                <p class="text-secondary mb-1">{{ $data['ta_informations_designations'] }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Full Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                Kenneth Valdez
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $data['ta_informations_semail'] ? $data['ta_informations_semail'] : 'Null' }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Phone</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $data['ta_informations_phone_no'] ? $data['ta_informations_phone_no'] : 'Null' }}
                                            </div>
                                        </div>
                                        <hr>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Gender</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $data['ta_informations_phone_no'] }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Date Of Birth</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $data['ta_informations_dob'] ? $data['ta_informations_dob'] : 'Null' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="text-gray-700">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <!-- Uncomment the following if you want the header to display the days -->
                                                            {{-- 
                                                            <tr>
                                                                <th class="px-4 py-2">Day</th>
                                                                @foreach ($data['person_office_hour'] as $personOfficeHour)
                                                                    @foreach ($personOfficeHour['day'] as $day)
                                                                        <th class="px-4 py-2">{{ $day['day_day'] }}</th>
                                                                    @endforeach
                                                                @endforeach
                                                            </tr>
                                                            --}}
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data['person_office_hour'] as $personOfficeHour)
                                                                @foreach ($personOfficeHour['day'] as $day)
                                                                    <tr>
                                                                        <td class="px-4 py-2">{{ $day['day_day'] }}</td>
                                                                        @foreach ($day['office_hour'] as $officeHour)
                                                                            <td class="border-bottom py-5 px-4 pl-5">
                                                                                <!-- You can adjust the padding and styling as per your preference -->
                                                                                <p>
                                                                                    {{ date('h:iA', strtotime($officeHour['office_hours_start_time'])) }}
                                                                                    -
                                                                                    {{ date('h:iA', strtotime($officeHour['office_hours_end_time'])) }}
                                                                                </p>
                                                                                @if (!$officeHour['office_hours_office_hour'])
                                                                                    <p class="text-sm">
                                                                                        {{ $officeHour['office_hours_subject_code'] }}
                                                                                        <br>
                                                                                        {{ $officeHour['office_hours_room_no'] }}
                                                                                    </p>
                                                                                @else
                                                                                    <p class="text-sm">Office Hour</p>
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
                                </div>
                            </div>
                        </div>

                    </div>
                </div>



            </div>
        </div> --}}
    </div>
    </div>
    <!-- contact area END -->
    </div>
    <!-- Content END-->
@endsection
