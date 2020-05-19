@extends('Secretaire.Parts.pageLayout')


@section('title')
Secretaire : Liste d'Attente
@endsection

@section('css')
<style>
 

        .line { 
            display: flex; 
            flex-direction: row; 
        } 
          
        .line:before, 
        .line:after { 
            content: ""; 
            flex: 1 1; 
            border-bottom: 2px solid #000; 
            margin: auto; 
        } 
        
    .timeline-panel {
        cursor: pointer !important;
    }
</style>
@endsection


@section('content')

{{-- Modal Start --}}
<div class="modal fade" id="Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Ajouter Un Patient à la liste d'attente
                    </h5>
                </div>
                <div class="modal-body">

                    <div class="row d-block w-100 text-center mt-3 mb-5">
                        <h3 class="h3 text-center">
                            <a href="{{ url('/patient') }}" class="text-center"> <i class="fas fa-user-plus"></i> Nouveau patient ? </a>
                        </h3>
                    </div>

                    <div class="text-center my-4">
                            <h5 class="line">  Ou  </h2>
                    </div>

                    <form action="/Rendez-Vous/Ressource" method="POST" id="CreateForm" class="mt-4 mb-3">
                        {{ csrf_field() }}

                        <div class="form-group d-none" id="PatientDetails">
                            <label> Patient :</label>
                            <div class="card rounded border mb-2">
                                <div class="card-body p-3">
                                    <div class="media">
                                        <i class="ti-user icon-md align-self-center mr-3 "></i>
                                        <div class="media-body">
                                            <h6 class="mb-1" id="PatientName">Name</h6>
                                            <p class="mb-0 text-muted" id="PatientID">
                                                Identifiant : JC54584545
                                            </p>
                                        </div>
                                        <button type="button" class="float-right" id="removePatient"
                                            style="border: none; background-color: transparent; cursor: pointer;"><i
                                                class="fa fa-times fa-lg text-danger"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_civile" id="id_civile" />
                        <div class="form-group mb-0" id="PatientSearch">
                            <label for="date"> Chercher Patient :</label>
                            <div id="custom-templates" class="w-100">
                                <input data-role="tagsInput" class="w-100 typeahead form-control w-100"
                                    autocomplete="off" type="text" placeholder="identifiant civile - nom du patient"
                                    id="id_civile2" name="id_civile2" />
                            </div>
                        </div>
                        <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                            id="idcivileModal">
                            <span id="idcivileError"></span>
                        </div>


                       
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger dissmiss" data-dismiss="modal"><i
                            class="fa fa-times"></i> Annuler</button>
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i> Ajouter</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal End --}}


<div style="flex-grow: 1;min-height: calc(100vh - 135px - 75px); width:100%; display:block;">
    <div class="container-fluid py-4" style="min-height: 100% !important;">

        <div class="row d-block w-25 mx-auto my-4 text-center">
            <button type="button" class="btn btn-primary btn-block py-3 px-5 text-white h3 " data-toggle="modal" data-target="#Add"> <i class="fa fa-plus fa-lg ml-n1 mr-1"></i> Patient Arrivé </button>
        </div>

        <div class="row">
            <div class="col-7 stretch-card">
                
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

                    <div class="card-body d-none ContentSec">
                        <h4 class=" display-4  text-center "> Liste d'attente</h4>
                        @if(!count($liste_attente))
                        
                        <div class="w-100 my-4 py-4 px-3">
                            <div class="alert alert-info py-4 px-3" role="alert">
                                Aucun Patient à la liste d'attente
                            </div>
                        </div>
                        
                        @else
                        <div class="mt-5">
                            <div class="timeline">
                                    @foreach($liste_attente as $row)
                                        @if($i++ % 2 == 0)

                                            @if($row->startTime!=null)   {{-- Patient en cour de consultation --}}
                                            <div class="timeline-wrapper   timeline-wrapper-success ">
                                            @elseif($row->Urgent){{-- Patient en cas d'urgence --}}
                                            <div class="timeline-wrapper   timeline-wrapper-danger ">
                                            @else
                                                <div class="timeline-wrapper   timeline-wrapper-info ">
                                            @endif
                                                <div class="timeline-badge"></div>

                                                @if($row->startTime!=null) {{-- Patient en cour de consultation --}}
                                                <div class="timeline-panel" style="box-shadow: 2px 3px 35px 0 rgba(1, 180, 1, 0.5) !important; padding: 27px 15px;" data-sid="{{ $row->id }}" id="Context-patient-EnConsulta">
                                                @elseif($row->Urgent)
                                                <div class="timeline-panel Context-patient-Urgent" data-sid="{{ $row->id }}"  >
                                                @elseif($row->rdvID!=null)
                                                <div class="timeline-panel Context-patient-Ardv" data-sid="{{ $row->id }}"  >
                                                @else
                                                <div class="timeline-panel Context-patient" data-sid="{{ $row->id }}">
                                                @endif
                                                    <div class="timeline-heading">
                                                            {!! $patients["".$row->id] !!}
                                                    </div>
                                                    <div class="timeline-body">
                                                        <p> </p>
                                                    </div>
                                                    <div class="timeline-footer d-flex mt-2 align-items-center flex-wrap">
                                                        @if($row->startTime!=null)
                                                            <i class="fas fa-sync  text-success mr-1"> </i> <span class="text-success ">Consultation...</span>
                                                        @else
                                                            {!! $row->rdvID != null ? ' <i class="fas fa-clock mr-1 text-info"></i> <span class="text-info text-small">rdv à: '.substr($row->DateTimeDebut,11,5).' </span>':'' !!}
                                                            {!! $row->Urgent != null ? ' <i class="ti-alert text-danger mr-1"></i> <span class="text-small text-danger">URGENT</span>':'' !!}
                                                        @endif
                                                        
                                                        <span class="ml-md-auto font-weight-bold">Heure d'arrivée: {{ substr($row->DateArrive,11,5) }}</span>

                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                                @if($row->Urgent)
                                                    <div class="timeline-wrapper  timeline-inverted timeline-wrapper-danger ">
                                                @else
                                                    <div class="timeline-wrapper  timeline-inverted timeline-wrapper-info ">
                                                @endif
                                                <div class="timeline-badge"></div>
                                                
                                                @if($row->Urgent)
                                                <div class="timeline-panel Context-patient-Urgent" data-sid="{{ $row->id }}" >
                                                @elseif($row->rdvID!=null)
                                                <div class="timeline-panel Context-patient-Ardv" data-sid="{{ $row->id }}"  >
                                                @else
                                                <div class="timeline-panel Context-patient" data-sid="{{ $row->id }}">
                                                @endif
                                                    <div class="timeline-heading">
                                                            {!! $patients["".$row->id] !!}
                                                    </div>
                                                    <div class="timeline-body">
                                                        <p></p>
                                                    </div>
                                                    <div class="timeline-footer d-flex mt-2 align-items-center flex-wrap">

                                                        {!! $row->rdvID != null ? ' <i class="fas fa-clock mr-1 text-info"></i> <span class="text-info text-small">rdv à: '.substr($row->DateTimeDebut,11,5).'</span>':'' !!}
                                                        {!! $row->Urgent != null ? ' <i class="ti-alert text-danger mr-1"></i> <span class="text-small text-danger">URGENT</span>':'' !!}

                                                        <span class="ml-md-auto font-weight-bold"> Heure d'arrivée: {{ substr($row->DateArrive,11,5) }}</span>

                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    @endforeach                             
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-5 grid-margin stretch-card">
                <div class="card">

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
                        <h4 class=" display-4  text-center "> Les Rendez-Vous d'aujourd'hui </h4>

                        @if(!count($rdv_liste_attente))

                        <div class="w-100 my-4 py-4 px-3">
                            <div class="alert alert-info py-4 px-3" role="alert">
                                Aucun Rendez vous Aujourd'hui
                            </div>
                        </div>

                        @else
                        <div class="row mt-n3">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="order-listing" class="table">
                                        <thead>
                                            <tr>
                                                <th>Nom Complet</th>
                                                <th>CIN</th>
                                                <th>Heure</th>
                                                <th>Motif</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $rdv_liste_attente as $rdv )
                                                <tr>
                                                    <td>{{ $rdv->patient->Nom.' '. $rdv->patient->Prenom }}
                                                    </td>
                                                    <td class="text-info">{{ $rdv->patient->id_civile }}</td>
                                                    <td class="text-warning"> {{ substr($rdv->DateTimeDebut,10,16) }}</td>
                                                    <td class="text-muted"> {{ $rdv->Description }}</td>
                                                    <td>
                                                            
                                                            <button type="button" onclick="submitRdv({{$rdv->id}})" class="btn btn-primary btn-sm">
                                                                <i class="ti-plus"></i>
                                                            </button>

                                                    </td>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>

function submitRdv(rdvID){

    $.ajaxSetup({
            hearders: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: "{{ url('/SalleAttente_aprouveRdv/' ) }}"+'/'+rdvID,
            type: 'POST',
            data:{
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (resp) {
                if (resp.status === "done") {
                    setTimeout(() => window.location.reload(), 1000);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Rendez-Vous Confirmé',
                        showConfirmation: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'Une erreure servenue ' + resp,
                        showConfirmation: false,
                        timer: 1500
                    });
                }
            },
            error: function (error) {
                if (error.status=="NotFound") {
                        Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Rendez vous introuvable !',
                        showConfirmation: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Une erreure servenue',
                        showConfirmation: false,
                        timer: 1500
                    });
                }
            }
        });

};

///// Context menu logic
(function($) {
  'use strict';

  //// Patient en consultation
  $.contextMenu({
    selector: '#Context-patient-EnConsulta',
    zIndex: 10,
    callback: function(key, options) {
    },
    items: {
      "nothingTodo": {
        name: "Rien a faire, En attendant la fin de la consultation",
      },
    }
  });
  
  //// patient en cas d'urgence
  $.contextMenu({
    selector: '.Context-patient-Urgent',
    zIndex: 10,
    callback: function(key, options) {
      var m = "clicked: " + key;
    },
    build: function($triggerElement, e){
        return {
            callback: function(key, options) {
                    const sid = $triggerElement[0].dataset.sid;
                    var url = "";
                    //console.log("sid :"+sid+" key: "+key+" op: "+options);
                    switch(key){
                        case 'passe': 
                            url = 'NextPatient';
                        break;
                        case 'nonUrgent':
                            url='UnUrgent';
                        break;
                        case 'quit':
                            url= "Quit";
                            break;
                        }
                    $.ajaxSetup({
                    hearders: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),}
                            });
                    $.ajax({
                        url: "{{ url('/SalleAttente/') }}"+'/'+url+'/'+sid,
                        type: 'GET',
                        data:{
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (resp) {
                            if (resp.status === "Done") {
                                setTimeout(() => window.location.reload(), 1600);
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: ''+resp.message,
                                    showConfirmation: false,
                                    timer: 2500
                                });
                            } else {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'warning',
                                    title: ' ' + resp.message,
                                    showConfirmation: false,
                                    timer: 2500
                                });
                            }
                        },
                        error: function (error) {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: error.responseJSON.message,
                                    showConfirmation: false,
                                    timer: 2500
                                });
                            }
                        });
                    }
                }
            },
        items: {
                "passe": {name: " Passer à la consultation "},
                "nonUrgent": {name: " Non Urgent "},
                "quit": {name: " Quitté ",icon: function(){
                        return 'context-menu-icon context-menu-icon-quit';
                    }
                },
            }
        });

    /// contexte Menu d'un pat a rdv
    $.contextMenu({
    selector: '.Context-patient-Ardv',
    zIndex: 10,
    callback: function(key, options) {
    },
    build: function($triggerElement, e){
        return {
            callback: function(key, options) {
                    const sid = $triggerElement[0].dataset.sid;
                    var url = "";
                    //console.log("sid :"+sid+" key: "+key+" op: "+options);
                    switch(key){
                        case 'annuler': 
                            url = 'UndoRdv';
                        break;
                        case 'passe': 
                            url = 'NextPatient';
                        break;
                        case 'Urgent':
                            url='Urgent';
                        break;
                        case 'quit':
                            url= "Quit";
                            break;
                        }

                    $.ajaxSetup({
                    hearders: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),}
                            });
                    
                    $.ajax({
                        url: "{{ url('/SalleAttente/') }}"+'/'+url+'/'+sid,
                        type: 'GET',
                        data:{
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (resp) {
                            if (resp.status === "Done") {
                                setTimeout(() => window.location.reload(), 1500);
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: ''+resp.message,
                                    showConfirmation: false,
                                    timer: 2500
                                });
                            } else {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'warning',
                                    title: ' ' + resp.message,
                                    showConfirmation: false,
                                    timer: 2500
                                });
                            }
                        },
                        error: function (error) {
                                    Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: ''+error.responseJSON.message,
                                    showConfirmation: false,
                                    timer: 2500
                                });
                            }
                        });
                    }
                }
            },
        items: {
                "annuler": {name: " Annuler la confirmation du Rendez-vous "},
                "passe": {name: " Passer à la consultation "},
                "Urgent": {name: " Urgent "},
                "quit": {name: " Quitté ",icon: function(){
                        return 'context-menu-icon context-menu-icon-quit';
                    }
                },
            }
        });



    /// Normal patient
    $.contextMenu({
    selector: '.Context-patient',
    zIndex: 10,
    callback: function(key, options) {
    },
    build: function($triggerElement, e){
        return {
            callback: function(key, options) {
                    const sid = $triggerElement[0].dataset.sid;
                    var url = "";
                    //console.log("sid :"+sid+" key: "+key+" op: "+options);
                    switch(key){
                        case 'passe': 
                            url = 'NextPatient';
                        break;
                        case 'Urgent':
                            url='Urgent';
                        break;
                        case 'quit':
                            url= "Quit";
                            break;
                        }

                    $.ajaxSetup({
                    hearders: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),}
                            });
                    
                    $.ajax({
                        url: "{{ url('/SalleAttente/') }}"+'/'+url+'/'+sid,
                        type: 'GET',
                        data:{
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (resp) {
                            if (resp.status === "Done") {
                                setTimeout(() => window.location.reload(), 1500);
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: ''+resp.message,
                                    showConfirmation: false,
                                    timer: 2500
                                });
                            } else {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'warning',
                                    title: ' ' + resp.message,
                                    showConfirmation: false,
                                    timer: 2500
                                });
                            }
                        },
                        error: function (error) {
                                    Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: ''+error.responseJSON.message,
                                    showConfirmation: false,
                                    timer: 2500
                                });
                            }
                        });
                    }
                }
            },
        items: {
                "passe": {name: " Passer à la consultation "},
                "Urgent": {name: " Urgent "},
                "quit": {name: " Quitté ",icon: function(){
                        return 'context-menu-icon context-menu-icon-quit';
                    }
                },
            }
        });
    
    


})(jQuery);
</script>

<script src="{{ asset('/js/typeahead.bundle.min.js') }}"></script>
<script>
    var data = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: '{{ url('/Rendez-Vous/autocomplete') }}',
        remote: {
            url: '{{ url('/Rendez-Vous/autocomplete').'?query=%QUERY' }}',
            wildcard: '%QUERY'
        }
    });

    $('#custom-templates .typeahead').typeahead(null, {
        name: 'data',
        display: function (data) {
            return data.name + ' – ' + data.ID_c;
        },
        source: data,
        templates: {
            empty: [
                '<div class="empty-message text-center">',
                ' Patient Introuvable ! <a href="' + "{{ url('/patient') }}" +
                '"> <i class="fa fa-arrow-right" ></i> Créer d\'abord un ? </a> ',
                '</div>'
            ].join('\n'),
            suggestion: function (data) {
                return '<p><strong>' + data.name + '</strong> – ' + data.ID_c + '</p>';
            }
        }
    });

    $('#custom-templates .typeahead').bind('typeahead:select', function (ev, suggestion) {
        $('#PatientName').html(suggestion.name);
        $('#PatientID').html("Identifiant: " + suggestion.ID_c);
        $('#id_civile2').val(suggestion.ID_c);
        $('#id_civile').val(suggestion.ID_c);
        $('#PatientDetails').removeClass("d-none");
        $('#PatientSearch').addClass("d-none");
    });

    $('#removePatient').click(() => {
        $('#PatientName').html('');
        $('#PatientID').html('');
        $('#id_civile2').val('');
        $('#id_civile').val('');
        $('#PatientDetails').addClass("d-none");
        $('#PatientSearch').removeClass("d-none");
    });

    $('#custom-templates').find(">:first-child").addClass('w-100');
    
    $('#CreateForm').submit((e) => {
        e.preventDefault();
        $.ajaxSetup({
            hearders: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('/SalleAttente/Add') }}",
            type: 'POST',
            data: $('#CreateForm').serialize(),
            success: function (resp) {
                if (resp.status === "Done") {
                    $("#Add").modal('toggle');
                    setTimeout(() => window.location.reload(), 1200);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: ''+resp.message,
                        showConfirmation: false,
                        timer: 1800
                    });
                } else {
                    $("#Add").modal('toggle');
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: '' + resp.message,
                        showConfirmation: false,
                        timer: 1800
                    });
                }
            },
            error: function (error) {
                const response = error.responseJSON;
                const errors = response.errors;

                if (error.responseJSON.errors) {

                    if (response.errors.id_civile) {
                        $('#idcivileError').html(error.responseJSON.errors.id_civile);
                        $('#idcivileModal').removeClass('d-none').addClass('show');
                    }
                    

                } else {
                    $("#Add").modal('toggle');
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: ' ' + error.responseJSON.message,
                        showConfirmation: false,
                        timer: 2500
                    });
                }
            }
        });
    });

    /// closing modal and clearing all of thiere stored data
    $("#Add").on('hide.bs.modal', function () {
        $(this).closest('form').find('input').val('');
        $('form .alert').removeClass('show').addClass('d-none');
        $('form .alert span').html('');
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
@endsection
