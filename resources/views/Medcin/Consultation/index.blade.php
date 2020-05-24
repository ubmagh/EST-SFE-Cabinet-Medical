@extends('Medcin.Parts.pageLayout')



@section('title')
Medcin: Consultation à Cabinet
@endsection

@section('css')
<style>
    .wizard.vertical>.steps {
        width: 25% !important;
    }
    
    .wizard > .content > .body{
        width: 100% !important;
    }

    .wizard.vertical>.content {
        width: 70% !important;
        overflow-y: scroll;
        height: 87%;
    }

    .twitter-typeahead{
        width: 100% !important;
    }

    #steps-uid-0{
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


                                <input id="userName" name="userName" type="hidden" class="required form-control">


                                <div class="form-group">
                                    <label for="">Type de consultation</label>
                                    <select name="typeConsultation" class="form-control text-dark">
                                        <option value="normale">Consultation normale</option>
                                        <option value="controle">Contrôle</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Titre</label>
                                    <textarea class="form-control" name="Description" rows="2"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Analyses à faire (Optionnel)</label>
                                    <textarea class="form-control" name="analyses" rows="5"></textarea>
                                </div>

                                


                            </section>
                            <h3><i class="fas fa-file-alt"></i> Ordonnance</h3>
                            <section>

                                <table class="w-100">
                                    <thead >
                                        <tr class="row">
                                            <th class="col-md-6 col-sm">Médicament</th>
                                            <th class="col-md-3 col-sm">Nombre par jour</th>
                                            <th class="col-md-3 col-sm">Période</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="row">
                                            <td class="col-md-6 px-1 col-sm">
                                                <input id="name1" name="medicament[]" autocomplete="off" type="text" class=" form-control typeahead ">
                                            </td>
                                            <td  class="col-md-3 px-1 col-sm">
                                                <input id="name2" name="unites[]" type="number" class=" form-control ">
                                            </td>
                                            <td  class="col-md-3 px-1 col-sm">
                                                <input id="name3" name="Periods[]" autocomplete="off" type="text" class=" form-control">
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
                                <strong>{{ $patient->typeMutuel.': ' }}</strong> {{$patient->ref_mutuel}}
                            </span>
                        </p>
                        @endif

                        <div class="w-100 mt-4 border border-secondary border-left-0 border-right-0 border-bottom-0">
                            <h4 class="h5 text-center mt-3 pb-3 mb-0 border border-secondary border-left-0 border-right-0 border-top-0"> Dernières Consultations : </h4>
                            <table id="order-listing" class="table table-striped mt-0 w-100" style="overflow-x: hidden;">
                                <thead>
                                    <tr>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Titre</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($consultations as $consultation)
                                        <tr>
                                            <td class="text-center">{{ substr( $consultation->Date,0,10) }}</td>
                                            <td class="text-center">{{ $consultation->Description }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h6 class="h6 text-center mt-3 pb-3 mb-0 border border-secondary border-left-0 border-right-0 py-2"> Secretaire : {{ $secretaire->Nom.' '.$secretaire->Prenom }} </h4>

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
    var i = 1;

    function addInput(indice) {
        var input = `<tr class="row" id="row` + indice + `" class="mt-1"> 
                                            <td class="col-md-6 px-1 col-sm">
                                                <input id="name1" name="medicament[]" autocomplete="off" type="text" class=" form-control typeahead ">
                                            </td>
                                            <td  class="col-md-3 px-1 col-sm">
                                                <input id="name2" name="unites[]" type="number" class=" form-control ">
                                            </td>
                                            <td  class="col-md-3 px-1 col-sm">
                                                <input id="name3" name="Periods[]" autocomplete="off" type="text" class=" form-control">
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
<script src="{{ asset('/js/typeahead.bundle.min.js') }}"></script>
<script>
    var data = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: '{{ url('/Rendez-Vous/autocomplete') }}',
        remote: {
            url: '{{ url('/Rendez-Vous/autocomplete').'?query=%QUERY' }}',
            wildcard: '%QUERY'
        }
    });

    $('.typeahead').typeahead(null, {
        name: 'data',
        display: function (data) {
            return data.name + ' – ' + data.ID_c;
        },
        source: data,
        templates: {
            empty: [
                '<div class="empty-message text-center">',
                ' Patient Introuvable ! <a href="' + "{{ url('/patient') }}" +
                '"> <i class="fa fa-arrow-right" ></i> Créer d\'abord un ? </a> ',
                '</div>'
            ].join('\n'),
            suggestion: function (data) {
                return '<p><strong>' + data.name + '</strong> – ' + data.ID_c + '</p>';
            }
        }
    });
    $('.typeahead').addClass('w-100');
    
</script>
<script src=" {{ asset('js/FontAwesomeAll.min.js') }}"></script>
@endsection
