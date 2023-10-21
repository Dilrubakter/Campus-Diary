
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    {{ env('APP_NAME') }}
  </title>

  <link href="https://demo.tailadmin.com/style.css" rel="stylesheet">

  <script src="https://demo.tailadmin.com/bundle.js" defer></script>
</head>

<body
  x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
  x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
  :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">
  <!-- ===== Preloader Start ===== -->
  {{-- <include src="./partials/preloader.html"></include> --}}
  <!-- ===== Preloader End ===== -->

  <!-- ===== Page Wrapper Start ===== -->
  <div class="flex h-screen overflow-hidden">
    <!-- ===== Sidebar Start ===== -->

    @include('layouts.sidebar')

    {{-- <include src="./partials/sidebar.html"></include> --}}
    <!-- ===== Sidebar End ===== -->

    <!-- ===== Content Area Start ===== -->
    <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
      <!-- ===== Header Start ===== -->

    @include('layouts.navigation')
      {{-- <include src="./partials/header.html" />
      <!-- ===== Header End ===== -->
            @include('layouts.navigation')
 --}}


            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            <!-- ===== Main Content End ===== -->
          </div>
          <!-- ===== Content Area End ===== -->
        </div>
        <!-- ===== Page Wrapper End ===== -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script defer src="bundle.js"></script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/v84a3a4012de94ce1a686ba8c167c359c1696973893317" integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA==" data-cf-beacon='{"rayId":"819adfb1fb31ba50","r":1,"version":"2023.10.0","token":"67f7a278e3374824ae6dd92295d38f77"}' crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            // Function to hide the success message after 5 seconds
            setTimeout(function() {
                $(".alert.alert-success").fadeOut("slow");
            }, 5000); // 5000 milliseconds (5 seconds)
        </script>

<script>
         document.getElementById('delete-button').addEventListener('click', function() {
            const recordId = this.getAttribute('data-record-id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/timeslot/${recordId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message === 'Record deleted.') {
                            Swal.fire('Deleted!', 'Your record has been deleted.', 'success');
                            // You can also update the UI or perform other actions here
                        } else {
                            Swal.fire('Error', 'An error occurred while deleting the record.', 'error');
                        }
                    });
                }
            });
        });
    </script>
    </body>

      </html>
