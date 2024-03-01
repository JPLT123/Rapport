<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Elceto_Holding') }}</title>

        {{-- <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets\images\logo_elceto.png')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        
        <!-- DataTables -->
        <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />  

        <script src="{{asset('https://cdn.jsdelivr.net/npm/apexcharts')}}"></script>
    
        <script src="{{asset('https://js.pusher.com/8.2.0/pusher.min.js')}}"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css">

    <!-- Plugins css -->
    <link href="assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.snow.css" rel="stylesheet">
        @livewireStyles
    </head>
    <body data-sidebar="dark" data-layout-mode="light">
        <div id="layout-wrapper">
            {{-- l'en-tete de l'accueil --}}
            @include('layouts.header-guest')
            {{-- les menu de navigation --}}
            @include('layouts.navigation-guest')

            <div class="font-sans text-gray-900 antialiased">
                @yield('content')
            </div>
        </div>

        @include('layouts.footer')
        <div class="rightbar-overlay"></div>
          <!-- JAVASCRIPT -->
          <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
          <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
          <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
          <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
          <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
          <!-- bootstrap datepicker -->
        <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

        <!--tinymce js-->
        <script src="{{asset('assets/libs/tinymce/tinymce.min.js')}}"></script>
        
        <!-- form repeater js -->
        <script src="{{asset('assets/libs/jquery.repeater/jquery.repeater.min.js')}}"></script>

        <script src="{{asset('assets/js/pages/task-create.init.js')}}"></script>

          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
          
          <!-- two-step-verification js -->
          <script src="{{asset('assets/js/pages/two-step-verification.init.js')}}"></script>

        <!-- apexcharts -->
        <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

        <script src="{{asset('assets/js/pages/tasklist.init.js')}}"></script>


        <!-- crypto exchange init -->
        <script src="{{asset('assets/js/pages/crypto-exchange.init.js')}}"></script>
        
        <!-- Saas dashboard init -->
        <script src="{{asset('assets/js/pages/saas-dashboard.init.js')}}"></script>
        
        <!-- Required datatable js -->
        <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        
        <script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        
        <!-- Responsive examples -->
        <script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
        
        <!-- crypto-wallet init -->
        <script src="{{asset('assets/js/pages/crypto-wallet.init.js')}}"></script>

        
        <script src="{{asset('assets/js/pages/project-overview.init.js')}}"></script>

        <!-- Init js-->
        <script src="{{asset('assets/js/pages/form-xeditable.init.js')}}"></script>   
        
        <!-- Plugins js -->
        <script src="{{asset('assets/libs/bootstrap-editable/js/index.js')}}"></script>
        <script src="{{asset('assets/libs/moment/min/moment.min.js')}}"></script>  
        
        <script src="{{asset('assets/js/pages/profile.init.js')}}"></script>
        

        <!-- owl.carousel js -->
        <script src="{{asset('assets/libs/owl.carousel/owl.carousel.min.js')}}"></script>

        <!-- validation init -->
        <script src="{{asset('assets/js/pages/validation.init.js')}}"></script>

        <!-- auth-2-carousel init -->
        <script src="{{asset('assets/js/pages/auth-2-carousel.init.js')}}"></script>
        <script src="{{asset('assets/js/pages/apexcharts.init.js')}}"></script>
        
        <!-- Plugins js -->
        <script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>

        <!-- Plugins js -->
        <script src="assets/libs/dropzone/min/dropzone.min.js"></script>

        
        <!-- Required datatable js -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/jszip/jszip.min.js"></script>
        <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        
        <!-- Responsive examples -->
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/js/pages/datatables.init.js"></script>

        <script src="assets/js/app.js"></script>
        <script>
            const quill = new Quill('#editor', {
              theme: 'snow'
            });
          </script>
        @include('sweetalert')
        @livewireScripts
    </body>
</html>
