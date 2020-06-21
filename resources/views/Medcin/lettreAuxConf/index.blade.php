@extends('Medcin.Parts.pageLayout')



@section('title')
Lettre au confrère
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('vendors/summernote/dist/summernote-bs4.css') }}">
@endsection
@section('content')
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row grid-margin">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body w-100 grid-margin  stretch-card LoaderSec" style="height: 480px;" >
                            <div class="loader-demo-box border-0">
                                <div class="dot-opacity-loader">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body d-none ContentSec">
                            
                            <div class="d-block row w-100 text-center mt-5 mb-4">
                                @if( isset($modifyletter) || session('modifyletter') )
                                    <h3 class="h3"> Modifier une Lettre : </h3>
                                @else
                                    <h3 class="h3"> Nouvelle Lettre : </h3>
                                @endif
                            </div>

                            @if(session('status'))

                                @if(session('status')=="good")
                                    
                                    <div class="row d-block w-75 px-2 py-4 mx-auto my-5">
                                        <div class="alert alert-success py-3 px-2 my-4 mx-2" role="alert">
                                            <h3 class="h4" > Lettre Bien enregistrée ! </h3>
                                        </div>
                                    </div>
                                    <div class="row mt-4 mb-3 col-11 mx-auto">
                                        
                                            <div class="col text-left text-white">
                                                <a class="btn btn-warning text-white " href="{{ url('LettresAuConfreres') }} " role="button"> <i class="fa fa-arrow-left"></i> retourner </a>
                                            </div>
                                            
                                            <div class="col text-center text-white">
                                                <a class="btn btn-primary text-white " href="{{ url('LettreAuConfrere') }} " role="button"> <i class="fa fa-plus" ></i> créer une autre </a>
                                            </div>

                                            <div class="col text-right">
                                                <a class="btn btn-success text-white " target="_blank" href="{{ url('Lettre/'.session('letterId')) }} " >  <i class="fas fa-print"></i> Imprimer la lettre </a>  
                                            </div>

                                    </div>

                                @elseif(session('status')=="err")
                                    <div class="row d-block w-75 px-2 py-4 mx-auto my-5">
                                        <div class="alert alert-danger py-3 px-2 my-4 mx-2" role="alert">
                                            <h3 class="h4" > Lettre non enregistrée, une Erreur servenue! </h3>
                                        </div>
                                    </div>
                                    <div class="row mt-4 mb-3 col-11 mx-auto">
                                        
                                            <div class="col text-left text-white">
                                                <a class="btn btn-warning text-white " href="{{ url('LettresAuConfreres') }} " role="button"> <i class="fa fa-arrow-left"></i> Annuler </a>
                                            </div>
                                            
                                            <div class="col text-right text-white">
                                                <a class="btn btn-success text-white " href="{{ url('LettreAuConfrere') }} " role="button"> <i class="fas fa-sync    "></i> re-créer la lettre </a>
                                            </div>


                                    </div>
                                @elseif(session('status')=="goodM")

                                    <div class="row d-block w-75 px-2 py-4 mx-auto my-5">
                                        <div class="alert alert-success py-3 px-2 my-4 mx-2" role="alert">
                                            <h3 class="h4" > Lettre Bien Modifiée ! </h3>
                                        </div>
                                    </div>
                                    <div class="row mt-4 mb-3 col-11 mx-auto">
                                        
                                            <div class="col text-left text-white">
                                                <a class="btn btn-warning text-white " href="{{ url('LettresAuConfreres') }} " role="button"> <i class="fa fa-arrow-left"></i> retourner </a>
                                            </div>
                                            
                                            <div class="col text-center text-white">
                                                <a class="btn btn-primary text-white " href="{{ url('LettreAuConfrere') }} " role="button"> <i class="fa fa-plus" ></i> créer une lettre </a>
                                            </div>

                                            <div class="col text-right">
                                                <a class="btn btn-success text-white " target="_blank" href="{{ url('Lettre/'.session('letterId')) }} " >  <i class="fas fa-print"></i> Imprimer la lettre </a>  
                                            </div>

                                    </div>
                                
                                @else

                                <div class="row d-block w-75 px-2 py-4 mx-auto my-5">
                                        <div class="alert alert-danger py-3 px-2 my-4 mx-2" role="alert">
                                            <h3 class="h4" > Lettre non Modifiée, une Erreur servenue! </h3>
                                        </div>
                                    </div>
                                    <div class="row mt-4 mb-3 col-11 mx-auto">
                                        
                                            <div class="col text-left text-white">
                                                <a class="btn btn-warning text-white " href="{{ url('LettresAuConfreres') }} " role="button"> <i class="fa fa-arrow-left"></i> Annuler </a>
                                            </div>
                                            
                                            <div class="col text-right text-white">
                                                <a class="btn btn-success text-white " href="{{ url('LettreAuConfrere') }} " role="button"> <i class="fas fa-sync    "></i> créer une lettre </a>
                                            </div>


                                    </div>

                                @endif  

                            @else
                                @if(isset($modifyletter))
                                <form method="POST" action="{{ url('LettreAuConfrere')."?modify=".$modifyletter->id }}" class="my-4">
                                 <input type="hidden" name="modify" value="{{$modifyletter->id}}" />
                                        @if($errors->has('modify'))
                                            <div class="alert alert-warning w-75 mx-auto mt-n5" role="alert">
                                                {{ $errors->first('modify') }}
                                            </div>
                                        @endif
                                @else
                                <form method="POST" action="{{ url('LettreAuConfrere') }}" class="my-4">
                                @endif
                                    {{ csrf_field() }}
                                    
                                   



                                    <div class="form-group row col-md-10 mx-auto mt-5">
                                        <div class="col-lg-2">
                                            <label class="col-form-label">Confrère :</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <select name="confrere" class="form-control text-dark" id="exampleFormControlSelect1">
                                            @if( !count($confrere) )
                                                        <option  disabled > Aucun confrère n'est enregistré </option>
                                            @endif
                                            @if( isset($modifyletter) )
                                                @foreach($confrere as $confreres)
                                                    @if($modifyletter->ConfrereID==$confreres->id)
                                                        <option value="{{ $confreres->id }}" selected >{{ $confreres->Nom }} - {{ $confreres->Specialite }} </option>
                                                    @else
                                                        <option value="{{ $confreres->id }}" >{{ $confreres->Nom }} - {{ $confreres->Specialite }} </option>
                                                    @endif
                                                @endforeach
                                            @else
                                                @foreach($confrere as $confreres)
                                                        <option value="{{ $confreres->id }}" >{{ $confreres->Nom }} - {{ $confreres->Specialite }} </option>
                                                @endforeach
                                            @endif
                                            </select>
                                        </div>
                                        @if($errors->has('confrere'))
                                            <div class="alert alert-danger w-75 mx-auto mt-n5" role="alert">
                                                {{ $errors->first('confrere') }}
                                            </div>
                                        @endif
                                    </div>



                                    @if(isset($modifyletter) && $modifyletter->PatientId)

                                        <div class="form-group col-md-10 row mx-auto" id="PatientDetails">
                                            <div class="col-lg-2">
                                                <label> Patient :</label>
                                            </div>
                                            <div class="col-lg-10">
                                                <div class="card rounded border mb-2">
                                                    <div class="card-body p-3">
                                                        <div class="media">
                                                            <i class="ti-user icon-md align-self-center mr-3 "></i>
                                                            <div class="media-body">
                                                                <h6 class="mb-1" id="PatientName">{{ $modifyletter->patient->Nom.' '.$modifyletter->patient->Prenom }}</h6>
                                                                <p class="mb-0 text-muted" id="PatientID">
                                                                    Identifiant : {{ $modifyletter->patient->id_civile }}
                                                                </p>
                                                            </div>
                                                            <button type="button" class="float-right" id="removePatient"
                                                                style="border: none; background-color: transparent; cursor: pointer;"><i
                                                                    class="fa fa-times fa-lg text-danger"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id_civile" id="id_civile" value="{{ $modifyletter->patient->id_civile }}" />

                                        <div class="form-group row col-md-10 mx-auto d-none" id="PatientSearch">
                                            <div class="col-lg-2">
                                                <label class="col-form-label">Patient : </label>
                                            </div>
                                            <div class="col-lg-10" id="custom-templates" >
                                                <input class="form-control typeahead" id="id_civile2" autocomplete="off"
                                                    type="text" placeholder="chercher le patient par nom ou identifiant">
                                                <small class="text-muted"> inclure des informations à propos du patient </small>
                                            </div>
                                        </div>

                                    @elseif( isset($patient) )
                                        
                                        <div class="form-group col-md-10 row mx-auto" id="PatientDetails">
                                            <div class="col-lg-2">
                                                <label> Patient :</label>
                                            </div>
                                            <div class="col-lg-10">
                                                <div class="card rounded border mb-2">
                                                    <div class="card-body p-3">
                                                        <div class="media">
                                                            <i class="ti-user icon-md align-self-center mr-3 "></i>
                                                            <div class="media-body">
                                                                <h6 class="mb-1" id="PatientName">{{ $patient->Nom.' '.$patient->Prenom }}</h6>
                                                                <p class="mb-0 text-muted" id="PatientID">
                                                                    Identifiant : {{ $patient->id_civile }}
                                                                </p>
                                                            </div>
                                                            <button type="button" class="float-right" id="removePatient"
                                                                style="border: none; background-color: transparent; cursor: pointer;"><i
                                                                    class="fa fa-times fa-lg text-danger"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id_civile" id="id_civile" value="{{ $patient->id_civile }}" />

                                        <div class="form-group row col-md-10 mx-auto d-none" id="PatientSearch">
                                            <div class="col-lg-2">
                                                <label class="col-form-label">Patient : </label>
                                            </div>
                                            <div class="col-lg-10" id="custom-templates" >
                                                <input class="form-control typeahead" id="id_civile2" autocomplete="off"
                                                    type="text" placeholder="chercher le patient par nom ou identifiant">
                                                <small class="text-muted"> inclure des informations à propos du patient </small>
                                            </div>
                                        </div>

                                    @else

                                        <div class="form-group d-none col-md-10 row mx-auto" id="PatientDetails">
                                            <div class="col-lg-2">
                                                <label> Patient :</label>
                                            </div>
                                            <div class="col-lg-10">
                                                <div class="card rounded border mb-2">
                                                    <div class="card-body p-3">
                                                        <div class="media">
                                                            <i class="ti-user icon-md align-self-center mr-3 "></i>
                                                            <div class="media-body">
                                                                <h6 class="mb-1" id="PatientName">Name</h6>
                                                                <p class="mb-0 text-muted" id="PatientID">
                                                                    Identifiant : JC54584545
                                                                </p>
                                                            </div>
                                                            <button type="button" class="float-right" id="removePatient"
                                                                style="border: none; background-color: transparent; cursor: pointer;"><i
                                                                    class="fa fa-times fa-lg text-danger"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id_civile" id="id_civile" />

                                        <div class="form-group row col-md-10 mx-auto" id="PatientSearch">
                                            <div class="col-lg-2">
                                                <label class="col-form-label">Patient : </label>
                                            </div>
                                            <div class="col-lg-10" id="custom-templates" >
                                                <input class="form-control typeahead" id="id_civile2" autocomplete="off"
                                                    type="text" placeholder="chercher le patient par nom ou identifiant">
                                                <small class="text-muted"> inclure des informations à propos du patient </small>
                                            </div>
                                        </div>
                                    @endif

                                    @if($errors->has('id_civile'))
                                            <div class="alert alert-danger w-75 mx-auto mt-n5" role="alert">
                                                {{ $errors->first('id_civile') }}
                                            </div>
                                    @endif
                                    
                                    
                                    <div class="form-group row col-md-10 mx-auto">
                                        <div class="col-lg-2">
                                            <label class="col-form-label">Objet : </label>
                                        </div>
                                        <div class="col-lg-10">
                                            @if(isset($modifyletter))
                                                <input class="form-control" maxlength="200" name="objet" id="defaultconfig-2" type="text" value="{{ $modifyletter->Titre }}" placeholder="Entrer l'objet de la lettre">
                                            @else
                                                <input class="form-control" maxlength="200" name="objet" id="defaultconfig-2" type="text" placeholder="Entrer l'objet de la lettre">
                                            @endif
                                        </div>
                                        @if($errors->has('objet'))
                                            <div class="alert alert-danger w-75 mx-auto mt-n5" role="alert">
                                                {{ $errors->first('objet') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-11 mx-auto">

                                        <h4 class="card-title ml-5">Message :</h4>
                                        <textarea name="message" id="summernoteExample" rows="35">
                                            @if(isset($modifyletter))
                                                {!! $modifyletter->Message !!}
                                            @endif
                                        </textarea>
                                        <br>                                  
                                        @if($errors->has('message'))
                                            <div class="alert alert-danger w-75 mx-auto mt-n5" role="alert">
                                                {{ $errors->first('message') }}
                                            </div>
                                        <br>                                  
                                        <br>                                  
                                        @endif
                                    </div>

                                    <div class="row mt-4 col-11 mx-auto">
                                        
                                            <div class="col text-left text-white">
                                                <a class="btn btn-warning text-white " href="{{ url('LettresAuConfreres') }} " role="button"> <i class="fa fa-arrow-left"></i> Annuler et retourner </a>
                                            </div>
                                        
                                            <div class="col text-right">
                                                <button class="btn btn-primary " type="submit"><i class="fas fa-print"></i>
                                                    @if(isset($modifyletter))
                                                        Modifier La Lettre
                                                    @else
                                                        Enregister la lettre
                                                    @endif
                                                </button>    
                                            </div>

                                    </div>

                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            </div>




        </div>

    </div>

</div>
@endsection




@section('script')

    @if(session('status'))

    @else
        <script src=" {{ asset('vendors/tinymce/tinymce.min.js') }} "></script>
        <script src=" {{ asset('vendors/tinymce/themes/modern/theme.js') }} "></script>
        <script src=" {{ asset('vendors/summernote/dist/summernote-bs4.min.js') }} "></script>
        <script src=" {{ asset('js/editorDemo.js') }} "></script>
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
            $('#id_civile2').val(suggestion.ID_c);
            $('#id_civile').val(suggestion.ID_c);
            $('#PatientDetails').removeClass("d-none");
            $('#PatientSearch').addClass("d-none");
        });

        $('#removePatient').click(() => {
            $('#PatientName').html('');
            $('#PatientID').html('');
            $('#id_civile2').val('');
            $('#id_civile').val('');
            $('#PatientDetails').addClass("d-none");
            $('#PatientSearch').removeClass("d-none");
        });

        $('#custom-templates').find(">:first-child").addClass('w-100');
        </script>
    @endif

    <script>
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
