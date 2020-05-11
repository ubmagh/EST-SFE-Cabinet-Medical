@extends('Secretaire.Parts.pageLayout')


@section('title','Rendez-vous')


@section('css')

<link rel="stylesheet" href="{{ asset('/css/main-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/main-core.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/main-daygrid.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/main-timegrid.min.css') }}">

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
                <form action="/rdv" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="date"> Identifiant Civile :</label>
                        <input class="typeahead form-control" type="text" autocomplete="off" name="id_civile">
                    </div>
                    <div class="form-group">
                        <label for="date">Date :</label>
                        <input type="date" class="form-control" name="Date">
                    </div>
                    <div class="form-group">
                        <label for="date">Heure :</label>
                        <input type="time" class="form-control" name="Heure">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Description :</label>
                        <textarea class="form-control" name="Description"></textarea>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
            </form>
        </div>
    </div>
</div>


{{-- End Add Rdv --}}

<div class="contenner border border-blue my-2">

    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddRdv">
                Ajouter Rendez-Vous
            </button>

            <div id="calendar" class="full-calendar"></div>
        </div>
    </div>
</div>

@endsection

@section('script')

{{-- hado dial autocomplete dial patient --}}

<script src="{{ asset('/js/bootstrap3-typeahead.min.js') }}"></script>
<script type="text/javascript">
    var path = "{{ url('/autocomplete') }}";

    $('input.typeahead').typeahead({

        source: function (query, process) {

            return $.get(path, {
                query: query
            }, function (data) {

                return process(data);

            });

        }

    });

</script>
{{-- END OF  autocomplete  patient --}}


{{-- les asset js pour le calendar --}}
<script src="{{ asset('/js/calendar/main-core.min.js') }}"></script>
<script src="{{ asset('/js/calendar/main-interaction.min.js') }}"></script>
<script src="{{ asset('/js/calendar/main-daygrid.min.js') }}"></script>
<script src="{{ asset('/js/calendar/main-timegrid.min.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');

        const calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['timeGrid', 'interaction'],
            //slotDuration: '02:00' ,
            header: {
                left: 'prevYear,prev,next,nextYear today',
                center: 'title',
                right: 'dayGridMonth, dayGridWeek, dayGridDay'
            },
            defaultDate: '{{ date('Y-m-d') }}',
            navlinks: true,
            editable: true, //ela wd modification f calendar
            selectable: true, // ela wd selection f calendar (zro9ia likatbanlik ila cliquiti)
            eventLimit: true, // ela wd bzzf d rdv f wahd nhar
            events: '/rdv', // had api ela wd affichage f calendar
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
                            url: '/rdv/' + info.event.id,
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
            // select : function(selectionInfo){ // had fonction ela wd ajout dial chi rdv
            //   let title = prompt("voila");
            //   let true_date = selectionInfo.start.getFullYear() + '-' + (selectionInfo.start.getMonth()+1) + '-' +selectionInfo.start.getDate();
            //   let true_heure = selectionInfo.start.getHours() + ':' + selectionInfo.start.getMinutes() + ":" + selectionInfo.start.getSeconds();                                    
            //   let Token =  $('meta[name="csrf-token"]').attr('content')+"";
            //    //alert(true_heure);
            //    $.ajaxSetup({
            //        hearders : {
            //          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            //        }
            //    });
            //    console.log(token);
            //    $.ajax({
            //      type: 'POST',
            //      url : '/rdv',
            //      data : {
            //       Description : title,
            //       Date : true_date,
            //       Heure : true_heure,
            //       PatientId : 1,
            //       SecretaireId : 1,
            //       Status : 'daba',
            //       _token : Token
            //      },
            //      success : function(){
            //        Swal.fire({
            //          position : 'center',
            //          icon : 'success',
            //          title : 'Rdv ajouté',
            //          showConfirmation : false,
            //          timer :1500
            //        });
            //        location.reload();
            //      }
            //    })         
            // },
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
                console.log(info.event);
                $.ajax({
                    type: 'PUT',
                    url: '/rdv_update',

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
                            title: 'Rdv modifé',
                            showConfirmation: false,
                            timer: 1500
                        });
                    }
                })
            }
        });
        calendar.setOption('locale', 'FR');
        calendar.render();
        document.querySelector('.fc-today-button').innerHTML ="Aujourd'hui"; // drtha hit calendar par défaut kay3tik dakshi b anglais
    });

</script>


@endsection
