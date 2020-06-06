<!DOCTYPE html>
<html lang="fr">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Medecin: login</title>
  <!-- plugins:css -->
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
<link rel="stylesheet" href="{{ asset('vendors/iconfonts/ti-icons/css/themify-icons.css') }}">
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
            <div class="col-lg-5 mx-auto">
              <div class="auth-form-light text-left py-5 px-4 px-sm-5">

                <div class="row w-100 ml-1 mb-4 ">
                    <div class="col-md-3 col-sm-12">
                      <img src="{{ asset('images/icons/medic.png') }}" class="w-md-100 mx-sm-auto d-md-block d-sm-block ml-md-auto ml-lg-n3  ml-lg-0" style="max-height: 80px;" alt="Secretary login" />
                    </div>
                  
                    <div class="col-md-9 col-sm-12 d-flex align-content-center align-items-center ml-lg-0">
                      <h1 class="h1 display-4 text-sm-center text-md-left mx-sm-auto mr-md-auto mt-sm-3 text-info"> Connexion Medecin </h1>
                    </div>
                  </div>
                
              <form class="pt-3" method="POST" action="{{{ url('/Medcin') }}}">

                {{ csrf_field() }}  

                  <div class="form-group ">
                    <input type="text" name="pseudo" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Votre Pseudo">
                    @if( $errors->has('pseudo') )
                      <div class="alert alert-danger alert-dismissible fade show mt-n5" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          <span class="sr-only">Close</span>
                        </button>
                        {{$errors->first('pseudo')}}
                      </div>
                    @endif
                  </div>
                 
                <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Mot de passe">
                    @if( $errors->has('password') )
                      <div class="alert alert-danger alert-dismissible fade show mt-n5" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          <span class="sr-only">Close</span>
                        </button>
                        {{$errors->first('password')}}
                      </div>
                      @else
                        @if ($message = Session::get('error'))
                          <div class="alert alert-danger alert-block">
                          <button type="button" class="close" data-dismiss="alert">×</button>
                          <strong>{{ $message }}</strong>
                          </div>
                        @endif

                    @endif
                    
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
                  <a href="{{ url('/Forgot') }}" class="auth-link text-black"><i class="fas fa-question-circle"></i>  Mot de passe/pseudo oublié?</a>
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
  <script src="{{ asset('js/FontAwesomeAll.min.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <!-- endinject -->
</body>


</html>