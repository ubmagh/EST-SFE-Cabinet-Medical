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
                        <div class="card-body">

                            <form method="POST" action="/lettreAuxConf">
                                {{ csrf_field() }}
                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <label class="col-form-label">Confrère :</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <select name="confrere" class="form-control" id="exampleFormControlSelect1">
                                            @foreach($confrere as $confreres)
                                                <option>{{ $confreres->Nom }} {{ $confreres->Prenom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <label class="col-form-label">Objet : </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input class="form-control" maxlength="20" name="objet" id="defaultconfig-2"
                                            type="text" placeholder="Entrer l'objet de la lettre">
                                    </div>
                                </div>

                                <div>

                                    <h4 class="card-title">Message :</h4>
                                    <textarea name="message" id="summernoteExample"></textarea>
                                    <br>
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-print"></i>
                                        Enregister et
                                        imprimer la lettre</button>


                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>




        </div>

    </div>

</div>
@endsection




@section('script')
<script src=" {{ asset('vendors/tinymce/tinymce.min.js') }}"></script>
<script src=".{{ asset('vendors/tinymce/themes/modern/theme.js') }}"></script>
<script src=" {{ asset('vendors/summernote/dist/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('js/editorDemo.js') }}"></script>


<script src=" {{ asset('js/FontAwesomeAll.min.js') }}"></script>
@endsection
