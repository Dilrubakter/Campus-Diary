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
    @php
        $data = json_decode($data, true); // Convert JSON string to PHP array
    @endphp
    <div>
        <div class="container mx-auto my-5 p-5">
            <div class="md:flex no-wrap md:-mx-2 ">
                <!-- Left Side -->
                <div class="w-full md:w-3/12 md:mx-2">
                    <!-- Profile Card -->
                    <div class="bg-white p-3 border-t-4 border-green-400">
                        <div class="image overflow-hidden">
                            <img class="h-auto w-full mx-auto" src="{{ asset($data['ta_informations_photo']) }}"
                                class="w-full" alt="">
                        </div>
                        <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">
                            {{ $data['ta_informations_first_name'] }}
                            {{ $data['ta_informations_last_name'] }}
                        </h1>
                        <h3 class="text-gray-600 font-lg text-semibold leading-6">
                            {{ $data['ta_informations_designations'] }}
                        </h3>
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
                                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
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
                                    <div class="px-4 py-2">{{ $data['ta_informations_first_name'] }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Last Name</div>
                                    <div class="px-4 py-2">{{ $data['ta_informations_last_name'] }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Gender</div>
                                    <div class="px-4 py-2">{{ $data['ta_informations_gender'] }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Contact No.</div>
                                    <div class="px-4 py-2">{{ $data['ta_informations_phone_no'] }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Email.</div>
                                    <div class="px-4 py-2">
                                        <a class="text-blue-800"
                                            href="mailto:{{ $data['ta_informations_semail'] }}">{{ $data['ta_informations_semail'] }}</a>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Birthday</div>
                                    <div class="px-4 py-2">{{ $data['ta_informations_dob'] }}</div>
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
                                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </span>
                                <span class="tracking-wide">Office Hour</span>
                            </div>
                            <a href="{{ route('backend.ta-information.office-hour', ['id' => $data['ta_informations_uuid']]) }}"
                                class="inline-flex items-center justify-center gap-2.5 rounded-md bg-primary py-1.5 px-10 text-center font-medium text-white hover:bg-opacity-90 lg:px-6 xl:px-8">
                                Add Office Hour
                            </a>
                        </div>
                        <div class="text-gray-700">
                            <div class="max-w-full overflow-x-auto">
                                <table class="w-full table-auto">
                                    <thead>
                                        {{-- <tr>
                                            <th class="px-4 py-2">Day</th>
                                            @foreach ($data['person_office_hour'] as $personOfficeHour)
                                                @foreach ($personOfficeHour['day'] as $day)
                                                    <th class="px-4 py-2">{{ $day['day_day'] }}
                                                    </th>
                                                @endforeach
                                            @endforeach
                                        </tr> --}}
                                    </thead>
                                    <tbody>

                                        @foreach ($data['person_office_hour'] as $personOfficeHour)
                                            @foreach ($personOfficeHour['day'] as $day)
                                                <tr>
                                                    <td class="px-4 py-2">{{ $day['day_day'] }}
                                                    </td>
                                                    @foreach ($day['office_hour'] as $officeHour)
                                                        {{-- @dd($officeHour) --}}
                                                        <td
                                                            class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark xl:pl-11">
                                                            <p class="text-black dark:text-white">
                                                                {{ date('h:iA', strtotime($officeHour['office_hours_start_time'])) }}
                                                                -
                                                                {{ date('h:iA', strtotime($officeHour['office_hours_end_time'])) }}
                                                            </p>
                                                            @if (!$officeHour['office_hours_office_hour'])
                                                                <p class="text-sm">
                                                                    {{ $officeHour['office_hours_subject_code'] }}
                                                                    <br>{{ $officeHour['office_hours_room_no'] }}
                                                                </p>
                                                            @else
                                                                <p class="text-sm">Office Hour</p>
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach


                                            {{-- <tr>
                                                <td class="px-4 py-2">{{ formatTime($officeHour->start_time) }} -
                                                    {{ formatTime($officeHour->end_time) }}</td>
                                                @foreach ($data->personOfficeHour as $personOfficeHour)
                                                    @foreach ($personOfficeHour->day[0]->officeHour as $officeHour)
                                                        <td class="px-4 py-2">
                                                            @if ($officeHour->subject_code)
                                                                {{ $officeHour->subject_code }}
                                                                @if ($officeHour->room_no)
                                                                    <br>{{ $officeHour->room_no }}
                                                                @endif
                                                            @else
                                                                Office Hour
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                @endforeach
                                            </tr> --}}
                                        @endforeach
                                    </tbody>
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
</x-app-layout>
