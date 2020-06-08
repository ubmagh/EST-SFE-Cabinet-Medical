@extends('Medcin.Parts.pageLayout')



@section('title')
Lettres aux confrères
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('vendors/summernote/dist/summernote-bs4.css') }}">
@endsection
@section('content')
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="w-75 content-wrapper" style="max-width: none;">
            <div class="row grid-margin">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row d-block w-100 mt-4 mb-3 py-3 text-center">
                                <a   class="btn btn-primary" href="{{ url('LettreAuConfrere') }}" role="button"> <i class="fas fa-plus fa-lg"></i> Nouvelle Lettre </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>
                                                #
                                            </th>
                                            <th>
                                                date
                                            </th>
                                            <th>
                                                Confrère
                                            </th>
                                            <th>
                                                Patient
                                            </th>
                                            <th>
                                                Objet
                                            </th>
                                            <th class="text-center">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ( $Lettres as $Lettre )
                                        <tr>
                                            <td class="py-1">
                                                {{ $Lettre->num }}
                                            </td>
                                            <td>
                                                {{ substr($Lettre->date,0,16) }}
                                            </td>
                                            <td>
                                               <a href="{{ url('Confrere/'.$Lettre->ConfrereID) }}" > {{ $Lettre->Nom }} </a>
                                            </td>
                                             <td>
                                                @if( $Lettre->Pnom )
                                                    <a href="{{ url('FichePatient/'.$Lettre->PatientId) }}" > {{ $Lettre->Pnom }} </a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-truncate">
                                                {{ $Lettre->Titre }}
                                            </td>
                                            <td class="text-center">
                                               <a name="" id="" class="btn btn-warning text-white" href="{{ url('Lettre/'.$Lettre->lettreID) }}" target="_blank" > <i class="fas fa-print fa-lg"></i>  </a>
                                               <a name="" id="" class="btn btn-info text-white" href="{{ url('LettreAuConfrere').'?modify='.$Lettre->lettreID }}"  > <i class="fas fa-edit fa-lg"></i>  </a>
                                               <button type="button" name="" id="" class="btn btn-danger text-white" href="#" role="button"> <i class="fas fa-trash fa-lg"></i>  </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-4 mb-3 d-block mx-auto" style="width: fit-content;" >
                                    {{ $Lettres->links() }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




@section('script')
<script src=" {{ asset('js/FontAwesomeAll.min.js') }}"></script>
@endsection
