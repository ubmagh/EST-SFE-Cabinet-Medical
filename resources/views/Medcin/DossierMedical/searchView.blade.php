@extends('Medcin.Parts.pageLayout')

@section('title','Dossier Medical')

@section('content')

<div class="content-wrapper" style="max-width: 85% !important;">



    <div class="card card-fluid">
        <div class="card-body py-4">

           <div class="mt-5 mb-4 row w-100">
                <h2 class="h2 mx-auto font-weight-light"> Dossier Medical d'un patient : </h2>
           </div>

           <div class="row w-100 my-5">
                <form method="GET" action="{{ url()->current() }}" class="col-md-8 col-10 mx-auto">
                    <div class="input-group">
                      <input type="text" aria-describedby="button-addon2" class="form-control border-dark" name="q" placeholder="chercher un patient: nom, identifiant .." />
                        <div class="input-group-append">
                            <button class="btn btn-outline-dark" type="submit" id="button-addon2"><i class="fas fa-search fa-lg"></i></button>
                        </div>
                    </div>
                </form>           
           </div>




           <div class="row col-lg-6 col-md-8 col-12 mx-auto my-5 ">

                @if(isset($q))
                    <h4 class="h4 mx-auto font-weight-light"> Résultats du recherche :   <a class="text-danger" href="{{url('DossierMedical')}}"> <i class="fas fa-times ml-5"></i> Annuler la recherche </a> </h4>
                @else
                    <h4 class="h4 mx-auto font-weight-light"> Liste des Patients:  </h4>
                @endif

                @if(count($patients))                
                    @foreach ( $patients as $patient)
                            <div class="col-12 my-3">
                                <a href="{{ url('DossierMedical',$patient->id) }}">
                                    <div class="card rounded border mb-2">
                                        <div class="card-body p-3">
                                            <div class="media text-center">
                                                <i class="ti-user icon-md align-self-center mr-3 "></i>
                                                <div class="media-body">
                                                    <h6 class="mb-1" id="PatientName">{{$patient->Nom}} {{$patient->Prenom}}</h6>
                                                    <p class="mb-0 text-muted" id="PatientID">
                                                        Identifiant : {{$patient->id_civile}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    @endforeach
                @elseif($q)

                    <div class="col-12 my-3">
                        <div class="alert alert-warning" role="alert">
                        Aucun Résultat n'a été trouvé pour le terme: {{$q}} 
                        </div>
                    </div>


                @else

                    <div class="col-12 my-3">
                        <div class="alert alert-warning" role="alert">
                        Aucun patient enregistré à la base de données !
                    </div>
                    </div>

                @endif
           </div>

           <div class="row w-50 mx-auto mt-5 mb-3 text-center">
                {{ $patients->links() }}
           </div>

        </div>
    </div>
</div>

@endsection
