@extends('Medcin.Parts.pageLayout')



@section('title')
Lettres aux confrères
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('vendors/summernote/dist/summernote-bs4.css') }}">
@endsection
@section('content')
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="w-75 content-wrapper" style="max-width: none;">
            <div class="row grid-margin">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row d-block w-100 mt-4 mb-3 py-3 text-center">
                                <a class="btn btn-primary" href="{{ url('LettreAuConfrere') }}"
                                    role="button"> <i class="fas fa-plus fa-lg"></i> Nouvelle Lettre </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>
                                                #
                                            </th>
                                            <th>
                                                date
                                            </th>
                                            <th>
                                                Confrère
                                            </th>
                                            <th>
                                                Patient
                                            </th>
                                            <th>
                                                Objet
                                            </th>
                                            <th class="text-center">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $Lettres as $Lettre )
                                            <tr>
                                                <td class="py-1">
                                                    {{ $Lettre->num }}
                                                </td>
                                                <td>
                                                    {{ substr($Lettre->date,0,16) }}
                                                </td>
                                                <td>
                                                    <a
                                                        href="{{ url('Confrere/'.$Lettre->ConfrereID) }}">
                                                        {{ $Lettre->Nom }} </a>
                                                </td>
                                                <td>
                                                    @if( $Lettre->Pnom )
                                                        <a
                                                            href="{{ url('FichePatient/'.$Lettre->PatientId) }}">
                                                            {{ $Lettre->Pnom }} </a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td class="text-truncate">
                                                    {{ $Lettre->Titre }}
                                                </td>
                                                <td class="text-center">
                                                    <a name="" id="" class="btn btn-warning text-white"
                                                        href="{{ url('Lettre/'.$Lettre->lettreID) }}"
                                                        target="_blank"> <i class="fas fa-print fa-lg"></i> </a>
                                                    <a name="" id="" class="btn btn-info text-white"
                                                        href="{{ url('LettreAuConfrere').'?modify='.$Lettre->lettreID }}">
                                                        <i class="fas fa-edit fa-lg"></i> </a>
                                                    <button type="button" data-id_delete="{{ $Lettre->lettreID }}"
                                                        data-toggle="modal" data-target="#ModalDelete"
                                                        class="btn btn-danger text-white"> <i
                                                            class="fas fa-trash fa-lg"></i> </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-4 mb-3 d-block mx-auto" style="width: fit-content;">
                                    {{ $Lettres->links() }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- -------------------- DELETE Modal  ------------------------- -->

<div class="modal fade left" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog model-notify modal-md modal-right modal-info" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">supprimer une lettre </h5>
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
                        cette lettre ?</p><br>



                    <button type="button" class="btn btn-primary" data-dismiss="modal" style="margin-left : 12%"><i
                            class="far fa-times-circle"></i>
                        Non/Annuler</button>
                    <button type="submit" class="btn btn-danger" style="margin-left : 12%"><i
                            class="fas fa-trash-alt"></i> Oui/Supprimer</button>
            </div>
            </form>

            <div id="msgSucc-delete" role="alert" style="background: rgb(214,233,198);background: linear-gradient(0deg, rgba(214,233,198,1) 0%, 
    rgba(198,233,229,1) 100%);" class="alert alert-success d-none">
                <i class="fa fa-check"></i> La lettre est supprimés
                avec
                succés !
            </div>

            <div id="msgDanger-delete" style="background: rgb(235,204,209);background: linear-gradient(0deg, rgba(235,204,209,1) 0%, 
      rgba(235,204,221,0.927608543417367) 100%);" role="alert" class="alert alert-danger d-none">
                <i class="fa fa-times"></i> La lettre n'est pas
                supprimée !
            </div>

        </div>
    </div>
</div>

@endsection




@section('script')
<script src=" {{ asset('js/FontAwesomeAll.min.js') }}"></script>

<script>

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
                url: "/LettreAuConfrere/" + Deletedid,
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

</script>

@endsection
