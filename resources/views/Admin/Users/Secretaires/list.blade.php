@extends('Admin.Parts.pageLayout')

@section('title','Administrateur : Secretaires')

@section('css')

<style>

</style>

@endsection


@section('content')

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
                                                    data-Dosage="{{ $secretaire['Dosage'] }}"
                                                    data-Prise="{{ $secretaire['Prise'] }}"
                                                    data-Quand="{{ $secretaire['Quand'] }}">
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
                        <input name="password" id="password" type="password" 
                            class="form-control" placeholder="">
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Create_passwordModal">
                        <span id="CreatepasswordError"></span>
                    </div>


                    <div class="form-group mb-2">
                        <label for="Tel">Numéro de Téléphone : </label>
                        <input name="Tel" id="Tel" type="text" minlength="9" maxlength="14" 
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

    </script>
    <script src=" {{ asset('js/data-table.js') }}"></script>
    @endsection
