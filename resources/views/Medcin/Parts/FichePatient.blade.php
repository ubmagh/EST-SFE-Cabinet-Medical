@extends('Medcin.Parts.pageLayout')

@section('title','Fiche du Patient')

@section('content')

<div class="content-wrapper">



    <div class="card card-fluid">
        <div class="card-body py-4">
    
            <div class="row mt-4 mb-3 w-100 text-center">
                <h3 class="h3 text-center mx-auto"> Fiche de Patient : </h3>
            </div>

            <div class="row w-100 mt-4 mb-2" >
                <div class="col-md col-12">
                    <div class="form-group">
                      <label for="Nom">Nom: </label>
                      <input type="text" id="Nom" class="form-control" readonly value="{{ $patient->Nom }}" />
                    </div>
                </div>
                <div class="col-md col-12">
                    <div class="form-group">
                      <label for="Prenom">Prenom: </label>
                      <input type="text" id="Prenom" class="form-control" readonly value="{{ $patient->Prenom }}" />
                    </div>
                </div>
            </div>

             <div class="row w-100 mt-4 mb-2" >
                <div class="col-md col-12">
                    <div class="form-group">
                      <label for="sx"> Sexe: </label>
                      <input type="text" id="sx" class="form-control" readonly value="{{ $patient->Sexe }}" />
                    </div>
                </div>
                <div class="col-md col-12">
                    <div class="form-group">
                      <label for="age">age: </label>
                      <input type="text" id="age" class="form-control" readonly value="{{ $age? $age." ans":"-" }}" />
                    </div>
                </div>
                <div class="col-md col-12">
                    <div class="form-group">
                      <label for="ddn"> Date de Naissance: </label>
                      <input type="text" id="ddn" class="form-control" readonly value="{{ $patient->DateNaissance }}" />
                    </div>
                </div>
            </div>

            <div class="row w-100 mt-4 mb-2" >
                <div class="col-md col-12">
                    <div class="form-group">
                      <label for="id_civile">Identifiant Civile: </label>
                      <input type="text" id="id_civile" class="form-control" readonly value="{{ $patient->id_civile }}" />
                    </div>
                </div>
                <div class="col-md col-12">
                    <div class="form-group">
                      <label for="Tel">Téléphone: </label>
                      <input type="text" id="Tel" class="form-control" readonly value="{{ $patient->Tel? $patient->Tel:'-' }}" />
                    </div>
                </div>
                <div class="col-md col-12">
                    <div class="form-group">
                      <label for="Email"> Adresse Email: </label>
                      <input type="text" id="Email" class="form-control" readonly value="{{ $patient->Email?$patient->Email:'-' }}" />
                    </div>
                </div>
            </div>


            <div class="row w-100 mt-4 mb-2" >
                <div class="col-md col-12">
                    <div class="form-group">
                      <label for="mt"> Mutuel: </label>
                      <input type="text" id="mt" class="form-control" readonly value="{{ $patient->typeMutuel? $patient->typeMutuel.'  - ref : '.$patient->ref_mutuel: '-'  }}" />
                    </div>
                </div>
                <div class="col-md col-12">
                    <div class="form-group">
                      <label for="Occupation">Occupation: </label>
                      <input type="text" id="Occupation" class="form-control" readonly value="{{ $patient->Occupation? $patient->Occupation:'-' }}" />
                    </div>
                </div>
                <div class="col-md col-12">
                    <div class="form-group">
                      <label for="Nationnalite">Nationnalité: </label>
                      <input type="text" id="Nationnalite" class="form-control" readonly value="{{ $patient->Nationnalite? $patient->Nationnalite:'-' }}" />
                    </div>
                </div>
            </div>
            
            <div class="row w-100 mt-4 mb-2" >
                <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="adresse"> adresse: </label>
                        <textarea class="form-control" id="adresse" rows="4" readonly>{{ $patient->adresse }},  {{ $patient->Ville }} </textarea>
                    </div>
                </div>
            </div>

            <div class="row w-100 my-5 p-4" >      

                <div class="col-md col-12 text-center">
                    <a class="btn btn-info text-white text-center" href="{{ url('DossierMedical',$patient->id) }}" target="_blank" >
                        <i class="far fa-id-card"></i>
                        Voir le dossier médical 
                    </a>
                </div>

                
                <div class="col-md col-12 text-center">
                    <a class="btn btn-warning text-white text-center" href="{{ url('LettreAuConfrere?patient='.$patient->id) }}" target="_blank" >
                        <i class="fas fa-envelope"></i>
                        Faire une lettre au confrère 
                    </a>
                </div>

                <div class="col-md col-12 text-center">
                    <a class="btn btn-success text-white text-center" href="{{ url('CreateCertificat?patient='.$patient->id) }}" target="_blank" >
                        <i class="fas fa-certificate"></i>
                        Créer un Certificat
                    </a>
                </div>

            </div>


        </div>
    </div>
</div>

@endsection
