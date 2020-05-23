@extends('Medcin.Parts.pageLayout')



@section('title')
Medcin: Consultation à Cabinet
@endsection

@section('css')
<style>
    .wizard.vertical>.steps {
        width: 25% !important;
    }

    .wizard.vertical>.content {
        width: 70% !important;
        overflow-y: scroll;
    }

</style>
@endsection

@section('content')


<div class="row w-100" style="height: -webkit-fill-available;">

    <div class="col-12 d-block text-center mt-5">
      <h4 class="h4 mt-3"> Consultation à la Cabinet: </h3>
    </div>

    @if( $EmptySa )

    <div class="col-8 mx-auto">
      <div class="alert d-block alert-warning px-5  py-4 " role="alert">
        <i class="fa fa-times"></i> La liste d'attente est vide pour le moment.
      </div>
    </div>

    @elseif(!$found)

    <div class="col-8 mx-auto">
      <div class="alert d-block alert-warning px-5 w-75 mx-auto py-4 " role="alert">
        <i class="far fa-clock"></i> Le Patient sera validé par le secretaire dans quelque secondes...
      </div>
    </div>

    @else
        <div class="col-9 grid-margin my-4">
            <div class="card h-100 ">
                <div class="card-body pt-3 px-1">
                    <form method="POST" action="/Consultation" id="example-vertical-wizard">
                        <div>
                            {{ csrf_field() }}

                            <h3><i class="fas fa-file-medical-alt"></i> Consultation</h3>
                            <section>


                                <input id="userName" name="userName" type="hidden" class="required form-control">


                                <div class="form-group">
                                    <label for="">Type de consultation</label>
                                    <select name="typeConsultation" class="form-control">
                                        <option>Consultation normale</option>
                                        <option>Contrôle</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea class="form-control" name="Description" rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Analyses à faire (Optionnel)</label>
                                    <textarea class="form-control" name="analyses" rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Urgent</label>
                                    <select name="urgent" class="form-control">
                                        <option>Oui</option>
                                        <option>Non</option>
                                    </select>
                                </div>


                            </section>
                            <h3><i class="fas fa-file-alt"></i> Ordonnance</h3>
                            <section>

                                <table class="w-100">
                                    <thead>
                                        <tr>
                                            <th>Médicament</th>
                                            <th>Unité/Jour</th>
                                            <th>Période</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>

                                                <select name="medicament[]" class="form-control">
                                                    @foreach($medicaments as $medicament)
                                                        <option>{{ $medicament->Nom }}</option>
                                                    @endforeach
                                                </select>

                                            </td>
                                            <td>
                                                <input id="name1" name="unites[]" type="number" class=" form-control ">
                                            </td>
                                            <td class="mr-n1">
                                                <input id="name1" name="Periods[]" type="number" class=" form-control">
                                            </td>
                                        </tr>

                                        <tr id="buttonsRaw">
                                            <td colspan="3" class="text-center">
                                                <button type="button" class="btn btn-info mt-4" id="addMedi"><i
                                                        class="fas fa-plus fa-lg text-white"></i></button>
                                                <button type="button" class="btn btn-danger d-none mt-4" id="DelMedi"><i
                                                        class="fas fa-times fa-lg text-white"></i></button>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>


                                <hr class="mt-4" />
                                <div class="form-group">
                                    <label for="">Remarques</label>
                                    <textarea class="form-control" name="remarque" rows="3"></textarea>
                                </div>
                            </section>
                            <h3><i class="fas fa-print"></i> Imprimer l'ordonnance</h3>
                            <section>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox">
                                        I agree with the Terms and Conditions.
                                    </label>
                                </div>
                            </section>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-3 my-4">
            <div class="card">
                <div class="card-body">

                    <div class="border-bottom text-center pb-4">
                        <img src="../../images/faces/face12.jpg" alt="profile" class="img-lg rounded-circle mb-3" />
                    </div>

                    <div class="py-4">

                        <p class="clearfix">

                            <span class="float-left">
                                Identifiant civil
                            </span>
                            <span class="float-right text-muted">
                                {{ $ListeAttentes->patient->id_civile }}
                            </span>
                        </p>
                        <p class="clearfix">
                            <span class="float-left">
                                Nom
                            </span>
                            <span class="float-right text-muted">
                                {{ $ListeAttentes->patient->Nom }}
                            </span>
                        </p>
                        <p class="clearfix">
                            <span class="float-left">
                                Prénom
                            </span>
                            <span class="float-right text-muted">
                                {{ $ListeAttentes->patient->Prenom }}
                            </span>
                        </p>
                        <table id="order-listing" class="table">

                            <thead>

                                <tr>
                                    <th class="text-center">Date de consultation</th>
                                    <th class="text-center">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($consultations as $consultation)
                                    <tr>
                                        <td class="text-center">{{ $consultation->Date }}</td>
                                        <td class="text-center">{{ $consultation->Description }}</td>
                                    </tr>
                                @endforeach
                            </tbody>


                        </table>


                    </div>

                    <button class="btn btn-primary btn-block mb-2"><i class="far fa-id-card"></i>
                        Voir le dossier médical</button>
                </div>
            </div>
        </div>
    @endif
</div>

@endsection

@section('script')
<script src="{{ asset('/js/wizard.js') }}"></script>
<script>
    var i = 1;

    function addInput(indice) {
        var input = `<tr id="row` + indice + `" class="mt-1"> 
      <td>

<select name="medicament[]" class="form-control" >
@foreach($medicaments as $mediacament)
<option>{{ $medicament->Nom }}</option>
@endforeach
</select>

</td>
<td>
<input id="name1" name="unites[]" type="number" class=" form-control ">
</td>
<td class="mr-n1">
<input id="name1" name="Periods[]" type="number" class=" form-control">
</td>
                  </tr>`;
        $(input).insertBefore("#buttonsRaw");
    };


    // code here
    $('#addMedi').click(function (e) {
        if (i == 1)
            $('#DelMedi').removeClass('d-none');
        addInput(i);
        i++;
    });

    $('#DelMedi').click(function (e) {
        if (i <= 1)
            return;
        $('#row' + (i - 1)).remove();
        i--;
        if (i == 1)
            $('#DelMedi').addClass('d-none');

    });

</script>

<script src=" {{ asset('js/FontAwesomeAll.min.js') }}"></script>
@endsection
