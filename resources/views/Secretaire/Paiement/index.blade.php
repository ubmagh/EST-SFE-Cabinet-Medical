@extends('Secretaire.Parts.pageLayout')


@section('title')
Secretaire : Paiement
@endsection

@section('css')
@endsection



@section('content')


               {{-- Modal détails paimenet --}}


<div class="modal fade" id="ShowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Détails facturation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
        <div class="card">
          <div class="card-body">
       
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home-1"  role="tab" aria-controls="home-1" aria-selected="true">Historique paiement</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile-1" aria-selected="false">Opération effectuée</a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                <div class="media">
                  <img class="mr-3 w-25 rounded" src="../../images/faces/face12.jpg" alt="sample image">
                  <div class="media-body">
                    <table class="table" id="data_paiement">
                      <thead>
                        <tr>
                          <th>Montant</th>
                          <th>Date </th>
                          <th>Type </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr >
                          <td></td>
                          <td></td>
                          <td></td>
                        </td>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="profile-1" role="tabpanel" aria-labelledby="profile-tab">
                <div class="media">
                  <img class="mr-3 w-25 rounded" src="../../images/faces/face12.jpg" alt="sample image">
                  <div class="media-body">
                    <table class="table" id="data_operation">
                      <thead>
                        <tr>
                          <th>Type opération</th>
                          <th>prix </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr >
                          <td></td>
                          <td></td>                         
                        </td>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
               
              {{-- end Modal détails paiement --}}


              {{-- ------------------------------------------------------------------------------ --}}


              {{-- Modal paiement --}}
 
              <div class="modal fade" id="payer_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Paiement Facture</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                  
                       <form id="payerform" action="####here" method="POST">  
                          {{ csrf_field() }}
                      <div class="input-group">                       
                        <div class="input-group-prepend">
                          <span class="input-group-text bg-primary text-white">$</span>
                        </div>                                          
                        <input type="number" name="paiement" id="paiement" class="form-control" aria-label="Amount (to the nearest dollar)"
                     
                        >
                        <div class="input-group-append">
                          <span class="input-group-text">.00</span>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-info">Payer</button>
                      <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    </div> 
                  </form>
                  </div>
                </div>
              </div> 
  
     

                {{-- End Modal paimenet --}}


<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="card px-2">
                <div class="card-body">
                    <div class="container-fluid">
                    <h3 class="text-right my-5">{{  $facture->first()->consultation->patient->Nom.' '.$facture->first()->consultation->patient->Prenom }}</h3>
                      <hr>
                    </div>
                    <div class="container-fluid d-flex justify-content-between">
                      <div class="col-lg-3 pl-0">
                        {{-- <h4 class="text-right mb-5">Total : $13,986</h4> --}}
                        <p class="mt-5 mb-2"><b> <h5>Informations :</h5> </b></p>
                        <p>CIN : {{ $facture->first()->consultation->patient->id_civile}}<br>Type Mutuelle : {{ $facture->first()->consultation->patient->typeMutuel}}<br>Occupation : {{ $facture->first()->consultation->patient->Occupation}}</p>
                      </div>
                      <div class="col-lg-3 pr-0">
                        <p class="mt-5 mb-2 text-right"><b>Nombre de consultation :</b></p>
                        <p class="text-right"> <b class="text-success"> {{$Nombre_consultation}} </b> </p>
                      </div>
                    </div>
                   
                    </div>
                    <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                      <div class="table-responsive w-100">
                          <table class="table">
                            <thead>
                              <tr class="bg-dark text-white">
                                  <th>#</th>
                                  <th>Type Consultation</th>
                                  <th class="text-right">Date Consultation</th>
                                  <th class="text-right">Total</th>
                                 
                                  <th class="text-right">Status</th>
                                   <th class="text-right">Reste à payer</th>
                                  <th class="text-right">Paiement</th>
                                  <th class="text-right">Détails</th>
                                 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($facture as $row)
                                             
                                
                                  <tr class="text-right" >
                                  <td class="text-left"></td>
                                  <td class="text-left">
                                      {{ $row->consultation->Type }}
                                  </td>
                                    <td>
                                       {{ date('d/m/Y', strtotime($row->consultation->Date)) }}
                                    </td>
                                    <td>{{ $row->Somme.' DH' }}</td>
                                   
                                
                                    <td>  
                                          @if ($row->Somme === $row->Paye)
                                            <label class="badge badge-success">Deja payé</label>
                                          @else
                                              <label class="badge badge-danger">Pas encore</label>
                                          @endif
                                    </td> 
                                    <td>
                                      @if ($row->Somme === $row->Paye)
                                          ----------
                                      @else
                                     <label class="text-danger" >{{ ($row->Somme-$row->Paye).' DH' }} </label>
                                      @endif
                                    </td>
                                    <td>
                                      @if ($row->Somme !== $row->Paye)
                                        <button 

                                        data-id="{{ $row->id }}"  
                                        data-rest="{{ $row->Somme - $row->Paye }}"                         
                                          type="button" class="btn btn-dark btn-icon details" data-toggle="modal" data-target="#payer_modal"  >                                        
                                          <i class="ti-file btn-icon-append"  ></i> 
                                        </button>    
                                      @else
                                        <button                                   
                                        type="button" class="btn btn-dark btn-icon" disabled >                                        
                                        <i class="ti-file btn-icon-append"></i> 
                                        </button >    
                                      @endif
                                    </td>
                                    <td>

                                                                  <button 
                                          data-idFacture="{{ $row->id }}"
                                          type="button" class="btn btn-primary btn-icon detailsBtn" data-toggle="modal" data-target="#ShowModal">
                                          <i class="ti-arrow-circle-right ml-1"></i></button>
                                      @php
                                      $test =  $row->Somme - $row->Paye   
                                      @endphp
                                    </td>
                                   
                                  </tr>
                                @endforeach
                            </tbody>
                          </table>
                          
                        </div>
                    </div>
                    <div class="container-fluid mt-5 w-100">
                      <h4 class="text-right mb-5">Total Non payé :
                            @php
                                $i=0;
                                $j=0;
                            @endphp 
                            @foreach ($facture as $row)
                                    @php   
                                    $i += $row->Somme;
                                    $j += $row->Paye;
                                    @endphp                                         
                            @endforeach
                          {{ $i - $j .' DH'}} 
                    </h4>
                      
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

                    
@endsection


@section('script')
<script>



</script>

<script>
     
                     // details paiement 
    
$('.detailsBtn').click(function(e){
  const id = $(this).data('idfacture') ;
  $.ajax({               
  type: 'GET',        
  url: '/Details_paiement/'+id, 

  success: function(response){
          
          $("#data_paiement tr>td").remove();
          $("#data_operation tr>td").remove();

         
          let tableBody = $('#data_paiement'); 
          let newLine='';
         
         
          for(let i=0;i<response.paiement.length;i++){
             var string = new Date(response.paiement[i].date);
              newLine = `
                              <tr>
                                  <td class="text-success"> `+ response.paiement[i].Montant +" DH"+` <i class="ti-arrow-up"></i></td>
                                  <td > `+ string.getDate()+'/'+ (string.getMonth()+1)+'/'+string.getFullYear() +` </td>
                                  <td> `+ response.paiement[i].Type +` </td>
                              </tr>
              `;
              tableBody.append(newLine);
     
          }

          
          let tableBody_operation = $('#data_operation'); 
          let newLine_operation='';
          
          for(let i=0;i<response.operation.length;i++){

              newLine_operation = `
                              <tr>
                                  <td> `+ response.operation[i].type +` </td>
                                  <td> `+ response.operation[i].prix +` </td>
                              </tr>
              `;
              tableBody_operation.append(newLine_operation);
     
          }
  },
  error: function(err){
  }
  });


});


                  // end details paiement



    // button paiement


$('.details').click(function(e){
  $("#paiement ").val(""); 

  const rest = $(this).data('rest') ;
  const id = $(this).data('id') ;
  $(function () {
  $("input").keydown(function () {
    if (!$(this).val() || (parseInt($(this).val()) <= rest && parseInt($(this).val()) > 0))
    $(this).data("old", $(this).val());
  });
  $("input").keyup(function () {
    if (!$(this).val() || (parseInt($(this).val()) <= rest && parseInt($(this).val()) > 0))
      ;
    else
      $(this).val($(this).data("old"));
  });
});
  

document.getElementById('payerform').onsubmit =
        function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: '/paiement/' +id,
                data: $('#payerform').serialize(),
                success: function (response) {
                  
                  if(response.paiement === "fait"){
                    Swal.fire({
                             position: 'center',
                             icon: 'success',
                             title: 'Paiement effectué',
                             showConfirmation: false,
                             timer: 2000                           
                         });
                         location.reload(); 
                  }
                   else if(response.paiement === "erreur"){
                    Swal.fire({
                             position: 'center',
                             icon: 'error',
                             title: 'Paiement refusé',
                             showConfirmation: false,
                             timer: 3000                           
                         });
                        location.reload(); 
                  }
                  
                               
                },
                error: function () {
                  
                    
                }

            });
        };




});



</script>

@endsection
