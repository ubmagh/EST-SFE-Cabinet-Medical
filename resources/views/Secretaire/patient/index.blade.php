@extends('Secretaire.Parts.pageLayout')



@section('title')
Gestion des patients
@endsection




@section('content')


<div class="content-wrapper" style="max-width: 85% !important;">
    <div class="card h-100">


        <div class="card-body w-100 grid-margin  stretch-card LoaderSec" style="height: 480px;">
            <div class="loader-demo-box border-0">
                <div class="dot-opacity-loader">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>


        <div class="card-body d-none ContentSec">

            <fieldset class=" col-md-8 mx-auto col-12 mb-3 p-4 border border-dark mt-3">
                <legend class="text-center d-inline w-auto mx-2"> Ajouter un Patient : </legend>
                <div class="row w-100">
                    <div class="col-md col-12 text-center px-2">
                        <a class="btn btn-success mx-auto text-center text-white " role="button" data-toggle="modal"
                            data-target="#QAddModal" type="button"> <i class="fas fa-clock fa-lg"></i> Création Rapide
                        </a>
                    </div>

                    <div class="col-md col-12 text-center px-2">
                        <a class="btn btn-warning mx-auto text-center text-white " role="button" data-toggle="modal"
                            data-target="#AddModal" type="button"> <i class="fa fa-plus-circle fa-lg"></i> Création
                            Détaillée </a>
                    </div>
                </div>
            </fieldset>


            <div class="row mt-5 mx-auto mb-3 w-100">
                <form method="GET" action="{{ url()->current() }}" class="col-md-8 col-10  mx-auto">
                    <div class="input-group">
                        <input type="text" aria-describedby="button-addon2" class="form-control border-dark" name="q"
                            placeholder="chercher un Patient ..." value="{{ $q? $q:null }}" />
                        <div class="input-group-append">
                            <button class="btn btn-outline-dark" type="submit" id="button-addon2"><i
                                    class="fas fa-search fa-lg"></i></button>
                        </div>
                    </div>
                </form>
            </div>


            <div class="row my-3">
                <div class="col-12 mx-auto px-5 mb-2">
                    <div class="table-responsive px-3 mb-2 mt-5">
                        @if( $q )
                            <div class="row w-100 text-center"> 
                                <h4 class="h4 mx-auto"> Résultats de recherche de : ` {{ $q }} `  <a href="{{url('patient')}}"> <i class="fas fa-times text-danger"></i> </a> </h4>
                            </div>
                        @endif
                        <table id="order-listing" class="table ">

                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Identifiant Civile</th>
                                    <th class="text-center">Nom</th>
                                    <th class="text-center">Prénom</th>
                                    <th class="text-center">Date de naissance</th>
                                    <th class="text-center">Téléphone</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($patients as $patient)
                                    <tr>
                                        <td class="text-center">{{ ($counter-1)*10 + $patient['num'] }}</td>
                                        <td class="text-center">{{ $patient['id_civile'] }}</td>
                                        <td class="text-center">{{ $patient['Nom'] }}</td>
                                        <td class="text-center">{{ $patient['Prenom'] }}</td>
                                        <td class="text-center">{{ $patient['DateNaissance'] }}
                                        </td>
                                        <td class="text-center">{{ $patient['Tel'] }}</td>
                                        <td class="px-0 text-center">

                                            <!-- -------------------- Show BUTTON   ------------------------- -->
                                            <button
                                                data-Nationnalite="{{ $patient['Nationnalite'] }}"
                                                data-Email="{{ $patient['Email'] }}"
                                                data-Sexe="{{ $patient['Sexe'] }}"
                                                data-adresse="{{ $patient['adresse'] }}"
                                                data-Ville="{{ $patient['Ville'] }}"
                                                data-Occupation="{{ $patient['Occupation'] }}"
                                                data-typeMutuel="{{ $patient['typeMutuel'] }}"
                                                data-ref_mutuel="{{ $patient['ref_mutuel'] }}"
                                                data-toggle="modal" data-target="#ShowModal" role="button" type="button"
                                                class="btn btn-outline-info py-2 px-4" title="plus d'infos">
                                                 <i class="fas fa-info fa-lg "></i></button>

                                            <!-- -------------------- EDIT BUTTON   ------------------------- -->
                                            <button data-id="{{ $patient['id'] }}"
                                                data-Nom="{{ $patient['Nom'] }}"
                                                data-Prenom="{{ $patient['Prenom'] }}"
                                                data-id_civile="{{ $patient['id_civile'] }}"
                                                data-DateNaissance="{{ $patient['DateNaissance'] }}"
                                                data-Sexe="{{ $patient['Sexe'] }}"
                                                data-Tel="{{ $patient['Tel'] }}"
                                                data-Nationnalite="{{ $patient['Nationnalite'] }}"
                                                data-Email="{{ $patient['Email'] }}"
                                                data-adresse="{{ $patient['adresse'] }}"
                                                data-Ville="{{ $patient['Ville'] }}"
                                                data-Occupation="{{ $patient['Occupation'] }}"
                                                data-typeMutuel="{{ $patient['typeMutuel'] }}"
                                                data-ref_mutuel="{{ $patient['ref_mutuel'] }}"
                                                data-toggle="modal" data-target="#modal_edit" role="button"
                                                type="button" class="btn btn-outline-success py-2 " title="Modifier">
                                                <i class="far fa-edit fa-lg"></i> </button>

                                            <!-- -------------------- DELETE BUTTON   ------------------------- -->
                                            <button data-id_delete="{{ $patient['id'] }}"
                                                data-toggle="modal" data-target="#ModalDelete" role="button"
                                                type="button" class="btn btn-outline-danger py-2 " title="Supprimer">
                                                <i class="fas fa-trash-alt fa-lg"></i> </button>

                                            <a href="{{ url( 'PatientF', $patient['id']) }}"
                                                target="_blank" class="btn btn-outline-facebook py-2 " title="Fiche Patient">
                                                <i class=" fas fa-external-link-alt fa-lg"></i>
                                            </a>
                                            <a href="{{ url( 'Paiement', $patient['id']) }}"
                                                target="_blank" class="btn btn-outline-success py-2 " title="Paiements">
                                                <i class="fas fa-file-invoice-dollar fa-lg"></i>
                                            </a>
                                            @if( ! $patient->Check_Complet() )
                                                <button type="button" class="btn btn-outline-warning py-2 dataLeak" data-nom="{{$patient['Nom']}} {{$patient['Prenom']}}" data-iden="{{$patient['id_civile']}}" > <i class="fas fa-exclamation fa-lg"></i> </button>
                                            @endif
                                    </tr>
                                @endforeach
                            </tbody>


                        </table>
                    </div>
                </div>
                <div class="col-12 mx-auto px-5 mb-2">
                   <div class="w-auto mx-auto text-center d-flex justify-content-center mt-3">
                        {{ $patients->appends(request()->input())->links() }}
                   </div>
                </div>
            </div>

            <div class="row w-100">



                <!-- -------------------- Quick INSERT Modal     ------------------------- -->
                <div class="modal fade left" id="QAddModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog model-notify modal-md modal-right modal-info" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nouveau patient: Création Rapide</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form id="Qaddform" action="####here" method="POST">
                                <div class="modal-body">
                                    @csrf

                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Nom</label>
                                        <input name="Nom" type="text" class="form-control" maxlength="30" autocomplete="off" placeholder="Entrer le nom">
                                        <div class="alert alert-danger w-100 d-none" id="Q_Create_div_nom" role="alert">
                                            <span id="Q_Create_Mess_nom"> </span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Prénom</label>
                                        <input name="Prenom" type="text" class="form-control" maxlength="30" autocomplete="off" placeholder="Entrer le prénom">
                                        <div class="alert alert-danger w-100 d-none" id="Q_Create_div_prenom" role="alert">
                                            <span id="Q_Create_Mess_prenom"> </span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Numéro d'identité</label>
                                        <input name="id_civile" type="text" class="form-control" maxlength="30" autocomplete="off" placeholder="Entrer le numéro d'identité">
                                        <div class="alert alert-danger w-100 d-none" id="Q_Create_div_civi" role="alert">
                                            <span id="Q_Create_Mess_civi"> </span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="Sexe">Sexe</label>
                                        <select name="Sexe" class="form-control">
                                            <option value="homme" selected>homme</option>
                                            <option value="femme">femme</option>
                                        </select>
                                        <div class="alert alert-danger w-100 d-none" id="Q_Create_div_sexe" role="alert">
                                            <span id="Q_Create_Mess_sexe"> </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="Telq">Numéro de Téléphone: </label>
                                        <input name="Tel" type="text" class="form-control" maxlength="14" min="9" autocomplete="off" placeholder="0612345678">
                                        <div class="alert alert-danger w-100 d-none" id="Q_Create_div_Tel" role="alert">
                                            <span id="Q_Create_Mess_Tel"> </span>
                                        </div>
                                    </div>
                                    


                                    <div class="row w-100 mx-auto">
                                        <div class="col text-left">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-times-circle"></i> Annuler</button>
                                        </div>
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-primary ml-auto"><i class="fas fa-save"></i> Enregistrer</button>
                                        </div>
                                    </div>

                                </div>
                            </form>


                            <div id="QmsgSucc" role="alert" style="background: rgb(214,233,198);background: linear-gradient(0deg, rgba(214,233,198,1) 0%, rgba(198,233,229,1) 100%);" class="alert alert-success d-none">
                                <i class="fa fa-check"></i> <strong>Succés!</strong> Le patient est ajouté avec
                                succés ! Veuillez Remplir les autres infos
                            </div>

                            <div id="QmsgDanger" style="background: rgb(235,204,209);background: linear-gradient(0deg, rgba(235,204,209,1) 0%,  rgba(235,204,221,0.927608543417367) 100%);" role="alert" class="alert alert-danger d-none">
                                <i class="fa fa-times"></i>  Le patient n'est pas
                                ajouté ! une Erreur est servenue .
                            </div>

                        </div>
                    </div>
                </div>




                <!-- -------------------- INSERT Modal   ------------------------- -->
                <div class="modal fade left" id="AddModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog model-notify modal-md modal-right modal-info" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nouveau patient: Création Détaillée</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form id="addform" action="####here" method="POST">
                                <div class="modal-body">
                                    {{ csrf_field() }}


                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Nom</label>
                                        <input name="Nom" type="text" class="form-control" maxlength="30" autocomplete="off" placeholder="Entrer le nom">
                                        <div class="alert alert-danger w-100 d-none" id="Create_div_nom" role="alert">
                                            <span id="Create_Mess_nom"> </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Prénom</label>
                                        <input name="Prenom" type="text" class="form-control" maxlength="30" autocomplete="off"
                                            placeholder="Entrer le prénom">
                                        <div class="alert alert-danger w-100 d-none" id="Create_div_prenom" role="alert">
                                            <span id="Create_Mess_prenom"> </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="DateNaissance">Date de naissance</label>
                                        <input name="DateNaissance" type="date" class="form-control">
                                        <div class="alert alert-danger w-100 d-none" id="Create_div_date" role="alert">
                                            <span id="Create_Mess_date"> </span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Numéro d'identité</label>
                                        <input name="id_civile" type="text" class="form-control" maxlength="30" autocomplete="off"
                                            placeholder="Entrer le numéro d'identité">
                                        <div class="alert alert-danger w-100 d-none" id="Create_div_id" role="alert">
                                            <span id="Create_Mess_id"> </span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="Email">Email</label>
                                        <input name="Email" type="email" class="form-control" maxlength="90" autocomplete="off"
                                            placeholder="name@example.com">
                                        <div class="alert alert-danger w-100 d-none" id="Create_div_emai" role="alert">
                                            <span id="Create_Mess_emai"> </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="Tel">Téléphone</label>
                                        <input name="Tel" type="tel" class="form-control" maxlength="14" autocomplete="off"
                                            placeholder="Entrer le numéro de téléphone" />
                                        <div class="alert alert-danger w-100 d-none" id="Create_div_Tel" role="alert">
                                            <span id="Create_Mess_Tel"> </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="Sexe">Sexe</label>
                                        <select name="Sexe" class="form-control">
                                            <option value="homme" selected>homme</option>
                                            <option value="femme">femme</option>
                                        </select>
                                        <div class="alert alert-danger w-100 d-none" id="Create_div_Sexe" role="alert">
                                            <span id="Create_Mess_Sexe"> </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Adresse</label>
                                        <textarea name="adresse"  class="form-control" maxlength="50" row="4"
                                            placeholder="Entrer l'adresse"> </textarea>
                                        <div class="alert alert-danger w-100 d-none" id="Create_div_addr" role="alert">
                                            <span id="Create_Mess_addr"> </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Ville</label>
                                        <input name="Ville" type="text" class="form-control" maxlength="40" 
                                            placeholder="Entrer la ville" />
                                        <div class="alert alert-danger w-100 d-none" id="Create_div_ville" role="alert">
                                            <span id="Create_Mess_ville"> </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Occupation</label>
                                        <input name="Occupation" type="text" class="form-control" maxlength="20" autocomplete="off"
                                            placeholder="Entrer l'occupation" />
                                        <div class="alert alert-danger w-100 d-none" id="Create_div_occ" role="alert">
                                            <span id="Create_Mess_occ"> </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Nationalité</label>
                                        <input name="Nationnalite" type="text" class="form-control" maxlength="60" value="Marocain(e)"
                                            placeholder="Entrer la nationalité">
                                        <div class="alert alert-danger w-100 d-none" id="Create_div_nat" role="alert">
                                            <span id="Create_Mess_nat"> </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="Mutuel">Mutuelle</label>
                                        <select name="typeMutuel" class="form-control">
                                            <option value="" selected>sans</option>
                                            <option value="CNSS">CNSS</option>
                                            <option value="CNOPS">CNOPS</option>
                                            <option value="RAMED">RAMED</option>
                                            <option value="FAR">FAR</option>
                                        </select>
                                        <div class="alert alert-danger w-100 d-none" id="Create_div_met" role="alert">
                                            <span id="Create_Mess_met"> </span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">référence de la mutuelle</label>
                                        <input name="ref_mutuel" type="text" class="form-control" maxlength="255" autocomplete="off"
                                            placeholder="Entrer la référence de la mutuelle" />
                                        <div class="alert alert-danger w-100 d-none" id="Create_div_metref" role="alert">
                                            <span id="Create_Mess_metref"> </span>
                                        </div>
                                    </div>

                                    <div class="row w-100 mx-auto">
                                        <div class="col text-left">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-times-circle"></i> Annuler</button>
                                        </div>
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-primary ml-auto"><i class="fas fa-save"></i> Enregistrer</button>
                                        </div>
                                    </div>
                                </div>
                            </form>


                            <div id="msgSucc" role="alert" style="background: rgb(214,233,198);background: linear-gradient(0deg, rgba(214,233,198,1) 0%, 
    rgba(198,233,229,1) 100%);" class="alert alert-success d-none">
                                <i class="fa fa-check"></i> <strong>Succés!</strong> Le patient est ajouté avec
                                succés !
                            </div>

                            <div id="msgDanger" style="background: rgb(235,204,209);background: linear-gradient(0deg, rgba(235,204,209,1) 0%, 
      rgba(235,204,221,0.927608543417367) 100%);" role="alert" class="alert alert-danger d-none">
                                <i class="fa fa-times"></i> <strong>Danger !</strong> Le patient n'est pas
                                ajouté !
                            </div>

                        </div>
                    </div>
                </div>




                <!-- -------------------- EDIT Modal  ------------------------- -->


                <div class="modal fade left" id="modal_edit" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog model-notify modal-md modal-right modal-info" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form id="editform">
                                <div class="modal-body">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}

                                    <input type="hidden" id="id" name="id_patient">
                                    

                                    <div class="form-group">
                                        <label for="nom">Nom</label>
                                        <input name="Nom" id="nom_edit" type="text" class="form-control" maxlength="30" autocomplete="off"
                                            placeholder="Entrer le nom">
                                        <div class="alert alert-danger w-100 d-none" id="Edit_div_nom" role="alert">
                                            <span id="Edit_Mess_nom"> </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="prenom">Prénom</label>
                                        <input name="Prenom" id="prenom_edit" type="text" class="form-control" maxlength="30" autocomplete="off"
                                            placeholder="Entrer le prénom">
                                        <div class="alert alert-danger w-100 d-none" id="Edit_div_prenom" role="alert">
                                            <span id="Edit_Mess_prenom"> </span>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label for="datenaissance">Date de naissance</label>
                                        <input name="DateNaissance" id="datenaissance_edit" type="date"
                                            class="form-control">
                                        <div class="alert alert-danger w-100 d-none" id="Edit_div_date" role="alert">
                                            <span id="Edit_Mess_date"> </span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="id_civile">Numéro d'identité</label>
                                        <input name="id_civile" id="id_civile_edit" type="text" class="form-control" maxlength="30" autocomplete="off"
                                            placeholder="Entrer le numéro d'identité">
                                        <div class="alert alert-danger w-100 d-none" id="Edit_div_id" role="alert">
                                            <span id="Edit_Mess_id"> </span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input name="Email" id="email_edit" type="email" class="form-control" maxlength="90" autocomplete="off"
                                            placeholder="name@example.com" />
                                        <div class="alert alert-danger w-100 d-none" id="Edit_div_emai" role="alert">
                                            <span id="Edit_Mess_emai"> </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="tel">Téléphone</label>
                                        <input name="Tel" id="tel_edit" type="tel" class="form-control" maxlength="14" autocomplete="off"
                                            placeholder="Entrer le numéro de téléphone" />
                                        <div class="alert alert-danger w-100 d-none" id="Edit_div_Tel" role="alert">
                                            <span id="Edit_Mess_Tel"> </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="sexe">Sexe</label>
                                        <select name="Sexe" id="sexe_edit" class="form-control">
                                            <option value="homme">homme</option>
                                            <option value="femme">femme</option>
                                        <div class="alert alert-danger w-100 d-none" id="Edit_div_Sexe" role="alert">
                                            <span id="Edit_Mess_Sexe"> </span>
                                        </div>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="adresse">Adresse</label>
                                        <textarea name="adresse" maxlength="50" row="4" id="adresse_edit" type="text" class="form-control"
                                            placeholder="Entrer l'adresse"> </textarea>
                                        <div class="alert alert-danger w-100 d-none" id="Edit_div_addr" role="alert">
                                            <span id="Edit_Mess_addr"> </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="ville">Ville</label>
                                        <input name="Ville" id="ville_edit" type="text" class="form-control" maxlength="40" 
                                            placeholder="Entrer la ville">
                                        <div class="alert alert-danger w-100 d-none" id="Edit_div_ville" role="alert">
                                            <span id="Edit_Mess_ville"> </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="occupation">Occupation</label>
                                        <input name="Occupation" id="occupation_edit" type="text" class="form-control" maxlength="20" autocomplete="off"
                                            placeholder="Entrer l'occupation">
                                        <div class="alert alert-danger w-100 d-none" id="Edit_div_occ" role="alert">
                                            <span id="Edit_Mess_occ"> </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="nationnalite">Nationalité</label>
                                        <input name="Nationnalite" id="nationnalite_edit" type="text" maxlength="60" value="Marocain(e)"
                                            class="form-control" placeholder="Entrer la nationalité" />
                                        <div class="alert alert-danger w-100 d-none" id="Edit_div_nat" role="alert">
                                            <span id="Edit_Mess_nat"> </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="typemutuel">Mutuelle</label>
                                        <select name="typeMutuel" id="typemutuel_edit"  class="form-control">
                                            <option value="" selected>sans</option>
                                            <option value="CNSS">CNSS</option>
                                            <option value="CNOPS">CNOPS</option>
                                            <option value="RAMED">RAMED</option>
                                            <option value="FAR">FAR</option>
                                        </select>
                                        <div class="alert alert-danger w-100 d-none" id="Edit_div_met" role="alert">
                                            <span id="Edit_Mess_met"> </span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="ref_mutuel">référence de la mutuelle</label>
                                        <input name="ref_mutuel" id="refmutuel_edit" type="text" class="form-control" maxlength="255" autocomplete="off"
                                            placeholder="Entrer la référence de la mutuelle">
                                        <div class="alert alert-danger w-100 d-none" id="Edit_div_metref" role="alert">
                                            <span id="Edit_Mess_metref"> </span>
                                        </div>
                                    </div>



                                    
                                    

                                    <div class="row w-100 mx-auto">
                                        <div class="col text-left">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                            class="far fa-times-circle"></i> Annuler</button>
                                        </div>
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-primary ml-auto"><i class="fas fa-edit"></i>
                                             Modifier</button>
                                        </div>
                                    </div>

                                </div>
                            </form>

                            <div id="msgSucc-edit" role="alert" style="background: rgb(214,233,198);background: linear-gradient(0deg, rgba(214,233,198,1) 0%, 
    rgba(198,233,229,1) 100%);" class="alert alert-success d-none">
                                <i class="fa fa-check"></i> <strong>Succés!</strong> Le patient est modifié avec
                                succés !
                            </div>

                            <div id="msgDanger-edit" style="background: rgb(235,204,209);background: linear-gradient(0deg, rgba(235,204,209,1) 0%, 
      rgba(235,204,221,0.927608543417367) 100%);" role="alert" class="alert alert-danger d-none">
                                <i class="fa fa-times"></i> Le patient n'a pas été
                                modifié !
                            </div>


                        </div>
                    </div>
                </div>

                <!-- -------------------- DELETE Modal  ------------------------- -->

                <div class="modal fade left" id="ModalDelete" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog model-notify modal-md modal-right modal-info" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Suppression du patient</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="deleteform">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}



                                    <input type="hidden" id="id_delete" name="id_delete">
                                    <p class="text-center" style="font-size : 20px">Voulez-vous vraiment
                                        supprimer
                                        ce patient ?</p><br>



                                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                                        style="margin-left : 12%"><i class="far fa-times-circle"></i>
                                        Non/Annuler</button>
                                    <button type="submit" class="btn btn-danger" style="margin-left : 12%"><i
                                            class="fas fa-trash-alt"></i> Oui/Supprimer</button>
                            </div>
                            </form>

                            <div id="msgSucc-delete" role="alert" style="background: rgb(214,233,198);background: linear-gradient(0deg, rgba(214,233,198,1) 0%, 
    rgba(198,233,229,1) 100%);" class="alert alert-success d-none">
                                <i class="fa fa-check"></i> <strong>Succés!</strong> Le patient est supprimé
                                avec
                                succés !
                            </div>

                            <div id="msgDanger-delete" style="background: rgb(235,204,209);background: linear-gradient(0deg, rgba(235,204,209,1) 0%, 
      rgba(235,204,221,0.927608543417367) 100%);" role="alert" class="alert alert-danger d-none">
                                <i class="fa fa-times"></i> <strong>Danger !</strong> Le patient n'est pas été
                                supprimé !
                            </div>

                        </div>
                    </div>
                </div>


                <!-- -------------------- SHOW Modal  ------------------------- -->


                <div class="modal fade left" id="ShowModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog model-notify modal-md modal-right modal-info" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Plus d'informations</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form >
                                <div class="modal-body">


                                    <div class="form-group">
                                        <label for="Email">Email</label>
                                        <input name="Email" id="email_show" type="email" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="Sexe">Sexe</label>
                                        <input name="Sexe" id="sexe_show" type="text" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="adresse">Adresse</label>
                                        <input name="adresse" id="adresse_show" type="text" class="form-control"
                                            readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="ville">Ville</label>
                                        <input name="Ville" id="ville_show" type="text" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="occupation">Occupation</label>
                                        <input name="Occupation" id="occupation_show" type="text" class="form-control"
                                            readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="nationnalite">Nationalité</label>
                                        <input name="Nationnalite" id="nationnalite_show" type="text"
                                            class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="nationnalite">Mutuelle</label>
                                        <input name="Nationnalite" id="typemutuel_show" type="text" class="form-control"
                                            readonly>
                                    </div>


                                    <div class="form-group">
                                        <label for="ref_mutuel">Référence de la mutuelle</label>
                                        <input name="ref_mutuel" id="refmutuel_show" type="text" class="form-control"
                                            readonly>
                                    </div>


                                    <div class="row w-100 mx-auto">
                                        <div class="col-md col-12 text-center">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                <i class="far fa-times-circle"></i> Fermer</button>
                                        </div>
                                    </div>

                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')


<script>

    // Modal alerts hidding + inputs Clearing
    $('.modal').on('hidden.bs.modal',function(event){
        $(this).find('.alert').addClass('d-none');
        $(this).find('.form-control').val('');
    });


    //*******************************Edit Form*****************************************


    $('#modal_edit').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        const Nom = button.data('nom');
        var id_civile = button.data('id_civile');
        var Prenom = button.data('prenom');
        var Tel = button.data('tel');
        var Email = button.data('email');
        var Sexe = button.data('sexe');
        var adresse = button.data('adresse');
        var Ville = button.data('ville');
        var DateNaissance = button.data('datenaissance');
        var Occupation = button.data('occupation');
        var Nationnalite = button.data('nationnalite');
        var Mutuel = button.data('typemutuel');
        var ref_mutuel = button.data('ref_mutuel');
        var id = button.data('id');

        let modal = $(this);
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-title').text('Modifier les informations du patient');
        modal.find('.modal-body #nom_edit').val(Nom);
        modal.find('.modal-body #prenom_edit').val(Prenom);
        modal.find('.modal-body #id_civile_edit').val(id_civile);
        modal.find('.modal-body #tel_edit').val(Tel);
        modal.find('.modal-body #email_edit').val(Email);
        modal.find('.modal-body #sexe_edit').val(Sexe);
        modal.find('.modal-body #adresse_edit').val(adresse);
        modal.find('.modal-body #ville_edit').val(Ville);
        modal.find('.modal-body #datenaissance_edit').val(DateNaissance);
        modal.find('.modal-body #occupation_edit').val(Occupation);
        modal.find('.modal-body #nationnalite_edit').val(Nationnalite);
        modal.find('.modal-body #typemutuel_edit').val(Mutuel);
        modal.find('.modal-body #refmutuel_edit').val(ref_mutuel);


    });

    document.getElementById('editform').onsubmit =
        function (e) {
            e.preventDefault();
            var id = $('#id').val();
            $.ajax({
                type: "PUT",
                url: "/patient/" + id,
                data: $('#editform').serialize(),
                success: function (response) {
                    if(response.status=="good"){
                        $("#msgSucc-edit").removeClass('d-none').addClass('d-block');
                        $("#editform").addClass('d-none');
                        location.reload();
                    } else {
                        $("#msgDanger-edit").removeClass('d-none').addClass('d-block');
                        $("#editform").addClass('d-none');
                    }
                },
                error: function (error) {
                    const errors = error.responseJSON.errors;
                    if (error.responseJSON.errors) {
                        if (errors.Nom) {
                            $('#Edit_Mess_nom').html(error.responseJSON.errors.Nom);
                            $('#Edit_div_nom').removeClass('d-none').addClass('show');
                        }
                        if (errors.Prenom) {
                            $('#Edit_Mess_prenom').html(error.responseJSON.errors.Prenom);
                            $('#Edit_div_prenom').removeClass('d-none').addClass('show');
                        }
                        if (errors.DateNaissance) {
                            $('#Edit_Mess_date').html(error.responseJSON.errors.DateNaissance);
                            $('#Edit_div_date').removeClass('d-none').addClass('show');
                        }
                        if (errors.id_civile) {
                            $('#Edit_Mess_id').html(error.responseJSON.errors.id_civile);
                            $('#Edit_div_id').removeClass('d-none').addClass('show');
                        }
                        if (errors.Email) {
                            $('#Edit_Mess_emai').html(error.responseJSON.errors.Email);
                            $('#Edit_div_emai').removeClass('d-none').addClass('show');
                        }
                        if (errors.Tel) {
                            $('#Edit_Mess_Tel').html(error.responseJSON.errors.Tel);
                            $('#Edit_div_Tel').removeClass('d-none').addClass('show');
                        }
                        if (errors.Sexe) {
                            $('#Edit_Mess_Sexe').html(error.responseJSON.errors.Sexe);
                            $('#Edit_div_Sexe').removeClass('d-none').addClass('show');
                        }
                        if (errors.adresse) {
                            $('#Edit_Mess_addr').html(error.responseJSON.errors.adresse);
                            $('#Edit_div_addr').removeClass('d-none').addClass('show');
                        }
                        if (errors.Ville) {
                            $('#Edit_Mess_ville').html(error.responseJSON.errors.Ville);
                            $('#Edit_div_ville').removeClass('d-none').addClass('show');
                        }
                        if (errors.Occupation) {
                            $('#Edit_Mess_occ').html(error.responseJSON.errors.Occupation);
                            $('#Edit_div_occ').removeClass('d-none').addClass('show');
                        }
                        if (errors.Nationnalite) {
                            $('#Edit_Mess_nat').html(error.responseJSON.errors.Nationnalite);
                            $('#Edit_div_nat').removeClass('d-none').addClass('show');
                        }
                        if (errors.typeMutuel) {
                            $('#Edit_Mess_met').html(error.responseJSON.errors.typeMutuel);
                            $('#Edit_div_met').removeClass('d-none').addClass('show');
                        }
                        if (errors.ref_mutuel) {
                            $('#Edit_Mess_metref').html(error.responseJSON.errors.ref_mutuel);
                            $('#Edit_div_metref').removeClass('d-none').addClass('show');
                        }
                      
                    } else {
                        $("#msgDanger-edit").removeClass('d-none').addClass('d-block');
                        $("#editform").addClass('d-none');
                    }
                }
            });
        };

    //*******************************Quick Add Form*****************************************


    document.getElementById('Qaddform').onsubmit =
        function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "/patient",
                data: $('#Qaddform').serialize(),
                success: function (response) {
                    if(response.status=="good"){
                        $("#QmsgSucc").removeClass('d-none').addClass('d-block');
                        $("#Qaddform").addClass('d-none');
                        location.reload();
                    } else {
                        $("#QmsgDanger").removeClass('d-none').addClass('d-block');
                        $("#Qaddform").addClass('d-none');
                    }
                },
                error: function (error) {
                    const errors = error.responseJSON.errors;
                    if (error.responseJSON.errors) {
                        if (errors.Nom) {
                            $('#Q_Create_Mess_nom').html(error.responseJSON.errors.Nom);
                            $('#Q_Create_div_nom').removeClass('d-none').addClass('show');
                        }
                        if (errors.Prenom) {
                            $('#Q_Create_Mess_prenom').html(error.responseJSON.errors.Prenom);
                            $('#Q_Create_div_prenom').removeClass('d-none').addClass('show');
                        }
                        if (errors.id_civile) {
                            $('#Q_Create_Mess_civi').html(error.responseJSON.errors.id_civile);
                            $('#Q_Create_div_civi').removeClass('d-none').addClass('show');
                        }
                        if (errors.Sexe) {
                            $('#Q_Create_Mess_sexe').html(error.responseJSON.errors.Sexe);
                            $('#Q_Create_div_sexe').removeClass('d-none').addClass('show');
                        }
                        if (errors.Tel) {
                            $('#Q_Create_Mess_Tel').html(error.responseJSON.errors.Tel);
                            $('#Q_Create_div_Tel').removeClass('d-none').addClass('show');
                        }
                    } else {
                        $("#QmsgDanger").removeClass('d-none').addClass('d-block');
                        $("#Qaddform").addClass('d-none');
                    }
                }

            });
        };




    //*******************************Add Form****************************************
    document.getElementById('addform').onsubmit =
        function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "/patient",
                data: $('#addform').serialize(),
                success: function (response) {
                     if(response.status=="good"){
                        $("#msgSucc").removeClass('d-none').addClass('d-block');
                        $("#addform").addClass('d-none');
                        location.reload();
                    } else {
                        $("#msgDanger").removeClass('d-none').addClass('d-block');
                        $("#addform").addClass('d-none');
                    }
                },
                error: function (error) {
                    const errors = error.responseJSON.errors;
                    if (error.responseJSON.errors) {
                        if (errors.Nom) {
                            $('#Create_Mess_nom').html(error.responseJSON.errors.Nom);
                            $('#Create_div_nom').removeClass('d-none').addClass('show');
                        }
                        if (errors.Prenom) {
                            $('#Create_Mess_prenom').html(error.responseJSON.errors.Prenom);
                            $('#Create_div_prenom').removeClass('d-none').addClass('show');
                        }
                        if (errors.DateNaissance) {
                            $('#Create_Mess_date').html(error.responseJSON.errors.DateNaissance);
                            $('#Create_div_date').removeClass('d-none').addClass('show');
                        }
                        if (errors.id_civile) {
                            $('#Create_Mess_id').html(error.responseJSON.errors.id_civile);
                            $('#Create_div_id').removeClass('d-none').addClass('show');
                        }
                        if (errors.Email) {
                            $('#Create_Mess_emai').html(error.responseJSON.errors.Email);
                            $('#Create_div_emai').removeClass('d-none').addClass('show');
                        }
                        if (errors.Tel) {
                            $('#Create_Mess_Tel').html(error.responseJSON.errors.Tel);
                            $('#Create_div_Tel').removeClass('d-none').addClass('show');
                        }
                        if (errors.Sexe) {
                            $('#Create_Mess_Sexe').html(error.responseJSON.errors.Sexe);
                            $('#Create_div_Sexe').removeClass('d-none').addClass('show');
                        }
                        if (errors.adresse) {
                            $('#Create_Mess_addr').html(error.responseJSON.errors.adresse);
                            $('#Create_div_addr').removeClass('d-none').addClass('show');
                        }
                        if (errors.Ville) {
                            $('#Create_Mess_ville').html(error.responseJSON.errors.Ville);
                            $('#Create_div_ville').removeClass('d-none').addClass('show');
                        }
                        if (errors.Occupation) {
                            $('#Create_Mess_occ').html(error.responseJSON.errors.Occupation);
                            $('#Create_div_occ').removeClass('d-none').addClass('show');
                        }
                        if (errors.Nationnalite) {
                            $('#Create_Mess_nat').html(error.responseJSON.errors.Nationnalite);
                            $('#Create_div_nat').removeClass('d-none').addClass('show');
                        }
                        if (errors.typeMutuel) {
                            $('#Create_Mess_met').html(error.responseJSON.errors.typeMutuel);
                            $('#Create_div_met').removeClass('d-none').addClass('show');
                        }
                        if (errors.ref_mutuel) {
                            $('#Create_Mess_metref').html(error.responseJSON.errors.ref_mutuel);
                            $('#Create_div_metref').removeClass('d-none').addClass('show');
                        }
                    } else {
                        $("#msgDanger").removeClass('d-none').addClass('d-block');
                        $("#addform").addClass('d-none');
                    }
                }
            });
        };

    //*******************************Delete Form*****************************************

    $('#ModalDelete').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        const id = button.data('id_delete');
        let modal = $(this);
        $('#id_delete').val("" + id);
    });


    document.getElementById('deleteform').onsubmit =
        function (e) {
            e.preventDefault();
            var Deletedid = $('#id_delete').val();
            $.ajax({
                type: "DELETE",
                url: "/patient/" + Deletedid,
                data: $('#deleteform').serialize(),
                success: function (response) {
                    $("#msgSucc-delete").removeClass('d-none').addClass('d-block');
                    $("#deleteform").addClass('d-none');
                    location.reload();
                },

                error: function (error) {
                    console.log(error)
                    $("#msgDanger-delete").removeClass('d-none').addClass('d-block');
                    $("#deleteform").addClass('d-none');
                    location.reload();
                }

            });
        };


    //*******************************SHOW Form*****************************************


    $('#ShowModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        var Email = button.data('email');
        var Sexe = button.data('sexe');
        var adresse = button.data('adresse');
        var Ville = button.data('ville');
        var Occupation = button.data('occupation');
        var Nationnalite = button.data('nationnalite');
        var Mutuel = button.data('typemutuel');
        var ref_mutuel = button.data('ref_mutuel');
        var id = button.data('id');

        let modal = $(this);
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #email_show').val(Email);
        modal.find('.modal-body #sexe_show').val(Sexe);
        modal.find('.modal-body #adresse_show').val(adresse);
        modal.find('.modal-body #ville_show').val(Ville);
        modal.find('.modal-body #occupation_show').val(Occupation);
        modal.find('.modal-body #nationnalite_show').val(Nationnalite);
        modal.find('.modal-body #typemutuel_show').val(Mutuel);
        modal.find('.modal-body #refmutuel_show').val(ref_mutuel);


    });



    const dataTable_Place_Holder = "Patient";
    const OnMyPaginationNSearch = false;
    const dataTable_Search_label = "Chercher : ";
    const dataTable_nbr_lines_language = "Afficher _MENU_ lignes";
    const dataTable_Order_string = "asc"; /// "desc" for descendent order
    const dataTable_can_sort_columns__ = [{
        "orderable": false,
        "targets": [6]
    }];

    $('.dataLeak').click(function(e){
        let t= e.target;
    Swal.fire({
                position: 'center',
                icon:  'warning',
                text: 'Le patient : '+t.dataset.nom+' avec l\'identifiant: '+t.dataset.iden+' a des informations incomplets !',
                showConfirmation: true,
            });
    });

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.LoaderSec').forEach(node => {
            node.classList.add('d-none');
        });
        document.querySelectorAll('.ContentSec').forEach(node => {
            node.classList.remove('d-none');
        });
    });

</script>




<script src=" {{ asset('js/data-table.js') }}"></script>


@endsection
