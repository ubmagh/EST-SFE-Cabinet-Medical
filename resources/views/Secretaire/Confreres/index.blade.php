@extends('Secretaire.Parts.pageLayout')



@section('title')
Liste des confrères
@endsection



@section('content')


<div class="content-wrapper">
    <div class="card h-100">
        <div class="card-body">
            <div class="d-block w-100 mb-n5 text-center mt-3">
                <a name="" id="" class="btn btn-primary mx-auto text-center text-white mb-n5 mt-3" role="button"
                    data-toggle="modal" data-target="#AddModal" type="button"> <i class="fa fa-plus-circle fa-lg"
                        aria-hidden="true"></i> Ajouter un confrère </a>
            </div>
            <div class="row mt-n3">
                <div class="col-12">
                    <div class="table-responsive">


                        <table id="order-listing" class="table">

                            <thead>

                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nom</th>
                                    <th class="text-center">Téléphone</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($confrere as $confreres)
                                    <tr>

                                        <td class="text-center">{{ $counter++ }}</td>
                                        <td class="text-center">{{ $confreres->Nom }}</td>
                                        <td class="text-center">{{ $confreres->Tel }}</td>
                                        <td class="text-center">{{ $confreres->Email }}</td>
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


                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Nom</label>
                                                <input name="Nom" type="text" class="form-control" maxlength="60"
                                                    placeholder="Entrer le nom">
                                            </div>
                                            <div class="alert alert-danger mt-n3 alert-dismissible fade show d-none" id="CM_Nom" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    <span class="sr-only">Close</span>
                                                </button>
                                                <span id="CM_Nom_MSG"> </span>
                                            </div>


                                            <div class="form-group">
                                                <label for="Tel">Téléphone</label>
                                                <input name="Tel" type="tel" class="form-control" maxlength="14"
                                                    placeholder="Entrer le numéro de téléphone" />
                                            </div>
                                             <div class="alert alert-danger mt-n3 alert-dismissible fade show d-none" id="CM_Tel" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    <span class="sr-only">Close</span>
                                                </button>
                                                <span id="CM_Tel_MSG"> </span>
                                            </div>


                                            <div class="form-group">
                                                <label for="Fax">Fax</label>
                                                <input name="Fax" type="tel" class="form-control" maxlength="14"
                                                    placeholder="Entrer le numéro de fax" />
                                            </div>





                                            <div class="form-group">
                                                <label for="Email">Email</label>
                                                <input name="Email" type="email" class="form-control"
                                                    placeholder="name@example.com">
                                            </div>




                                            <div class="form-group">
                                                <label for="adresse">Adresse</label>
                                                <input name="adresse" type="text" class="form-control" maxlength="50"
                                                    placeholder="Entrer l'adresse">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Ville</label>
                                                <input name="Ville" type="text" class="form-control" maxlength="40"
                                                    placeholder="Entrer la ville">
                                            </div>

                                            <div class="form-group">
                                                <label for="Specialite">Spécialité</label>
                                                <input name="Specialite" type="text" maxlength="50" class="form-control"
                                                    placeholder="Entrer la Specialité"> 
                                            </div>


                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                                    class="far fa-times-circle"></i> Annuler</button>
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                                Enregistrer</button>
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



                                            <div class="form-group">
                                                <label for="Nom">Nom</label>
                                                <input id="nom" name="Nom" type="text" class="form-control"
                                                    placeholder="Entrer le nom">
                                            </div>


                                            <div class="form-group">
                                                <label for="Tel">Téléphone</label>
                                                <input id="tel" name="Tel" type="tel" class="form-control"
                                                    placeholder="Entrer le numéro de téléphone">
                                            </div>



                                            <div class="form-group">
                                                <label for="Fax">Fax</label>
                                                <input id="fax" name="Fax" type="tel" class="form-control"
                                                    placeholder="Entrer le numéro de fax">
                                            </div>





                                            <div class="form-group">
                                                <label for="Email">Email</label>
                                                <input id="email" name="Email" type="email" class="form-control"
                                                    placeholder="name@example.com">
                                            </div>




                                            <div class="form-group">
                                                <label for="adresse">Adresse</label>
                                                <input id="adresse" name="adresse" type="text" class="form-control"
                                                    placeholder="Entrer l'adresse">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Ville</label>
                                                <input id="ville" name="Ville" type="text" class="form-control"
                                                    placeholder="Entrer la ville">
                                            </div>

                                            <div class="form-group">
                                                <label for="Specialite">Spécialité</label>
                                                <input id="specialite" name="Specialite" type="text"
                                                    class="form-control" placeholder="Entrer l'occupation">
                                            </div>



                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                                    class="far fa-times-circle"></i> Annuler</button>
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i>
                                                Modifier</button>
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

                                    <form id="editform">
                                        <div class="modal-body">

                                            <input type="hidden" id="id" name="id_confrere">


                                            <div class="form-group">
                                                <label for="Fax">Fax</label>
                                                <input id="fax" name="Fax" type="tel" class="form-control"
                                                    placeholder="Entrer le numéro de fax" readonly>
                                            </div>


                                            <div class="form-group">
                                                <label for="adresse">Adresse</label>
                                                <input id="adresse" name="adresse" type="text" class="form-control"
                                                    placeholder="Entrer l'adresse" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Ville</label>
                                                <input id="ville" name="Ville" type="text" class="form-control"
                                                    placeholder="Entrer la ville" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="Specialite">Spécialité</label>
                                                <input id="specialite" name="Specialite" type="text"
                                                    class="form-control" placeholder="Entrer la Specialité" readonly>
                                            </div>


                                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                <i class="far fa-times-circle"></i> Fermer</button>

                                        </div>
                                    </form>


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
                    $("#msgSucc-edit").removeClass('d-none').addClass('d-block');
                    $("#editform").addClass('d-none');
                    location.reload();
                },

                error: function (error) {
                    $("#msgDanger-edit").removeClass('d-none').addClass('d-block');
                    $("#editform").addClass('d-none');

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
                    $("#msgSucc").removeClass('d-none').addClass('d-block');
                    $("#addform").addClass('d-none');
                    location.reload();
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
        let modal = $(this);
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
        var Specialite = button.data('specialite');
        var id = button.data('id');

        let modal = $(this);
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #fax').val(Fax);
        modal.find('.modal-body #adresse').val(adresse);
        modal.find('.modal-body #ville').val(Ville);
        modal.find('.modal-body #specialite').val(Specialite);


    });



    const dataTable_Place_Holder = "Confrère";
    const dataTable_Search_label = "Chercher : ";
    const dataTable_nbr_lines_language = "Afficher _MENU_ lignes";
    const dataTable_Order_string = "asc"; /// "desc" for descendent order
    const dataTable_can_sort_columns__ = [{
        "orderable": false,
        "targets": [5]
    }];

</script>




<script src=" {{ asset('js/FontAwesomeAll.min.js') }}"></script>
<script src=" {{ asset('js/data-table.js') }}"></script>


@endsection
