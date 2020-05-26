@extends('Medcin.Parts.pageLayout')

@section('title')
Medcin: Consultation à Cabinet
@endsection

@section('css')
<style>
    .wizard.vertical>.steps {
        width: 25% !important;
    }

    .wizard>.content>.body {
        width: 100% !important;
    }

    .wizard.vertical>.content {
        width: 70% !important;
        overflow-y: scroll;
        height: 87%;
    }

    .twitter-typeahead {
        width: 100% !important;
    }

    #steps-uid-0 {
        height: 100%;
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
                <div class="card-body h-100 pt-3 px-1">
                    <form method="POST" class="h-100" action="/Consultation" id="example-vertical-wizard">
                        <div class="h-100">
                            {{ csrf_field() }}

                            <h3><i class="fas fa-file-medical-alt"></i> Consultation</h3>
                            <section>

                            <input id="PatientID" type="hidden" value="{{ $patient->id }}" />

                                <div class="form-group">
                                    <label for="" class=" font-weight-bold ">Type de consultation</label>
                                    

                                    <div class="col-md-8 mx-auto row ml-2 mb-3">
                                        <div class="col-6 ">
                                            <input class="form-check-input" name="typeConsultation" type="radio" id="inlineRadio1" value="normale" checked />
                                            <label class="form-check-label" for="inlineRadio1">Normale</label>
                                          </div>
                                          <div class="col-6 ">
                                            <input class="form-check-input" type="radio" name="typeConsultation" id="inlineRadio2" value="controle">
                                            <label class="form-check-label" for="inlineRadio2">Contrôle</label>
                                        </div>
                                    </div>


                                    
                                </div>

                                <div class="form-group">
                                    <label  class=" font-weight-bold ">Titre</label>
                                    <textarea class="form-control" name="Description" maxlength="200"
                                        rows="2"></textarea>
                                </div>

                                <div class="form-group" >
                                    <label class=" font-weight-bold ">Analyses à faire (Optionnelles)</label>
                                    <textarea class="form-control" name="analyses" rows="8"></textarea>
                                </div>

                            </section>


                            <h3> <i class="fas fa-stethoscope"></i> Examens et Mesures</h3>
                            <section>

                                <table class="w-100">
                                    <thead>
                                        <tr class="row">
                                            <th class="col-md-5 col-sm">objet</th>
                                            <th class="col-md-7 col-sm">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="row mt-3">
                                            <td class="col-md-5 px-1 col-sm">
                                                <input name="ExaTitres[]" autocomplete="false" type="text"
                                                    placeholder="Poids" class=" form-control SuggestExa ">
                                            </td>
                                            <td class="col-md-7 px-1 col-sm">
                                                <input name="ExaValues[]" type="text" class=" form-control"
                                                    placeholder="60Kg" />
                                            </td>
                                        </tr>

                                        <tr id="ExabuttonsRaw">
                                            <td colspan="2" class="text-center">
                                                <button type="button" class="btn btn-info mt-4" id="addExa"><i
                                                        class="fas fa-plus fa-lg text-white"></i></button>
                                                <button type="button" class="btn btn-danger d-none mt-4" id="DelExa"><i
                                                        class="fas fa-times fa-lg text-white"></i></button>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </section>




                            <h3> <i class="fas fa-microscope"></i> Opérations </h3>
                            <section>
                                <div class="row py-3 my-2 px-0 border border-secondary rounded mx-0 w-100 d-block text-center ">
                                    <div class="input-group mb-2 mt-1 col-11 mx-auto">
                                        <select class="custom-select col-12" name="Operations[]" id="inputGroupSelect02">
                                            <option selected disabled>choisir opération...</option>
                                            @if( !empty($operations) )
                                                @foreach($operations as $operation)
                                                    <option value="{{ $operation->id }} "> {{ $operation->Intitule }} </option>
                                                @endforeach
                                            @else
                                                <option disabled> Aucune opération n'est enregistrée </option>
                                            @endif
                                        </select>
                                    </div>
                                    
                                    <div class="form-group col-11 d-block mx-auto mt-3 mb-0">
                                      <input type="text"
                                        class="form-control" name="Remarquez[]"  maxlength="100" placeholder="Remarque pour l'opération.." />
                                    </div>
                                </div>
                                <div class="row my-2 px-0 w-100 d-block text-center" id="OpsBeforeRow">
                                    <div class="text-center">
                                        <button type="button" class="btn btn-info mt-4" id="addOp"><i
                                                class="fas fa-plus fa-lg text-white"></i></button>
                                        <button type="button" class="btn btn-danger d-none mt-4" id="DelOp"><i
                                                class="fas fa-times fa-lg text-white"></i></button>
                                        </div>
                                </div>
                            </section>




                            <h3><i class="fas fa-file-alt"></i> Ordonnance</h3>
                            <section>
                                <table class="w-100">
                                    <thead>
                                        <tr class="row">
                                            <th class="col-md-6 col-sm">Médicament</th>
                                            <th class="col-md-3 col-sm">Nombre par jour</th>
                                            <th class="col-md-3 col-sm">Période</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="row mt-3">
                                            <td class="col-md-6 px-1 col-sm">
                                                <input autocomplete="false" type="text"
                                                    class=" form-control typeahead ">
                                            </td>
                                            <td class="col-md-3 px-1 col-sm">
                                                <div class="input-group">
                                                    <input name="unites[]" type="number" min="0"
                                                        class=" form-control px-1 ">
                                                </div>
                                            </td>
                                            <td class="col-md-3 px-1 col-sm">
                                                <input name="Periods[]" autocomplete="false" type="text"
                                                    class=" form-control px-1" placeholder="15 jours | 1 semaine"
                                                    maxlength="20">
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
                                <hr class="mt-5" />
                                <div class="form-group mt-3">
                                    <label class=" font-weight-bold "> contenu additionnel à l'ordonndance : </label>
                                    <textarea class="form-control" name="remarque"
                                        placeholder="antécédants, allergie, remarques sur les medicaments..."
                                        rows="12"></textarea>
                                </div>
                            </section>


                            <h3> <i class="fas fa-file-import"></i> Inclure des fichiers </h3>
                            <section>
                               


                            </section>


                            <h3><i class="fas fa-print"></i> Imprimer l'ordonnance</h3>
                            <section>
                                
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
                        <h5 class="h6 text-center mb-2"> {{ $patient->id_civile }} </h5>
                    </div>


                    <div class="py-4">


                        <p class="clearfix">
                            <span class="float-left">
                                Nom
                            </span>
                            <span class="float-right text-muted">
                                {{ $patient->Nom }}
                            </span>
                        </p>

                        <p class="clearfix">
                            <span class="float-left">
                                Prénom
                            </span>
                            <span class="float-right text-muted">
                                {{ $patient->Prenom }}
                            </span>
                        </p>

                        @if($patient->age)
                            <p class="clearfix">
                                <span class="float-left">
                                    Age
                                </span>
                                <span class="float-right text-muted">
                                    {{ $patient->age }}
                                </span>
                            </p>
                        @endif


                        @if($patient->Occupation)
                            <p class="clearfix">
                                <span class="float-left">
                                    Occupation
                                </span>
                                <span class="float-right text-muted">
                                    {{ $patient->Occupation }}
                                </span>
                            </p>
                        @endif

                        @if($patient->typeMutuel)
                            <p class="clearfix">
                                <span class="float-left">
                                    Mutuel
                                </span>
                                <span class="float-right text-muted">
                                    <strong>{{ $patient->typeMutuel.': ' }}</strong>
                                    {{ $patient->ref_mutuel }}
                                </span>
                            </p>
                        @endif

                        <div class="w-100 mt-4 border border-secondary border-left-0 border-right-0 border-bottom-0">
                            <h4
                                class="h5 text-center mt-3 pb-3 mb-0 border border-secondary border-left-0 border-right-0 border-top-0">
                                Dernières Consultations : </h4>
                            <table id="order-listing" class="table table-striped mt-0 w-100"
                                style="overflow-x: hidden;">
                                <thead>
                                    <tr>
                                        <th class="text-center py-3">Date</th>
                                        <th class="text-center py-3">Titre</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if( $consultations->isEmpty() )
                                        <tr>
                                            <td colspan="2" class="text-center text-muted">
                                                Aucun enregistrement !
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($consultations as $consultation)
                                            <tr>
                                                <td class="text-center">{{ substr( $consultation->Date,0,10) }}</td>
                                                <td class="text-truncate text-center">{{ $consultation->Description }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <h6
                                class="h6 text-center mt-3 pb-3 mb-0 border border-secondary border-left-0 border-right-0 py-2">
                                Secretaire : {{ $secretaire->Nom.' '.$secretaire->Prenom }}
                                </h4>

                        </div>

                    </div>

                    <button class="btn btn-success btn-block mb-2"><i class="far fa-id-card"></i>
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
    var i = 1,j = 1,nbrOps=1;

    function addInput(indice) {
        var input = `<tr class="row mt-2" id="row` + indice + `" class="mt-1"> 
                                            <td class="col-md-6 px-1 col-sm">
                                                <input  autocomplete="false" type="text" class=" form-control typeahead ">
                                            </td>
                                            <td  class="col-md-3 px-1 col-sm">
                                                <div class="input-group">
                                                    <input  name="unites[]" type="number" min="0" class=" form-control  px-1">
                                                </div>
                                            </td>
                                            <td  class="col-md-3 px-1 col-sm">
                                                <input  name="Periods[]" autocomplete="off" type="text" class=" form-control px-1" maxlength="20">
                                            </td>
                                        </tr>`;
        $(input).insertBefore("#buttonsRaw");
        let newMedicinInput = $("#row" + indice).children().first().children().first();
        CreateTypeAHead(newMedicinInput);
    };

    function addExaInput(indice) {
        var input = `<tr class="row mt-2" id="Exa` + indice + `" class="mt-1"> 
            <td class="col-md-5 px-1 col-sm">
                                            <input  name="ExaTitres[]" autocomplete="false" type="text"  class=" form-control SuggestExa ">
                                            </td>
                                            <td  class="col-md-7 px-1 col-sm">
                                                <input  name="ExaValues[]" type="text" class=" form-control" />
                                            </td>
                                        </tr>`;
        $(input).insertBefore("#ExabuttonsRaw");
        let newMedicinInput = $("#Exa" + indice).children().first().children().first();
        CreateTypeAHeadExa(newMedicinInput);
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
<script src="{{ asset('/js/typeahead.bundle.min.js') }}"></script>
<script>
    var data = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: '{{ url('Medicament/Search') }}',
        remote: {
            url: '{{ url('/Medicament/Search').'?query=%QUERY' }}',
            wildcard: '%QUERY'
        }
    });



    // #1 These 3 functions are well nested to match the correcte event with each action by the user 


    /// Function to Create TypeAhead objects: :D 
    function CreateTypeAHead(element) {
        $(element).typeahead(null, {
            name: 'data',
            display: function (data) {
                return data.Nom;
            },
            source: data,
            templates: {
                empty: [
                    '<div class="empty-message text-center">',
                    " Medicament Introuvable !",
                    '</div>'
                ].join('\n'),
                suggestion: function (data) {
                    return '<p><strong>' + data.Nom + '</strong> </p>';
                }
            }
        });
        $(element).addClass('w-100');
        BindSelectEvent(element);
    }



    /// Function that binds Select Event on a given typeAhead object
    function BindSelectEvent(element) {
        $(element).bind('typeahead:select', function (ev, suggestion) {
            let td = $(ev.target).closest('td');
            let medicinElem = `
                            <div class="card rounded border mb-2">
                                <div class="card-body pl-2 pr-1 py-2">
                                    <div class="media py-1">
                                        <i class="fas fa-prescription-bottle-alt align-self-center mr-1 ml-n5 "></i>
                                        <div class="media-body">
                                            ` + suggestion.Nom + `
                                        </div>
                                        <input type="hidden" name="medicament[]" value="` + suggestion.id + `"/>
                                        <button type="button" class="float-right deleteMedicine" 
                                            style="border: none; background-color: transparent; cursor: pointer;"><i
                                                class="fa fa-times fa-lg text-danger"></i></button>
                                    </div>
                                </div>
                            </div>
        `;
            td.siblings().first().children().first().append(` <div class="input-group-append">
                                                <div class="input-group-text">` + suggestion.Prise +
            `</div>
                                            </div>
                                        `); // Ajouter le Type de Prise après la selectionne du medicament à la fin du champ nombre par jour
            td.empty(); // delete all children of TD element
            td.append(medicinElem); // ajouter le medicament selectionné
            let button = td.children().first().children().first().children().first().children().last();
            BindDeleteEvent(button);
        });
    }





    // Function that Binds Deleting event on delete button inside typeAhead card view
    function BindDeleteEvent(element) {
        $(element).click((event) => {
            let td = $(event.target).closest('td');
            td.siblings().first().children().first().children().last()
        .remove(); // supprimer le tage de prise pour le champs de nombre par jour
            td.empty(); // supprimer le contenue de la case TD
            td.append(` <input  autocomplete="false" type="text" class=" form-control typeahead "> `);
            CreateTypeAHead(td.children().first());
            td.children().first().addClass('w-100');
        });

    }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////  Section des Examens  //////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    var ExamsSrc = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: '{{ url('Examens/Example') }}',
        remote: {
            url: '{{ url('/Examens/Example').'?query=%QUERY' }}',
            wildcard: '%QUERY'
        }
    });

    function CreateTypeAHeadExa(element) {
        $(element).typeahead(null, {
            name: 'data',
            display: function (data) {
                return data.Titre;
            },
            source: ExamsSrc,
            templates: {
                empty: [
                    '<div class="empty-message text-center">',
                    " Aucune suggestion !",
                    '</div>'
                ].join('\n'),
                suggestion: function (data) {
                    return '<p><strong>' + data.Titre + '</strong> </p>';
                }
            }
        });
        $(element).addClass('w-100');
    }

    $('#addExa').click(() => {
        if (j == 1)
            $('#DelExa').removeClass('d-none');
        addExaInput(j);
        j++;
    });
    $('#DelExa').click(() => {
        if (j <= 1)
            return;
        $('#Exa' + (j - 1)).remove();
        j--;
        if (j == 1)
            $('#DelExa').addClass('d-none');
    });


    /// Operations JS
    $('#addOp').click(()=>{
        // at start nbrOps = 1;
        let Toappend = `
                                <div class="row py-3 my-3 px-0 border border-secondary rounded mx-auto w-100 d-block text-center " id="Op`+nbrOps+`">
                                    <div class="input-group mb-2 mt-1 col-11 mx-auto">
                                        <select class="custom-select col-12" name="Operations[]" id="inputGroupSelect02">
                                            <option selected disabled>choisir opération...</option>
                                            @if( !empty($operations) )
                                                @foreach($operations as $operation)
                                                    <option value="{{ $operation->id }} "> {{ $operation->Intitule }} </option>
                                                @endforeach
                                            @else
                                                <option disabled> Aucune opération n'est enregistrée </option>
                                            @endif
                                        </select>
                                    </div>
                                    
                                    <div class="form-group col-11 d-block mx-auto mt-3 mb-0">
                                      <input type="text"
                                        class="form-control" name="Remarquez[]" maxlength="100" placeholder="Remarque pour l'opération.." />
                                    </div>
                                </div>
        `;
        $(Toappend).insertBefore('#OpsBeforeRow');
        if (nbrOps == 1)
            $('#DelOp').removeClass('d-none');
        nbrOps++;
    });

    $('#DelOp').click(() => {
        if (nbrOps <= 1)
            return;
        $('#Op' + (nbrOps - 1)).remove();
        nbrOps--;
        if (nbrOps== 1)
            $('#DelOp').addClass('d-none');
    });


    document.addEventListener('DOMContentLoaded', function () {
        $('.typeahead').each((index, elem) => {
            CreateTypeAHead(elem);
        });
        CreateTypeAHeadExa($('.SuggestExa'));
    });

</script>
<script src=" {{ asset('js/FontAwesomeAll.min.js') }}"></script>
@endsection
