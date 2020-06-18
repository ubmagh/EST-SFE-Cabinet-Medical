
@extends('Secretaire.Parts.pageLayout')


@section('title')
Secretaire : Journal Paiement
@endsection

@section('css')
@endsection



@section('content')
    
 
<div class="content-wrapper">
    <div class="dropdown" id="cat">
        <button type="button" class="btn btn-primary dropdown-toggle" id="dropdownMenuIconButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <i class="ti-time"></i> 
        </button>
            <div class="dropdown-menu"  aria-labelledby="dropdownMenuIconButton3">
                <h6 class="dropdown-header" >Type Paiement</h6>                    
                                <a class="dropdown-item "  id="cat1" data-value="consultation">Paiement Consultation</a>               
                                <a class="dropdown-item "  id="cat2" data-value="autres">Autres</a>              
            </div>
    </div>
      <br>
      <br>
      <br>

      <div id="data">
        <div class="row">
      
            @foreach ($journal as $row)
            
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                                <img src="../../images/faces/face12.jpg" class="img-lg rounded" alt="profile image">
                                <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                    @if ($row->ConsultationId !== NULL)
                                <h6 class="mb-0"><a class="mb-0" href="/Paiement/{{$row->consultation->PatientId}}">{{ $row->Motif  }}</a> </h6>
                                         <p class="mb-0 text ">{{"De : ". $row->consultation->patient->Nom.' '. $row->consultation->patient->Prenom}}</p>
                                         <p class="mb-0 text ">{{"Date : ". $row->Date}}</p>
                                         <p class="mb-0 text font-weight-bold">{{"Montant : ".$row->Somme." DH"}}</p>  
                                    @else
                                    <h6 class="mb-0"><a class="mb-0" href="#">{{ $row->Motif  }}</a> </h6>
                                    <p class="mb-0 text ">{{"Date : ". $row->Date}}</p>
                                    <p class="mb-0 text font-weight-bold">{{"Montant : ".$row->Somme." DH"}}</p>  
                                    @endif
                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
            @endforeach
        
       
        </div> 

     </div>
     
</div>
 
@endsection 




@section('script')

<script>


    $(document).ready(function(){
             let tmp='';
       for(let i=0 ; i< $("#cat div>a").length ;i++){
            $("#cat div>a").eq(i).click(function(){                          
                tmp = $("#cat div>a").eq(i).data('value');
                   $.ajax({
                       
                        type: 'get',
                        dataType: 'html',
                        url: '/CategoriePaiement',
                        data: 'tmp=' +tmp,
                        success:function(response){
                           
                               $("#data").html(response);
                        }

                    }); 
            });

               
       }
              
    });
</script>
@endsection