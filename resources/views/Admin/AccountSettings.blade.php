@extends('Admin.Parts.pageLayout')

@section('title','Administrateur : Paramètres de compte')

@section('content')

<div class="content-wrapper">
         

          
        
@if( session('status')=="done" )

<div class="row w-100 my-3 ml-1">

    <div class="alert alert-success py-3 w-100 d-block mx-auto px-2 alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        Modifications Bien Enregistrées
    </div>

</div>

@elseif( session('status')=="err" )
<div class="row w-100 my-3 ml-1">

    <div class="alert alert-danger py-3 w-100 px-2 d-block mx-auto px-2 alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        La modifications est echouée
    </div>

</div>
@endif


<div class="card card-fluid mt-3 mb-4">
    <h6 class="card-header"> Votre dernier Connexion : </h6>
    <div class="card-body text-center">
        {{ json_decode($LastLoginDate)->last }}
    </div>
</div>


<div class="card card-fluid">
    <h6 class="card-header"> Paramètres  du compte administrateur : </h6>
    <div class="card-body">
    <form method="post" action="{{ url('AdminParametres') }}">

            {{ csrf_field() }}
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="input05">Changer votre Pseudo : </label>
                    <input type="text" class="form-control" id="input05" name="Pseudo" maxlength="20" placeholder="{{ $user->AdminPseudo }}" />
                    @if($errors->has('Pseudo'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            {{ $errors->first('Pseudo') }}
                        </div>
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <label for="input03">Changer votre adresse Email :</label>
                    <input type="email" class="form-control" id="input03" name="Email" maxlength="100" placeholder="{{ $user->AdminEmail }}" />
                    @if($errors->has('Email'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            {{ $errors->first('Email') }}
                        </div>
                    @endif
                </div>
            </div>

            <h4 class="h4 mt-2"> Changer votre Mot de passe : </h4>

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="input04">Nouveau mot de passe: </label>
                    <input type="password" class="form-control" id="input04" name="password" maxlength="100"/>
                    @if($errors->has('password'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <label for="pwdc">Confirmez le nouveau mot de passe :</label>
                    <input type="password" class="form-control" id="pwdc" name="pwdc" />
                    @if($errors->has('pwdc'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            {{ $errors->first('pwdc') }}
                        </div>
                    @endif
                </div>
            </div>

            <h5 class="h5 my-3 mb-2 text-info"> <i class="fa fa-exclamation-circle fa-lg"></i> laissez le champ vide s'il n'est pas modifiable. </h5>
 
            <hr>
            <div class="form-row">
                <div class="col-md-10 mb-3">
                    <input type="password" class="form-control ml-auto mr-3 " name="Oldpwd"  placeholder="Entrez votre mot de passe mot de passe" maxlength="100" />
                    <small class="text-muted"> Le mot de passe courant est necessaire pour toute modification </small>
                    @if($errors->has('Oldpwd'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            {{ $errors->first('Oldpwd') }}
                        </div>
                    @endif
                </div>
                <div class="col-md-2 mb-3">
                    <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Enregistrer </button>
                </div>
            </div>
        </form>
    </div>
</div>
        </div>

@endsection
