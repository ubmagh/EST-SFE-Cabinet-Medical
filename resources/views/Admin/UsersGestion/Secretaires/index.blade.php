@extends('Admin.Parts.pageLayout')

@section('title','Administrateur : Gestion des Secretaires')

@section('css')

<style>

</style>

@endsection


@section('content')
<div class="content-wrapper">
<!-- partial -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body mb-4">
                <h4 class="card-title h3"> La liste des utilisateurs Secretaires :</h4>

                <div class="row mt-n3">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Num#</th>
                                        <th class="text-center">Nom complet</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Tel</th>
                                        <th class="text-center">Créé en</th>
                                        <th class="text-center"> Actions </th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach($secretaires as $secretaire)

                                        <tr>
                                            <td class="text-center">{{ ++$counter }}</td>
                                            <td>{{ $secretaire['Nom'].' '.$secretaire['Prenom'] }}
                                            </td>
                                            <td class="text-center">{{ $secretaire['Email'] }}
                                            </td>
                                            <td class="text-center">{{ $secretaire['Tel'] }}
                                            </td>
                                            <td class="text-center">
                                                {{ substr($secretaire['created_at'],0,16) }}
                                            </td>
                                            <td class="px-0 text-center">
                                                <button class="btn btn-outline-secondary py-2 " role="button"
                                                    data-toggle="modal" data-target="#EditModal"
                                                    class="btn btn-info btn-sn"
                                                    data-id="{{ $secretaire['id'] }}"
                                                    data-Nom="{{ $secretaire['Nom'] }}"
                                                    data-Prenom="{{ $secretaire['Prenom'] }}"
                                                    data-Pseudo="{{ $secretaire['Pseudo'] }}"
                                                    data-Email="{{ $secretaire['Email'] }}"
                                                    data-Adresse="{{ $secretaire['Adresse'] }}"
                                                    data-Tel="{{ $secretaire['Tel'] }}">
                                                    <i class="far fa-edit"></i> Modifier
                                                </button>
                                                <button class="btn btn-outline-danger py-2 " role="button" type="button"
                                                    data-medid="{{ $secretaire['id'] }}"
                                                    data-toggle="modal" data-target="#DeleteModal">
                                                    <i class="fas fa-trash-alt"></i> supprimer
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row d-block w-100 mt-4 mb-3 text-center">
                    <a name="" id="" class="btn btn-success text-white px-4 mb-n5 mt-3" role="button"
                    data-toggle="modal" data-target="#ajoutModal" type="button"> <i class="fa fa-plus-circle fa-lg"
                        aria-hidden="true"></i> Créer </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- -------------------- Create new Modal  ------------------------- -->
<div class="modal fade left" id="ajoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog model-notify modal-md modal-right modal-info" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Créer un utilisateur secretaire: </h5>
                <button type="button" id="closeCreateModal" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST"  id="createForm">
                    @csrf
                    @method('POST')


                    <div class="form-group mb-2">
                        <label for="Nom">Nom : </label>
                        <input name="Nom" id="Nom" type="text" minlength="2" maxlength="30" required
                            class="form-control" placeholder="Nom">
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Create_NomModal">
                        <span id="CreateNomError"></span>
                    </div>


                    <div class="form-group mb-2">
                        <label for="prenom">Prenom : </label>
                        <input name="Prenom" id="prenom" type="text" minlength="2" maxlength="30" required
                            class="form-control" placeholder="Prenom">
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Create_PrenomModal">
                        <span id="CreatePrenomError"></span>
                    </div>


                    <div class="form-group mb-2">
                        <label for="Email">Email : </label>
                        <input name="Email" id="Email" type="email" maxlength="100"
                            class="form-control" placeholder="Email">
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Create_EmailModal">
                        <span id="CreateEmailError"></span>
                    </div>


                    <div class="form-group mb-2">
                        <label for="Pseudo">Pseudo : </label>
                        <input name="Pseudo" id="Pseudo" type="text" minlength="4" maxlength="20" required
                            class="form-control" placeholder="Pseudo">
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Create_PseudoModal">
                        <span id="CreatePseudoError"></span>
                    </div>


                    <div class="form-group mb-2">
                        <label for="password">Mot de passe : </label>
                        <input name="password" id="password" type="password" min="6" required
                            class="form-control" placeholder="">
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Create_passwordModal">
                        <span id="CreatepasswordError"></span>
                    </div>


                    <div class="form-group mb-2">
                        <label for="Tel">Numéro de Téléphone : </label>
                        <input name="Tel" id="Tel" type="text" minlength="9" maxlength="14" required
                            class="form-control" placeholder="Tel">
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Create_TelModal">
                        <span id="CreateTelError"></span>
                    </div>
                    

                    <div class="form-group mb-2">
                        <label for="Adresse">Adresse : </label>
                        <textarea name="Adresse" id="Adresse"  maxlength="100" rows="3"
                            class="form-control" placeholder="Adresse"></textarea>
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Create_AdresseModal">
                        <span id="CreateAdresseError"></span>
                    </div>

                    <div class="row w-100 ml-1">
                        <div class="col">
                            <button type="button" class="btn btn-danger text-white" data-dismiss="modal"
                                id="DismissCreateModal"> <i class="fas fa-times ml-n1 mr-1"></i>Annuler</button>
                        </div>
                        <div class="col mr-0">
                            <button type="submit" class="btn btn-info text-white d-block ml-auto mr-0"> <i
                                    class="fa fa-plus-square ml-n1 mr-1" aria-hidden="true"></i> Ajouter </button>
                        </div>
                    </div>
                </form>
                <div class="w-100 d-none" id="CreateModal_ErrorSection">
                    <div class="alert alert-danger" role="alert">
                        <p> Une erreure Servenue! Ressayez plus-tard !</p>
                        <p id="createErrorMSG"></p>
                    </div>
                </div>
                <div class="w-100 d-none" id="CreateModal_SuccessSection">
                    <div class="alert alert-success" role="alert">
                        <p> Créé avec succès !</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- -------------------- ENDZ Create Modal   ------------------------- -->



<!-- -------------------- Create EDIT Modal  ------------------------- -->
<div class="modal fade left" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog model-notify modal-md modal-right modal-info" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditModalLabel">Modifier un Secretaire :</h5>
                <button type="button" id="closeEditModal" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="EditForm">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="id" id="id" value="">

                    <div class="form-group mb-2">
                        <label for="NomEdit">Nom : </label>
                        <input name="Nom" id="NomEdit" type="text" minlength="2" maxlength="30" required
                            class="form-control" placeholder="Nom de medicament">
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Edit_NomModal">
                        <span id="EditNomError"></span>
                    </div>


                    <div class="form-group mb-2">
                        <label for="prenom">Prenom : </label>
                        <input name="Prenom" id="PrenomEdit" type="text" minlength="2" maxlength="30" required
                            class="form-control" placeholder="Prenom">
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Edit_PrenomModal">
                        <span id="EditPrenomError"></span>
                    </div>


                    <div class="form-group mb-2">
                        <label for="EmailEdit">Email : </label>
                        <input name="Email" id="EmailEdit" type="email" maxlength="100" required
                            class="form-control" placeholder="Email">
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Edit_EmailModal">
                        <span id="EditEmailError"></span>
                    </div>


                    <div class="form-group mb-2">
                        <label for="PseudoEdit">Pseudo : </label>
                        <input name="Pseudo" id="PseudoEdit" type="text" minlength="4" maxlength="20" required
                            class="form-control" placeholder="Pseudo">
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Edit_PseudoModal">
                        <span id="EditPseudoError"></span>
                    </div>


                    <div class="form-group mb-2">
                        <label for="passwordEdit">Mot de passe : </label>
                        <small class="text-muted text-warning"> Laissez ce champs vide, s'il n'est pas modifiable </small>
                        <input name="password" id="passwordEdit" type="password" 
                            class="form-control" placeholder="">
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Edit_passwordModal">
                        <span id="EditpasswordError"></span>
                    </div>


                    <div class="form-group mb-2">
                        <label for="TelEdit">Numéro de Téléphone : </label>
                        <input name="Tel" id="TelEdit" type="text" minlength="9" maxlength="14" 
                            class="form-control" placeholder="Tel">
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Edit_TelModal">
                        <span id="EditTelError"></span>
                    </div>


                    <div class="form-group mb-2">
                        <label for="AdresseEdit">Adresse : </label>
                        <textarea name="Adresse" id="AdresseEdit"  maxlength="100" rows="3"
                            class="form-control" placeholder="Adresse"></textarea>
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Edit_AdresseModal">
                        <span id="EditAdresseError"></span>
                    </div>


                    <div class="row w-100">
                        <div class="col">
                            <button type="button" class="btn btn-danger text-white" data-dismiss="modal"
                                id="DismissEditModal"> <i class="fas fa-times ml-n1 mr-1"></i>Annuler</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-info text-white d-block ml-auto mr-0"> <i
                                    class="fas fa-save ml-n1 mr-1   "></i> Enregistrer </button>
                        </div>
                    </div>
                </form>
                <div class="w-100 d-none" id="EditModal_ErrorSection">
                    <div class="alert alert-danger" role="alert">
                        <p> Une erreure Servenue! Ressayez plus-tard !</p>
                        <p id="EditErrorMSG"></p>
                    </div>
                </div>
                <div class="w-100 d-none" id="EditModal_SuccessSection">
                    <div class="alert alert-success" role="alert">
                        <p> Modifié avec succès !</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- -------------------- ENDZ EDIT Modal   ------------------------- -->

<!-- --------------------  Delete Modal   ------------------------- -->


<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-3"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel-3">Supprimer un secretaire </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="DELETEmodal">
                @csrf
                @method('DELETE')

                <input type="hidden" name="deleteID" value="" id="deleteID" />
                <div class="modal-body">
                    <p>Toutes les les données relatives à cet utilisateur seront supprimées, Etes-vous Sure ?</p>
                    <div class="form-group mb-2">
                        <small class="text-muted text-warning"> Saisissez votre mot de passe pour confirmer: </small>
                        <input name="password" id="passwordDELETE" type="password" required 
                            class="form-control" placeholder="">
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="DELETE_passwordModal">
                        <span id="DELETEpasswordError"></span>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger"> <i class="fas fa-trash-alt"></i> Supprimer</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="DismissDeleteModal"> <i
                            class="fas fa-times    "></i> Annuler</button>
                </div>
            </form>
            <div class="modal-body d-none" id="deleteModal_ErrorSection">
                <div class="alert alert-danger" role="alert">
                    <p> Une erreure Servenue! Ressayez plus-tard !</p>
                    <p id="deleteErrorMSG"></p>
                </div>
                <button type="button" class="btn btn-danger dissmiss" data-dismiss="modal" > <i
                        class="fas fa-times    "></i> Fermer</button>
            </div>
            <div class="modal-body d-none" id="deleteModal_SuccessSection">
                <div class="alert alert-success" role="alert">
                    <p> Supprimé avec succès !</p>
                </div>
                <button type="button" class="btn btn-danger dissmiss" data-dismiss="modal" > <i
                        class="fas fa-times    "></i> Fermer</button>
            </div>
        </div>
    </div>
</div>
</div>

<!-- -------------------- ENDZ Delete Modal   ------------------------- -->


    @endsection

    @section('script')
    <script>

        const dataTable_Place_Holder = "secretaire";
        const dataTable_Search_label = "Chercher: ";
        const dataTable_nbr_lines_language = "Afficher _MENU_ lignes";
        const dataTable_Order_string = "asc"; /// "desc" for descendent order
        const dataTable_can_sort_columns__ = [{
            "orderable": false,
            "targets": [5]
        }];
        
        /// closing modals and clearing all of thiere stored data
    $('#DismissCreateModal').add('#DismissEditModal, .dissmiss,#DismissDeleteModal, #closeCreateModal, #closeEditModal').click(
        function () {
            $(this).closest('form').find('input').val('');
            $(this).closest('form').find('textarea').val('');
            $(this).closest('form').find('textarea').html('');
            $('form .alert').removeClass('show').addClass('d-none');
            $('form .alert span').html('');
        });

/// submit creating form
$('#createForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: <?php echo '"'.url("users/secretaires/create").'"'; ?>,
            data: $(this).serialize(),
            success: function (resp) {
                if (resp.status === "OK") {
                    $('#createForm').hide();
                    $("#CreateModal_SuccessSection").removeClass('d-none').show();
                    setTimeout(() => window.location.reload(), 1400);
                } else {
                    $("#createForm").hide();
                    $("#createErrorMSG").html(resp);
                    $("#CreateModal_ErrorSection").removeClass('d-none').show();
                }
            },
            error: function (error) {
                const response = error.responseJSON;
                const errors = response.errors;
                console.log(errors);
                if (error.responseJSON.errors) {
                    if (errors.Nom[0]) {
                        $('#CreateNomError').html(error.responseJSON.errors.Nom);
                        $('#Create_NomModal').removeClass('d-none').addClass('show');
                    }
                    if (errors.Prenom[0]) {
                        $('#CreatePrenomError').html(error.responseJSON.errors.Prenom);
                        $('#Create_PrenomModal').removeClass('d-none').addClass('show');
                    }
                    if (errors.Email[0]) {
                        $('#CreateEmailError').html(error.responseJSON.errors.Email);
                        $('#Create_EmailModal').removeClass('d-none').addClass('show');
                    }
                    if (errors.Pseudo[0]) {
                        $('#CreatePseudoError').html(error.responseJSON.errors.Pseudo);
                        $('#Create_PseudoModal').removeClass('d-none').addClass('show');
                    }
                    if (errors.password[0]) {
                        $('#CreatepasswordError').html(error.responseJSON.errors.password);
                        $('#Create_passwordModal').removeClass('d-none').addClass('show');
                    }
                    if (errors.Tel[0]) {
                        $('#CreateTelError').html(error.responseJSON.errors.Tel);
                        $('#Create_TelModal').removeClass('d-none').addClass('show');
                    }
                    if (errors.Adresse[0]) {
                        $('#CreateAdresseError').html(error.responseJSON.errors.Adresse);
                        $('#Create_AdresseModal').removeClass('d-none').addClass('show');
                    }
                } else {
                    $("#createForm").hide();
                    $("#createErrorMSG").html(error.responseJSON.message);
                    $("#CreateModal_ErrorSection").removeClass('d-none').show();
                }
            }
        });
    });

    ////  copyind data from datatable to modal fields
    $('#EditModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        const id = button.data('id');
        const Nom = button.data('nom');
        const Prenom = button.data('prenom');
        const Email = button.data('email');
        const Pseudo = button.data('pseudo');
        const Tel = button.data('tel');
        const Adresse = button.data('adresse');


        let modal = $(this);
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #NomEdit').val(Nom);
        modal.find('.modal-body #PrenomEdit').val(Prenom);
        modal.find('.modal-body #EmailEdit').val(Email);
        modal.find('.modal-body #PseudoEdit').val(Pseudo);
        modal.find('.modal-body #TelEdit').val(Tel);
        modal.find('.modal-body #AdresseEdit').val(Adresse);
    });

    /// submit Edditing form
    $('#EditForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: <?php echo '"'.url('users/secretaires/Modify').'"' ?>,
            data: $(this).serialize(),
            success: function (resp) {
                if (resp.status === "OK") {
                    $('#EditForm').hide();
                    $("#EditModal_SuccessSection").removeClass('d-none').show();
                    setTimeout(() => window.location.reload(), 1400);
                } else {
                    $("#EditForm").hide();
                    $("#EditErrorMSG").html(resp);
                    $("#EditModal_ErrorSection").removeClass('d-none').show();
                }
            },
            error: function (error) {
                const response = error.responseJSON;
                if (error.responseJSON.errors) {
                    if (response.errors.Nom) {
                        $('#EditNomError').html(error.responseJSON.errors.Nom);
                        $('#Edit_NomModal').removeClass('d-none').addClass('show');
                    }
                    if (response.errors.Prenom) {
                        $('#EditPrenomError').html(error.responseJSON.errors.Prenom);
                        $('#Edit_PrenomModal').removeClass('d-none').addClass('show');
                    }
                    if (response.errors.Email) {
                        $('#EditEmailError').html(error.responseJSON.errors.Email);
                        $('#Edit_EmailModal').removeClass('d-none').addClass('show');
                    }
                    if (response.errors.Pseudo) {
                        $('#EditPseudoError').html(error.responseJSON.errors.Pseudo);
                        $('#Edit_PseudoModal').removeClass('d-none').addClass('show');
                    }
                    if (response.errors.password) {
                        $('#EditpasswordError').html(error.responseJSON.errors.password);
                        $('#Edit_passwordModal').removeClass('d-none').addClass('show');
                    }
                    if (response.errors.Tel) {
                        $('#EditTelError').html(error.responseJSON.errors.Tel);
                        $('#Edit_TelModal').removeClass('d-none').addClass('show');
                    }
                    if (response.errors.Adresse) {
                        $('#EditAdresseError').html(error.responseJSON.errors.Adresse);
                        $('#Edit_AdresseModal').removeClass('d-none').addClass('show');
                    }
                } else {
                    $("#EditForm").hide();
                    $("#EditErrorMSG").html(error.responseJSON.message);
                    $("#EditModal_ErrorSection").removeClass('d-none').show();
                }
            }
        });
    });


////  copyind data from datatable to delete modal fields
$('#DeleteModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        const id = button.data('medid');
        let modal = $(this);
        $('#deleteID').val(""+id);
    });

/// submitting delete form

$('#DELETEmodal').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "DELETE",
            url: <?php echo '"'.url('users/secretaires/Delete').'"' ?>,
            data: $(this).serialize(),
            success: function (resp) {
                if (resp.status === "OK") {
                    $('#DELETEmodal').hide();
                    $("#deleteModal_SuccessSection").removeClass('d-none').show();
                    setTimeout(() => window.location.reload(), 1400);
                } else if(resp.status=="pwd"){
                    $('#DELETEpasswordError').html("Mot de passe erroné !");
                        $('#DELETE_passwordModal').removeClass('d-none').addClass('show');
                } else {
                    $("#DELETEmodal").hide();
                    $("#deleteErrorMSG").html(resp);
                    $("#deleteModal_ErrorSection").removeClass('d-none').show();
                }
            },
            error: function (error) {
                const response = error.responseJSON;
                const errors = response.errors;

                if (error.responseJSON.errors && response.errors.password) {
                        $('#DELETEpasswordError').html(error.responseJSON.errors.password);
                        $('#DELETE_passwordModal').removeClass('d-none').addClass('show');
                    }else{

                    $("#DELETEmodal").hide();
                    $("#deleteErrorMSG").html(error.responseJSON.message);
                    $("#deleteModal_ErrorSection").removeClass('d-none').show();
                }
            }
        });
    });


    </script>
    <script src=" {{ asset('js/data-table.js') }}"></script>
    @endsection
