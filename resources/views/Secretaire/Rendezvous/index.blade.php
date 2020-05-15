@extends('Secretaire.Parts.pageLayout')


@section('title','Rendez-vous')


@section('css')

<link rel="stylesheet" href="{{ asset('/css/main-core.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/main-daygrid.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/main-timegrid.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/jquery.datetimepicker.min.css') }}">
<style>
    .fc-resized-row {}

</style>
@endsection



@section('content')

{{-- Add rdv --}}

<div class="modal fade" id="AddRdv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Ajouter Un Rendez-Vous
                </h5>
            </div>
            <div class="modal-body">
                <form action="/Rendez-Vous/Ressource" method="POST" id="CreateForm">
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
                                <button type="button" class="float-right" id="removePatient" style="border: none; background-color: transparent; cursor: pointer;"><i class="fa fa-times fa-lg text-danger" ></i></button>                            
                              </div> 
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="PatientSearch">
                        <label for="date"> Chercher Patient :</label>
                        <div id="custom-templates" class="w-100">
                            <input data-role="tagsInput" class="w-100 typeahead form-control w-100" autocomplete="off" type="text" placeholder="identifiant civile - nom du patient" id="id_civile" name="id_civile" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date">Date Debut :</label>
                        <input type="text" class="form-control" autocomplete="off" name="DateDebut" id="DateDebut">
                    </div>
                    <div class="form-group">
                        <label for="date">Date Fin :</label>
                        <input type="text" class="form-control" autocomplete="off" name="DateFin" id="DateFin">
                    </div>
                    
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Description :</label>
                        <textarea class="form-control" name="Description" rows="3" maxlength="255" style="resize: none;"></textarea>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
                <button type="submit" class="btn btn-primary"> <i class="fa fa-check" ></i> Ajouter</button>
            </div>
            </form>
        </div>
    </div>
</div>


{{-- End Add Rdv --}}


    <div class="card w-100 p-0">
        <div class="card-body w-100 ">
            <div class="w-100 d-block">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddRdv">
                    <i class="fa fa-plus"></i>
                    Ajouter Rendez-Vous
                </button>
                
            </div>
            <div id="calendar" class="w-100 p-0 d-block"></div>
        </div>
    </div>

@endsection

@section('script')





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
  display: function(data){
    return  data.name + ' – ' + data.ID_c ;
  },
  source: data,
  templates: {
    empty: [
      '<div class="empty-message text-center">',
        ' Patient Introuvable ! <a href="'+"{{ url('/patient') }}"+'"> <i class="fa fa-arrow-right" ></i> Créer d\'abord un ? </a> ',
      '</div>'
    ].join('\n'),
    suggestion:function(data) {
    return '<p><strong>' + data.name + '</strong> – ' + data.ID_c + '</p>';
    } 
  }
});

$('#custom-templates .typeahead').bind('typeahead:select', function(ev, suggestion) {
    $('#PatientName').html(suggestion.name);
    $('#PatientID').html("Identifiant: "+suggestion.ID_c);
    $('#id_civile').val(suggestion.ID_c);
    $('#PatientDetails').removeClass("d-none");
    $('#PatientSearch').addClass("d-none");
});

$('#removePatient').click(()=>{
    $('#PatientName').html('');
    $('#PatientID').html('');
    $('#id_civile').val('');
    $('#PatientDetails').addClass("d-none");
    $('#PatientSearch').removeClass("d-none");
});

</script>


{{-- les asset js pour le calendar --}}
<script src="{{ asset('/js/calendar/main-core.min.js') }}"></script>
<script src="{{ asset('/js/calendar/main-interaction.min.js') }}"></script>
<script src="{{ asset('/js/calendar/main-daygrid.min.js') }}"></script>
<script src="{{ asset('/js/calendar/main-timegrid.min.js') }}"></script>

<script>

    $('#custom-templates').find(">:first-child").addClass('w-100');
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['timeGrid', 'interaction',"dayGrid" ],
            columnHeaderFormat: {
                weekday: 'long',
                day: 'numeric',
                omitCommas: true
            },
            header: {
                right: 'prev,today,next ',
                left: 'title',
                center: "timeGridWeek,timeGridDay"
            },
            buttonText: {
                today: "Aujourd'hui",
                week: "Semaine",
                day: "Jour"
            },
            minTime: '07:00:00',
            maxTime: '19:00:00',
            hiddenDays: [0],
            allDaySlot: false,
            allDayText: ' ',
            height: 'auto',
            defaultView: "timeGridWeek",
            slotLabelFormat: {
                hour: "numeric",
                minute: "2-digit",
                omitZeroMinute: false,
                meridiem: ""
            },
            eventOverlap:false,
            nowIndicator: true,
            defaultDate: '{{ date('Y-m-d') }}',
            navlinks: true,
            contentHeight: "auto",
            eventDurationEditable:true,
            editable: true, //ela wd modification f calendar
            selectable: false, // ela wd selection f calendar (zro9ia likatbanlik ila cliquiti)
            eventLimit: true, // ela wd bzzf d rdv f wahd nhar
            events: '/Rendez-Vous/Ressource', // had api ela wd affichage f calendar
            eventClick: function (info) { // hadi ela wd ila clikiti ela shi rdv i2afichi lik delete..
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-info',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Veuillez choisir une action :',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Annuler',
                    cancelButtonText: 'Supprimer',
                    reverseButtons: false
                }).then((result) => {
                    if (result.value) {
                        //
                    } else {
                        $.ajaxSetup({
                            hearders: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            }
                        });
                        let Token = $('meta[name="csrf-token"]').attr('content') + "";
                        //console.log(Token);
                        $.ajax({
                            type: 'DELETE',
                            url: '/Rendez-Vous/Ressource/' + info.event.id,
                            data: {
                                _token: Token
                            },
                            success: function () {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Rdv Supprimé',
                                    showConfirmation: false,
                                    timer: 1500
                                });
                                location.reload();
                            }
                        })
                    }
                })
            },
            eventDrop: function (info) { // had fonction ela wd update dial chi rdv
                let true_date = info.event.start.getFullYear() + '-' + (info.event.start
                    .getMonth() + 1) + '-' + info.event.start.getDate();
                let true_heure = info.event.start.getHours() + ':' + info.event.start.getMinutes() +
                    ":" + info.event.start.getSeconds();
                let Token = $('meta[name="csrf-token"]').attr('content') + "";
                //console.log(token);
                let id = info.event.Description;
                //alert(info.true_heure);
                $.ajaxSetup({
                    hearders: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'PUT',
                    url: '/Rendez-Vous/Update',

                    data: {
                        //Description : title,
                        rdvID: info.event.id,
                        Date: true_date,
                        Heure: true_heure,
                        //PatientId : 1,
                        //SecretaireId : 1,
                        //Status : 'daba',
                        _token: Token
                    },
                    success: function () {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Rendezvous modifié',
                            showConfirmation: false,
                            timer: 1500
                        });
                    }
                })
            }

        });
        calendar.setOption('locale', 'FR');
        calendar.render();
        document.querySelector('.fc-today-button').classList.add('text-dark');
        document.querySelectorAll('.fc-day-header.fc-widget-header').forEach(node => node.classList.add('text-center'));


    });
    </script>
    <script src="{{ asset('/js/jquery.datetimepicker.full.min.js') }}"></script>
    <script> 
    $('#DateDebut').datetimepicker({
        format:'Y-m-d H:i',
        minDate:0,
        minTime:'07:00',
        maxTime:'20:00',
        step:30,
        defaultTime:'08:00',
        disabledWeekDays:[0],
    }); 
    $('#DateFin').datetimepicker({
        format:'Y-m-d H:i',
        minTime:'07:00',
        maxTime:'20:00',
        step:30,
        defaultTime:'08:00',
        disabledWeekDays:[0],
        onShow:function( ct ){
            this.setOptions({
                minDate:jQuery('#DateDebut').val()?jQuery('#DateDebut').val():false,
                minTime:jQuery('#DateDebut').val()?jQuery('#DateDebut').val().split(' ').pop():false
            })
        }
    }); 
    $.datetimepicker.setLocale('fr');


    $('#CreateForm').submit((e)=>{
        e.preventDefault();
        $.ajax({
            url: {{url('/Rendez-Vous/Ressource')}},
            type: 'POST',
            data: $(this).serialize();
            success: function (resp) {
                if (resp.status === "OK") {
                    $('#DELETEmodal').hide();
                    $("#deleteModal_SuccessSection").removeClass('d-none').show();
                    setTimeout(() => window.location.reload(), 1200);
                    Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Rendez-Vous bien ajouté',
                                    showConfirmation: false,
                                    timer: 1500
                                });
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
    </script>
@endsection
