<!-- Bootstrap JS-->
<script src="{{ asset('/assets-admin/vendor/bootstrap-4.1/popper.min.js') }}"></script>
<script src="{{ asset('/assets-admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
<!-- Vendor JS       -->
<script src="{{ asset('/assets-admin/vendor/slick/slick.min.js') }}"></script>
<script src="{{ asset('/assets-admin/vendor/wow/wow.min.js') }}"></script>
<script src="{{ asset('/assets-admin/vendor/animsition/animsition.min.js') }}"></script>
<script src="{{ asset('/assets-admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<script src="{{ asset('/assets-admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('/assets-admin/vendor/counter-up/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('/assets-admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
<script src="{{ asset('/assets-admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('/assets-admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('/assets-admin/vendor/select2/select2.min.js') }}"></script>

<!-- Main JS-->
<script src="{{ asset('/assets-admin/js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- SweetAlert Notification -->
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif
@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif
