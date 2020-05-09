@extends('Admin.Parts.pageLayout')

@section('title','Administrateur : Informations du Cabinet')

@section('css')

<style>

  .cabinetLogo {
    height: 150px;
    width: 150px;
  }

  .data {
    color : #787878;
  }

  .col .h4 {
    font-weight: lighter;
  }
</style>

@endsection


@section('content')

<!-- partial -->
<div class="container-fluid page-body-wrapper">
<div class="main-panel">
  <div class="pt-1 content-wrapper">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body mb-4">
            <h4 class="card-title h3">Les informations du Cabinet :</h4>
            <div class="row w-100 d-block text-right mt-n4 mb-n5">
              <a class="btn btn-info py-2 px-5 text-white" href="{{ url('/CabinetInfos/Modify') }}" role="button"> <i class="fas fa-edit text-white"></i> Modifier </a>
            </div>

            @if (session('edited'))
                <div class="alert alert-success d-block w-75 mx-auto alert-dismissible fade show" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                  </button>
                  Modifications Bien Enregistrés .
                </div>
            @endif

            <div class="row w-100 d-block mt-3 text-center">
            <img src="{{ asset('/images/logo/').'/'.$cabinet->logo }}" class="cabinetLogo rounded-circle d-block mx-auto {{ $cabinet->logo==''? 'border border-secondary':'' }}" alt="">
              <small class="text-muted mt-2"> Le logo du Cabinet </small>
            </div>

            <div class="row mx-auto w-75  mt-5 ">
                <div class="col text-left">
                  <div class="d-block ml-auto" style="width: fit-content;">
                    <h4 class="h4 text-left">
                      Nom de Cabinet :
                    </h4>
                  </div>
                </div>
                <div class="col text-left ">
                  <h4 class="h4 data">
                    {{ $cabinet->Nom }}
                  </h4>
                </div>
            </div>

            <div class="row w-75 mx-auto mt-3">
              <div class="col text-left">
                <div class="d-block ml-auto" style="width: fit-content;">
                  <h4 class="h4 text-left">
                    Spécialité(s) :
                  </h4>
                </div>
              </div>
              <div class="col text-left ">
                <h4 class="h4 data">
                  {{ $cabinet->Specialites!="" ? $cabinet->Specialites:"-" }}
                </h4>
              </div>
            </div>

            <div class="row w-75 mx-auto mt-3">
              <div class="col text-left">
                <div class="d-block ml-auto" style="width: fit-content;">
                  <h4 class="h4 text-left">
                    Téléphone :
                  </h4>
                </div>
              </div>
              <div class="col text-left ">
                <h4 class="h4 data">
                  {{ $cabinet->Tel!=''? $cabinet->Tel:'-'}}
                </h4>
              </div>
            </div>

            <div class="row w-75 mx-auto mt-3">
              <div class="col text-left">
                <div class="d-block ml-auto" style="width: fit-content;">
                  <h4 class="h4 text-left">
                  Fax :
                  </h4>
                </div>
              </div>
              <div class="col text-left ">
                <h4 class="h4 data">
                  {{ $cabinet->Fax!=''? $cabinet->Fax:'-'}}
                </h4>
              </div>
            </div>

            <div class="row w-75 mx-auto mt-3">
              <div class="col text-left">
                <div class="d-block ml-auto" style="width: fit-content;">
                  <h4 class="h4 text-left">
                  Email :
                  </h4>
                </div>
              </div>
              <div class="col text-left ">
                <h4 class="h4 data">
                  {{ $cabinet->Email!=''? $cabinet->Email:'-'}}
                </h4>
              </div>
            </div>

            <div class="row w-75 mx-auto mt-3">
              <div class="col text-left">
                <div class="d-block ml-auto" style="width: fit-content;">
                  <h4 class="h4 text-left">
                  Adresse  :
                  </h4>
                </div>
              </div>
              <div class="col text-left ">
                <h4 class="h4 data">
                  {{ $cabinet->Adresse!=''? $cabinet->Adresse:'-'}}
                </h4>
              </div>
            </div>

            <div class="row w-75 mx-auto mt-3">
              <div class="col text-left">
                <div class="d-block ml-auto" style="width: fit-content;">
                  <h4 class="h4 text-left">
                  Description  :
                  </h4>
                </div>
              </div>
              <div class="col text-left ">
                <h4 class="h4 data">
                  {{ $cabinet->Description!=''? $cabinet->Description:'-'}}
                </h4>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection


