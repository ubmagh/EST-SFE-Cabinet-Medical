<!DOCTYPE html>
<html lang="fr">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> Mot de Passe ou pseudo oublié </title>
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
            <div class="col-lg-8 mx-auto">
              <div class="auth-form-light text-left py-5 px-4 px-sm-5">

                <div class="row w-100 mb-4 ">
                  <div class="col-12">
                      <h1 class="h1 display-2 font-weight-light"> Mot de passe ou pseudo oublié ? </h1>
                      <p> Saisissez votre adresse Email ci dessous </p>
                  </div>
                </div>
                
              <form class="pt-3" method="POST" action="{{{ url('/Forgot') }}}">

                {{ csrf_field() }}  

                  <div class="form-group ">
                    <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="ABCD@xyz.com">
                    @if( $errors->has('pseudo') )
                      <div class="alert alert-danger alert-dismissible fade show mt-n5" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          <span class="sr-only">Close</span>
                        </button>
                        {{$errors->first('pseudo')}}
                      </div>
                    @endisset
                  </div>
                 
                
                  
                  <div class="mt-3 mb-2">
                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"> <i class="fas fa-user-check fa-lg"></i> Vérifier </button>
                  </div>
                  
                  <div class="mb-2">
                    <a href="{{url('/')}}" class="btn btn-block btn-google auth-form-btn">
                      <i class="fa fa-arrow-left fa-lg" aria-hidden="true"></i>  Plutot se-connecter
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