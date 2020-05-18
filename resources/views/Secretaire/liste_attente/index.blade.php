@extends('Secretaire.Parts.pageLayout')


@section('title')
Secretaire : Liste d'Attente
@endsection

@section('css')

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

                                        @if($row->startTime!=null)
                                        <div class="timeline-wrapper   timeline-wrapper-success ">
                                        @elseif($row->Urgent)
                                        <div class="timeline-wrapper   timeline-wrapper-danger ">
                                        @else
                                            <div class="timeline-wrapper   timeline-wrapper-info ">
                                        @endif
                                            <div class="timeline-badge"></div>

                                            @if($row->startTime!=null)
                                            <div class="timeline-panel" style="box-shadow: 2px 3px 35px 0 rgba(1, 180, 1, 0.5) !important; padding: 27px 15px;">
                                                @else
                                            <div class="timeline-panel">
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
                                                        {!! $row->rdvID != null ? ' <i class="icon-clock mr-1"></i> <span class="text-info text-small">à rdv</span>':'' !!}
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
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                        {!! $patients["".$row->id] !!}
                                                </div>
                                                <div class="timeline-body">
                                                    <p></p>
                                                </div>
                                                <div class="timeline-footer d-flex mt-2 align-items-center flex-wrap">

                                                    {!! $row->rdvID != null ? ' <i class="icon-clock text-info mr-1"></i> <span class="text-info text-small">à rdv</span>':'' !!}
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
                                                        <form action="/SalleAttente_aprouveRdv/{{ $rdv->id }}" method="POST">
                                                            {{ csrf_field() }}
                                                            {{ method_field('POST') }}
                                                            <button type="submit" class="btn btn-primary btn-sm">
                                                                <i class="ti-plus"></i>
                                                            </button>

                                                        </form>
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

@endsection
