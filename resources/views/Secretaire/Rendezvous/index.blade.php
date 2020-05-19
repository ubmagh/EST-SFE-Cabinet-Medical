@extends('Secretaire.Parts.pageLayout')


@section('title','Rendez-vous')


@section('css')

<link rel="stylesheet" href="{{ asset('/css/main-core.min.css') }}">

{{-- <link rel="stylesheet" href="{{ asset('/css/main-daygrid.min.css') }}">
100% unsued --}}
<link rel="stylesheet" href="{{ asset('/css/main-timegrid.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/jquery.datetimepicker.min.css') }}">
<style>
    .fc-resized-row {}

</style>
@endsection



@section('content')

{{-- Add rdv --}}
<div class="content-wrapper">

    <div class="modal fade" id="AddRdv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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


                        <div class="form-group mb-0">
                            <label for="DateDebut">Date Debut :</label>
                            <input type="text" class="form-control" autocomplete="off" name="DateDebut" id="DateDebut">
                        </div>
                        <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                            id="datedebModal">
                            <span id="datedebError"></span>
                        </div>


                        <div class="form-group mb-0">
                            <label for="DateFin">Date Fin :</label>
                            <input type="text" class="form-control" autocomplete="off" name="DateFin" id="DateFin">
                        </div>
                        <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                            id="datefinModal">
                            <span id="datefinError"></span>
                        </div>


                        <div class="form-group mb-0">
                            <label for="message-text" class="col-form-label">Description :</label>
                            <textarea class="form-control" name="Description" rows="3" maxlength="255"
                                style="resize: none;"></textarea>
                            <small class="text-muted text-right d-block ml-auto">255 caractères</small>
                        </div>
                        <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                            id="descModal">
                            <span id="descError"></span>
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


    {{-- End Add Rdv --}}


    <div class="card w-100 p-0">
        <div class="card-body w-100 grid-margin  stretch-card " style="height: 480px;" id="LoaderSec">
            <div class="loader-demo-box border-0">
                <div class="dot-opacity-loader">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <div class="card-body w-100 d-none" id="PageContent">
            <div class="w-100 d-block text-center mt-4 mb-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddRdv">
                    <i class="fa fa-plus"></i>
                    Ajouter Rendez-Vous
                </button>

            </div>
            <div id="calendar" class="w-100 p-0 d-block"></div>
        </div>
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

</script>


{{-- les asset js pour le calendar --}}
<script src="{{ asset('/js/calendar/main-core.min.js') }}"></script>
<script src="{{ asset('/js/calendar/main-interaction.min.js') }}"></script>
<script src="{{ asset('/js/calendar/main-daygrid.min.js') }}"></script>
<script src="{{ asset('/js/calendar/main-timegrid.min.js') }}"></script>

<script>
    $('#custom-templates').find(">:first-child").addClass('w-100');

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('PageContent').classList.remove('d-none');
        document.getElementById('PageContent').classList.add('d-block');
        document.getElementById('LoaderSec').classList.add('d-none');

        const calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['timeGrid', 'interaction', "dayGrid"],
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
            eventOverlap: false,
            nowIndicator: true,
            defaultDate: '{{ date('Y-m-d') }}',
            navlinks: true,
            contentHeight: "auto",
            eventDurationEditable: true,
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
                    confirmButtonText: 'Supprimer',
                    cancelButtonText: 'Annuler',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value===true) {
                        //
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
                                    title: 'Rendezvous Supprimé',
                                    showConfirmation: false,
                                    timer: 1500
                                });
                            }
                        })
                    } else {//
                    }
                })
            },
            eventDrop: function (info) { // had fonction ela wd update dial chi rdv
                let Token = $('meta[name="csrf-token"]').attr('content') + "";
                $.ajaxSetup({
                    hearders: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'PUT',
                    url: '/Rendez-Vous/Update',

                    data: {
                        rdvID: info.event.id,
                        start: FullCalendar.formatDate(info.event.start, {
                            meridiem: false,
                            omitCommas: true,
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit',
                            hour: '2-digit',
                            minute: '2-digit',
                            hour12: false
                        }),
                        end: FullCalendar.formatDate(info.event.end, {
                            meridiem: false,
                            omitCommas: true,
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit',
                            hour: '2-digit',
                            minute: '2-digit',
                            hour12: false
                        }),
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
                    },
                    error: function (err) {
                        info.revert();
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Midification échouée : ' + err.responseJSON
                                .message,
                            showConfirmation: false,
                            timer: 1500
                        });
                    }

                })
            },
            eventResize: function (info) {
                let Token = $('meta[name="csrf-token"]').attr('content') + "";
                $.ajaxSetup({
                    hearders: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'PUT',
                    url: '/Rendez-Vous/Update',

                    data: {
                        rdvID: info.event.id,
                        start: FullCalendar.formatDate(info.event.start, {
                            meridiem: false,
                            omitCommas: true,
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit',
                            hour: '2-digit',
                            minute: '2-digit',
                            hour12: false
                        }),
                        end: FullCalendar.formatDate(info.event.end, {
                            meridiem: false,
                            omitCommas: true,
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit',
                            hour: '2-digit',
                            minute: '2-digit',
                            hour12: false
                        }),
                        _token: Token
                    },
                    success: function () {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Durée du Rendezvous modifié avec succès',
                            showConfirmation: false,
                            timer: 1500
                        });
                    },
                    error: function (err) {
                        info.revert();
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Midification de la durée est échouée : ' +
                                err.responseJSON.message,
                            showConfirmation: false,
                            timer: 1500
                        });
                    }
                });
            }

        });
        calendar.setOption('locale', 'FR');
        calendar.render();
        document.querySelector('.fc-today-button').classList.add('text-dark');
        document.querySelectorAll('.fc-day-header.fc-widget-header').forEach(node => node.classList.add(
            'text-center'));


    });

</script>
<script src="{{ asset('/js/jquery.datetimepicker.full.min.js') }}"></script>
<script>
    $('#DateDebut').datetimepicker({
        format: 'Y-m-d H:i',
        minDate: 0,
        minTime: '07:00',
        maxTime: '19:00',
        step: 30,
        defaultTime: '07:00',
        disabledWeekDays: [0],
    });
    $('#DateFin').datetimepicker({
        format: 'Y-m-d H:i',
        minTime: '07:30',
        maxTime: '19:30',
        step: 30,
        defaultTime: '19:00',
        disabledWeekDays: [0],
        onShow: function (ct) {
            this.setOptions({
                minDate: jQuery('#DateDebut').val() ? jQuery('#DateDebut').val() : jQuery('#DateDebut').val().split(' ').shift(),
                minTime: jQuery('#DateDebut').val() ? jQuery('#DateDebut').val().split(' ').pop() :
                    '07:30'
            })
        }
    });
    $.datetimepicker.setLocale('fr');


    $('#CreateForm').submit((e) => {
        e.preventDefault();
        $.ajaxSetup({
            hearders: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('/Rendez-Vous/Ressource') }}",
            type: 'POST',
            data: $('#CreateForm').serialize(),
            success: function (resp) {
                if (resp.status === "OK") {
                    $("#AddRdv").modal('toggle');
                    setTimeout(() => window.location.reload(), 1200);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Rendez-Vous bien ajouté',
                        showConfirmation: false,
                        timer: 1500
                    });
                } else {
                    $("#AddRdv").modal('toggle');
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Une erreure servenue:' + resp,
                        showConfirmation: false,
                        timer: 1500
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

                    if (response.errors.DateDebut) {
                        $('#datedebError').html(error.responseJSON.errors.DateDebut);
                        $('#datedebModal').removeClass('d-none').addClass('show');
                    }

                    if (response.errors.DateFin) {
                        $('#datefinError').html(error.responseJSON.errors.DateFin);
                        $('#datefinModal').removeClass('d-none').addClass('show');
                    }

                    if (response.errors.Description) {
                        $('#descError').html(error.responseJSON.errors.Description);
                        $('#descModal').removeClass('d-none').addClass('show');
                    }

                } else {
                    $("#AddRdv").modal('toggle');
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Une erreure servenue: ' + error.responseJSON.message,
                        showConfirmation: false,
                        timer: 1500
                    });
                }
            }
        });
    });

    /// closing modal and clearing all of thiere stored data
    $("#AddRdv").on('hide.bs.modal', function () {
        $(this).closest('form').find('input').val('');
        $(this).closest('form').find('textarea').val('');
        $(this).closest('form').find('textarea').html('');
        $('form .alert').removeClass('show').addClass('d-none');
        $('form .alert span').html('');
    });

</script>
@endsection
