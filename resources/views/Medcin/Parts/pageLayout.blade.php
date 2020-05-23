<!DOCTYPE html>
<html lang="fr">


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> @yield('title') </title>
<link rel="stylesheet" href="{{ asset('vendors/iconfonts/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.addons.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
  @yield('css')
</head>

<body>
  <div class="container-scroller">
    <div class="horizontal-menu">
      <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container">
          <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="index-2.html"><img src="http://www.urbanui.com/justdo/template/images/logo-white.svg" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="index-2.html"><img src="http://www.urbanui.com/justdo/template/images/logo-mini.svg" alt="logo"/></a>
          </div>
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <ul class="navbar-nav mr-lg-2">
              
            </ul>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown mr-1">
                <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
                  <i class="ti-email mx-0"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <img src="{{ asset('/images/faces/face4.jpg') }}" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content flex-grow">
                      <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                      </h6>
                      <p class="font-weight-light small-text text-muted mb-0">
                        The meeting is cancelled
                      </p>
                    </div>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <img src="{{ asset('/images/faces/face2.jpg') }}" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content flex-grow">
                      <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
                      </h6>
                      <p class="font-weight-light small-text text-muted mb-0">
                        New product launch
                      </p>
                    </div>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <img src="{{ asset('/images/faces/face3.jpg')}}" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content flex-grow">
                      <h6 class="preview-subject ellipsis font-weight-normal"> Johnson
                      </h6>
                      <p class="font-weight-light small-text text-muted mb-0">
                        Upcoming board meeting
                      </p>
                    </div>
                  </a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                  <i class="ti-bell mx-0"></i>
                  <span class="count"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-success">
                        <i class="ti-info-alt mx-0"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <h6 class="preview-subject font-weight-normal">Application Error</h6>
                      <p class="font-weight-light small-text mb-0 text-muted">
                        Just now
                      </p>
                    </div>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-warning">
                        <i class="ti-settings mx-0"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <h6 class="preview-subject font-weight-normal">Settings</h6>
                      <p class="font-weight-light small-text mb-0 text-muted">
                        Private message
                      </p>
                    </div>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-info">
                        <i class="ti-user mx-0"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <h6 class="preview-subject font-weight-normal">New user registration</h6>
                      <p class="font-weight-light small-text mb-0 text-muted">
                        2 days ago
                      </p>
                    </div>
                  </a>
                </div>
              </li>
              <li class="nav-item nav-profile dropdown">
                <a class="nav-link mt-2" href="#" data-toggle="dropdown" id="profileDropdown">
                <p style="font-family: Source Sans Pro;"> <u> {{ $name }} </u> </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="{{ url('MedcinParametres') }}">
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
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-heartbeat menu-icon"></i>
                <span class="menu-title">Consultation</span>
                <i class="menu-arrow"></i></a>
              </a>
              <div class="submenu">
                <ul class="submenu-item">
                  <li class="nav-item"><a  href="{{ url('/Consultation') }}" class="nav-link"> à Cabinet</a></li>
                  <li class="nav-item"><a class="nav-link" href="#Domicile"> à Domicile</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/widgets/widgets.html">
                <i class="ti-settings menu-icon"></i>
                <span class="menu-title">Widgets</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="ti-clipboard menu-icon"></i>
                <span class="menu-title">Forms</span>
                <i class="menu-arrow"></i></a>
              <div class="submenu">
                <ul class="submenu-item">
                  <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Basic Elements</a></li>
                  <li class="nav-item"><a class="nav-link" href="pages/forms/advanced_elements.html">Advanced Elements</a></li>
                  <li class="nav-item"><a class="nav-link" href="pages/forms/validation.html">Validation</a></li>
                  <li class="nav-item"><a class="nav-link" href="pages/forms/wizard.html">Wizard</a></li>
                  <li class="nav-item"><a class="nav-link" href="pages/forms/text_editor.html">Text Editor</a></li>
                  <li class="nav-item"><a class="nav-link" href="pages/forms/code_editor.html">Code Editor</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item mega-menu">
              <a href="#" class="nav-link">
                <i class="ti-bar-chart-alt menu-icon"></i>
                <span class="menu-title">Data</span>
                <i class="menu-arrow"></i></a>
              <div class="submenu">
                <div class="col-group-wrapper row">
                  <div class="col-group col-md-6">
                    <p class="category-heading">Charts</p>
                    <div class="submenu-item">
                      <div class="row">
                        <div class="col-md-6">
                          <ul>
                            <li class="nav-item"><a class="nav-link" href="pages/charts/chartjs.html">Chart Js</a></li>
                            <li class="nav-item"><a class="nav-link" href="pages/charts/morris.html">Morris</a></li>
                            <li class="nav-item"><a class="nav-link" href="pages/charts/flot-chart.html">Flot</a></li>
                            <li class="nav-item"><a class="nav-link" href="pages/charts/google-charts.html">Google Chart</a></li>
                          </ul>
                        </div>
                        <div class="col-md-6">
                          <ul>
                            <li class="nav-item"><a class="nav-link" href="pages/charts/sparkline.html">Sparkline</a></li>
                            <li class="nav-item"><a class="nav-link" href="pages/charts/c3.html">C3 Chart</a></li>
                            <li class="nav-item"><a class="nav-link" href="pages/charts/chartist.html">Chartist</a></li>
                            <li class="nav-item"><a class="nav-link" href="pages/charts/justGage.html">JustGage</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-group col-md-3">
                    <p class="category-heading">Table</p>
                    <ul class="submenu-item">
                      <li class="nav-item"><a class="nav-link" href="pages/tables/basic-table.html">Basic Table</a></li>
                      <li class="nav-item"><a class="nav-link" href="pages/tables/data-table.html">Data Table</a></li>
                      <li class="nav-item"><a class="nav-link" href="pages/tables/js-grid.html">Js-grid</a></li>
                      <li class="nav-item"><a class="nav-link" href="pages/tables/sortable-table.html">Sortable Table</a></li>
                    </ul>
                  </div>
                  <div class="col-group col-md-3">
                    <p class="category-heading">Maps</p>
                    <ul class="submenu-item">
                      <li class="nav-item"><a class="nav-link" href="pages/maps/mapael.html">Mapael</a></li>
                      <li class="nav-item"><a class="nav-link" href="pages/maps/vector-map.html">Vector Map</a></li>
                      <li class="nav-item"><a class="nav-link" href="pages/maps/google-maps.html">Google Map</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item mega-menu">
              <a href="#" class="nav-link">
                <i class="ti-layers menu-icon"></i>
                <span class="menu-title">Sample Pages</span>
                <i class="menu-arrow"></i></a>
              <div class="submenu">
                <div class="col-group-wrapper row">
                  <div class="col-group col-md-3">
                    <p class="category-heading">User Pages</p>
                    <ul class="submenu-item">
                      <li class="nav-item"><a class="nav-link" href="pages/samples/login.html">Login</a></li>
                      <li class="nav-item"><a class="nav-link" href="pages/samples/login-2.html">Login 2</a></li>
                      <li class="nav-item"><a class="nav-link" href="pages/samples/register.html">Register</a></li>
                      <li class="nav-item"><a class="nav-link" href="pages/samples/register-2.html">Register 2</a></li>
                      <li class="nav-item"><a class="nav-link" href="pages/samples/lock-screen.html">Lockscreen</a></li>
                    </ul>
                  </div>
                  <div class="col-group col-md-3">
                    <p class="category-heading">Error Pages</p>
                    <ul class="submenu-item">
                      <li class="nav-item"><a class="nav-link" href="pages/samples/error-400.html">400</a></li>
                      <li class="nav-item"><a class="nav-link" href="pages/samples/error-404.html">404</a></li>
                      <li class="nav-item"><a class="nav-link" href="pages/samples/error-500.html">500</a></li>
                      <li class="nav-item"><a class="nav-link" href="pages/samples/error-505.html">505</a></li>
                    </ul>
                  </div>
                  <div class="col-group col-md-3">
                    <p class="category-heading">E-commerce</p>
                    <ul class="submenu-item">
                      <li class="nav-item"><a class="nav-link" href="pages/samples/invoice.html">Invoice</a></li>
                      <li class="nav-item"><a class="nav-link" href="pages/samples/pricing-table.html">Pricing Table</a></li>
                      <li class="nav-item"><a class="nav-link" href="pages/samples/orders.html">Orders</a></li>
                    </ul>
                  </div>
                  <div class="col-group col-md-3">
                    <p class="category-heading">General</p>
                    <ul class="submenu-item">
                      <li class="nav-item"><a class="nav-link" href="pages/samples/search-results.html">Search Results</a></li>
                      <li class="nav-item"><a class="nav-link" href="pages/samples/profile.html">Profile</a></li>
                      <li class="nav-item"><a class="nav-link" href="pages/samples/timeline.html">Timeline</a></li>
                      <li class="nav-item"><a class="nav-link" href="pages/samples/news-grid.html">News grid</a></li>
                      <li class="nav-item"><a class="nav-link" href="pages/samples/portfolio.html">Portfolio</a></li>
                      <li class="nav-item"><a class="nav-link" href="pages/samples/faq.html">FAQ</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="ti-package menu-icon"></i>
                <span class="menu-title">Apps</span>
                <i class="menu-arrow"></i></a>
              <div class="submenu">
                <ul class="submenu-item">
                  <li class="nav-item"><a class="nav-link" href="pages/apps/email.html">Email</a></li>
                  <li class="nav-item"><a class="nav-link" href="pages/apps/calendar.html">Calendar</a></li>
                  <li class="nav-item"><a class="nav-link" href="pages/apps/todo.html">Todo List</a></li>
                  <li class="nav-item"><a class="nav-link" href="pages/apps/gallery.html">Gallery</a></li>
                </ul>
              </div>
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
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018 <a href="http://www.urbanui.com/" target="_blank">Urbanui</a>. All rights reserved.</span>
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
  @yield('script')
  <script src="{{ asset('/js/FontAwesomeAll.min.js') }}"></script>
  <script src="js/dashboard.js"></script>
</body>


</html>