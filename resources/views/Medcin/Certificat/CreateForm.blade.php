@extends('Medcin.Parts.pageLayout')



@section('title')
Creation de Certificat Médical
@endsection



@section('content')

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="main-panel">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="row w-100 ml-1 mb-4 ">
                                <div class="col-md-3 col-sm-12">
                                    <img src="{{ asset('images/icons/contract.png') }}"
                                        class="w-md-100 mx-sm-auto d-md-block d-sm-block ml-md-auto ml-lg-n3  ml-lg-0"
                                        style="max-height: 80px;" alt="Secretary login" />
                                </div>

                                <div class="col-md-9 col-sm-12 d-flex align-content-center align-items-center ml-lg-0">
                                    <h1
                                        class="h1 display-4 text-sm-center text-md-left mx-sm-auto mr-md-auto mt-sm-3 text-info">
                                        Certificat Médical </h1>
                                </div>
                            </div>


                            @if(session('status'))

                                @if(session('status')=="good")
                                    
                                    <div class="row d-block w-100 px-2 py-4 mx-auto my-5">
                                        <div class="alert alert-success py-3 px-2 my-4 mx-2" role="alert">
                                            <h3 class="h4" > Certificat Bien enregistré ! </h3>
                                        </div>
                                    </div>
                                    <div class="row mt-4 mb-3 col-12 mx-auto">
                                        
                                            
                                            <div class="col-12 text-right mt-3">
                                                <a class="btn btn-success text-white btn-block" target="_blank" href="{{ url('PrintCertf/'.session('CertfId')) }} " >  <i class="fas fa-print"></i> Imprimer Le </a>  
                                            </div>


                                            <div class="col-12 text-center text-white mt-3">
                                                <a class="btn btn-primary text-white btn-block" href="{{ url('CreateCertificat') }} " role="button"> <i class="fa fa-plus" ></i> créer un autre </a>
                                            </div>

                                            

                                            <div class="col-12 text-left text-white mt-3">
                                                <a class="btn btn-warning text-white btn-block" href="{{ url('Certificat') }} " role="button"> <i class="fa fa-arrow-left"></i> retourner </a>
                                            </div>
                                    </div>
                                @else
                                    <div class="row d-block w-100 px-2 py-4 mx-auto my-5">
                                        <div class="alert alert-danger py-3 px-2 my-4 mx-2" role="alert">
                                            <h3 class="h4" > Certificat non enregistré, une Erreur servenue! </h3>
                                        </div>
                                    </div>
                                    <div class="row mt-4 mb-3 w-100 mx-auto">
                                            <div class="col-12 text-right text-white mt-3">
                                                <a class="btn btn-success text-white " href="{{ url('CreateCertificat') }} " role="button"> <i class="fas fa-sync    "></i> re-créer le </a>
                                            </div>
                                            <div class="col-12 text-left text-white mt-3">
                                                <a class="btn btn-warning text-white " href="{{ url('Certificat') }} " role="button"> <i class="fa fa-arrow-left"></i> Annuler </a>
                                            </div>
                                    </div>
                                @endif

                            @else
                                <form action="{{ url()->current() }}" method="POST" class="pt-3">
                                @csrf
                                @if( isset($patient) )      
                                        <div class="form-group w-100 row mx-auto" id="PatientDetails">
                                            
                                                <div class="card rounded border mb-2 w-100">
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
                                        <input type="hidden" name="id_civile" id="id_civile" value="{{ $patient->id_civile }}" />

                                        <div class="form-group row w-100 mx-auto d-none" id="PatientSearch">
                                        
                                            <div class="w-100" id="custom-templates" >
                                                <input class="form-control typeahead" id="id_civile2" autocomplete="off"
                                                    type="text" placeholder="chercher le patient par nom ou identifiant">
                                                <small class="text-muted"> inclure des informations à propos du patient </small>
                                            </div>
                                        </div>

                                    @else

                                        <div class="form-group d-none w-100 row mx-auto" id="PatientDetails">
                                                <div class="card w-100 rounded border mb-2">
                                                    <div class="card-body w-100 p-3">
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
                                        <input type="hidden" name="id_civile" id="id_civile" />

                                        <div class="form-group row w-100 mx-auto" id="PatientSearch">
                                            <div class="w-100" id="custom-templates" >
                                                <input class="form-control typeahead" id="id_civile2" autocomplete="off"
                                                    type="text" placeholder="chercher le patient par nom ou identifiant">
                                            </div>
                                        </div>
                                @endif

                                    @if($errors->has('id_civile'))
                                                <div class="alert alert-danger w-75 mx-auto mt-n5 mb-2" role="alert">
                                                    {{ $errors->first('id_civile') }}
                                                </div>
                                    @endif


                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg" name="motif" id="motif" maxlength="255" placeholder="Motif">
                                        @if($errors->has('motif'))
                                                <div class="alert alert-danger w-75 mx-auto mt-n5" role="alert">
                                                    {{ $errors->first('motif') }}
                                                </div>
                                        @endif
                                    </div>
                                    

                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg" name="duree" id="duree" maxlength="30" placeholder="Durée : 5 jours, 2 semaines ....">
                                        @if($errors->has('duree'))
                                                <div class="alert alert-danger w-75 mx-auto mt-n5" role="alert">
                                                    {{ $errors->first('duree') }}
                                                </div>
                                        @endif
                                    </div>
                                    



                                    <div class="mt-3">
                                        <button type="submit"
                                            class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                            <i class="fas fa-print"></i> Enregistrer le certificat</button>
                                    </div>

                                </form>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>

@endsection



@section('script')

    @if(session('status'))

    @else
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
