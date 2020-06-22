@extends('Secretaire.Parts.pageLayout')

@section('title','Secretaire : Medicaments')


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
        <h4 class=" display-4  text-center mt-3 mb-4"> Medicaments : </h4>
        <div class="d-block w-100 mb-n5 text-center mt-3">

            <div class="row w-100 mb-4 mt-5 mx-auto">

                <div class="col-md col-12 text-left">
                    <a name="" id="" class="btn btn-success mx-auto text-center text-white " role="button"
                        data-toggle="modal" data-target="#ajoutModal" type="button"> <i class="fa fa-plus-circle fa-lg"
                            aria-hidden="true"></i> Ajouter </a>
                </div>
                <div class="col-md col-12 text-left">
                    <form method="GET" action="{{ url()->current() }}" class="col-12  ml-auto">
                        <div class="input-group">
                            <input type="text" aria-describedby="button-addon2" class="form-control border-dark" name="q"
                                placeholder="chercher dans les Medicaments ..." value="{{ $q? $q:null }}" />
                            <div class="input-group-append">
                                <button class="btn btn-outline-dark" type="submit" id="button-addon2"><i
                                        class="fas fa-search fa-lg"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            
        </div>
        <div class="row mt-n3">
            <div class="col-12">
                @if( $q )
                    <div class="row w-100 text-center"> 
                        <h4 class="h4 mx-auto"> Résultats de recherche de : ` {{ $q }} `  <a href="{{url('Medicaments')}}"> <i class="fas fa-times text-danger"></i> </a> </h4>
                    </div>
                @endif
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>

                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nom</th>
                                <th class="text-center">Prise</th>
                                <th class="text-center">Quand</th>
                                <th class="text-center"> Actions </th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach($medicaments as $medicament)

                                <tr>
                                    <td class="text-center">{{ ($counter-1)*10+ $medicament['num'] }}</td>
                                    <td>{{ $medicament['Nom'] }}</td>
                                    <td class="text-center">{{ $medicament['Prise'] }}</td>
                                    <td class="text-center">
                                        @switch(strtolower($medicament['Quand']))

                                            @case("avant")
                                                <label class="badge badge-success text-center">Avant</label>
                                                @break
                                            @case("apres")
                                                <label class="badge badge-warning text-center">Après</label>
                                                @break
                                            @default
                                            <label class="badge badge-dark text-center">Indifini</label>
                                        @endswitch
                                    </td>
                                    <td class="px-0 text-center">
                                        <button class="btn btn-outline-secondary py-2 " role="button"
                                            data-toggle="modal" data-target="#EditModal" class="btn btn-info btn-sn"
                                            data-id="{{ $medicament['id'] }}"
                                            data-Nom="{{ $medicament['Nom'] }}"
                                            data-Prise="{{ $medicament['Prise'] }}"
                                            data-Quand="{{ $medicament['Quand'] }}">
                                            <i class="far fa-edit"></i> Modifier
                                        </button>
                                        <button class="btn btn-outline-danger py-2 " role="button" type="button"
                                            data-medid="{{ $medicament['id'] }}"
                                            data-toggle="modal" data-target="#DeleteModal">
                                            <i class="fas fa-trash-alt"></i> supprimer
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-12 mx-auto px-5 mb-2">
                   <div class="w-auto mx-auto text-center d-flex justify-content-center mt-3">
                        {{ $medicaments->appends(request()->input())->links() }}
                   </div>
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
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un nouveau medicament</h5>
                
                <button type="button" id="closeCreateModal" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="GET" id="createForm">
                    @csrf
                    @method('GET')


                    <div class="form-group mb-2">
                        <label for="nom">Nom de medicament: </label>
                        <input name="Nom" id="Nom" type="text" minlength="2" maxlength="100" required
                            class="form-control" placeholder="Nom de medicament">
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Create_NomModal">
                        <span id="CreateNomError"></span>
                    </div>




                    <div class="form-group mb-2">
                        <label for="Prise">Prise:</label>
                        <input name="Prise" id="Prise" maxlength="30" minlength="0" type="text" class="form-control"
                            placeholder=" une Pilule, un cuiller, 3ml">
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Create_PriseModal">
                        <span id="CreatePriseError"></span>
                    </div>


                    <div class="form-group mb-2">
                        <label for="Quand">Quand:</label>
                        <select class="form-control" name="Quand" id="Quand">
                            <option value="Avant">Avant</option>
                            <option value="Apres">Apres</option>
                            <option value="indifini" selected>indifini</option>
                        </select>
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Create_QuandModal">
                        <span id="CreateQuandError"></span>
                    </div>

                    <div class="row mx-auto w-100 mt-3">
                        <div class="col-md col-12 text-left">
                            <button type="button" class="btn btn-danger text-white" data-dismiss="modal"
                                id="DismissCreateModal"> <i class="fas fa-times ml-n1 mr-1"></i>Annuler</button>
                        </div>
                        <div class="col-md col-12 text-right">
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
                <h5 class="modal-title" id="EditModalLabel">Modifier un medicament</h5>
                <button type="button" id="closeEditModal" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="GET" id="EditForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="id" value="">
                    <div class="form-group mb-2">
                        <label for="NomEdit">Nom de medicament: </label>
                        <input name="Nom" id="NomEdit" type="text" minlength="2" maxlength="100" required
                            class="form-control" placeholder="Nom de medicament">
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Edit_NomModal">
                        <span id="EditNomError"></span>
                    </div>

                    <div class="form-group mb-2">
                        <label for="PriseEdit">Prise:</label>
                        <input name="Prise" id="PriseEdit" maxlength="30" minlength="0" type="text" class="form-control"
                            placeholder=" une Pilule, un cuiller, 3ml">
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Edit_PriseModal">
                        <span id="EditPriseError"></span>
                    </div>


                    <div class="form-group mb-2">
                        <label for="QuandEdit">Quand:</label>
                        <select class="form-control" name="Quand" id="QuandEdit">
                            <option value="Avant">Avant</option>
                            <option value="Apres">Apres</option>
                            <option value="indifini" selected>indifini</option>
                        </select>
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="Edit_QuandModal">
                        <span id="EditQuandError"></span>
                    </div>

                    <div class="row mx-auto mt-3 w-100">
                        <div class="col-md col-12 text-left">
                            <button type="button" class="btn btn-danger text-white" data-dismiss="modal"
                                id="DismissEditModal"> <i class="fas fa-times ml-n1 mr-1"></i>Annuler</button>
                        </div>
                        <div class="col-md col-12 text-right">
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
                <h5 class="modal-title" id="exampleModalLabel-3">Supprimer un Medicament </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="DELETEmodal">
                @csrf
                @method('DELETE')

                <input type="hidden" name="deleteID" value="" id="deleteID" />
                <div class="modal-body">
                    <p>Etes-vous Sure ?</p>
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
                    <p> Bien Supprimé avec succès !</p>
                </div>
                <button type="button" class="btn btn-danger dissmiss" data-dismiss="modal" > <i
                        class="fas fa-times    "></i> Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- -------------------- ENDZ Delete Modal   ------------------------- -->


</div>

@endsection

@section('script')
<script>
    // define data table options
    const dataTable_Place_Holder = "medicament";
    const OnMyPaginationNSearch = false;
    const dataTable_Search_label = "Chercher: ";
    const dataTable_nbr_lines_language = "Afficher _MENU_ lignes";
    const dataTable_Order_string = "asc"; /// "desc" for descendent order
    const dataTable_can_sort_columns__ = [{
        "orderable": false,
        "targets": [4]
    }];

    /// closing modals and clearing all of thiere stored data
    $('#DismissCreateModal').add('#DismissEditModal, .dissmiss,#DismissDeleteModal, #closeCreateModal, #closeEditModal').click(
        function () {
            $(this).closest('form').find('input').val('');
            $('form .alert').removeClass('show').addClass('d-none');
            $('form .alert span').html('');
        });

    /// submit creating form
    $('#createForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "/Medicaments/create",
            data: $(this).serialize(),
            success: function (resp) {
                if (resp.status === "OK") {
                    $('#createForm').hide();
                    $("#CreateModal_SuccessSection").removeClass('d-none').show();
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    $("#createForm").hide();
                    $("#createErrorMSG").html(resp);
                    $("#CreateModal_ErrorSection").removeClass('d-none').show();
                }
            },
            error: function (error) {
                const errors = error.responseJSON.errors;
                if (error.responseJSON.errors) {
                    if (errors.Nom) {
                        $('#CreateNomError').html(errors.Nom);
                        $('#Create_NomModal').removeClass('d-none').addClass('show');
                    }
                    if (errors.Prise) {
                        $('#CreatePriseError').html(errors.Prise);
                        $('#Create_PriseModal').removeClass('d-none').addClass('show');
                    }
                    if (errors.Quand) {
                        $('#CreateQuandError').html(errors.Quand);
                        $('#Create_QuandModal').removeClass('d-none').addClass('show');
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
        const Dosage = button.data('dosage');
        const Prise = button.data('prise');
        const Quand = button.data('quand');


        let modal = $(this);
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #NomEdit').val(Nom);
        modal.find('.modal-body #DosageEdit').val(Dosage);
        modal.find('.modal-body #PriseEdit').val(Prise);
        modal.find('.modal-body #QuandEdit').val(Quand);

    });


    /// submit Edditing form
    $('#EditForm').submit(function (e) {
        e.preventDefault();
        const id = $('#id').val();
        $.ajax({
            type: "PUT",
            url: "/Medicaments/" + id,
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
                if (error.responseJSON.errors) {
                    if (errors.Nom) {
                        $('#EditNomError').html(errors.Nom);
                        $('#Edit_NomModal').removeClass('d-none').addClass('show');
                    }
                    if (errors.Prise) {
                        $('#EditPriseError').html(errors.Prise);
                        $('#Edit_PriseModal').removeClass('d-none').addClass('show');
                    }
                    if (errors.Quand) {
                        $('#EditQuandError').html(errors.Quand);
                        $('#Edit_QuandModal').removeClass('d-none').addClass('show');
                    }
                } else {
                    $("#EditForm").hide();
                    $("#EditErrorMSG").html(error.responseJSON.message);
                    $("#EditModal_ErrorSection").removeClass('d-none').show();
                }
            }
        });
    });


////  copyind data from datatable to modal fields
$('#DeleteModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        const id = button.data('medid');
        let modal = $(this);
        $('#deleteID').val(""+id);
    });



    /// submitting delete form

    $('#DELETEmodal').submit(function (e) {
        const DeleteId = $("#deleteID").val();
        e.preventDefault();
        $.ajax({
            type: "DELETE",
            url: "/Medicaments/" + DeleteId,
            data: $(this).serialize(),
            success: function (resp) {
                if (resp.status === "OK") {
                    $('#DELETEmodal').hide();
                    $("#deleteModal_SuccessSection").removeClass('d-none').show();
                    setTimeout(() => window.location.reload(), 1400);
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
