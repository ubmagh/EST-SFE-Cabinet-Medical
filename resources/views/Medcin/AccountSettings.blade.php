@extends('Admin.Parts.pageLayout')

@section('title','Medecin : Paramètres de compte')

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
    <h6 class="card-header"> Paramètres  du compte Medecin : </h6>
    <div class="card-body">
    <form method="post" action="{{ url('MedcinParametres') }}" enctype="multipart/form-data">

            {{ csrf_field() }}
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="input05">Changer votre Pseudo : </label>
                <input type="text" class="form-control" id="input05" name="Pseudo" maxlength="20" placeholder="{{ $user->Pseudo }}">
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
                    <input type="email" class="form-control" id="input03" name="Email" maxlength="100" placeholder="{{ $user->Email }}" />
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
                    <input type="password" class="form-control" id="input04" maxlength="100" name="password"/>
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

            <div class="form-row mt-3">
                <div class="col-md-6 mb-3">
                    <label for="Tel">Numéro de Téléphone: </label>
                    <input type="text" class="form-control" id="Tel" name="Tel" maxlength="14" placeholder="{{ $user->Tel }}" />
                    @if($errors->has('Tel'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            {{ $errors->first('Tel') }}
                        </div>
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <label for="adresse">Adresse :</label>
                    <textarea class="form-control" id="adresse" name="adresse" maxlength="100" rows="3" placeholder="{{ $user->Adresse }}"></textarea>
                    @if($errors->has('adresse'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            {{ $errors->first('adresse') }}
                        </div>
                    @endif
                </div>
            </div>

            <h5 class="h5 my-3 mb-2 text-info"> <i class="fa fa-exclamation-circle fa-lg"></i> laissez le champ vide s'il n'est pas modifiable. </h5>
            <hr>
            <div class="row my-3">
                <h4 class="h4 mt-2 ml-2"> Changer votre Signature : </h4>
            </div>
            
                <div class="form-row mt-3 mb-4">
                    <div class="col-md-6">
                        @if( $user->Signature )
                            <img src="{{ url('/Signature/'.$user->Signature) }}" class="border border-secondary rounded" style="min-height: 200px; max-height: 400px; width: auto; max-width: 100%;" alt="votre Signature Actuelle" title="votre Signature Actuelle"/>
                            <small class="form-text text-muted">Votre signature actuelle</small>
                        @else
                            <div  class="bg-secondary" style="min-height: 200px;width: auto;" alt="votre Signature Actuelle" title="votre Signature Actuelle"></div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="custom-file mt-4 mb-5">
                          <input type="file" class="custom-file-input" name="Nsigna" id="file" accept="image/*" />
                          <label class="custom-file-label" for="file">Choisir une Nouvelle signature</label>
                          <small id="fileHelpId" class="form-text text-muted">une image large de plus de 300*100px, d'une arrière plan transparent(.png).</small>
                            @if($errors->has('Nsigna'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    {{ $errors->first('Nsigna') }}
                                </div>
                            @endif
                        </div>
                        <div class="d-block form-group mt-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="DelCurrent"  value="YesPlease" />
                                Supprimer la signature courante
                              </label>
                            </div>
                        </div>

                    </div>
                </div>
            <hr>


            <div class="form-row">
                <div class="col-md-10 mb-3">
                    <input type="password" class="form-control ml-auto mr-3 " name="Oldpwd"  placeholder="Entrez votre mot de passe mot de passe" />
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
