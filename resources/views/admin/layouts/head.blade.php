@yield('css')

<link rel="stylesheet" href="{{ URL::asset('assets/admin/vendor/fonts/remixicon/remixicon.css') }}" />

<!-- Menu waves for no-customizer fix -->
<link rel="stylesheet" href="{{ URL::asset('assets/admin/vendor/libs/node-waves/node-waves.css') }}" />

<!-- Core CSS -->
<link rel="stylesheet" href="{{ URL::asset('assets/admin/vendor/css/core.css') }}" class="template-customizer-core-css" />
<link rel="stylesheet" href="{{ URL::asset('assets/admin/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
<link rel="stylesheet" href="{{ URL::asset('assets/admin/css/demo.css') }}" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="{{ URL::asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

<link rel="stylesheet" href="{{ URL::asset('assets/admin/vendor/ckeditor5-premium-features.css') }}">

<style>
    .ui-state-default {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 5px;
        background-color: #E0E0E0;
        cursor: move;
    }

    .table td {
        word-break: break-word;
        white-space: normal;
    }
</style>
<!-- Page CSS -->
@yield('css-bottom')

<!-- Helpers -->
<script src="{{ URL::asset('assets/admin/vendor/js/helpers.js') }}"></script>
<script src="{{ URL::asset('assets/admin/js/config.js') }}"></script>
