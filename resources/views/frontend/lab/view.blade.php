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
                        <li><a href="{{ route('lab-info') }}">Lab List</a></li>
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
                                            <img class="round"
                                                src="{{ $data['lab_information_photo'] ? $data['lab_information_photo'] : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTgsED9a4S9icB49GF7X-6aSbZwjOV_bnA03w&usqp=CAU' }}"
                                                alt="user" style="width: 100%; height: 200px; object-fit: cover" />

                                            <div class="mt-3">
                                                <h3>{{ $data['lab_information_name'] }} </h3>
                                                <p class="text-secondary mb-1">{{ $data['lab_information_room_no'] }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div>
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="text-gray-700">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            @foreach ($data['person_office_hour'] as $personOfficeHour)
                                                                @foreach ($personOfficeHour['day'] as $day)
                                                                    <tr>
                                                                        <td class="px-4 py-2">{{ $day['day_day'] }}
                                                                        </td>
                                                                        @foreach ($day['lab_office_hour'] as $officeHour)
                                                                            {{-- @dd($officeHour) --}}
                                                                            <td
                                                                                class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark xl:pl-11">
                                                                                <p class="text-black dark:text-white">
                                                                                    {{ date('h:iA', strtotime($officeHour['lab_offie_hour_start_time'])) }}
                                                                                    -
                                                                                    {{ date('h:iA', strtotime($officeHour['lab_offie_hour_end_time'])) }}
                                                                                </p>
                                                                                @if (!$officeHour['lab_offie_hour_office_hour'])
                                                                                    <p class="text-sm">
                                                                                        {{ $officeHour['lab_offie_hour_subject_code'] }}
                                                                                        <br>{{ $officeHour['lab_offie_hour_room_no'] }}
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
        </div>
    </div>
    </div>
    <!-- contact area END -->
    </div>
    <!-- Content END-->
@endsection
