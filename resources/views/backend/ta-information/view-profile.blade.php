<x-app-layout>

    <style>
        :root {
            --main-color: #4a76a8;
        }

        .bg-main-color {
            background-color: var(--main-color);
        }

        .text-main-color {
            color: var(--main-color);
        }

        .border-main-color {
            border-color: var(--main-color);
        }
    </style>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <div>
        <div class="container mx-auto my-5 p-5">
            <div class="md:flex no-wrap md:-mx-2 ">
                <!-- Left Side -->
                <div class="w-full md:w-3/12 md:mx-2">
                    <!-- Profile Card -->
                    <div class="bg-white p-3 border-t-4 border-green-400">
                        <div class="image overflow-hidden">
                            <img class="h-auto w-full mx-auto"
                                src="{{ asset($data->photo) }}" class="w-full"
                                alt="">
                        </div>
                        <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">{{ $data->first_name }} {{ $data->last_name }}</h1>
                        <h3 class="text-gray-600 font-lg text-semibold leading-6">{{ $data->designations}}</h3>
                        {{-- <p class="text-sm text-gray-500 hover:text-gray-600 leading-6">Lorem ipsum dolor sit amet
                            consectetur adipisicing elit.
                            Reprehenderit, eligendi dolorum sequi illum qui unde aspernatur non deserunt</p> --}}
                        {{-- <ul
                            class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                            <li class="flex items-center py-3">
                                <span>Status</span>
                                <span class="ml-auto"><span
                                        class="bg-green-500 py-1 px-2 rounded text-white text-sm">Active</span></span>
                            </li>
                            <li class="flex items-center py-3">
                                <span>Member since</span>
                                <span class="ml-auto">Nov 07, 2016</span>
                            </li>
                        </ul> --}}
                    </div>
                    <!-- End of profile card -->
                    <div class="my-4"></div>
                </div>
                <!-- Right Side -->
                <div class="w-full md:w-9/12 mx-2 h-64">
                    <!-- Profile tab -->
                    <!-- About Section -->
                    <div class="bg-white p-3 shadow-sm rounded-sm">
                        <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                            <span clas="text-green-500">
                                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                            <span class="tracking-wide">About</span>
                        </div>
                        <div class="text-gray-700">
                            <div class="grid md:grid-cols-2 text-sm">
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">First Name</div>
                                    <div class="px-4 py-2">{{ $data->first_name }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Last Name</div>
                                    <div class="px-4 py-2">{{ $data->last_name }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Gender</div>
                                    <div class="px-4 py-2">{{ $data->gender }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Contact No.</div>
                                    <div class="px-4 py-2">{{ $data->phone_no }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Email.</div>
                                    <div class="px-4 py-2">
                                        <a class="text-blue-800" href="mailto:{{ $data->email }}">{{ $data->email }}</a>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Birthday</div>
                                    <div class="px-4 py-2">{{ $data->dob }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of about section -->
                    <div class="py-4"></div>
                    <!-- About Section -->
                    <div class="bg-white p-3 shadow-sm rounded-sm">
                        <div class="flex justify-between my-4">
                            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                                <span clas="text-green-500">
                                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </span>
                                <span class="tracking-wide">Office Hour</span>
                            </div>
                            <a href="{{ route('backend.ta-information.office-hour', ['id' => $data->uuid]) }}" class="inline-flex items-center justify-center gap-2.5 rounded-md bg-primary py-1.5 px-10 text-center font-medium text-white hover:bg-opacity-90 lg:px-6 xl:px-8">
                                Add Office Hour
                            </a>
                        </div>
                        <div class="text-gray-700">
                            <div class="max-w-full overflow-x-auto">
                                <table class="w-full table-auto">
                                  <tbody>
                                    @php
                                    function formatTime($time) {
                                        $timeParts = explode(' - ', $time);
                                        $formattedTime = [];
                                        foreach ($timeParts as $part) {
                                            $formattedTime[] = date('h:iA', strtotime($part));
                                        }
                                        return implode(' - ', $formattedTime);
                                    }
                                    @endphp
                                    @php
                                    $previousDay = '';
                                    $previousTimeSlots = [];
                                    @endphp
                                    @if ($data->personOfficeHour)
                                        @foreach ($data->personOfficeHour as $personOfficeHour)
                                            @php
                                            $day = $personOfficeHour->day[0]->day;
                                            $timeSlots = [];
                                            $courses = [];
                                            $roomNumbers = [];
                                            @endphp
                                            @if ($personOfficeHour->day[0]->officeHour)
                                                @foreach ($personOfficeHour->day[0]->officeHour as $officeHour)
                                                    @php
                                                    $startTime = $officeHour->start_time;
                                                    $endTime = $officeHour->end_time;
                                                    $subjectCode = $officeHour->subject_code;
                                                    $roomNo = $officeHour->room_no;

                                                    if ($startTime && $endTime) {
                                                        $timeSlots[] = "$startTime - $endTime";

                                                        if ($subjectCode && $roomNo) {
                                                            $courses[] = $subjectCode;
                                                            $roomNumbers[] = $roomNo;
                                                        } else {
                                                            $courses[] = ''; // Add an empty value if subject code is not available
                                                            $roomNumbers[] = ''; // Add an empty value if room number is not available
                                                        }
                                                    }
                                                    @endphp
                                                @endforeach
                                            @endif
                                            @if ($day && count($timeSlots) > 0)
                                                @if ($day !== $previousDay || $timeSlots !== $previousTimeSlots)
                                                    <tr>
                                                        <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark xl:pl-11">
                                                            <p class="text-black dark:text-white">{{ $day }}</p>
                                                        </td>
                                                        @foreach ($timeSlots as $index => $time)
                                                            <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark xl:pl-11">
                                                                <p class="text-black dark:text-white">{{ formatTime($time) }}</p>
                                                                @if ($courses[$index])
                                                                    <p class="text-sm">
                                                                        {{ $courses[$index] }}
                                                                        @if ($roomNumbers[$index])
                                                                            <br>{{ $roomNumbers[$index] }}
                                                                        @endif
                                                                    </p>
                                                                @elseif ($roomNumbers[$index])
                                                                    <p class="text-sm">{{ $roomNumbers[$index] }}</p>
                                                                @else
                                                                    <p class="text-sm">Office Hour</p>
                                                                @endif
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                @endif
                                                @php
                                                $previousDay = $day;
                                                $previousTimeSlots = $timeSlots;
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endif
                                </table>
                              </div>
                        </div>
                    </div>

                    <div class="my-4"></div>


                    </div>
                    <!-- End of profile tab -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
