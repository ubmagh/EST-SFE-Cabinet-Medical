<!DOCTYPE html>
<html lang="fr">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <!-- plugins:css -->
  <!-- deleted them none is used here -->
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href={{ asset("images/favicon.png") }} />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="main-panel">
        <div class="content-wrapper d-flex align-items-center auth px-0">
          <div class="row w-100 mx-0">
            <div class="col-lg-6 mx-auto">
              <div class="auth-form-light text-left py-5 px-4 px-sm-5">

                
            
                <div class="mt-4 mb-4">
                    <a href="{{url('/Secretaire')}}" class="btn btn-block btn-primary auth-form-btn  py-3">
                     <span class="display-4">   <i class="fas fa-user-nurse fa-lg"></i>  Se Connecter comme Secretaire </span>
                      </a>
                </div>

                <div class="mb-4 mt-4">
                    <a href="{{url('/Medcin')}}" class="btn btn-block btn-success auth-form-btn  py-3">
                        <span class="display-4">    <i class="fas fa-user-md fa-lg"></i>  Se Connecter comme Medcin</span>
                      </a>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset("vendors/js/vendor.bundle.base.js") }}"></script>
  <script src="{{ asset('vendors/js/vendor.bundle.addons.js') }} "></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/FontAwesomeAll.min.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <script src="{{ asset('js/settings.js') }}"></script>
  <script src="{{ asset('js/todolist.js') }}"></script>
  <!-- endinject -->
</body>


</html>