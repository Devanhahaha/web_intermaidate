<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    @yield('body')
</body>
<style>
    .whatsapp {
        padding: 10px;
        background: #5aff89;
        color: #000;
        margin: 10px;
        border-radius: 10px;
        list-style: none;
    }

    .whatsapp h5 {
        display: block;
        width: 100%;
    }

    .whatsapp span {
        font-size: 12px;
    }
</style>

</html>