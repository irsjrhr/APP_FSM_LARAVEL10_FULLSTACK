
{{-- GET AND SET ENV VALUE TO WINDOW VARIABEL  --}}
{{-- INGAT!!!! KALO ADA P --}}
@php
$BASE_URL_PAGE = asset('');
$URL_SERVICE_BE = env('URL_SERVICE_BE');
$URL_SERVICE_FILE = env('URL_SERVICE_FILE');
@endphp


<script type="text/javascript">

    window.ENV = {
        BASE_URL_PAGE: @json($BASE_URL_PAGE),
        URL_SERVICE_CI: "BELUM DIISI",
        URL_SERVICE_BE: @json($URL_SERVICE_BE),
        URL_SERVICE_FILE: @json($URL_SERVICE_FILE) 
    };

</script>

@include('Index.header')
@include('template.alert_flasher')
{{-- Disi Oleh JS SPA di core.js load_page() --}}
@include('Index.footer')
@include('Index.modal_menu')
@include('File.modal_select_file')