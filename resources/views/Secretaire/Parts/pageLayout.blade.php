

{{--
les variables de ce template

  - title
  - css
  - content
  - script


--}}

<!DOCTYPE html>
<html lang="fr">


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}" >
  <title> @yield('title') </title>
  <link rel="stylesheet" href="{{ asset('vendors/iconfonts/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.addons.css') }}">
  @yield('css')
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" />
</head>

<body>
  <div class="container-scroller">
    <div class="horizontal-menu">
      <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container">
          <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a href="#{{config('app.name')}}" class="text-white" title="{{ config('app.name') }}"> <i class="fas fa-plus fa-2x"></i> <i id="{{config('app.name')}}" class="fab fa-medium-m fa-2x"></i>.app</a>
          </div>
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <ul class="navbar-nav mr-lg-2">
              
            </ul>
            <ul class="navbar-nav navbar-nav-right">
              
              
              <li class="nav-item nav-profile dropdown">
                <a class="nav-link mt-2" href="#" data-toggle="dropdown" id="profileDropdown">
                  <p style="font-family: Source Sans Pro; font-size: large;">  <i class="fas fa-user fa-lg ml-n1 mr-1"></i>  <u> {{ $name }} </u> </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="{{ url('SecretaireParametres') }}">
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
                <span class="menu-title">Acceuil</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('SalleAttente') }}">
                <i class="ti-list-ol menu-icon"></i>
                <span class="menu-title">Liste d'Attente</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/Rendez-Vous') }}" class="nav-link">
                <i class="ti-time menu-icon"></i>
                <span class="menu-title">Rendez-Vous</span>
               </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/patient') }}" class="nav-link">
                <i class="fas fa-users menu-icon"></i>
                <span class="menu-title">Patients</span></a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/Medicaments') }}" class="nav-link">
                <i class="fas fa-pills menu-icon"></i>
                <span class="menu-title">Medicaments</span></a>
            </li>
            <li class="nav-item">
              <a href="{{ url('Confreres') }}" class="nav-link">
                <i class="fas fa-user-friends menu-icon"></i>
                  <span class="menu-title">Confrères</span>
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </div>

    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        
          
          
        @yield('content')
        
          
        
        <footer class="footer">
          <div class="w-100 clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2020 <a href="#"> {{ config('app.name') }} </a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
          </div>
        </footer>
      </div>
    </div>
  </div>

  <script src="{{ asset('/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('/vendors/js/vendor.bundle.addons.js') }}"></script>
  <script src="{{ asset('/js/off-canvas.js') }}"></script>
  <script src="{{ asset('/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('/js/template.js') }}"></script>
  <script src="{{ asset('/js/settings.js') }}"></script>
  <script src="{{ asset('/js/todolist.js') }}"></script>
<script src="{{ asset('/js/FontAwesomeAll.min.js') }}"></script>
<script src="{{ asset('/js/sweetalert2@9.js') }}"></script>
  @yield('script')
</body>


</html>