@extends('Medcin.Parts.pageLayout')



@section('title')
    Modifier une consultation
@endsection



@section('content')

    <div class="content-wrapper">
        <form action="{{ url( 'ConsultationEdit', $consultation->id) }}" enctype="multipart/form-data" id="DomForm" methode="POST">

            <div class="card">
                <div class="card-body">
                    <div class="row w-100">
                        <h2 class="h3 mt-4 mb-0 font-weight-light mx-auto"> Modifier une Consultation </h2>
                    </div>
                    <hr class="w-50 mx-auto" />

                    <input type="hidden" name="c" value="{{ $consultation->id }}" />
                    <input type="hidden" name="id_civile" id="id_civile" />
                    

                    <input type="hidden" name="id_civile" id="id_civile" value="{{ $patient->id_civile }}" />

                    <div class="row w-100 mx-auto mb-4 " id="finishState">
                        <div class="col-md-8 mx-auto">
                            <div class="form-group my-3 w-100" >
                                <label for="srch">Le patient Consulté: </label>
                                <div id="custom-templates" class="w-100 d-none">
                                    <input type="text" class="form-control typeahead" autocomplete="off"  id="srch" placeholder="chercher le patient par son nom ou son identifiant" />
                                </div>
                            </div>

                            <div class="w-100 mx-auto" id="PatientDetails">
                                <div class="card rounded border mb-2">
                                    <div class="card-body p-3">
                                        <div class="media">
                                            <i class="ti-user icon-md align-self-center mr-3 "></i>
                                            <div class="media-body">
                                                <h6 class="mb-1" id="PatientName"> {{ $patient->Nom }} {{ $patient->Prenom }} </h6>
                                                <p class="mb-0 text-muted" id="PatientID">
                                                    Identifiant : {{ $patient->id_civile }}
                                                </p>
                                            </div>
                                            <a href="{{ url('DossierMedical',$patient->id) }}" target="_blank" id="dossier" class="float-right mr-4"> <i class="far fa-id-card fa-lg"></i></a>
                                            <button type="button" class="float-right" id="removePatient" style="border: none; background-color: transparent; cursor: pointer;">
                                                <i class="fa fa-times fa-lg text-danger"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                                            id="IDAlert">
                                            <span id="IDError"></span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            @csrf
    
            <div class="card con my-4">
                <div class="card-body">

                    <div class="row w-100">
                        <h2 class="h3 mt-4 mb-0 font-weight-light mx-auto"> Détails de la consultation </h2>
                    </div>

                    <div class="form-group mt-3">
                        <label class=" font-weight-bold " for="Titre">Titre de consultation</label>
                        <textarea class="form-control" name="Description" id="Titre" maxlength="200" required rows="2" >{{ $consultation->Description }}</textarea>
                        <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                                        id="DescriptionAlert">
                                        <span id="DescriptionError"></span>
                        </div>
                    </div>

                    <div class="form-group" >
                        <label class=" font-weight-bold ">Analyses à faire (Optionnelles)</label>
                        <textarea class="form-control" name="analyses" rows="8" maxlength="450">{{ $consultation->ExamensAfaire }}</textarea>
                        <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                            id="analysesAlert">
                            <span id="analysesError"></span>
                        </div>
                    </div>

                    <div class="form-group" >
                        <div class="form-check d-block mx-auto">
                          <label class="form-check-label text-danger">
                            <input type="checkbox" class="form-check-input" name="Urgent" id="" value="checkedValue" {{ $consultation->Urgent ? "checked":"" }} >
                            Consultation Urgente
                          </label>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card con  my-4">
                <div class="card-body">

                    <div class="row w-100">
                        <h2 class="h3 mt-4 mb-0 font-weight-light mx-auto"> Mesures et Examens:  </h2>
                    </div>

                    <div class="row mt-4 w-100 px-0 mb-3">
                        <div class="col-11 px-0 mx-auto">
                            <table class="w-100">
                                <thead>
                                    <tr class="row d-none" id="OpersHeader">
                                        <th class="col-md-5 col-sm">Mesure</th>
                                        <th class="col-md-7 col-sm">Valeur</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($Mesures_Exams))
                                        @foreach($Mesures_Exams as $key => $mesure )
                                            <tr class="row mt-2" id="Exa{{$key+1}}" class="mt-1"> 
                                                <td class="col-md-5 px-1 col-sm">
                                                    <input  name="ExaTitres[]" placeholder="Poids" autocomplete="false" type="text" value="{{$mesure->Titre}}"  class=" form-control SuggestExa ">
                                                </td>
                                                <td  class="col-md-7 px-1 col-sm">
                                                    <input  name="ExaValues[]"  placeholder="60Kg" value="{{$mesure->Valeur}}" type="text" class=" form-control" />
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    <tr id="ExabuttonsRaw">
                                        <td colspan="2" class="text-center">
                                            <button type="button" class="btn btn-info mt-4" id="addExa"><i
                                                    class="fas fa-plus fa-lg text-white"></i></button>
                                            <button type="button" class="btn btn-danger {{count($Mesures_Exams)? "":"d-none"}} mt-4" id="DelExa"><i
                                                    class="fas fa-times fa-lg text-white"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="alert alert-danger alert-dismissible fade mt-n5 d-none show" id="ExaAlert" role="alert">
                                                <span id="ExaError"></span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card con my-4">
                <div class="card-body">   
                    <div class="row w-100">
                        <h2 class="h3 mt-4 mb-3 font-weight-light mx-auto"> Opérations :  </h2>
                    </div>

                    @if( !empty($Operations) )
                        @foreach ( $Operations as $key=>$Ooperation )
                            <div class="row py-3 my-3 px-0 border border-secondary rounded mx-auto w-100 d-block text-center " id="Op{{ $key+1 }}">
                                <div class="input-group mb-2 mt-1 col-11 mx-auto">
                                    <select class="custom-select col-12" name="Operations[]" id="">
                                        <option selected disabled>choisir opération...</option>
                                        @if( !empty($operationsC) )
                                            @foreach($operationsC as $operation)
                                                <option value="{{ $operation->id }} " {{ $Ooperation->OperationId==$operation->id? "selected":"" }}> {{ $operation->Intitule }} </option>
                                            @endforeach
                                        @else
                                            <option disabled> Aucune opération n'est enregistrée </option>
                                        @endif
                                    </select>
                                </div>
                                
                                <div class="form-group col-11 d-block mx-auto mt-3 mb-0">
                                <input type="text"
                                    class="form-control" name="Remarquez[]" value="{{ $Ooperation->Remarque }}" maxlength="100" placeholder="Remarque pour l'opération.." />
                                </div>
                            </div>
                        @endforeach
                    @endif
                    
                    <div class="row my-2 px-0 w-100 d-block text-center" id="OpsBeforeRow">
                        <div class="text-center">
                            <button type="button" class="btn btn-info mt-4" id="addOp"><i
                                    class="fas fa-plus fa-lg text-white"></i></button>
                            <button type="button" class="btn btn-danger {{count($Operations)? "":"d-none"}} mt-4" id="DelOp"><i
                                    class="fas fa-times fa-lg text-white"></i></button>
                            </div>
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                            id="OpsAlert">
                            <span id="OpsError"></span>
                    </div>
                </div>
            </div>

            

            <div class="card con my-4">
                <div class="card-body">  
                    <div class="row w-100">
                        <h2 class="h3 mt-4 mb-3 font-weight-light mx-auto"> Ordonnance :  </h2>
                    </div>

                    <div class="row w-100">
                        <table class="col-md-11 mx-auto">
                                    <thead>
                                        <tr class="row d-none" id="MedHeader">
                                            <th class="col-md-6 col-sm">Médicament</th>
                                            <th class="col-md-3 col-sm">Nombre par jour</th>
                                            <th class="col-md-3 col-sm">Période</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ( $ordonnance->MedicamentFromThisOrd as $key=>$medpO )
                                            <tr class="row mt-2" id="row{{$key+1}}" class="mt-1"> 
                                                <td class="col-md-6 px-1 col-sm">
                                                    <div class="card rounded border mb-2">
                                                        <div class="card-body pl-2 pr-1 py-2">
                                                            <div class="media py-1">
                                                                <i class="fas fa-prescription-bottle-alt align-self-center mr-1 ml-n5 "></i>
                                                                <div class="media-body">
                                                                    {{ $medpO->medicament->Nom }}
                                                                </div>
                                                                <input type="hidden" name="medicament[]" value="{{ $medpO->medicament->id }}"/>
                                                                <button type="button" class="float-right deleteMedicine" 
                                                                    style="border: none; background-color: transparent; cursor: pointer;"><i
                                                                        class="fa fa-times fa-lg text-danger"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td  class="col-md-3 px-1 col-sm">
                                                    <div class="input-group">
                                                        <input  name="unites[]" type="number" min="0" value="{{ $medpO->NbrParJour }}" class=" form-control  px-1">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">{{ $medpO->medicament->Prise }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td  class="col-md-3 px-1 col-sm">
                                                    <input  name="Periods[]" autocomplete="off" value="{{ $medpO->Periode }}" type="text" class=" form-control px-1" maxlength="20">
                                                </td>
                                            </tr>
                                        @endforeach

                                        <tr id="buttonsRaw">
                                            <td colspan="3" class="text-center">
                                                <button type="button" class="btn btn-info mt-4" id="addMedi"><i
                                                        class="fas fa-plus fa-lg text-white"></i></button>
                                                <button type="button" class="btn btn-danger {{ $ordonnance? "":"d-none" }} mt-4" id="DelMedi"><i
                                                        class="fas fa-times fa-lg text-white"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                                                    id="MedsAlert">
                                                    <span id="MedsError"></span>
                                            </div>
                    <hr class="mt-3 {{ $ordonnance? "":"d-none" }} " id="addtionalContentLine" />
                    <div class=" {{ $ordonnance? "":"d-none" }} " id="addtionalContent">
                        <div class="form-group mt-3 " >
                            <label class=" font-weight-bold "> contenu additionnel à l'ordonndance : </label>
                            <textarea class="form-control" name="AddContent"
                                placeholder="antécédants, allergie, remarques sur les medicaments..."
                                rows="12"> {{ $ordonnance->Description }} </textarea>
                        </div>
                        <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert" id="ContentAlert">
                            <span id="ContentError"></span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card con  my-4">
                <div class="card-body">
                
                    <div class="row w-100">
                        <h2 class="h3 mt-4 mb-3 font-weight-light mx-auto"> Inclure des Fichiers :  </h2>
                    </div>

                    <div class="row my-2 px-0 w-100 d-block text-center" id="FilesBeforeRow">
                        <div class="text-center">
                            <button type="button" class="btn btn-info mt-4" id="addfile"><i
                                    class="fas fa-plus fa-lg text-white"></i></button>
                            <button type="button" class="btn btn-danger d-none mt-4" id="Delfile"><i
                                    class="fas fa-times fa-lg text-white"></i></button>
                        </div>
                    </div>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                            id="fileAlert">
                            <span id="fileError"></span>
                    </div>

                </div>
            </div>

            <div class="card con my-4">
                <div class="card-body">
                
                    <div class="row w-100">
                        <button type="submit" class="btn btn-success mx-auto" id="subtn"> <i class="fas fa-save"></i> Enregistrer la consultation </button>
                    </div>

                </div>
            </div>
            
                
                



        </form>
        
    </div>

@endsection

@section('script')
    <script src="{{ asset('/js/typeahead.bundle.min.js') }}"></script>
    <script>

        var data = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: '{{ url('/LettreAuConfrerePatient') }}',
            remote: {
                url: '{{ url('/LettreAuConfrerePatient').'?query=%QUERY' }}',
                wildcard: '%QUERY'
            }
        });

        $('#custom-templates .typeahead').typeahead(null, {
            name: 'data',
            display: function (data) {
                return data.name + ' – ' + data.ID_c;
            },
            source: data,
            templates: {
                empty: [
                    '<div class="empty-message text-center">',
                    ' Patient Introuvable ! ',
                    '</div>'
                ].join('\n'),
                suggestion: function (data) {
                    return '<p><strong>' + data.name + '</strong> – ' + data.ID_c + '</p>';
                }
            }
        });

        $('#custom-templates .typeahead').bind('typeahead:select', function (ev, suggestion) {
            $('#PatientName').html(suggestion.name);
            $('#PatientID').html("Identifiant: " + suggestion.ID_c);
            $('#srch').val(suggestion.ID_c);
            $('#id_civile').val(suggestion.ID_c);
            $('#PatientDetails').removeClass("d-none");
            $('#custom-templates').addClass("d-none");
            $('#dossier').attr('href','http://127.0.0.1:8000/DossierMedical/'+suggestion.I);
            $('.con').each(function(i,ele){
                setTimeout(()=>$(ele).removeClass('d-none'),100);
            });
        });

        $('#removePatient').click(() => {
            $('#PatientName').html('');
            $('#PatientID').html('');
            $('#srch').val('');
            $('#id_civile').val('');
            $('#PatientDetails').addClass("d-none");
            $('#custom-templates').removeClass("d-none");
            $('#dossier').attr('href',"#");
            
            $('.con').each(function(i,ele){
                setTimeout(()=>$(ele).addClass('d-none'),100);
            });
        });

        $('#custom-templates').find(">:first").addClass('w-100');


        // globale vars 
        var j=1,nbrOps=1,i=1,nbrfile=1;
        
        {{ count($Mesures_Exams)? "j=".(count($Mesures_Exams)+1).";" : ""}}
        {{ count($Operations)? "nbrOps= ".( count($Operations)+1 ).";" : "" }}
        {{ count($ordonnance->MedicamentFromThisOrd)? "i= ".( count($ordonnance->MedicamentFromThisOrd) +1 ).";" : "" }}
        

        // Exmas script
        $('#addExa').click(() => {
        if (j == 1){
            $('#DelExa').removeClass('d-none');
            $('#OpersHeader').removeClass('d-none');
        }
        addExaInput(j);
        j++;
        });
        $('#DelExa').click(() => {
            if (j <= 1)
                return;
            $('#Exa' + (j - 1)).remove();
            j--;
            if (j == 1){
                $('#DelExa').addClass('d-none');
                $('#OpersHeader').addClass('d-none');
            }
        });
        function addExaInput(indice) {
            var input = `<tr class="row mt-2" id="Exa` + indice + `" class="mt-1"> 
                <td class="col-md-5 px-1 col-sm">
                                                <input  name="ExaTitres[]" placeholder="Poids" autocomplete="false" type="text"  class=" form-control SuggestExa ">
                                                </td>
                                                <td  class="col-md-7 px-1 col-sm">
                                                    <input  name="ExaValues[]"  placeholder="60Kg" type="text" class=" form-control" />
                                                </td>
                                            </tr>`;
            $(input).insertBefore("#ExabuttonsRaw");
            let newMedicinInput = $("#Exa" + indice);
            CreateTypeAHeadExa(newMedicinInput);
        };
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
            let ele = $(element).children().first().children().first()
            $(ele).typeahead(null, {
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
            $(ele).parent().addClass('w-100');
        }



        // operations script
        $('#addOp').click(()=>{
        // at start nbrOps = 1;
        let Toappend = `
                                    <div class="row py-3 my-3 px-0 border border-secondary rounded mx-auto w-100 d-block text-center " id="Op`+nbrOps+`">
                                        <div class="input-group mb-2 mt-1 col-11 mx-auto">
                                            <select class="custom-select col-12" name="Operations[]" id="">
                                                <option selected disabled>choisir opération...</option>
                                                @if( !empty($operationsC) )
                                                    @foreach($operationsC as $operation)
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
        
        // medicines script

        $('#addMedi').click(function (e) {
            if (i == 1){
                $('#DelMedi').removeClass('d-none');
                $('#MedHeader').removeClass('d-none');
                $('#addtionalContent').removeClass('d-none');
                $('#addtionalContentLine').removeClass('d-none');
            }
            
            addInput(i);
            i++;
        });

        $('#DelMedi').click(function (e) {
            if (i <= 1)
                return;
            $('#row' + (i - 1)).remove();
            i--;
            if (i == 1){
                $('#DelMedi').addClass('d-none');
                $('#MedHeader').addClass('d-none');
                $('#addtionalContent').addClass('d-none');
                $('#addtionalContentLine').addClass('d-none');
            }
                

        });

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

        var data = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: '{{ url('Medicament/Search') }}',
            remote: {
                url: '{{ url('/Medicament/Search').'?query=%QUERY' }}',
                wildcard: '%QUERY'
            }
        });
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
            $(element).parent().addClass('w-100');
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


        $('#addfile').click(()=>{
        let Toappend = `
                                <div class="row py-3 my-3 px-0 border border-secondary rounded mx-auto w-100 d-block text-center " id="file`+nbrfile+`">
                                    <div class="input-group mb-2 mt-1 col-11 mx-auto">
                                        
                                        <input type="file" class="custom-file-input" accept=".bmp,.jpg,.jpeg,.png,.avi,.mpg,.mpeg,.mov,.mp4,.pdf,.zip" name="Files[]" id="customFile`+nbrfile+`">
                                        <label class="custom-file-label" for="customFile`+nbrfile+`">Choisir un fichier</label>
                                        <small class="text-muted"> choisissez une image, une video, un fichier.zip d'une taille de 25Mo au Max </small>

                                    </div>
                                </div>
        `;
        $(Toappend).insertBefore('#FilesBeforeRow');

        $("#customFile"+nbrfile).on("change", function(e) {
            console.log( this.files[0] );
            // check file type
            let type=this.files[0].type;
            if( type.search('zip')==-1 && type.search('image')==-1 && type.search('video')==-1 && type.search('pdf')==-1 ){
                swal(" Le type de fichier est insupporté.");
                e.preventDefault();
                return;
            }
            // check size 
            if( this.files[0].size/1024/1024 > 25 ){
                swal(" le fichier choisi a une taille grande que 25 Mo.");
                e.preventDefault();
                return;
            }
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        if (nbrfile == 1)
            $('#Delfile').removeClass('d-none');
            nbrfile++;
        });

        $('#Delfile').click(() => {
            if (nbrfile <= 1)
                return;
            $('#file' + (nbrfile - 1)).remove();
            nbrfile--;
            if (nbrfile== 1)
                $('#Delfile').addClass('d-none');
        });





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

        let submitting = false;

        $('#DomForm').submit(function(e){

            if(submitting)
            return;
            $('.alert').addClass('d-none');
            submitting = true;
            $("#subtn").html('<i class="fas fa-spinner"></i>');
            e.preventDefault();
            let formy = document.getElementById('DomForm');
            var fd = new FormData(formy);

            $.ajax({
                type:"POST",
                url: "/ADomicile",
                data: fd,
                contentType: false,
                processData: false,
                complete: function() {
                    $("#subtn").html('<i class="fas fa-save"></i> Enregistrer la consultation');
                    submitting = false;
                },
                success: function(resp) {
                    
                    if (resp.status == "Good") {
                        $('.con').each(function(i,ele){
                            setTimeout(()=>$(ele).addClass('d-none'),100);
                        });
                        $('#finishState').children().first().addClass('d-none');
                        $('#finishState').append(`
                            <div class=" col-md-11 mx-auto py-4 my-4">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    Consultation Bien Enregistrée ! 
                                </div>
                            </div>
                        `);

                        if (resp.ordonnanceurl != 'none')
                            $('#finishState').append(` <div class="row w-100 text-center mt-5 mb-3" > <a href="` + resp.ordonnanceurl + `" target="_blank" class="btn btn-info text-white text-center text-wite mx-auto"> <h3 class="h3"> <i class="fas fa-print"></i> Imprimer l'ordonnance </h3> </a> </div> `);

                        $('#finishState').append(` <div class="row w-100 text-center my-3" > <a href="` + resp.letter + `" target="_blank" class="btn text-white btn-warning text-center mx-auto"> <h3 class="h3"> <i class="fas fa-envelope "></i> Créer une lettre au confrère </h3> </a> </div> `);
                    }else{
                        $('#finishState').append(`
                            <div class=" col-md-11 mx-auto py-4 my-4">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    Consultation n'est pas Enregistrée ! une erreure servenue.
                                </div>
                            </div>
                        `);
                    }
                },
                error: function(error) {
                    const response = error.responseJSON;
                    const errors = response.errors;

                    if (error.responseJSON.errors) {
                        if (errors.id_civile) {
                            $("#IDError").html(
                                error.responseJSON.errors.id_civile
                            );
                            $("#IDAlert")
                                .removeClass("d-none")
                                .addClass("show");
                        }
                        if (errors.Description) {
                            $("#DescriptionError").html(
                                error.responseJSON.errors.Description
                            );
                            $("#DescriptionAlert")
                                .removeClass("d-none")
                                .addClass("show");
                        }
                        if (errors.analyses) {
                            $("#analysesError").html(
                                error.responseJSON.errors.analyses
                            );
                            $("#analysesAlert")
                                .removeClass("d-none")
                                .addClass("show");
                        } ///////
                        //////// /// // 
                        for (var key in errors) {
                            // examens show validation msg
                            if (key.search("ExaValues") != -1 || key.search("ExaTitres") != -1) {
                                $("#ExaError").html(
                                    error.responseJSON.errors[key]
                                );
                                $("#ExaAlert")
                                    .removeClass("d-none")
                                    .addClass("show");
                            }
                            // OPerations show validation msg
                            if (key.search("Operations") != -1 || key.search("Remarquez") != -1) {
                                $("#OpsError").html(
                                    error.responseJSON.errors[key]
                                );
                                $("#OpsAlert")
                                    .removeClass("d-none")
                                    .addClass("show");
                            }
                            if (key.search("medicament") != -1 || key.search("unites") != -1 || key.search("Periods") != -1) {
                                $("#MedsError").html() ? null : $("#MedsError").html(
                                    error.responseJSON.errors[key]
                                );
                                $("#MedsAlert")
                                    .removeClass("d-none")
                                    .addClass("show");
                            }
                            if (key.search("Files") != -1) {
                                $("#fileError").html() ? null : $("#fileError").html(
                                    error.responseJSON.errors[key]
                                );
                                $("#fileAlert")
                                    .removeClass("d-none")
                                    .addClass("show");
                            }
                        }
                        /////////////////////
                        ///
                        ////
                        if (errors.AddContent) {
                            $("#ContentError").html(
                                error.responseJSON.errors.AddContent
                            );
                            $("#ContentAlert")
                                .removeClass("d-none")
                                .addClass("show");
                        }
                        // get error step
                    }
                },
                
            });
            
            
        });

        let ob=0;
        setTimeout(function(){

            @foreach ( $Mesures_Exams as $key => $mesure )
                ob = $('#Exa{{$key+1}}'); 
                CreateTypeAHeadExa( ob );
            @endforeach

            $(".deleteMedicine").each(function(i, node){
            BindDeleteEvent(node);

            })

        },4000);

    </script>
    



@endsection
