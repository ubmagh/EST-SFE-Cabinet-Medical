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

            <div class="row w-50 mx-auto text-center mt-4 mb-5">
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
                                    @if( count($consultation->Examen))
                                        <li class="nav-item">
                                            <a class="nav-link" id="pillsEX{{$consultation->id}}" data-toggle="pill" href="#ContentEX{{$consultation->id}}" role="tab" aria-controls="ContentEX{{$consultation->id}}" aria-selected="false"><i class="fas fa-stethoscope fa-lg"></i> Mesures & Examens</a>
                                        </li>
                                    @endif
                                    @if(count( $consultation->OperationSelonConsu ))
                                        <li class="nav-item">
                                            <a class="nav-link" id="pillsOps{{$consultation->id}}" data-toggle="pill" href="#ContentOps{{$consultation->id}}" role="tab" aria-controls="ContentOps{{$consultation->id}}" aria-selected="false"><i class="fas fa-microscope fa-lg"></i> Opérations </a>
                                        </li>
                                    @endif
                                    @if( !empty( $consultation->Ordonnance ))
                                        <li class="nav-item">
                                            <a class="nav-link" id="pillsMed{{$consultation->id}}" data-toggle="pill" href="#ContentMed{{$consultation->id}}" role="tab" aria-controls="ContentMed{{$consultation->id}}" aria-selected="false"><i class="fas fa-prescription-bottle-alt fa-lg"></i> Medicaments </a>
                                        </li>
                                    @endif
                                    <li class="nav-item">
                                        <a class="nav-link" id="pillsFA{{$consultation->id}}" data-toggle="pill" href="#ContentFA{{$consultation->id}}" role="tab" aria-controls="ContentFA{{$consultation->id}}" aria-selected="false"><i class="fas fa-file-medical fa-lg"></i> Fichiers Ajoutés </a>
                                    </li>
                                </ul>                                

                                <div class="tab-content border-0 mt-3" id="pills-tabContent" style="min-height: 350px;">
                                    <div class="tab-pane fade show active" id="ContentDC{{$consultation->id}}" role="tabpanel" aria-labelledby="pillsDC{{$consultation->id}}" >
                                        <div class="media">
                                            <div class="media-body row px-4">
                                                <div  class="col-7">
                                                    <li class="font-weight-bold"> Type de Consultation : </li>
                                                    <p class="my-3 " style="text-indent: 50px; font-size: medium;"> {{ $consultation->Type }} </p>
                                                    <li class="font-weight-bold mt-3"> Titre de consultation : </li>
                                                    <p class="my-3 " style="text-indent: 50px; font-size: medium;"> {{ $consultation->Description }} </p>
                                                    @if($consultation->ExamensAfaire)
                                                        <li class="font-weight-bold"> Analyses à faire : </li>
                                                        <p class="my-3 " style="text-indent: 50px; font-size: medium;line-break: normal; word-break: break-all;">
                                                          {{$consultation->ExamensAfaire}}
                                                        </p>
                                                    @endif
                                                </div>
                                                <div  class="col-5">
                                                    <li class="font-weight-bold"> Date et Heure : </li>
                                                    <p class="my-3 dateTimeHour" style="text-indent: 50px; font-size: medium;"> {{ $consultation->Date }} </p>

                                                    <li class="font-weight-bold"> Secretaire : </li>
                                                    <p class="my-3" style="text-indent: 50px; font-size: medium;"> {{ $consultation->salleAttente->Secretaire->Nom.' '.$consultation->salleAttente->Secretaire->Prenom }} </p>
                                                    

                                                    @if($consultation->Urgent)
                                                        <div class="badge badge-pill badge-danger px-3 py-2 mt-3"  style="font-size: 18px;"> <i class="ti-alert ti-lg mr-2"></i> Consultation Urgente </div>
                                                    @endif
                                                    @if( $consultation->salleAttente )
                                                        @if($consultation->salleAttente->rdvID)
                                                            <div class="badge badge-pill badge-info text-white px-3 py-2 mt-3"  style="font-size: 18px;">
                                                            <i class="far fa-clock mr-2" style="font-size: 28px;"></i>Consultation à RendezVous</div>
                                                        @endif
                                                    @endif

                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    @if( count($consultation->Examen) )
                                        <div class="tab-pane fade" id="ContentEX{{$consultation->id}}" role="tabpanel" aria-labelledby="pillsEX{{$consultation->id}}">
                                            <div class="media">
                                                <div class="media-body row px-4">

                                                    <div class="col-md-6 col-12">
                                                        @foreach ($consultation->Examen as $num => $exa )
                                                            @if( ! $num%2 )
                                                                <li class="font-weight-bold my-2" style="text-indent: 50px; font-size: large;"> {{ $exa->Titre }} <span class="font-weight-normal"> {{ $exa->Valeur ? " :  ".$exa->Valeur:"" }} </span> </li>
                                                            @endif
                                                        @endforeach
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        @foreach ($consultation->Examen as $num => $exa )
                                                            @if( $num%2 )
                                                                <li class="font-weight-bold my-2" style="text-indent: 50px; font-size: large;"> {{ $exa->Titre }} <span class="font-weight-normal"> {{ $exa->Valeur ? " :  ".$exa->Valeur:"" }} </span> </li>
                                                            @endif
                                                        @endforeach
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(count( $consultation->OperationSelonConsu ))
                                        <div class="tab-pane fade" id="ContentOps{{$consultation->id}}" role="tabpanel" aria-labelledby="pillsOps{{$consultation->id}}">
                                            <div class="media">
                                                <div class="media-body px-4 row">
                                                    <div class="col-md-10 text-left mx-auto">
                                                        @foreach ( $consultation->OperationSelonConsu as $opSelConsu )

                                                            <li class="font-weight-bold my-2" style="text-indent: 50px; font-size: large;"> {{ $opSelConsu->Operation->Intitule }} 
                                                                <span class="font-weight-normal">
                                                                    {{ $opSelConsu->Operation->Description? " : ".$opSelConsu->Operation->Description:"" }} 
                                                                </span>
                                                            </li>
                                                            <ul class=" mb-3  list-arrow col-11 mx-auto">
                                                                <li class="ml-5">
                                                                    {{ $opSelConsu->Remarque ? $opSelConsu->Remarque:"" }}
                                                                </li>
                                                            </ul>
                                                            
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if( !empty( $consultation->Ordonnance ))
                                        <div class="tab-pane fade" id="ContentMed{{$consultation->id}}" role="tabpanel" aria-labelledby="pillsMed{{$consultation->id}}">
                                            <div class="media">
                                                <div class="media-body  row px-4">
                                                    @if(count( $consultation->Ordonnance->MedicamentFromThisOrd))
                                                        <div class="table-responsive mb-2 col-12 d-block">
                                                            <table class="table w-100 table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th> Nom </th>
                                                                        <th> Prise </th>
                                                                        <th> Période </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ( $consultation->Ordonnance->MedicamentFromThisOrd as $medicamentParOrd )
                                                                        
                                                                    <tr>
                                                                        <td scope="row">{{ $medicamentParOrd->medicament->Nom }}</td>
                                                                        <td> {{ $medicamentParOrd->NbrParJour }} {{ $medicamentParOrd->medicament->Prise }}  {{ $medicamentParOrd->medicament->Quand!="indifini"? ', '.$medicamentParOrd->medicament->Quand:" " }}  </td>
                                                                        <td> {{ $medicamentParOrd->Periode }} </td>
                                                                    </tr>

                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    @endif
                                            
                                                    @if($consultation->Ordonnance->Description )
                                                        <div class="col-12 d-block my-1">
                                                            <hr class="w-50 mx-auto mb-5 mt-0" />
                                                            <h4 class="h4 text-left font-weight-medium"> Contenue Ajouté à l'ordonnace :  </h4>
                                                            <p class="my-3 d-block w-100 py-3 px-2" style="text-indent: 50px; font-size: medium;"> 
                                                                {{ $consultation->Ordonnance->Description }}
                                                            </p>    
                                                            <hr class="w-50 mx-auto mt-5 mb-0"  />
                                                        </div>
                                                    @endif

                                                    @if(count( $consultation->Ordonnance->MedicamentFromThisOrd))
                                                        <div class="col-12 d-block text-center mt-2 ">
                                                            <a href=" {{ url('/Ordonnance/'.$consultation->Ordonnance->id) }} " target="_blank" class="btn mx-auto btn-info text-white text-center text-wite mx-auto"> <h4 class="h4 font-weight-light"> <i class="fas fa-print"></i> Imprimer l'ordonnance </h4> </a>
                                                        </div>
                                                    @endif
                                                </div>


                                            </div>
                                        </div>
                                    @endif
                                    <div class="tab-pane fade" id="ContentFA{{$consultation->id}}" role="tabpanel" aria-labelledby="pillsFA{{$consultation->id}}">
                                        <div class="media">
                                            <img class="mr-3 w-25 rounded" src="../../images/samples/300x300/14.jpg" alt="sample image">
                                            <div class="media-body row px-4">
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

        document.querySelectorAll('.dateTimeHour').forEach( node=>{
            node.innerHTML =  ' '+ moment( node.innerHTML, "YYYY-MM-DD HH-ii-ss").format("dddd DD MMMM YYYY à HH:mm ")+' ';
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
