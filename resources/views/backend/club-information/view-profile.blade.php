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
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="mx-auto max-w-242.5">
            <!-- ====== Profile Section Start -->
            <div
                class="overflow-hidden rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="relative z-20 h-35 md:h-65">
                    <img src="{{ asset('images/cover/cover-01.png') }}" alt="profile cover"
                        class="h-full w-full rounded-tl-sm rounded-tr-sm object-cover object-center">
                    <div class="absolute bottom-1 right-1 z-10 xsm:bottom-4 xsm:right-4">
                        {{-- <label for="cover"
                            class="flex cursor-pointer items-center justify-center gap-2 rounded bg-primary py-1 px-2 text-sm font-medium text-white hover:bg-opacity-80 xsm:px-4">
                            <input type="file" name="cover" id="cover" class="sr-only">
                            <span>
                                <svg class="fill-current" width="14" height="14" viewBox="0 0 14 14"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.76464 1.42638C4.87283 1.2641 5.05496 1.16663 5.25 1.16663H8.75C8.94504 1.16663 9.12717 1.2641 9.23536 1.42638L10.2289 2.91663H12.25C12.7141 2.91663 13.1592 3.101 13.4874 3.42919C13.8156 3.75738 14 4.2025 14 4.66663V11.0833C14 11.5474 13.8156 11.9925 13.4874 12.3207C13.1592 12.6489 12.7141 12.8333 12.25 12.8333H1.75C1.28587 12.8333 0.840752 12.6489 0.512563 12.3207C0.184375 11.9925 0 11.5474 0 11.0833V4.66663C0 4.2025 0.184374 3.75738 0.512563 3.42919C0.840752 3.101 1.28587 2.91663 1.75 2.91663H3.77114L4.76464 1.42638ZM5.56219 2.33329L4.5687 3.82353C4.46051 3.98582 4.27837 4.08329 4.08333 4.08329H1.75C1.59529 4.08329 1.44692 4.14475 1.33752 4.25415C1.22812 4.36354 1.16667 4.51192 1.16667 4.66663V11.0833C1.16667 11.238 1.22812 11.3864 1.33752 11.4958C1.44692 11.6052 1.59529 11.6666 1.75 11.6666H12.25C12.4047 11.6666 12.5531 11.6052 12.6625 11.4958C12.7719 11.3864 12.8333 11.238 12.8333 11.0833V4.66663C12.8333 4.51192 12.7719 4.36354 12.6625 4.25415C12.5531 4.14475 12.4047 4.08329 12.25 4.08329H9.91667C9.72163 4.08329 9.53949 3.98582 9.4313 3.82353L8.43781 2.33329H5.56219Z"
                                        fill="white"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M6.99992 5.83329C6.03342 5.83329 5.24992 6.61679 5.24992 7.58329C5.24992 8.54979 6.03342 9.33329 6.99992 9.33329C7.96642 9.33329 8.74992 8.54979 8.74992 7.58329C8.74992 6.61679 7.96642 5.83329 6.99992 5.83329ZM4.08325 7.58329C4.08325 5.97246 5.38909 4.66663 6.99992 4.66663C8.61075 4.66663 9.91659 5.97246 9.91659 7.58329C9.91659 9.19412 8.61075 10.5 6.99992 10.5C5.38909 10.5 4.08325 9.19412 4.08325 7.58329Z"
                                        fill="white"></path>
                                </svg>
                            </span>
                            <span>Edit</span>
                        </label> --}}
                    </div>
                </div>
                <div class="px-4 pb-6 text-center lg:pb-8 xl:pb-11.5">
                    <div
                        class="relative z-30 mx-auto -mt-22 h-30 w-full max-w-30 bg-white/20 p-1 backdrop-blur sm:h-44 sm:max-w-44 sm:p-3">
                        <div class="relative drop-shadow-2">
                            <img src="{{ $data['club_information_photo'] ? $data['club_information_photo'] : asset('images/user/user-01.png') }}"
                                alt="profile">
                            {{-- <label for="profile"
                                class="absolute bottom-0 right-0 flex h-8.5 w-8.5 cursor-pointer items-center justify-center rounded-full bg-primary text-white hover:bg-opacity-90 sm:bottom-2 sm:right-2">
                                <svg class="fill-current" width="14" height="14" viewBox="0 0 14 14"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.76464 1.42638C4.87283 1.2641 5.05496 1.16663 5.25 1.16663H8.75C8.94504 1.16663 9.12717 1.2641 9.23536 1.42638L10.2289 2.91663H12.25C12.7141 2.91663 13.1592 3.101 13.4874 3.42919C13.8156 3.75738 14 4.2025 14 4.66663V11.0833C14 11.5474 13.8156 11.9925 13.4874 12.3207C13.1592 12.6489 12.7141 12.8333 12.25 12.8333H1.75C1.28587 12.8333 0.840752 12.6489 0.512563 12.3207C0.184375 11.9925 0 11.5474 0 11.0833V4.66663C0 4.2025 0.184374 3.75738 0.512563 3.42919C0.840752 3.101 1.28587 2.91663 1.75 2.91663H3.77114L4.76464 1.42638ZM5.56219 2.33329L4.5687 3.82353C4.46051 3.98582 4.27837 4.08329 4.08333 4.08329H1.75C1.59529 4.08329 1.44692 4.14475 1.33752 4.25415C1.22812 4.36354 1.16667 4.51192 1.16667 4.66663V11.0833C1.16667 11.238 1.22812 11.3864 1.33752 11.4958C1.44692 11.6052 1.59529 11.6666 1.75 11.6666H12.25C12.4047 11.6666 12.5531 11.6052 12.6625 11.4958C12.7719 11.3864 12.8333 11.238 12.8333 11.0833V4.66663C12.8333 4.51192 12.7719 4.36354 12.6625 4.25415C12.5531 4.14475 12.4047 4.08329 12.25 4.08329H9.91667C9.72163 4.08329 9.53949 3.98582 9.4313 3.82353L8.43781 2.33329H5.56219Z"
                                        fill=""></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.00004 5.83329C6.03354 5.83329 5.25004 6.61679 5.25004 7.58329C5.25004 8.54979 6.03354 9.33329 7.00004 9.33329C7.96654 9.33329 8.75004 8.54979 8.75004 7.58329C8.75004 6.61679 7.96654 5.83329 7.00004 5.83329ZM4.08337 7.58329C4.08337 5.97246 5.38921 4.66663 7.00004 4.66663C8.61087 4.66663 9.91671 5.97246 9.91671 7.58329C9.91671 9.19412 8.61087 10.5 7.00004 10.5C5.38921 10.5 4.08337 9.19412 4.08337 7.58329Z"
                                        fill=""></path>
                                </svg>
                                <input type="file" name="profile" id="profile" class="sr-only">
                            </label> --}}
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="mb-1.5 text-2xl font-medium text-black dark:text-white">
                            {{ $data['club_information_name'] }}
                        </h3>
                        <p class="font-medium">{{ $data['club_information_short_name'] }}</p>

                        <div class="mx-auto max-w-180">
                            <h4 class="font-medium text-black dark:text-white">
                                OverView
                            </h4>
                            <p class="mt-4.5 text-sm font-medium">
                                {{ $data['club_information_overview'] }}
                            </p>
                        </div>


                    </div>
                </div>
            </div>
            <!-- ====== Profile Section End -->


        </div>
    </div>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">


    </div>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <!-- Breadcrumb Start -->
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-title-md2 font-bold py-2 text-black dark:text-white">
                    Panel Mamber
                </h2>
            </div>
            <!-- ====== Form Elements Section Start -->
            <div class="w-fill text-right py-4">
                <a href="{{ route('backend.club-information.add-panel-member', ['id' => $data['club_information_uuid']]) }}"
                    class="inline-flex items-center justify-center gap-2.5 rounded-md bg-primary py-3 px-10 text-center font-medium text-white hover:bg-opacity-90 lg:px-6 xl:px-8">
                    Add Panel Member
                </a>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
            @foreach ($data['panel_members'] as $panelMember)
                <div
                    class="center rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
                    <div class="mt-4 center items-end justify-between" style="text-align: center">
                        <img class="w-32 h-32 rounded-full mx-auto"
                            src="{{ $panelMember['club_information_panel_members_photo'] ? $panelMember['club_information_panel_members_photo'] : asset('images/user/user-01.png') }}"
                            alt="">
                        {{-- Additional details can be added here --}}
                        <div class="center text-sm mt-5">
                            <p
                                class="font-medium leading-none text-gray-900 hover:text-indigo-600 transition duration-500 ease-in-out">
                                {{ $panelMember['club_information_panel_members_name'] }}</p>
                            <p>{{ $panelMember['club_information_panel_members_designation'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- Card Item End -->
        </div>

    </div>


</x-app-layout>
