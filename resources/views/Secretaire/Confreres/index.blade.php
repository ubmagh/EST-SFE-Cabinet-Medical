@extends('Secretaire.Parts.pageLayout')



@section('title')
Liste des confrères
@endsection



@section('content')


<div class="content-wrapper">
    <div class="card h-100">
        
        <div class="card-body w-100 grid-margin  stretch-card LoaderSec" style="height: 480px;" >
                        <div class="loader-demo-box border-0">
                            <div class="dot-opacity-loader">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>

        <div class="card-body d-none ContentSec">



            

            <div class="row mt-n3">
                <div class="col-12">
                    <h4 class=" display-4  text-center mt-3 mb-4"> Confrères : </h4>

                    <div class="row w-100 mb-4 mt-5 mx-auto">

                        <div class="col-md col-12 text-left">
                             <a name="" id="" class="btn btn-primary mx-auto text-center text-white " role="button"
                            data-toggle="modal" data-target="#AddModal" type="button"> <i class="fa fa-plus-circle fa-lg"
                                aria-hidden="true"></i> Ajouter un confrère </a>
                        </div>
                        <div class="col-md col-12 text-left">
                            <form method="GET" action="{{ url()->current() }}" class="col-12  ml-auto">
                                <div class="input-group">
                                    <input type="text" aria-describedby="button-addon2" class="form-control border-dark" name="q"
                                        placeholder="chercher un Confrère ..." value="{{ $q? $q:null }}" />
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-dark" type="submit" id="button-addon2"><i
                                                class="fas fa-search fa-lg"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if( $q )
                        <div class="row w-100 text-center"> 
                            <h4 class="h4 mx-auto"> Résultats de recherche de : ` {{ $q }} `  <a href="{{url('Confreres')}}"> <i class="fas fa-times text-danger"></i> </a> </h4>
                        </div>
                    @endif
                    <div class="table-responsive">  
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nom</th>
                                    <th class="text-center">Téléphone</th>
                                    <th class="text-center">Spécialité</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($confrere as $confreres)
                                    <tr>

                                        <td class="text-center">{{ ($counter-1)*10+ $confreres['num'] }}</td>
                                        <td class="text-center">{{ $confreres->Nom }}</td>
                                        <td class="text-center">{{ $confreres->Tel }}</td>
                                        <td class="text-center">{{ $confreres->Specialite }}</td>
                                        <td class="px-0 text-center">


                                            <!-- -------------------- Show BUTTON   ------------------------- -->
                                            <button data-id="{{ $confreres->id }}" data-Nom="{{ $confreres->Nom }}"
                                                data-Tel="{{ $confreres->Tel }}" data-Fax="{{ $confreres->Fax }}"
                                                data-Email="{{ $confreres->Email }}"
                                                data-adresse="{{ $confreres->adresse }}"
                                                data-Ville="{{ $confreres->Ville }}"
                                                data-Specialite="{{ $confreres->Specialite }}" data-toggle="modal"
                                                data-target="#ShowModal" role="button" type="button"
                                                class="btn btn-outline-info py-2 ">
                                                <i class="fas fa-plus"></i> Plus de détails</button>

                                            <!-- -------------------- EDIT BUTTON   ------------------------- -->
                                            <button data-id="{{ $confreres->id }}" data-Nom="{{ $confreres->Nom }}"
                                                data-Tel="{{ $confreres->Tel }}" data-Fax="{{ $confreres->Fax }}"
                                                data-Email="{{ $confreres->Email }}"
                                                data-adresse="{{ $confreres->adresse }}"
                                                data-Ville="{{ $confreres->Ville }}"
                                                data-Specialite="{{ $confreres->Specialite }}" data-toggle="modal"
                                                data-target="#modal_edit" role="button" type="button"
                                                class="btn btn-outline-success py-2 ">
                                                <i class="far fa-edit"></i> Modifier</button>

                                            <!-- -------------------- DELETE BUTTON   ------------------------- -->
                                            <button data-id_delete="{{ $confreres['id'] }}"
                                                data-toggle="modal" data-target="#ModalDelete" role="button"
                                                type="button" class="btn btn-outline-danger py-2 ">
                                                <i class="fas fa-trash-alt"></i> Supprimer</button>
                                        </td>





                                    </tr>
                                @endforeach
                            </tbody>


                        </table>
                    </div>
                    <div class="col-12 mx-auto px-5 mb-2">
                        <div class="w-auto mx-auto text-center d-flex justify-content-center mt-3">
                                {{ $confrere->appends(request()->input())->links() }}
                        </div>
                    </div>

                    <!-- -------------------- INSERT Modal   ------------------------- -->


                        <div class="modal fade left" id="AddModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog model-notify modal-md modal-right modal-info" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nouveau confrère</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form id="addform" action="#here" method="POST">
                                        <div class="modal-body">
                                            {{ csrf_field() }}


                                            <div class="form-group mt-2">
                                                <label for="exampleFormControlInput1">Nom</label>
                                                <input name="Nom" type="text" class="form-control" maxlength="60"
                                                    placeholder="Entrer le nom">
                                                <div class="alert alert-danger  alert-dismissible fade show d-none" id="CM_Nom" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span id="CM_Nom_MSG"> </span>
                                                </div>
                                            </div>
                                            


                                            <div class="form-group">
                                                <label for="Tel">Téléphone</label>
                                                <input name="Tel" type="tel" class="form-control" maxlength="14"
                                                    placeholder="Entrer le numéro de téléphone" />
                                                <div class="alert alert-danger alert-dismissible fade show d-none" id="CM_Tel" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span id="CM_Tel_MSG"> </span>
                                                </div>
                                            </div>
                                             


                                            <div class="form-group">
                                                <label for="Fax">Fax</label>
                                                <input name="Fax" type="tel" class="form-control" maxlength="14"
                                                    placeholder="Entrer le numéro de fax" />
                                                <div class="alert alert-danger alert-dismissible fade show d-none" id="CM_Fax" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span id="CM_Fax_MSG"> </span>
                                                </div>
                                            </div>
                                            




                                            <div class="form-group">
                                                <label for="Email">Email</label>
                                                <input name="Email" type="email" class="form-control"
                                                    placeholder="name@example.com">
                                                <div class="alert alert-danger alert-dismissible fade show d-none" id="CM_Ema" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span id="CM_Ema_MSG"> </span>
                                                </div>
                                            </div>
                                            




                                            <div class="form-group">
                                                <label for="adresse">Adresse</label>
                                                <input name="adresse" type="text" class="form-control" maxlength="50"
                                                    placeholder="Entrer l'adresse">
                                                <div class="alert alert-danger alert-dismissible fade show d-none" id="CM_Addr" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span id="CM_Addr_MSG"> </span>
                                                </div>
                                            </div>
                                                                                       

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Ville</label>
                                                <input name="Ville" type="text" class="form-control" maxlength="40"
                                                    placeholder="Entrer la ville">
                                                <div class="alert alert-danger  alert-dismissible fade show d-none" id="CM_Ville" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span id="CM_Ville_MSG"> </span>
                                                </div>
                                            </div>
                                            



                                            <div class="form-group">
                                                <label for="Specialite">Spécialité</label>
                                                <input name="Specialite" type="text" maxlength="50" class="form-control"
                                                    placeholder="Entrer la Specialité">
                                                <div class="alert alert-danger  alert-dismissible fade show d-none" id="CM_Spec" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span id="CM_Spec_MSG"> </span>
                                                </div> 
                                            </div>
                                           
                                            
                                            <div class="w-100 row mx-auto">
                                                <div class="col-md col-12 text-left">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                                        class="far fa-times-circle"></i> Annuler</button>
                                                </div>
                                                <div class="col-md col-12 text-right">
                                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                                    Enregistrer</button>
                                                </div>
                                            </div>

                                            
                                            
                                        </div>
                                    </form>


                                    <div id="msgSucc" role="alert" style="background: rgb(214,233,198);background: linear-gradient(0deg, rgba(214,233,198,1) 0%, 
    rgba(198,233,229,1) 100%);" class="alert alert-success d-none">
                                        <i class="fa fa-check"></i> <strong>Succés!</strong> confrère ajouté avec
                                        succés !
                                    </div>

                                    <div id="msgDanger" style="background: rgb(235,204,209);background: linear-gradient(0deg, rgba(235,204,209,1) 0%, 
      rgba(235,204,221,0.927608543417367) 100%);" role="alert" class="alert alert-danger d-none">
                                        <i class="fa fa-times"></i> <strong>Une Erreur servenue  !</strong> Le confrère n'est pas
                                        ajouté !

                                        <div id="err_msg">  </div>
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

                                            <input type="hidden" id="id" name="id_confrere">



                                            <div class="form-group mt-n4">
                                                <label for="Nom">Nom</label>
                                                <input id="nom" name="Nom" type="text" class="form-control"
                                                    placeholder="Entrer le nom">
                                                <div class="alert alert-danger alert-dismissible fade show d-none" id="EM_Nom" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span id="EM_Nom_MSG"> </span>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="Tel">Téléphone</label>
                                                <input id="tel" name="Tel" type="tel" class="form-control"
                                                    placeholder="Entrer le numéro de téléphone">
                                                <div class="alert alert-danger alert-dismissible fade show d-none" id="EM_Tel" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span id="EM_Tel_MSG"> </span>
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <label for="Fax">Fax</label>
                                                <input id="fax" name="Fax" type="tel" class="form-control"
                                                    placeholder="Entrer le numéro de fax">
                                                <div class="alert alert-danger alert-dismissible fade show d-none" id="EM_Fax" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span id="EM_Fax_MSG"> </span>
                                                </div>
                                            </div>





                                            <div class="form-group">
                                                <label for="Email">Email</label>
                                                <input id="email" name="Email" type="email" class="form-control"
                                                    placeholder="name@example.com">
                                                <div class="alert alert-danger alert-dismissible fade show d-none" id="EM_Ema" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span id="EM_Ema_MSG"> </span>
                                                </div>
                                            </div>




                                            <div class="form-group">
                                                <label for="adresse">Adresse</label>
                                                <input id="adresse" name="adresse" type="text" class="form-control"
                                                    placeholder="Entrer l'adresse">
                                                <div class="alert alert-danger alert-dismissible fade show d-none" id="EM_Addr" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span id="EM_Addr_MSG"> </span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Ville</label>
                                                <input id="ville" name="Ville" type="text" class="form-control"
                                                    placeholder="Entrer la ville">
                                                <div class="alert alert-danger alert-dismissible fade show d-none" id="EM_Ville" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span id="EM_Ville_MSG"> </span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="Specialite">Spécialité</label>
                                                <input id="specialite" name="Specialite" type="text"
                                                    class="form-control" placeholder="Entrer la Spécialité">
                                                <div class="alert alert-danger alert-dismissible fade show d-none" id="EM_Spec" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span id="EM_Spec_MSG"> </span>
                                                </div>
                                            </div>


                                            <div class="w-100 row mx-auto">
                                                <div class="col-md col-12 text-left">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                                    class="far fa-times-circle"></i> Annuler</button>
                                                </div>
                                                <div class="col-md col-12 text-right">
                                                    <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i>
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
                                        <i class="fa fa-times"></i> <strong>Danger !</strong> Le patient n'est pas été
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
                                        <h5 class="modal-title" id="exampleModalLabel">Suppression du confrère</h5>
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
                                                ce confrère ?</p><br>



                                            <button type="button" class="btn btn-primary" data-dismiss="modal"
                                                style="margin-left : 12%"><i class="far fa-times-circle"></i>
                                                Non/Annuler</button>
                                            <button type="submit" class="btn btn-danger" style="margin-left : 12%"><i
                                                    class="fas fa-trash-alt"></i> Oui/Supprimer</button>
                                    </div>
                                    </form>

                                    <div id="msgSucc-delete" role="alert" style="background: rgb(214,233,198);background: linear-gradient(0deg, rgba(214,233,198,1) 0%, 
    rgba(198,233,229,1) 100%);" class="alert alert-success d-none">
                                        <i class="fa fa-check"></i> <strong>Succés!</strong> Le confrère est supprimé
                                        avec
                                        succés !
                                    </div>

                                    <div id="msgDanger-delete" style="background: rgb(235,204,209);background: linear-gradient(0deg, rgba(235,204,209,1) 0%, 
      rgba(235,204,221,0.927608543417367) 100%);" role="alert" class="alert alert-danger d-none">
                                        <i class="fa fa-times"></i> <strong>Danger !</strong> Le confrère n'est pas été
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

                                        <div class="modal-body">

                                            <input type="hidden" id="id" name="id_confrere">

                                            <div class="form-group">
                                                <label for="Emaila">Email</label>
                                                <input id="Emaila" name="Specialite" type="text" class="form-control" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="Fax">Fax</label>
                                                <input id="fax" name="Fax" type="tel" class="form-control" readonly>
                                            </div>


                                            <div class="form-group">
                                                <label for="adresse">Adresse</label>
                                                <input id="adresse" name="adresse" type="text" class="form-control" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Ville</label>
                                                <input id="ville" name="Ville" type="text" class="form-control"  readonly>
                                            </div>

                                            

                                            <div class="w-100 row mx-auto">
                                                <div class="col-md col-12 text-center">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                    <i class="far fa-times-circle"></i> Fermer</button>
                                                </div>
                                            </div>
                                            

                                        </div>

                                </div>
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
    //*******************************Edit Form*****************************************


    $('#modal_edit').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        var Nom = button.data('nom');
        var Tel = button.data('tel');
        var Email = button.data('email');
        var Fax = button.data('fax');
        var adresse = button.data('adresse');
        var Ville = button.data('ville');
        var Specialite = button.data('specialite');
        var id = button.data('id');

        let modal = $(this);
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #nom').val(Nom);
        modal.find('.modal-body #tel').val(Tel);
        modal.find('.modal-body #email').val(Email);
        modal.find('.modal-body #fax').val(Fax);
        modal.find('.modal-body #adresse').val(adresse);
        modal.find('.modal-body #ville').val(Ville);
        modal.find('.modal-body #specialite').val(Specialite);



    });

    document.getElementById('editform').onsubmit =
        function (e) {
            e.preventDefault();
            var id = $('#id').val();
            $.ajax({
                type: "PUT",
                url: "/Confreres/" + id,
                data: $('#editform').serialize(),
                success: function (response) {

                    if(response.statut=="Good"){
                        $("#msgSucc-edit").removeClass('d-none').addClass('d-block');
                        $("#editform").addClass('d-none');
                        location.reload();
                    }else{
                        $("#msgDanger-edit").removeClass('d-none').addClass('d-block');
                        $("#editform").addClass('d-none');
                    }
                },

                error: function (error) {
                    const errors = error.responseJSON.errors;
                    if(errors){

                        if(errors.id_confrere){
                            $("#msgDanger-edit").removeClass('d-none').addClass('d-block');
                            $("#editform").addClass('d-none');
                            return;
                        }

                        if(errors.Nom){
                            $('#EM_Nom_MSG').html(errors.Nom[0]);
                            $('#EM_Nom').removeClass('d-none');
                        }
                        if(errors.Tel){
                            $('#EM_Tel_MSG').html(errors.Tel[0]);
                            $('#EM_Tel').removeClass('d-none');
                        }
                        if(errors.Fax){
                            $('#EM_Fax_MSG').html(errors.Fax[0]);
                            $('#EM_Fax').removeClass('d-none');
                        }
                        if(errors.Email){
                            $('#EM_Ema_MSG').html(errors.Email[0]);
                            $('#EM_Ema').removeClass('d-none');
                        }
                        if(errors.adresse){
                            $('#EM_Addr_MSG').html(errors.adresse[0]);
                            $('#EM_Addr').removeClass('d-none');
                        }
                        if(errors.Ville){
                            $('#EM_Ville_MSG').html(errors.Ville[0]);
                            $('#EM_Ville').removeClass('d-none');
                        }
                        if(errors.Specialite){
                            $('#EM_Spec_MSG').html(errors.Specialite[0]);
                            $('#EM_Spec').removeClass('d-none');
                        }

                    }else{
                        $("#msgDanger-edit").removeClass('d-none').addClass('d-block');
                        $("#editform").addClass('d-none');
                    }
                }
            });
        };

    //*******************************Add Form*****************************************


    document.getElementById('addform').onsubmit =
        function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "/Confreres",
                data: $('#addform').serialize(),
                success: function (response) {
                    if(response.statut=="Good"){
                        $("#msgSucc").removeClass('d-none').addClass('d-block');
                        $("#addform").addClass('d-none');
                    location.reload();
                    }else{
                        $("#msgDanger").removeClass('d-none').addClass('d-block');
                        $('#err_msg').html(error);
                        $("#addform").addClass('d-none');
                    }
                },
                error: function (error) {
                    const errors = error.responseJSON.errors;
                    if(errors){

                        if(errors.Nom){
                            $('#CM_Nom_MSG').html(errors.Nom[0]);
                            $('#CM_Nom').removeClass('d-none');
                        }
                        if(errors.Tel){
                            $('#CM_Tel_MSG').html(errors.Tel[0]);
                            $('#CM_Tel').removeClass('d-none');
                        }
                        if(errors.Fax){
                            $('#CM_Fax_MSG').html(errors.Fax[0]);
                            $('#CM_Fax').removeClass('d-none');
                        }
                        if(errors.Email){
                            $('#CM_Ema_MSG').html(errors.Email[0]);
                            $('#CM_Ema').removeClass('d-none');
                        }
                        if(errors.adresse){
                            $('#CM_Addr_MSG').html(errors.adresse[0]);
                            $('#CM_Addr').removeClass('d-none');
                        }
                        if(errors.Ville){
                            $('#CM_Ville_MSG').html(errors.Ville[0]);
                            $('#CM_Ville').removeClass('d-none');
                        }
                        if(errors.Specialite){
                            $('#CM_Spec_MSG').html(errors.Specialite[0]);
                            $('#CM_Spec').removeClass('d-none');
                        }

                    }else{                    
                    $("#msgDanger").removeClass('d-none').addClass('d-block');
                    $('#err_msg').html(error);
                    $("#addform").addClass('d-none');
                    }

                }

            });
        };

    //*******************************Delete Form*****************************************

    $('#ModalDelete').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        const id = button.data('id_delete');
        $('#id_delete').val("" + id);
    });


    document.getElementById('deleteform').onsubmit =
        function (e) {
            e.preventDefault();
            var Deletedid = $('#id_delete').val();
            $.ajax({
                type: "DELETE",
                url: "/Confreres/" + Deletedid,
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
        var Fax = button.data('fax');
        var adresse = button.data('adresse');
        var Ville = button.data('ville');
        var Emaila = button.data('email');
        var id = button.data('id');

        let modal = $(this);
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #fax').val(Fax);
        modal.find('.modal-body #adresse').val(adresse);
        modal.find('.modal-body #ville').val(Ville);
        modal.find('.modal-body #Emaila').val(Emaila);


    });



    const dataTable_Place_Holder = "Confrère";
    const OnMyPaginationNSearch = false;
    const dataTable_Search_label = "Chercher : ";
    const dataTable_nbr_lines_language = "Afficher _MENU_ lignes";
    const dataTable_Order_string = "asc"; /// "desc" for descendent order
    const dataTable_can_sort_columns__ = [{
        "orderable": false,
        "targets": [4]
    }];


    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.LoaderSec').forEach(node=>{
            node.classList.add('d-none');
        });
        document.querySelectorAll('.ContentSec').forEach(node=>{
            node.classList.remove('d-none');
        });
    });
</script>




<script src=" {{ asset('js/data-table.js') }}"></script>


@endsection
