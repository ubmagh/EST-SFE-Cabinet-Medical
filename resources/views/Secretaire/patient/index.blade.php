@extends('Secretaire.Parts.pageLayout')



@section('title')
Liste des patients
@endsection



@section('content')


<div class="content-wrapper" style="max-width: 85% !important;">
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
            <div class="d-block w-100 mb-n5 text-center mt-3">
                <a name="" id="" class="btn btn-primary mx-auto text-center text-white mb-n5 mt-3" role="button"
                    data-toggle="modal" data-target="#AddModal" type="button"> <i class="fa fa-plus-circle fa-lg"
                        aria-hidden="true"></i> Ajouter un patient </a>
            </div>
            <div class="row mt-n3">
                <div class="col-12">
                    <div class="table-responsive">


                        <table id="order-listing" class="table">

                            <thead>

                                <tr>
                                    <th class="text-center">Num Patient</th>
                                    <th class="text-center">Identifiant Civil</th>
                                    <th class="text-center">Nom</th>
                                    <th class="text-center">Prénom</th>
                                    <th class="text-center">Date de naissance</th>
                                    <th class="text-center">Sexe</th>
                                    <th class="text-center">Téléphone</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($patients as $patient)
                                    <tr>
                                        <td class="text-center">{{ $patient['id'] }}</td>
                                        <td class="text-center">{{ $patient['id_civile'] }}</td>
                                        <td class="text-center">{{ $patient['Nom'] }}</td>
                                        <td class="text-center">{{ $patient['Prenom'] }}</td>
                                        <td class="text-center">{{ $patient['DateNaissance'] }}
                                        </td>
                                        <td class="text-center">{{ $patient['Sexe'] }}</td>
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
                                                class="btn btn-outline-info py-2 ">
                                                <i class="fas fa-plus"></i> Plus de détails</button>

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
                                                type="button" class="btn btn-outline-success py-2 ">
                                                <i class="far fa-edit"></i> Modifier</button>

                                            <!-- -------------------- DELETE BUTTON   ------------------------- -->
                                            <button data-id_delete="{{ $patient['id'] }}"
                                                data-toggle="modal" data-target="#ModalDelete" role="button"
                                                type="button" class="btn btn-outline-danger py-2 ">
                                                <i class="fas fa-trash-alt"></i> Supprimer</button>




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
                                        <h5 class="modal-title" id="exampleModalLabel">Nouveau patient</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form id="addform" action="####here" method="POST">
                                        <div class="modal-body">
                                            {{ csrf_field() }}


                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Nom</label>
                                                <input name="Nom" type="text" class="form-control"
                                                    placeholder="Entrer le nom">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Prénom</label>
                                                <input name="Prenom" type="text" class="form-control"
                                                    placeholder="Entrer le prénom">
                                            </div>

                                            <div class="form-group">
                                                <label for="DateNaissance">Date de naissance</label>
                                                <input name="DateNaissance" type="date" class="form-control">
                                            </div>


                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Numéro d'identité</label>
                                                <input name="id_civile" type="text" class="form-control"
                                                    placeholder="Entrer le numéro d'identité">
                                            </div>


                                            <div class="form-group">
                                                <label for="Email">Email</label>
                                                <input name="Email" type="email" class="form-control"
                                                    placeholder="name@example.com">
                                            </div>

                                            <div class="form-group">
                                                <label for="Tel">Téléphone</label>
                                                <input name="Tel" type="tel" class="form-control"
                                                    placeholder="Entrer le numéro de téléphone">
                                            </div>

                                            <div class="form-group">
                                                <label for="Sexe">Sexe</label>
                                                <select name="Sexe" class="form-control">
                                                    <option>Masculin</option>
                                                    <option>Féminin</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Adresse</label>
                                                <input name="adresse" type="text" class="form-control"
                                                    placeholder="Entrer l'adresse">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Ville</label>
                                                <input name="Ville" type="text" class="form-control"
                                                    placeholder="Entrer la ville">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Ocuupation</label>
                                                <input name="Occupation" type="text" class="form-control"
                                                    placeholder="Entrer l'occupation">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Nationalité</label>
                                                <input name="Nationnalite" type="text" class="form-control"
                                                    placeholder="Entrer la nationalité">
                                            </div>

                                            <div class="form-group">
                                                <label for="Mutuel">Mutuelle</label>
                                                <select name="typeMutuel" class="form-control">
                                                    <option>CNSS</option>
                                                    <option>CNOPS</option>
                                                    <option>RAMED</option>
                                                    <option>FAR</option>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">référence de la mutuelle</label>
                                                <input name="ref_mutuel" type="text" class="form-control"
                                                    placeholder="Entrer la référence de la mutuelle">
                                            </div>

                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                                    class="far fa-times-circle"></i> Annuler</button>
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                                Enregistrer</button>
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


                                            <div class="form-group">
                                                <label for="nom">Nom</label>
                                                <input name="Nom" id="nom_edit" type="text" class="form-control"
                                                    placeholder="Entrer le nom">
                                            </div>

                                            <div class="form-group">
                                                <label for="prenom">Prénom</label>
                                                <input name="Prenom" id="prenom_edit" type="text" class="form-control"
                                                    placeholder="Entrer le prénom">
                                            </div>

                                            <input type="hidden" id="id" name="id_patient">


                                            <div class="form-group">
                                                <label for="datenaissance">Date de naissance</label>
                                                <input name="DateNaissance" id="datenaissance_edit" type="date"
                                                    class="form-control">
                                            </div>


                                            <div class="form-group">
                                                <label for="id_civile">Numéro d'identité</label>
                                                <input name="id_civile" id="id_civile_edit" type="text"
                                                    class="form-control" placeholder="Entrer le numéro d'identité">
                                            </div>


                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input name="Email" id="email_edit" type="email" class="form-control"
                                                    placeholder="name@example.com">
                                            </div>

                                            <div class="form-group">
                                                <label for="tel">Téléphone</label>
                                                <input name="Tel" id="tel_edit" type="tel" class="form-control"
                                                    placeholder="Entrer le numéro de téléphone">
                                            </div>

                                            <div class="form-group">
                                                <label for="sexe">Sexe</label>
                                                <select name="Sexe" id="sexe_edit" class="form-control">
                                                    <option>Masculin</option>
                                                    <option>Féminin</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="adresse">Adresse</label>
                                                <input name="adresse" id="adresse_edit" type="text" class="form-control"
                                                    placeholder="Entrer l'adresse">
                                            </div>

                                            <div class="form-group">
                                                <label for="ville">Ville</label>
                                                <input name="Ville" id="ville_edit" type="text" class="form-control"
                                                    placeholder="Entrer la ville">
                                            </div>

                                            <div class="form-group">
                                                <label for="occupation">Occupation</label>
                                                <input name="Occupation" id="occupation_edit" type="text"
                                                    class="form-control" placeholder="Entrer l'occupation">
                                            </div>

                                            <div class="form-group">
                                                <label for="nationnalite">Nationalité</label>
                                                <input name="Nationnalite" id="nationnalite_edit" type="text"
                                                    class="form-control" placeholder="Entrer la nationalité">
                                            </div>

                                            <div class="form-group">
                                                <label for="typemutuel">Mutuelle</label>
                                                <select name="typeMutuel" id="typemutuel_edit" class="form-control">
                                                    <option>CNSS</option>
                                                    <option>CNOPS</option>
                                                    <option>RAMED</option>
                                                    <option>FAR</option>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label for="ref_mutuel">référence de la mutuelle</label>
                                                <input name="ref_mutuel" id="refmutuel_edit" type="text"
                                                    class="form-control"
                                                    placeholder="Entrer la référence de la mutuelle">
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

                                    <form id="editform">
                                        <div class="modal-body">

                                            <input type="hidden" id="id" name="id_patient">



                                            <div class="form-group">
                                                <label for="Email">Email</label>
                                                <input name="Email" id="email_show" type="email" class="form-control"
                                                    readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="Sexe">Sexe</label>
                                                <input name="Sexe" id="sexe_show" type="text" class="form-control"
                                                    readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="adresse">Adresse</label>
                                                <input name="adresse" id="adresse_show" type="text" class="form-control"
                                                    readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="ville">Ville</label>
                                                <input name="Ville" id="ville_show" type="text" class="form-control"
                                                    readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="occupation">Occupation</label>
                                                <input name="Occupation" id="occupation_show" type="text"
                                                    class="form-control" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="nationnalite">Nationalité</label>
                                                <input name="Nationnalite" id="nationnalite_show" type="text"
                                                    class="form-control" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="nationnalite">Mutuelle</label>
                                                <input name="Nationnalite" id="typemutuel_show" type="text"
                                                    class="form-control" readonly>
                                            </div>


                                            <div class="form-group">
                                                <label for="ref_mutuel">Référence de la mutuelle</label>
                                                <input name="ref_mutuel" id="refmutuel_show" type="text"
                                                    class="form-control" readonly>
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
                url: "/patient",
                data: $('#addform').serialize(),
                success: function (response) {
                    $("#msgSucc").removeClass('d-none').addClass('d-block');
                    $("#addform").addClass('d-none');
                    location.reload();
                },

                error: function (error) {
                    console.log(error)
                    $("#msgDanger").removeClass('d-none').addClass('d-block');
                    $("#addform").addClass('d-none');
                    location.reload();
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
    const dataTable_Search_label = "Chercher : ";
    const dataTable_nbr_lines_language = "Afficher _MENU_ lignes";
    const dataTable_Order_string = "asc"; /// "desc" for descendent order
    const dataTable_can_sort_columns__ = [{
        "orderable": false,
        "targets": [7]
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
