@extends('Admin.Parts.pageLayout')

@section('title','Administrateur : Paramètres de compte')

@section('content')


<div class="card card-fluid mt-3 mb-4">
    <h6 class="card-header"> Votre dernier Connexion : </h6>
    <div class="card-body text-center">
        {{ json_decode($LastLoginDate)->last }}
    </div>
</div>

<div class="card card-fluid">
    <h6 class="card-header"> Paramètres  du compte administrateur : </h6>
    <div class="card-body">
        <form method="post">

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="input05">Changer votre Pseudo : </label>
                    <input type="text" class="form-control" id="input05" >
                </div>
                <div class="col-md-6 mb-3">
                    <label for="input03">Changer votre adresse Email :</label>
                    <input type="email" class="form-control" id="input03" />
                </div>
            </div>

            <h4 class="h4 mt-2"> Changer votre Mot de passe : </h4>

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="input04">Nouveau mot de passe: </label>
                    <input type="password" class="form-control" id="input04" />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="pwdc">Confirmez le nouveau mot de passe :</label>
                    <input type="password" class="form-control" id="pwdc" />
                </div>
            </div>

            <h5 class="h5 my-3 mb-2 text-info"> <i class="fa fa-exclamation-circle fa-lg"></i> laissez le champ vide s'il n'est pas modifiable. </h5>
 
            <hr>
            <div class="form-row">
                <div class="col-md-10 mb-3">
                    <input type="password" class="form-control ml-auto mr-3 "  placeholder="Entrez votre mot de passe mot de passe" />
                    <small class="text-muted"> Le mot de passe courant est necessaire pour toute modification </small>
                </div>
                <div class="col-md-2 mb-3">
                    <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Enregistrer </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
