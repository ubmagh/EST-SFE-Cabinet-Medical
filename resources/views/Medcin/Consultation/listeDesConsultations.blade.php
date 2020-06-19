@extends('Medcin.Parts.pageLayout')



@section('title')
Liste des consultation
@endsection



@section('content')


<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="row grid-margin">
                        <div class="col-12">
                            <h3 class="h3 text-center mx-auto mt-4 mb-0 font-weight-light"> Liste des consultations :
                            </h3>
                        </div>
                    </div>

                    <div class="row mt-2 mx-auto mb-5 w-100">
                        <form method="GET" action="{{ url()->current() }}" class="col-md-8 col-12 py-3 mx-auto">
                            <div class="input-group">
                                <input type="text" aria-describedby="button-addon2" class="form-control border-dark" name="q"
                                    placeholder="chercher dans les Consultations ..." value="{{ $q? $q:null }}" />
                                <div class="input-group-append">
                                    <button class="btn btn-outline-dark" type="submit" id="button-addon2"><i
                                            class="fas fa-search fa-lg"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>

                    @if( $q )
                        <div class="row w-100 text-center mb-3 mt-n3"> 
                            <h4 class="h4 mx-auto"> Résultats de recherche de : ` {{ $q }} `  <a href="{{url('ListeConsultations')}}"> <i class="fas fa-times text-danger"></i> </a> </h4>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="order-listing" class="table">
                                    <thead>
                                        <tr class="bg-primary text-white">
                                            <th class="text-center">#</th>
                                            <th class="text-center">Patient</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Type de consultation</th>
                                            <th class="text-center">Titre de consultation</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($consultation as $consultations)
                                            <tr>
                                                <td class="text-center">{{ ($counter-1)*10+ $consultations->num }}</td>
                                                <td class="text-center"> <a
                                                        href="{{ url('FichePatient',$consultations->patient->id) }}"
                                                        target="_blank"> {{ $consultations->patient->Nom }}
                                                        {{ $consultations->patient->Prenom }} </a></td>
                                                <td class="text-center">{{ $consultations->Date }}</td>
                                                <td class="text-center">{{ $consultations->Type }}</td>
                                                <td class="text-center">{{ $consultations->Description }}</td>
                                                <td class="px-0 text-center">

                                                    <a  href="{{ url("ConsultationEdit",$consultations->id) }}"
                                                        class="btn btn-light">
                                                        <i class="ti-check-box text-primary"></i>Modifier
                                                    </a>

                                                    <button
                                                        data-id_delete="{{ $consultations['id'] }}"
                                                        data-toggle="modal" data-target="#ModalDelete"
                                                        class="btn btn-light">
                                                        <i class="ti-close text-danger"></i>Supprimer
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                                <div class="col-12 mx-auto px-5 mb-2">
                                    <div class="w-auto mx-auto text-center d-flex justify-content-center mt-3">
                                        {{ $consultation->links() }}
                                    </div>
                                </div>
                            
                                <!-- -------------------- DELETE Modal  ------------------------- -->

                                <div class="modal fade left" id="ModalDelete" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog model-notify modal-md modal-right modal-info"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Suppression du
                                                    Consultation</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
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
                                                        cette consultation ?</p><br>



                                                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                                                        style="margin-left : 12%"><i class="far fa-times-circle"></i>
                                                        Non/Annuler</button>
                                                    <button type="submit" class="btn btn-danger"
                                                        style="margin-left : 12%"><i class="fas fa-trash-alt"></i>
                                                        Oui/Supprimer</button>
                                            </div>
                                            </form>

                                            <div id="msgSucc-delete" role="alert" style="background: rgb(214,233,198);background: linear-gradient(0deg, rgba(214,233,198,1) 0%, 
rgba(198,233,229,1) 100%);" class="alert alert-success d-none">
                                                <i class="fa fa-check"></i> <strong>Succés!</strong> La consultation est
                                                supprimée
                                                avec
                                                succés !
                                            </div>

                                            <div id="msgDanger-delete" style="background: rgb(235,204,209);background: linear-gradient(0deg, rgba(235,204,209,1) 0%, 
rgba(235,204,221,0.927608543417367) 100%);" role="alert" class="alert alert-danger d-none">
                                                <i class="fa fa-times"></i> <strong>Danger !</strong> La consultation
                                                n'est pas été
                                                supprimée !
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
                url: "/ListeConsultationCabinet/delete/" + Deletedid,
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

    //*******************************Edit Form*****************************************


   


    const dataTable_Place_Holder = "Consultation";
    const OnMyPaginationNSearch = false;
    const dataTable_Search_label = "Chercher : ";
    const dataTable_nbr_lines_language = "Afficher _MENU_ lignes";
    const dataTable_Order_string = "asc"; /// "desc" for descendent order
    const dataTable_can_sort_columns__ = [{
        "orderable": false,
        "targets": [5]
    }];

</script>

<script src=" {{ asset('js/data-table.js') }}"></script>


@endsection
