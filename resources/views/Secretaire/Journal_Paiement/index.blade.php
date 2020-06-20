@extends('Secretaire.Parts.pageLayout')


@section('title')
Secretaire : Journal des Paiements
@endsection

@section('css')
@endsection



@section('content')


<div class="content-wrapper">


    <div class="card w-100 mx-auto my-2">
        <h4 class=" display-4  text-center mt-5 mb-2"> Journal des Paiements : </h4>
        <div class="d-block w-100 mb-n5 text-center mt-3">

            <div class="row col-md-8 col-12 mb-4 mt-0 mx-auto">
                <form method="GET" action="{{ url()->current() }}" class="col-12  ml-auto">
                    <div class="input-group">
                        <input type="text" aria-describedby="button-addon2" class="form-control border-dark" name="q"
                            placeholder="chercher dans les Paiements ..." value="{{ $q? $q:null }}" />
                        <div class="input-group-append">
                            <button class="btn btn-outline-dark" type="submit" id="button-addon2"><i
                                    class="fas fa-search fa-lg"></i></button>
                        </div>
                    </div>
                </form>
            </div>



            <div class="row w-100 mb-4 mt-3 mx-auto">
                <div class="col-md col-12 text-center">
                    <a name="" id="" class="btn btn-success mx-auto text-center text-white " role="button"
                        data-toggle="modal" data-target="#ajoutModal" type="button"> <i class="fa fa-plus-circle fa-lg"
                            aria-hidden="true"></i> Ajouter une dépense </a>
                </div>
                <div class="col-md col-12 text-center">
                    <div class="dropdown" id="cat">
                        <button type="button" class="btn btn-primary dropdown-toggle" id="dropdownMenuIconButton3"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-sort"></i> 
                            @switch( $typeConsulte )
                                @case('none')
                                    Catégorie des Paiements :
                                @break
                                @case('depenses')
                                    Affichant les dépenses
                                @break
                                @case('recettes')
                                    Affichant les recettes
                                @break
                            @endswitch
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton3">
                            <a class="dropdown-item " href="{{ url('JournalPaiement') }}"> Voir tous
                            </a>
                            <a class="dropdown-item "
                                href="{{ url()->current().'?recettes=X' }}"> Les Recettes </a>
                            <a class="dropdown-item "
                                href="{{ url()->current().'?depenses=O' }}"> Les Dépenses </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if( $q )
                    <div class="row w-100 text-center mx-auto card my-3">
                        <div class="card-body py-4">
                        <h4 class="h4 mx-auto"> Résultats de recherche de : ` {{ $q }} `  <a href="{{url('JournalPaiement')}}"> <i class="fas fa-times text-danger"></i> </a> </h4>
                        </div>
                    </div>
    @endif



    <div id="data">
        <div class="row w-100 mx-auto">

            @if( !count($paiements) )
                <div class="alert alert-warning w-100 text-center mx-auto py-3 my-4 " role="alert">
                    <h4 class="h4 text-center mx-auto font-weight-light"><i class="fas fa-info    "></i> Aucun paiement n'a été trouvé !</h4>
                    
                </div>
            @endif

            @foreach($paiements as $row)
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">

                                <div class="row w-100 mx-auto">
                                    @if( $row->Is_recette() )
                                        <h3 class="h3 text-success mx-auto my-2"> <i class="ti-arrow-up"></i>
                                            {{ $row->Montant }} DH </h3>
                                    @else
                                        <h3 class="h3 text-danger mx-auto my-2"> <i class="ti-arrow-down"></i>
                                            {{ $row->Montant }} DH </h3>
                                    @endif
                                </div>

                                <div class="row w-100 mx-auto text-left">

                                    @if( $row->Is_recette() )
                                        <div class="col-12">
                                            <h5 class="h5 d-block  text-success mx-auto text-center mb-3 ">
                                                {{ $row->Motif }} <h5>
                                        </div>
                                        <div class="col-12">
                                            <h6 class="h6 d-block text-warning mx-auto text-center my-1 "> Date :
                                                {{ $row->date }} <h6>
                                        </div>
                                        <div class="col-12">
                                            <h6 class="mb-0 h6 d-block text-warning mx-auto text-center"><a class="mb-0"
                                                    target="_blank"
                                                    href="/Paiement/{{ $row->Facture->consultation->patient->id }}">
                                                    Facture <i class="fas fa-external-link-alt"></i> </a> </h6>
                                        </div>
                                        <div class="col-12">
                                            <h6 class="mb-0 h6 d-block text-info mx-auto text-center mt-2"> Du patient :
                                                <a class="mb-0" target="_blank"
                                                    href="/PatientF/{{ $row->Facture->consultation->patient->id }}">
                                                    {{ $row->Facture->consultation->patient->Nom }}{{ $row->Facture->consultation->patient->Prenom }}
                                                    <i class="fas fa-external-link-alt"></i> </a> </h6>
                                        </div>
                                    @else
                                        {{-- Dépense --}}
                                        <div class="col-12">
                                            <h5 class="h5 d-block col-12 text-danger mx-auto text-center mb-3 mt-2 ">
                                                <span class="text-dark">Motif : </span> {{ $row->Motif }} <h5>
                                        </div>
                                        <div class="col-12">
                                            <h6 class="h6 d-block col-12 text-warning mx-auto text-center my-1 "> Date :
                                                {{ $row->date }} <h6>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
        <div class="col-12 mx-auto px-5 mb-2">
            <div class="w-auto mx-auto text-center d-flex justify-content-center mt-3">
                {{ $paiements->appends(request()->input())->links() }}
            </div>
        </div>
        <!-- -------------------- Create new Dépense Modal  ------------------------- -->
        <div class="modal fade left" id="ajoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog model-notify modal-md modal-right modal-info" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Insérer une dépense </h5>
                        
                        <button type="button" id="closeCreateModal" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="GET" id="createForm">
                            @csrf
                            @method('GET')


                            <div class="form-group mb-2">
                                <label for="Motif"> Motif : </label>
                                <textarea name="Motif" id="Motif"  minlength="1" maxlength="100" required rows="3"
                                    class="form-control" placeholder="Motif du dépense"></textarea>
                            </div>
                            <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                                id="depense_Modal">
                                <span id="depenseError"></span>
                            </div>

                            <label for="Montant mt-3">Montant:</label>
                            <div class="input-group mb-2">
                                <input type="text" name="Montant" id="Montant" autocomplete="off" placeholder=" 00.00 " class="form-control" />
                                <div class="input-group-append">
                                    <span class="input-group-text">DH</span>
                                </div>
                            </div>
                            <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                                id="MontantModal">
                                <span id="MontantError"></span>
                            </div>


                            

                            <div class="row mx-auto w-100 mt-4">
                                <div class="col-md col-12 text-left">
                                    <button type="button" class="btn btn-danger text-white" data-dismiss="modal"
                                        id="DismissCreateModal"> <i class="fas fa-times ml-n1 mr-1"></i>Annuler</button>
                                </div>
                                <div class="col-md col-12 text-right">
                                    <button type="submit" class="btn btn-info text-white d-block ml-auto mr-0"> <i
                                            class="fa fa-plus-square ml-n1 mr-1" aria-hidden="true"></i> Ajouter </button>
                                </div>
                            </div>
                        </form>
                        <div class="w-100 d-none" id="CreateModal_ErrorSection">
                            <div class="alert alert-danger" role="alert">
                                <p> Une erreure Servenue! Ressayez plus-tard !</p>
                                <p id="createErrorMSG"></p>
                            </div>
                        </div>
                        <div class="w-100 d-none" id="CreateModal_SuccessSection">
                            <div class="alert alert-success" role="alert">
                                <p> Ajouté avec succès !</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- -------------------- ENDZ Create Depense Modal   ------------------------- -->
    </div>

</div>

@endsection




@section('script')

<script>

    $('#createForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "/JournalPaiement/createDepense",
            data: $(this).serialize(),
            success: function (resp) {
                if (resp.status === "OK") {
                    $('#createForm').hide();
                    $("#CreateModal_SuccessSection").removeClass('d-none').show();
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    $("#createForm").hide();
                    $("#createErrorMSG").html(resp);
                    $("#CreateModal_ErrorSection").removeClass('d-none').show();
                }
            },
            error: function (error) {
                const errors = error.responseJSON.errors;
                if (error.responseJSON.errors) {
                    if (errors.Motif) {
                        $('#depenseError').html(errors.Motif);
                        $('#depense_Modal').removeClass('d-none').addClass('show');
                    }
                    if (errors.Montant) {
                        $('#MontantError').html(errors.Montant);
                        $('#MontantModal').removeClass('d-none').addClass('show');
                    }
                } else {
                    $("#createForm").hide();
                    $("#createErrorMSG").html(error.responseJSON.message);
                    $("#CreateModal_ErrorSection").removeClass('d-none').show();
                }
            }
        });
    });

    function setInputFilter(textbox, inputFilter) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
        textbox.addEventListener(event, function() {
        if (inputFilter(this.value)) {
            this.oldValue = this.value;
            this.oldSelectionStart = this.selectionStart;
            this.oldSelectionEnd = this.selectionEnd;
        } else if (this.hasOwnProperty("oldValue")) {
            this.value = this.oldValue;
            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
        } else {
            this.value = "";
        }
        });
    });
    }

    setInputFilter(document.getElementById("Montant"), function(value) {
    return /^\d*[.]?\d*$/.test(value); });

</script>
@endsection
