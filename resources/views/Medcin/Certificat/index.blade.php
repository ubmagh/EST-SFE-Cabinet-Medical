@extends('Medcin.Parts.pageLayout')



@section('title')
Certificat Médical
@endsection



@section('content')

<div class="w-75 content-wrapper" style="max-width: none;">
    <div class="card col-12">


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
            <div class="row mx-auto w-100 mt-4 mb-0 py-3 text-center">
                <h3 class="h3 mx-auto font-weight-light"> Les Certificats : </h3>
            </div>
          <div class="row mx-auto w-100 mt-4 mb-3 py-3 ">
            <div class="col-md col-12 text-left">
                <a class="btn btn-primary" href="{{ url('CreateCertificat') }}" role="button">
                    <i class="fas fa-plus fa-lg"></i> 
                    Créer un Certificat 
                </a>
            </div>
            <div class="col-md col-12 text-right">
                <form method="GET" action="{{ url()->current() }}" class="col-12  ml-auto">
                    <div class="input-group">
                      <input type="text" aria-describedby="button-addon2" class="form-control border-dark" name="q" placeholder="chercher  ..." value="{{ $q? $q:null }}" />
                        <div class="input-group-append">
                            <button class="btn btn-outline-dark" type="submit" id="button-addon2"><i class="fas fa-search fa-lg"></i></button>
                        </div>
                    </div>
                </form>   
            </div>
          </div>
          
          @if( $q )
            <div class="row w-100 text-center"> 
                <h4 class="h4 mx-auto"> Résultats de recherche de : ` {{ $q }} `  <a href="{{url('Certificat')}}"> <i class="fas fa-times text-danger"></i> </a> </h4>
            </div>
          @endif

          <div class="table-responsive my-4">
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
                            Patient
                        </th>
                        <th>
                            Motif
                        </th>
                        <th class="text-center">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if( !count($certfs) )
                      <tr>
                        <td colspan="5" class="text-center"> Aucun Certificat Trouvé </td>
                      </tr>
                    @endif
                    @foreach( $certfs as $certf )
                        <tr>
                            <td class="py-1">
                                {{ ($counter-1)*10 + $certf->num }}
                            </td>
                            <td>
                                {{ substr($certf->date,0,11) }}
                            </td>
                            <td>
                              <a href="{{ url('FichePatient/'.$certf->PatientId) }}">
                                  {{ $certf->patient->Nom }}  {{ $certf->patient->Prenom }}
                              </a>
                            </td>
                            <td class="text-truncate">
                                {{ strlen($certf->Motif)>40? substr( $certf->Motif, 0,36).' ...' : $certf->Motif  }}
                            </td>
                            <td class="text-center">
                                <a name="" id="" class="btn btn-warning text-white" href="{{ url('PrintCertf/'.$certf->id) }}" >
                                  <i class="fas fa-eye fa-lg"></i> 
                                </a>
                                <button type="button" data-id_delete="{{ $certf->id }}" data-toggle="modal" data-target="#ModalDelete" class="btn btn-danger text-white"> 
                                  <i class="fas fa-trash fa-lg"></i> 
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-12 mx-auto px-5 mb-2">
            <div class="w-auto mx-auto text-center d-flex justify-content-center mt-4">
                  {{ $certfs->links() }}
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
                <h5 class="modal-title" id="exampleModalLabel">supprimer un Certificat </h5>
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
                        ce Certificat ?</p><br>



                    <button type="button" class="btn btn-primary" data-dismiss="modal" style="margin-left : 12%"><i
                            class="far fa-times-circle"></i>
                        Non/Annuler</button>
                    <button type="submit" class="btn btn-danger" style="margin-left : 12%"><i
                            class="fas fa-trash-alt"></i> Oui/Supprimer</button>
            </div>
            </form>

            <div id="msgSucc-delete" role="alert" style="background: rgb(214,233,198);background: linear-gradient(0deg, rgba(214,233,198,1) 0%, 
    rgba(198,233,229,1) 100%);" class="alert alert-success d-none">
                <i class="fa fa-check"></i>  Certificat supprimé
                avec
                succés !
            </div>

            <div id="msgDanger-delete" style="background: rgb(235,204,209);background: linear-gradient(0deg, rgba(235,204,209,1) 0%, 
      rgba(235,204,221,0.927608543417367) 100%);" role="alert" class="alert alert-danger d-none">
                <i class="fa fa-times"></i> Certificat n'est pas
                supprimé !
            </div>

        </div>
    </div>
</div>



@endsection




@section('script')


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
                url: "/Certificat/" + Deletedid,
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

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.LoaderSec').forEach(node=>{
            node.classList.add('d-none');
        });
        document.querySelectorAll('.ContentSec').forEach(node=>{
            node.classList.remove('d-none');
        });
    });
</script>
@endsection
