@extends('base.noDashboard')
 <!--Swiper Css-->
    <link rel="stylesheet" type="text/css" href="{{asset('front-end/assets/css/swiper-bundle.min.css')}}">

    <!-- Swiper Js -->
    <script src="{{ asset('front-end/assets/js/swiper-bundle.min.js') }}"></script>

@section('content')
    <!-- Style -->
    @include('base.patient-dashboard.style')

    <div class="template-color-13 template-font-1">
        <!-- Dashboard Header -->
        @include('base.patient-dashboard.header')
        <div id="wrapper" class="toggled">
            <!-- Dashboard Sidebar -->
            @include('base.patient-dashboard.sidebar')

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            @yield('doctor-content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        let toggle_btn = document.querySelectorAll('.sidebar-toggle');
        for(let i = 0;i < toggle_btn.length; i++){
            toggle_btn[i].addEventListener('click',function(){
                let element = document.getElementById('wrapper');
                element.classList.toggle("toggled");
            });
        }

        function handleViewportChange() {
            if(window.matchMedia('(max-width: 767px)').matches) {
                // Apply remove mobile class
                let element = document.getElementById('wrapper');
                element.classList.remove("toggled");
            } 
        }
        // Call the function once to apply the initial
        handleViewportChange();

        // Call the function again whenever the viewport size changes
        window.addEventListener('resize', handleViewportChange);
        
    </script>
@endsection

