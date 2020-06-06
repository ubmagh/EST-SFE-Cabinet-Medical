@extends('Admin.Parts.pageLayout')

@section('title','Administrateur : Opérations du cabinet')

@section('css')

<style>

</style>

@endsection


@section('content')

<!-- partial -->
<div class="row">
    <div class="col-12">
        <div class="card">

             <div class="card-body w-100 grid-margin  stretch-card LoaderSec" style="height: 480px;" >
                        <div class="loader-demo-box border-0">
                            <div class="dot-opacity-loader">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>

            <div class="card-body d-none ContentSec mb-4">
                <h4 class="card-title h3"> La liste des Opérations du Cabinet :</h4>

                <div class="row mt-n3">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Num#</th>
                                        <th class="text-center">Intitulé</th>
                                        <th class="text-center">Prix</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">Actions</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach($Operations as $operation)

                                        <tr>
                                            <td class="text-center">{{ ++$counter }}</td>
                                            <td>{{ $operation['Intitule'] }}
                                            </td>
                                            <td class="text-center">{{ $operation['Prix'] }} DH
                                            </td>
                                            <td class="text-center">{{ $operation['Description'] }}
                                            </td>
                                            <td class="px-0 text-center">
                                                <button class="btn btn-outline-secondary py-2 " role="button"
                                                    data-toggle="modal" data-target="#EditModal"
                                                    class="btn btn-info btn-sn"
                                                    data-id="{{ $operation['id'] }}"
                                                    data-intitule="{{ $operation['Intitule'] }}"
                                                    data-prix="{{ $operation['Prix'] }}"
                                                    data-Description="{{ $operation['Description'] }}">
                                                    <i class="far fa-edit"></i> Modifier
                                                </button>
                                                <button class="btn btn-outline-danger py-2 " role="button" type="button"
                                                    data-opid="{{ $operation['id'] }}"
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
                        aria-hidden="true"></i> Ajouter </a>
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
                <h5 class="modal-title" id="exampleModalLabel"> Ajouter une Opération </h5>
                <button type="button" id="closeCreateModal" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST"  id="createForm">
                    @csrf
                    @method('POST')


                    <div class="form-group mb-2">
                        <label for="Intitule">Intitule : </label>
                        <input name="Intitule" id="Intitule" type="text" minlength="2" maxlength="120" required
                            class="form-control" placeholder="">
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Create_IntituleModal">
                        <span id="CreateIntituleError"></span>
                    </div>


                    <div class="form-group mb-2">
                        <label for="Prix">Prix : </label>
                        <input name="Prix" id="Prix" type="text" maxlength="15" required
                            class="form-control" placeholder="100.00">
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Create_PrixModal">
                        <span id="CreatePrixError"></span>
                    </div>


                    <div class="form-group mb-2">
                        <label for="Description">Description : </label>
                        <textarea name="Description" id="Description"  maxlength="350" rows="4"
                            class="form-control" placeholder=""></textarea>
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Create_DescriptionModal">
                        <span id="CreateDescriptionError"></span>
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
                        <p> Ajouté avec succès !</p>
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
                <h5 class="modal-title" id="EditModalLabel"> Modifier une Opération :</h5>
                <button type="button" id="closeEditModal" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="EditForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="id" value="">
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Edit_idModal">
                        <span id="EditidError"></span>
                    </div>

                    <div class="form-group mb-2">
                        <label for="IntituleEdit">Intitule : </label>
                        <input name="Intitule" id="IntituleEdit" type="text" minlength="2" maxlength="120" required
                            class="form-control" placeholder="">
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Edit_IntituleModal">
                        <span id="EditIntituleError"></span>
                    </div>


                    <div class="form-group mb-2">
                        <label for="PrixEdit">Prix : </label>
                        <input name="Prix" id="PrixEdit" type="text" minlength="2" maxlength="15" required
                            class="form-control" placeholder="150.0">
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Edit_PrixModal">
                        <span id="EditPrixError"></span>
                    </div>

                    <div class="form-group mb-2">
                        <label for="DescriptionEdit">Description : </label>
                        <textarea name="Description" id="DescriptionEdit"  maxlength="350" rows="6"
                            class="form-control" placeholder=""></textarea>
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Edit_DescriptionModal">
                        <span id="EditDescriptionError"></span>
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
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel-3">Supprimer une opération </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="DELETEmodal">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <p>Toutes les les données relatives à cet utilisateur seront supprimées, Etes-vous Sure ?</p>
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

<!-- -------------------- ENDZ Delete Modal   ------------------------- -->


    @endsection

    @section('script')
    <script>

        const dataTable_Place_Holder = "Operation";
        const dataTable_Search_label = "Chercher: ";
        const dataTable_nbr_lines_language = "Afficher _MENU_ lignes";
        const dataTable_Order_string = "asc"; /// "desc" for descendent order
        const dataTable_can_sort_columns__ = [{
            "orderable": false,
            "targets": [3,4]
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
            url: <?php echo '"'.url("Operations").'"'; ?>,
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
                const errors = error.responseJSON.errors;
                if (errors) {
                    if (errors.Intitule) {
                        $('#CreateIntituleError').html(error.responseJSON.errors.Intitule);
                        $('#Create_IntituleModal').removeClass('d-none').addClass('show');
                    }
                    if (errors.Prix) {
                        $('#CreatePrixError').html(error.responseJSON.errors.Prix);
                        $('#Create_PrixModal').removeClass('d-none').addClass('show');
                    }
                    if (errors.Description) {
                        $('#CreateDescriptionError').html(error.responseJSON.errors.Description);
                        $('#Create_DescriptionModal').removeClass('d-none').addClass('show');
                    }
                } else {
                    $("#createForm").hide();
                    $("#createErrorMSG").html(error.responseJSON.message);
                    $("#CreateModal_ErrorSection").removeClass('d-none').show();
                }
            }
        });
    });
    var id=null;
    ////  copyind data from datatable to modal fields
    $('#EditModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        id = button.data('id');
        const Intitule = button.data('intitule');
        const Prix = button.data('prix');
        const Description = button.data('description');


        let modal = $(this);
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #IntituleEdit').val(Intitule);
        modal.find('.modal-body #PrixEdit').val(Prix);
        modal.find('.modal-body #DescriptionEdit').val(Description);
    });

    /// submit Edditing form
    $('#EditForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "PUT",
            url: <?php echo '"'.url('Operations').'"' ?>+'/'+id,
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
                const errors = error.responseJSON.errors;
                if (errors) {
                    if (errors.id) {
                        $('#EditidError').html(error.responseJSON.errors.id);
                        $('#Edit_idModal').removeClass('d-none').addClass('show');
                    }
                    if (errors.Intitule) {
                        $('#EditIntituleError').html(error.responseJSON.errors.Intitule);
                        $('#Edit_IntituleModal').removeClass('d-none').addClass('show');
                    }
                    if (errors.Prix) {
                        $('#EditPrixError').html(error.responseJSON.errors.Prix);
                        $('#Edit_PrixModal').removeClass('d-none').addClass('show');
                    }
                    if (errors.Description) {
                        $('#EditDescriptionError').html(error.responseJSON.errors.Description);
                        $('#Edit_DescriptionModal').removeClass('d-none').addClass('show');
                    }
                } else {
                    $("#EditForm").hide();
                    $("#EditErrorMSG").html(error.responseJSON.message);
                    $("#EditModal_ErrorSection").removeClass('d-none').show();
                }
            }
        });
    });

var delId = null;
////  copyind data from datatable to delete modal fields
$('#DeleteModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        delId = button.data('opid');
    });

/// submitting delete form

$('#DELETEmodal').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "DELETE",
            url: <?php echo '"'.url('Operations').'"' ?>+'/'+delId,
            data : $(this).serialize(),
            success: function (resp) {
                if (resp.status === "OK") {
                    $('#DELETEmodal').hide();
                    $("#deleteModal_SuccessSection").removeClass('d-none').show();
                    setTimeout(() => window.location.reload(), 1300);
                } else {
                    $("#DELETEmodal").hide();
                    $("#deleteErrorMSG").html(resp);
                    $("#deleteModal_ErrorSection").removeClass('d-none').show();
                }
            },
            error: function (error) {
                const response = error.responseJSON;
                const errors = response.errors;
                    $("#DELETEmodal").hide();
                    $("#deleteErrorMSG").html(error.responseJSON.message);
                    $("#deleteModal_ErrorSection").removeClass('d-none').show();
            }
        });
    });


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
