<!DOCTYPE html>
<html lang="fr">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> @yield('title') </title>
  <!-- plugins:css -->
<link rel="stylesheet" href="{{ asset('vendors/iconfonts/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.addons.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" />
  @yield('css')

</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_horizontal-navbar.html -->
    <div class="horizontal-menu">
      <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container">
          <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          </div>
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <ul class="navbar-nav mr-lg-2">
              <a href="#{{config('app.name')}}" class="text-white" title="{{ config('app.name') }}"> <i class="fas fa-plus fa-2x"></i> <i id="{{config('app.name')}}" class="fab fa-medium-m fa-2x"></i>.app</a>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item nav-profile dropdown">
                <a class="nav-link mt-2" href="#" data-toggle="dropdown" id="profileDropdown">
                  <p style="font-family: Source Sans Pro; font-size: large;">  <u> {{ $name }} </u> </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="{{ url('/AdminParametres') }}">
                    <i class="ti-settings text-primary"></i>
                    Paramètres
                  </a>
                <a class="dropdown-item" href="{{ url('logout') }}">
                    <i class="ti-power-off text-primary"></i>
                    Déconnexion
                  </a>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
              <span class="ti-menu"></span>
            </button>
          </div>
        </div>
      </nav>
      <nav class="bottom-navbar">
        <div class="container">
          <ul class="nav page-navigation">
            <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">
                <i class="ti-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            
            
            
            <li class="nav-item mega-menu">
              <a href="{{ url('Operations') }}" class="nav-link">
                <i class="fas fa-microscope menu-icon"></i>
                <span class="menu-title"> Opérations</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-users-cog menu-icon"></i>
                <span class="menu-title">Utilisateurs</span>
                <i class="menu-arrow"></i></a>
              <div class="submenu">
                <ul class="submenu-item">
                <li class="nav-item"><a class="nav-link" href="{{ url('/users/secretaires') }}">Secretaires</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('/users/medcins') }}">Medcins</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a href="{{ url('/CabinetInfos') }}" class="nav-link">
                <i class="ti-info-alt menu-icon"></i>
                <span class="menu-title">Infos du Cabinet</span></a>
            </li>
          </ul>
        </div>
      </nav>
    </div>

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          
          
        @yield('content')
        
          
        
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
       <footer class="footer">
          <div class="w-100 clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2020 <a href="#"> {{ config('app.name') }} </a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ asset('/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('/vendors/js/vendor.bundle.addons.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('/js/off-canvas.js') }}"></script>
  <script src="{{ asset('/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('/js/template.js') }}"></script>
  <script src="{{ asset('/js/settings.js') }}"></script>
  <script src="{{ asset('/js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  @yield('script')
  <script src="{{ asset('/js/FontAwesomeAll.min.js') }}"></script>
  <!--<script src="js/todolist.js"></script>-->
  <!-- End custom js for this page-->
</body>


<!-- Mirrored from www.urbanui.com/justdo/template/demo/horizontal-default-light/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Apr 2019 21:12:44 GMT -->
</html>