@extends('Secretaire.Parts.pageLayout')


@section('title')
Secretaire : Paiement
@endsection


@section('content')

{{-- Modal détails paimenet --}}

<div class="modal fade" id="ShowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg " style="width: 70% !important" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Détails facturation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card">

                    <div class="card-body ">

                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home-1" role="tab"
                                    aria-controls="home-1" aria-selected="true">Historique des paiements</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile-1" role="tab"
                                    aria-controls="profile-1" aria-selected="false">Opérations effectuées à a consultation</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="home-1" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="media">
                                    <div class="media-body">
                                        <table class="table" id="data_paiement">
                                            <thead>
                                                <tr>
                                                    <th>Motif</th>
                                                    <th>Montant</th>
                                                    <th>Date </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile-1" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="media">
                                    <div class="media-body">
                                        <table class="table" id="data_operation">
                                            <thead>
                                                <tr>
                                                    <th>Type opération</th>
                                                    <th>prix </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
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
                <div class=" row w-100 mx-auto text-center">
                    <div class=" col mx-auto text-center">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fas fa-times    "></i> Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- end Modal détails paiement --}}


{{-- ------------------------------------------------------------------------------ --}}


{{-- Modal paiement --}}

<div class="modal fade" id="payer_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
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
                        <input type="text" name="paiement" id="paiement" autocomplete="off" placeholder=" 00.00 " class="form-control" />
                        <div class="input-group-append">
                            <span class="input-group-text">DH</span>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success"> <i class="fas fa-money-bill    "></i> Payer</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fas fa-times    "></i> Annuler</button>
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
                <div class="card-body w-100 grid-margin  stretch-card LoaderSec" style="height: 480px;" >
                      <div class="loader-demo-box border-0">
                        <div class="dot-opacity-loader">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="card-body  d-none ContentSec">
                    <div class="container-fluid">
                        <h3 class="text-right my-5">
                            {{ $patient->Nom.' '.$patient->Prenom }}
                        </h3>
                        <hr>
                    </div>
                    <div class="container-fluid d-flex justify-content-between">
                        <div class="col-lg-3 pl-0">
                            {{-- <h4 class="text-right mb-5">Total : $13,986</h4> --}}
                            <p class="mt-5 mb-2"><b>
                                    <h5>Informations : <a target="_blank" href="{{url('PatientF',$patient->id)}}"><i class=" fas fa-external-link-alt "></i></a></h5>
                                </b></p>
                            <p>CIN : {{ $patient->id_civile }}<br>Type Mutuelle
                                : {{ $patient->typeMutuel }}<br>Occupation :
                                {{ $patient->Occupation }}</p>
                        </div>
                        <div class="col-lg-3 pr-0">
                            <p class="mt-5 mb-2 text-right"><b>Nombre de consultation :</b></p>
                            <p class="text-right"> <b class="text-success"> {{ $Nombre_consultation }} </b> </p>
                        </div>
                    </div>
                </div>
                <div class="container-fluid mt-5  justify-content-center w-100  d-none ContentSec">
                    <div class="table-responsive w-100">
                        <table class="table">
                            <thead>
                                <tr class="bg-dark text-white">
                                    <th>#</th>
                                    <th>Type Consultation</th>
                                    <th>Medecin</th>
                                    <th class="text-right">Date Consultation</th>
                                    <th class="text-right">Total</th>
                                    <th class="text-right">Status</th>
                                    <th class="text-right">Reste à payer</th>
                                    <th class="text-right">Paiement</th>
                                    <th class="text-right">Détails</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if( !count($facture) )
                                    <tr >
                                        <td class="text-center" colspan="8"> Aucune Consultation n'a été trouvée pour ce patient . </td>
                                    </tr>
                                @endif
                                @foreach($facture as $row)
                                    <tr class="text-right">
                                        <td class="text-left"> {{ $row->num }} </td>
                                        <td class="text-left">
                                            {{ $row->consultation->Type }}
                                        </td>
                                        <td class="text-left">
                                            {{ $row->consultation->medcin->Nom.' '.$row->consultation->medcin->Prenom }}
                                        </td>
                                        <td>
                                            {{ date('d/m/Y', strtotime($row->consultation->Date)) }}
                                        </td>
                                        <td>{{ $row->Somme.' DH' }}</td>
                                        <td>
                                            @if($row->Somme === $row->Paye)
                                                <label class="badge badge-success">Deja payé</label>
                                            @else
                                                <label class="badge badge-danger">Pas encore</label>
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->Somme === $row->Paye)
                                                ----------
                                            @else
                                                <label
                                                    class="text-danger">{{ ($row->Somme-$row->Paye).' DH' }}
                                                </label>
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->Somme !== $row->Paye)
                                                <button data-id="{{ $row->id }}"
                                                    data-rest="{{ $row->Somme - $row->Paye }}" type="button"
                                                    class="btn btn-dark btn-icon details" data-toggle="modal"
                                                    data-target="#payer_modal">
                                                    <i class="fas fa-dollar-sign    "></i>
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-inverse-dark btn-icon" disabled>
                                                    <i class="fas fa-dollar-sign    "></i>
                                                </button>
                                            @endif
                                        </td>
                                        <td>
                                            <button data-idFacture="{{ $row->id }}" type="button"
                                                class="btn btn-primary btn-icon detailsBtn" data-toggle="modal"
                                                data-target="#ShowModal">
                                                <i class="ti-arrow-circle-right ml-1"></i></button>
                                            @php
                                                $test = $row->Somme - $row->Paye
                                            @endphp
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="container-fluid mt-5 w-100 mb-4 d-none ContentSec">
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
    // details paiement 

    $('.detailsBtn').click(function (e) {
        let id = $(this).data('idfacture');
        $.ajax({
            type: 'GET',
            url: '/Details_paiement/' + id,

            success: function (response) {

                $("#data_paiement tr>td").remove();
                $("#data_operation tr>td").remove();


                let tableBody = $('#data_paiement');
                let newLine = '';

                if( !response.paiement.length)
                    tableBody.append(`<tr>
                                         <td class="text-center " colspan="3"> Aucun paiement n'a été fait </td>
                                    </tr>
                        `);
                else
                for (let i = 0; i < response.paiement.length; i++) {
                    var string = new Date(response.paiement[i].date);
                    newLine = `
                              <tr>
                                    <td class="text-left"> ` + response.paiement[i].Motif +` </td>
                                  <td class="text-success"> ` + response.paiement[i].Montant + " DH" + ` <i class="ti-arrow-up"></i></td>
                                  <td > ` + string.getDate() + '/' + (string.getMonth() + 1) + '/' + string
                        .getFullYear() + ` </td>
                              </tr>
              `;
                    tableBody.append(newLine);
                }


                let tableBody_operation = $('#data_operation');
                let newLine_operation = '';

                if(!response.operation.length)
                    tableBody_operation.append(`<tr>
                                         <td class="text-center " colspan="2"> Aucune opération n'a été faite </td>
                                    </tr>
                        `);
                else
                for (let i = 0; i < response.operation.length; i++) {

                    newLine_operation = `
                              <tr>
                                  <td> ` + response.operation[i].type + ` </td>
                                  <td> ` + response.operation[i].prix + ` DH </td>
                              </tr>
              `;
                    tableBody_operation.append(newLine_operation);

                }
            },
            error: function (err) {}
        });


    });


    // end details paiement



    // button paiement


    $('.details').click(function (e) {
        $("#paiement ").val("");

        $("input").unbind("keydown").unbind("keyup");

        let rest = $(this).data('rest');
        let id = $(this).data('id');
        $(function () {
            $("input").keydown(function () {
                if (!$(this).val() || ( parseFloat($(this).val()) <= rest && parseFloat($(this)
                    .val()) > 0))
                    $(this).data("old", $(this).val());
            });
            $("input").keyup(function () {
                if (!$(this).val() || ( parseFloat($(this).val()) <= rest && parseFloat($(this)
                    .val()) > 0))
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
                    url: '/paiement/' + id,
                    data: $('#payerform').serialize(),
                    success: function (response) {

                        if (response.paiement === "fait") {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Paiement effectué',
                                showConfirmation: false,
                                timer: 2000
                            });
                            location.reload();
                        } else if (response.paiement === "erreur") {
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
