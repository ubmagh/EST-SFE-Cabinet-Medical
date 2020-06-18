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
