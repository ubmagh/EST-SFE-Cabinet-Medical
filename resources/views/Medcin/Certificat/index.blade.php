@extends('Medcin.Parts.pageLayout')



@section('title')
Certificat Médical
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('vendors/summernote/dist/summernote-bs4.css') }}">
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
                      <img src="{{ asset('images/icons/contract.png') }}" class="w-md-100 mx-sm-auto d-md-block d-sm-block ml-md-auto ml-lg-n3  ml-lg-0" style="max-height: 80px;" alt="Secretary login" />
                    </div>
                  
                    <div class="col-md-9 col-sm-12 d-flex align-content-center align-items-center ml-lg-0">
                      <h1 class="h1 display-4 text-sm-center text-md-left mx-sm-auto mr-md-auto mt-sm-3 text-info"> Certificat Médical </h1>
                    </div>
                  </div>
                
                <form action="/Certificat" method="POST" class="pt-3">
                    {{ csrf_field() }}

                  <div class="form-group">
                    <input type="text" class="form-control"  name="id_patient"  placeholder="Patient">
                  </div>

                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="motif" id="motif" placeholder="Motif">
                  </div>

                  <div class="form-group">
                    <input type="number" class="form-control form-control-lg" name="duree" id="duree" placeholder="Durée">
                  </div>

                  
                  
                  <div class="mt-3">
                    <button type="submit"  class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                        <i class="fas fa-print"></i> Enregistrer et imprimer le certificat</button>
                  </div>

                 
                  
                </form>
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


<script src="{{ asset('/js/typeahead.bundle.min.js') }}"></script>



<script src=" {{ asset('vendors/tinymce/tinymce.min.js') }}"></script>
<script src=".{{ asset('vendors/tinymce/themes/modern/theme.js') }}"></script>
<script src=" {{ asset('vendors/summernote/dist/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('js/editorDemo.js') }}"></script>


<script src=" {{ asset('js/FontAwesomeAll.min.js') }}"></script>
@endsection
