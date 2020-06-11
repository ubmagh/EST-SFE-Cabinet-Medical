@extends('Medcin.Parts.pageLayout')

@section('title','Dossier Medical: '.$patient->Nom.' '.$patient->Prenom)

@section('content')

<div class="content-wrapper" style="max-width: 85% !important;">

    <div class="card card-fluid mb-3">
        <div class="card-body w-100 grid-margin  stretch-card LoaderSec" style="height: 480px;" >
                        <div class="loader-demo-box border-0">
                            <div class="dot-opacity-loader">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
        </div>
        <div class="card-body py-4 d-none ContentSec">

            <div class="row w-50 mx-auto text-center mt-4 mb-5">
                <h2 class="mx-auto d-block font-weight-light h2"> Informations sur le patient: </h2>
                <div class="col-12 d-block">
                    <hr class="d-block text-secondary mx-auto" />
                </div>
            </div>

            <div class="row col-md-9 col-10 mx-auto mt-3">
                <div class="col-md col-12  text-center">
                    <h4 class="h4 font-weight-normal"> <span class="font-weight-bold">Nom : </span>
                        {{ $patient->Nom }} </h4>
                </div>
                <div class="col-md col-12  text-center">
                    <h4 class="h4 font-weight-normal"> <span class="font-weight-bold">Prenom : </span>
                        {{ $patient->Prenom }} </h4>
                </div>
                <div class="col-md col-12  text-center">
                    <h4 class="h4 font-weight-normal"> <span class="font-weight-bold">Sexe : </span>
                        {{ $patient->Sexe }} </h4>
                </div>
            </div>
            <div class="row col-md-9 col-10 mx-auto mt-3">
                <div class="col-md col-12  text-center">
                    <h4 class="h4 font-weight-normal"> <span class="font-weight-bold">Age : </span> {{ $age }} </h4>
                </div>
                <div class="col-md col-12  text-center">
                    <h4 class="h4 font-weight-normal"> <span class="font-weight-bold">Occupation : </span>
                        {{ $patient->Occupation }} </h4>
                </div>
                <div class="col-md col-12  text-center">
                    <h4 class="h4 font-weight-normal"> <span class="font-weight-bold">Mutuel : </span> <span
                            class="text-dark"> {!! $patient->typeMutuel ? $patient->typeMutuel.' </span> <span
                            class="text-secondary"> N°: '.$patient->ref_mutuel.' </span>':' - ' !!} </h4>
                </div>
            </div>

            <div class="row col-md-9 col-10 mx-auto mt-4 mb-2  ">
                <div class="col-md col-12 text-center">
                    @if($lastCons)
                        <a class="btn btn-inverse-warning mx-auto disabled" disabled href="#"> <i
                                class="fas fa-clock"></i> Dernière Consultation: <span id="last"></span> </a>
                    @endif
                </div>
                <div class="col-md col-12 text-center">
                    <a class="btn btn-inverse-info mx-auto"
                        href="{{ url('FichePatient',$patient->id) }}" target="_blank"> <i
                            class="fas fa-plus"></i> Plus d'informations </a>
                </div>
                <div class="col-md col-12 text-center">
                    <a class="btn btn-inverse-success mx-auto disabled" disabled href="#"> <i class="fas fa-flag"></i>
                        nombre de Consultations : {{ $nbrCons->num }}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-fluid mt-3">
        <div class="card-body w-100 grid-margin  stretch-card LoaderSec" style="height: 480px;" >
                        <div class="loader-demo-box border-0">
                            <div class="dot-opacity-loader">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
        </div>

        <div class="card-body py-4 d-none ContentSec">

            <div class="row w-50 mx-auto text-center mt-4 mb-3">
                <h2 class="mx-auto d-block font-weight-light h2"> Liste des consultations: </h2>
                <div class="col-12 d-block">
                    <hr class="d-block text-secondary mx-auto" />
                </div>
            </div>


            {{-- Archive des consultations Loops --}}


            <div class="row col-12 my-2">
                <div class="col-3">
                    <ul class="nav nav-tabs nav-tabs-vertical-custom" role="tablist">

                        {{-- les tabs à gauche --}}

                        @foreach ($consultations as $key => $consultation )
                               
                            <li class="nav-item border border-top border-white border-left-0 border-bottom-0 border-right-0 ">
                                <a class="nav-link {{ !$key? "active show":"" }} border-0 " id="consTab{{$consultation->id}}" data-toggle="tab" href="#consultation{{$consultation->id}}" role="tab"
                                    aria-controls="consultation{{$consultation->id}}" aria-selected="{{ !$key? "true":"false" }}">
                                    <p class="float-right"> 
                                    @if( $consultation->Urgent )
                                            <i class="ti-alert text-danger ti-lg" style="font-size: 28px;"></i> 
                                    @endif
                                    @if( $consultation->salleAttente )
                                        @if($consultation->salleAttente->rdvID)
                                            <i class="far fa-clock text-success" style="font-size: 28px;"></i>
                                        @endif
                                    @endif

                                    </p>
                                    <p class="DateTime w-100 text-left ml-3">{{$consultation->Date}}</p>
                                    <span style="font-size: medium;">
                                        {{ $consultation->Description }}
                                    </span>
                                </a>
                            </li>

                        @endforeach

                    </ul>
                </div>
                <div class="col-9 ">
                    <div class="tab-content tab-content-vertical tab-content-vertical-custom">

                        @foreach ( $consultations as $key => $consultation  )
                            <div class="tab-pane fade  {{ !$key? "show active":"" }} border rounded border-secondary py-3 " id="consultation{{$consultation->id}}" role="tabpanel"
                                aria-labelledby="consTab{{$consultation->id}}">

                                {{-- The Tabs Inside ! --}}


                                 <ul class=" d-flex justify-content-center nav nav-pills nav-pills-success col-11 mx-auto mt-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pillsDC{{$consultation->id}}" data-toggle="pill" href="#ContentDC{{$consultation->id}}" role="tab" aria-controls="ContentDC{{$consultation->id}}" aria-selected="true"> <i class="fas fa-info fa-lg"></i> Détails de la Consultation</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pillsEX{{$consultation->id}}" data-toggle="pill" href="#ContentEX{{$consultation->id}}" role="tab" aria-controls="ContentEX{{$consultation->id}}" aria-selected="false"><i class="fas fa-stethoscope fa-lg"></i> Mesures & Examens</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pillsOps{{$consultation->id}}" data-toggle="pill" href="#ContentOps{{$consultation->id}}" role="tab" aria-controls="ContentOps{{$consultation->id}}" aria-selected="false"><i class="fas fa-microscope fa-lg"></i> Opérations </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pillsMed{{$consultation->id}}" data-toggle="pill" href="#ContentMed{{$consultation->id}}" role="tab" aria-controls="ContentMed{{$consultation->id}}" aria-selected="false"><i class="fas fa-prescription-bottle-alt fa-lg"></i> Medicaments </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pillsFA{{$consultation->id}}" data-toggle="pill" href="#ContentFA{{$consultation->id}}" role="tab" aria-controls="ContentFA{{$consultation->id}}" aria-selected="false"><i class="fas fa-file-medical fa-lg"></i> Fichiers Ajoutés </a>
                                    </li>
                                </ul>                                

                                <div class="tab-content border-0 mt-3" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="ContentDC{{$consultation->id}}" role="tabpanel" aria-labelledby="pillsDC{{$consultation->id}}">
                                        <div class="media">
                                            <img class="mr-3 w-25 rounded" src="../../images/samples/300x300/12.jpg" alt="sample image">
                                            <div class="media-body">
                                                <h5 class="mt-0">I'm doing mental jumping jacks.</h5>
                                                <p>Only you could make those words cute. Oh I beg to differ, I think we have a lot to discuss. After all, you are a client. I am not a killer. I feel like a 
                                                    jigsaw puzzle missing a piece. And I'm not even sure what the picture should be.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="ContentEX{{$consultation->id}}" role="tabpanel" aria-labelledby="pillsEX{{$consultation->id}}">
                                        <div class="media">
                                            <img class="mr-3 w-25 rounded" src="http://www.urbanui.com/" alt="sample image">
                                            <div class="media-body">
                                            <p>I'm thinking two circus clowns dancing. You? Finding a needle in a haystack isn't hard when every straw is computerized. Tell him time is of the essence. 
                                                Somehow, I doubt that. You have a good heart, Dexter.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="ContentOps{{$consultation->id}}" role="tabpanel" aria-labelledby="pillsOps{{$consultation->id}}">
                                        <div class="media">
                                            <img class="mr-3 w-25 rounded" src="../../images/samples/300x300/14.jpg" alt="sample image">
                                            <div class="media-body">
                                            <p>
                                                I'm really more an apartment person. This man is a knight in shining armor. Oh I beg to differ, I think we have a lot to discuss. After all, you are a client. You all right, Dexter?
                                            </p>
                                            <p>
                                                I'm generally confused most of the time. Cops, another community I'm not part of. You're a killer. I catch killers. Hello, Dexter Morgan.
                                            </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="ContentMed{{$consultation->id}}" role="tabpanel" aria-labelledby="pillsMed{{$consultation->id}}">
                                        <div class="media">
                                            <img class="mr-3 w-25 rounded" src="../../images/samples/300x300/14.jpg" alt="sample image">
                                            <div class="media-body">
                                            <p>
                                                I'm really more an apartment person. This man is a knight in shiningqsdqsdqsdqsdiiqjjoiduqosi armor. Oh I beg to differ, I think we have a lot to discuss. After all, you are a client. You all right, Dexter?
                                            </p>
                                            <p>
                                                I'm generally confused most of the time. Cops, another community I'm not part of. You're a killer. I catch killers. Hello, Dexter Morgan.
                                            </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="ContentFA{{$consultation->id}}" role="tabpanel" aria-labelledby="pillsFA{{$consultation->id}}">
                                        <div class="media">
                                            <img class="mr-3 w-25 rounded" src="../../images/samples/300x300/14.jpg" alt="sample image">
                                            <div class="media-body">
                                            <p>
                                                I'm really more an apartment person. This man is a knight in shiningqsdqsdqsdqsdiiqjjoiduqosi armor. Oh I beg to differ, I think we have a lot to discuss. After all, you are a client. You all right, Dexter?
                                            </p>
                                            <p>
                                                I'm generally confused most of the time. Cops, another community I'm not part of. You're a killer. I catch killers. Hello, Dexter Morgan.
                                            </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                

                            </div>
                        @endforeach

                    </div>
                </div>
            </div>


            {{-- --}}

        </div>


        <div class="row col-md-6 mx-auto text-center mt-3 mb-4">
            {{ $consultations->links() }}
        </div>

    </div>


</div>

@endsection


@section('script')
<script>

    moment.locale('fr', {
            months : 'janvier_février_mars_avril_mai_juin_juillet_août_septembre_octobre_novembre_décembre'.split('_'),
            weekdays : 'dimanche_lundi_mardi_mercredi_jeudi_vendredi_samedi'.split('_'),
            relativeTime: {
                future: 'dans %s',
                past: 'il y a %s',
                s: 'quelques secondes',
                m: 'une minute',
                mm: '%d minutes',
                h: 'une heure',
                hh: '%d heures',
                d: 'un jour',
                dd: '%d jours',
                M: 'un mois',
                MM: '%d mois',
                y: 'un an',
                yy: '%d ans'
            },
        });

    document.addEventListener('DOMContentLoaded', function () {

        document.querySelectorAll('.DateTime').forEach( node=>{
            node.innerHTML =  '- '+ moment( node.innerHTML, "YYYY-MM-DD HH-ii-ss").format("dddd DD MMMM YYYY")+' -';
        });

        document.querySelectorAll('.LoaderSec').forEach(node=>{
            node.classList.add('d-none');
        });
        
        document.querySelectorAll('.ContentSec').forEach(node=>{
            node.classList.remove('d-none');
        });
    });
    
    @if($lastCons)
        
    $('#last').html(moment("{{ $lastCons->Date }}", "YYYY-MM-DD HH-ii-ss").fromNow()); 
    @endif

</script>
@endsection
