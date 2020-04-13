<!DOCTYPE html>
<html lang="fr">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Medcin: login</title>
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
  <link rel="shortcut icon" href={{ asset("images/favicon.png") }} />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="main-panel">
        <div class="content-wrapper d-flex align-items-center auth px-0">
          <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left py-5 px-4 px-sm-5">

                <div class="row w-100ml-1 mb-4 ">
                  <div class="col-md-3 col-sm-12">
                    <img src="{{ asset('images/icons/medic.png') }}" class="w-md-100 mx-sm-auto d-md-block d-sm-block ml-md-auto ml-lg-n3  ml-lg-0" style="max-height: 80px;" alt="Secretary login" />
                  </div>
                
                  <div class="col-md-9 col-sm-12 d-flex align-content-center align-items-center ml-lg-0">
                    <h1 class="h1 display-4 text-sm-center text-md-left mx-sm-auto mr-md-auto mt-sm-3 text-info"> Connexion Medcin </h1>
                  </div>
                </div>
                
              <form class="pt-3" method="POST" action="{{{ url('login/Secretary') }}}">

                {{ csrf_field() }}  

                  <div class="form-group">
                    <input type="email" name="pseudo" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Votre Pseudo">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Mot de passe">
                  </div>
                  <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" > <i class="fas fa-sign-in-alt fa-lg"></i> Se Connecter </button>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" name="saveMe" class="form-check-input">
                        Rester Connecté(e)
                      </label>
                    </div>
                    <a href="#" class="auth-link text-black">Mot de passe oublié?</a>
                  </div>
                  <div class="mb-2">
                  <a href="{{url('/')}}" class="btn btn-block btn-google auth-form-btn">
                      <i class="fa fa-arrow-left fa-lg" aria-hidden="true"></i>  Retourner au menu
                    </a>
                  </div>
                </form>
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