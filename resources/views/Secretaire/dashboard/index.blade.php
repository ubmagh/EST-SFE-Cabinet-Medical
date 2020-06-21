
@extends('Secretaire.Parts.pageLayout')

@section('title','Secretaire : Acceuil')

@section('content')
<div class="content-wrapper">
    
    <div class="row">
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title text-md-center text-xl-left">nombre des Rendez-vous </p>
            
            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
              <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$nb_rdv}}</h3>
              <i class="ti-calendar icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
            </div>  
            <p class="mb-0 mt-2 text-warning">Aujourd'hui <span class="text-black ml-1"><small></small></span></p>
          </div>
        </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title text-md-center text-xl-left">nombre de patient en attente</p>
                           
            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
              <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$nb_attente}}</h3>
              <i class="ti-user icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
            </div> 
            <p class="mb-0 mt-2 text-warning">Maintenant <span class="text-black ml-1"><small></small></span></p>
          </div>
        </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title text-md-center text-xl-left">nombre des cas d'urgence</p>
            <p class="card-title text-md-center text-xl-left"></p>
            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
              <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$nb_urgence}}</h3>
              <i class="ti-agenda icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
            </div>  
            <p class="mb-0 mt-2 text-warning">Maintenant <span class="text-black ml-1"><small></small></span></p>
          </div>
        </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title text-md-center text-xl-left">Totals des consultations</p>
            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
              <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$nb_consultation}}</h3>
              <i class="ti-layers-alt icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
            </div>  
            <p class="mb-0 mt-2 text-warning">Aujourd'hui <span class="text-black ml-1"><small></small></span></p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-15 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title mb-0">Les Rendez-vous d'Aujourd'hui </p>
          <div class="table-responsive">
            <table class="table table-striped table-borderless">
              <thead>
                <tr>
                  <th>Nom </th>
                  <th>Prénom </th>
                  <th class="text-right">Identifiant Civil</th>
                  <th class="text-right">téléphone</th>                 
                  <th class="text-right">Heure du Rendez-vous</th>
                </tr>  
              </thead>
              <tbody>
                  @if($rdv->isempty())
                    <tr> 
                      <td colspan="5" class="text-center">
                        Aucun rendezVous pour le moment
                      </td>
                    </tr>
                  @endif
                  @foreach ($rdv as $row)
                    <tr > 
                      <td>{{  $row->patient->Nom  }}</td>                   
                      <td>{{  $row->patient->Prenom   }}</td>
                      <td class="text-right">{{  $row->patient->id_civile   }}</td>
                      <td class="text-right">{{  $row->patient->Tel  }}</td>
                      <td class="font-weight-medium text-success text-right ">{{ date('h:i', strtotime( $row->DateTimeDebut )).' PM'  }}</td>                                                        
                    </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  


</div>
@endsection

@section('script')




@endsection


