@yield('css')
<!-- Main Stylesheet -->
<link rel="stylesheet" href="{{ URL::asset('assets/user/css/style.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('assets/user/css/responsive.css') }}" />
<!-- Dark Stylesheet -->
{{-- <link rel="stylesheet" href="{{ URL::asset('assets/user/css/style-dark.css') }}" /> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background-color: #fff;
    }
    .preloader .loading {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%,-50%);
        font: 14px arial;
    }

    .main-menu-logo img {
        width: 140px;
        height: auto;
    }

    .submit {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .center-button {
        padding: 10px 20px;
        font-size: 16px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .center-button i {
        margin-left: 5px;
        line-height: 1;
        vertical-align: middle;
    }

    .clients-carousel {
        display: flex;
        overflow-x: auto;
        gap: 20px;
        padding: 10px;
        width: 100%;
    }

    .client-item {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 150px;
        min-width: 150px;
        /* background-color: #f8f8f8; */
    }

    .client-item img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
    }

    .table-responsive {
        overflow-y: hidden;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    table.sheet0 {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ddd;
    }

    table.sheet0 th, table.sheet0 td {
        padding: 5px;
        text-align: left;
    }

    table.sheet0 th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .modal {
        z-index: 9999 !important; /* Z-index sangat tinggi untuk menghindari konflik */
        position: fixed;
        top: 10%;
        left: 50%;
        transform: translate(-50%, 0);
    }

    .modal-backdrop {
        z-index: 9998 !important; /* Pastikan backdrop tetap di bawah modal */
    }

    .table>:not(caption)>*>* {
        padding: 10px 15px;
    }

    .d2_select_all,
    .d2_input_all {
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 5px;
        color: #000;
        font-size: 14px;
        width: 100%;
        max-width: 150px;
        height: 38px;
        box-sizing: border-box;
    }

</style>
@yield('css-bottom')
