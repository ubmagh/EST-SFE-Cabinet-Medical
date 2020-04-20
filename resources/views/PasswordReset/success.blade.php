<!DOCTYPE html>
<html lang="fr">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Reinitialisation du Mot de passe </title>
    <!-- plugins:css -->
    <link rel="stylesheet"
        href="{{ asset('vendors/iconfonts/ti-icons/css/themify-icons.css') }}">
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


                                <div class="py-3 px-4 w-100 my-3">

                                    <div class="row w-100 mb-4 ">
                                        <div class="col-12">
                                            <h1 class="h1 display-2 font-weight-light">Reinitialiser votre mot de passe:
                                            </h1>
                                        </div>
                                    </div>

                                    <div class="alert alert-success py-2 px-3" role="alert">
                                        Vos données sont Bien modifiées, Vous pouvez maintenant vous connecter.
                                    </div>

                                    <div class="my-2">
                                        <a href="{{ url('/') }}"
                                            class="btn btn-block btn-primary auth-form-btn">
                                            <i class="fas fa-home fa-lg"></i> Acceuil
                                        </a>
                                    </div>
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
