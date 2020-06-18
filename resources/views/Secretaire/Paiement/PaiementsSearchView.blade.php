@extends('Secretaire.Parts.pageLayout')


@section('title')
Secretaire : Paiements
@endsection



@section('content')

<div class=" content-wrapper " style="max-width: 100%;">
    <div class="row col-md-10 mx-auto">
        <div class=" col-md-9 px-4 col-12" >
            <div class="card">
                <div class="card-body w-100 grid-margin  stretch-card LoaderSec" style="height: 200px;" >
                      <div class="loader-demo-box border-0">
                        <div class="dot-opacity-loader">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="card-body d-none ContentSec p-4">

                    <div class="row w-100 my-5">
                        <form method="GET" action="{{ url()->current() }}" class="col-md-8 col-10 mx-auto">
                            <div class="input-group">
                            <input type="text" aria-describedby="button-addon2" class="form-control border-dark" name="q" value="{{ $q?$q:null }}" placeholder="chercher un patient: nom, identifiant .." />
                                <div class="input-group-append">
                                    <button class="btn btn-outline-dark" type="submit" id="button-addon2"><i class="fas fa-search fa-lg"></i></button>
                                </div>
                            </div>
                        </form>   
                    </div>

                    @if( $q )
                        <div class="row w-100 text-center"> 
                            <h4 class="h4 mx-auto"> Résultats de recherche de : ` {{ $q }} `  <a href="{{url('Paiements')}}"> <i class="fas fa-times text-danger"></i> </a> </h4>
                        </div>
                    @endif

                    <div class="row col-md-7 mx-auto my-3">

                        @if( !count($patients) )
                            <div class="alert alert-info col-md-8 mx-auto col-12" role="alert">
                                <i class="fas fa-info fa-lg"></i> Aucun Enregistrement à afficher.
                            </div>
                        @endif
                        
                        @foreach( $patients as $patient )
                            <div class="col-12 my-3">
                                <a href="{{ url('Paiement',$patient->id) }}">
                                    <div class="card rounded border mb-2">
                                        <div class="card-body p-3">
                                            <div class="media text-center">
                                                <i class="ti-user icon-md align-self-center mr-3 "></i>
                                                <div class="media-body">
                                                    <h6 class="mb-1">{{$patient->Nom}} {{$patient->Prenom}}</h6>
                                                    <p class="mb-0 text-muted">
                                                        Identifiant : {{$patient->id_civile}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>

                    <div class="row w-100 d-block">
                        <div class="mt-4 mb-3 d-block mx-auto" style="width: fit-content;">                       
                            {{ $patients->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-3 px-2 col-12" >
            <div class="card ">
                <div class="card-body w-100 grid-margin  stretch-card LoaderSec" style="height: 200px;" >
                      <div class="loader-demo-box border-0">
                        <div class="dot-opacity-loader">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="card-body d-none ContentSec p-4">



                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@section('script')
<script>
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
