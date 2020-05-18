@extends('Secretaire.Parts.pageLayout')


@section('title')
Secretaire : Liste d'Attente
@endsection

@section('css')
<style>
    .timeline-panel {
        cursor: pointer !important;
    }
</style>
@endsection


@section('content')
<div style="flex-grow: 1;min-height: calc(100vh - 135px - 75px); width:100%; display:block;">
    <div class="container-fluid py-4">
        <div class="row d-block w-100 my-4 text-center">

        </div>
        <div class="row">
            <div class="col-7 ">
                <div class="card">
                    <div class="card-body">
                        <h4 class=" display-4  text-center "> Liste d'attente</h4>

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
                                                        {!! $row->rdvID != null ? ' <i class="fas fa-clock mr-1 text-info"></i> <span class="text-info text-small">à rdv</span>':'' !!}
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

                                                    {!! $row->rdvID != null ? ' <i class="fas fa-clock mr-1 text-info"></i> <span class="text-info text-small">à rdv</span>':'' !!}
                                                    {!! $row->Urgent != null ? ' <i class="ti-alert text-danger mr-1"></i> <span class="text-small text-danger">URGENT</span>':'' !!}

                                                    <span class="ml-md-auto font-weight-bold"> Heure d'arrivée: {{ substr($row->DateArrive,11,5) }}</span>

                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                @endforeach                             

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5 grid-margin stretch-card">
                <div class="card " style="height: fit-content;">
                    <div class="card-body">
                        <h4 class=" display-4  text-center "> Les Rendez-Vous d'aujourd'hui </h4>

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
                    console.log("sid :"+sid+" key: "+key+" op: "+options);
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
                            console.log(error);
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


    /// Normal patient
    $.contextMenu({
    selector: '.Context-patient',
    zIndex: 10,
    callback: function(key, options) {
      var m = "clicked: " + key;
    },
    build: function($triggerElement, e){
        return {
            callback: function(key, options) {
                    const sid = $triggerElement[0].dataset.sid;
                    var url = "";
                    console.log("sid :"+sid+" key: "+key+" op: "+options);
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
                            if (resp.status === "done") {
                                //setTimeout(() => window.location.reload(), 1000);
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: ''+resp.message,
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
                                    Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Rendez vous introuvable !',
                                    showConfirmation: false,
                                    timer: 1500
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
    
    


})(jQuery);


</script>
@endsection
