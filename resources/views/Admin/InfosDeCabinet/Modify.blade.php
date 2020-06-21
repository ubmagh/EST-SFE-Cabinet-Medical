@extends('Admin.Parts.pageLayout')

@section('title','Administrateur : Informations du Cabinet')

@section('css')

<style>

  .cabinetLogo {
    height: 170px;
    width: 170px;
  }

  .data {
    color : #787878;
  }

  .col .h4 {
    font-weight: lighter;
  }
</style>

@endsection


@section('content')
<div class="content-wrapper">
<!-- partial -->
<div class="container-fluid page-body-wrapper">
<div class="main-panel">
  <div class="pt-1 content-wrapper">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body mb-4">
            <h4 class="card-title h3">Modifier les informations du Cabinet :</h4>
           

          <form action="{{ url('/CabinetInfos') }}" class="mb-4" method="post" enctype="multipart/form-data">

            @csrf
            @method('POST')
            <input type="hidden" name="logodelete" id="logodelete" value="0" />

            <div class="row w-100 d-block mt-5 text-center" >
              <div class="p-4 border border-secondary mx-auto" style="width: fit-content; height: fit-content;">
              <button type="button" class="btn rounded btn-danger p-2  ml-auto {{ $cabinet->logo==''? ' d-none ':' d-block ' }}" title="Supprimer le Logo" style="margin-right: -20px !important; margin-top: -20px !important;" id="DeleteLogo"><i class="fa fa-times" ></i></button>
                <img src="{{ asset('/images/logo/').'/'.$cabinet->logo }}" class="cabinetLogo rounded-circle d-block mx-auto {{ $cabinet->logo==''? ' invisible ':'' }}"  alt="CabinetLogo" id="CabinetLogo" />
              </div>
              <small class="text-muted mt-2"> Le logo du Cabinet </small>
              <div class="custom-file d-block mt-3 col-md-8 mx-auto">
                <input type="file" class="custom-file-input" name="logo"  accept="image/png, image/jpeg, image/bmp, image/jpg, image/svg" id="customFile" />
                <label class="custom-file-label" for="customFile" data-browse="Chercher un logo">Changer le logo</label>
                <small class="text-muted ">Dimensions de plus de 200*200px </small>
              </div>
              @if($errors->has('logo'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                  </button>
                  {{$errors->first('logo')}}
                </div>
              @endif
            </div>


            <div class="row mx-auto w-75  mt-5 pr-5">
                <div class="col text-left"> 
                  <div class="d-block ml-auto" style="width: fit-content;">
                    <h4 class="h4 mt-3 text-left">
                      Nom de Cabinet :
                    </h4>
                  </div>
                </div>
                  <div class="col form-group mt-n1">
                    <input type="text"
                      class="form-control d-block" maxlength="100" name="Nom" id="" placeholder="" value="{{ $cabinet->Nom }}" />
                      @if($errors->has('Nom'))
                        <div class="alert alert-danger d-block alert-dismissible fade show" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                          </button>
                          {{$errors->first('Nom')}}
                        </div>
                      @endif
                  </div>
            </div>

            <div class="row w-75 mx-auto mt-3 pr-5">
              <div class="col text-left">
                <div class="d-block ml-auto" style="width: fit-content;">
                  <h4 class="h4 mt-3 text-left">
                    Spécialité(s) :
                  </h4>
                </div>
              </div>
              <div class="col form-group mt-n1">
                <input type="text"
                  class="form-control d-block" maxlength="255" name="Specialites" id="" placeholder="" value="{{ $cabinet->Specialites }}" />
                @if($errors->has('Specialites'))
                  <div class="alert alert-danger d-block alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      <span class="sr-only">Close</span>
                    </button>
                    {{$errors->first('Specialites')}}
                  </div>
                @endif
              </div>
              
            </div>

            <div class="row w-75 mx-auto mt-3 pr-5">
              <div class="col text-left">
                <div class="d-block ml-auto" style="width: fit-content;">
                  <h4 class="h4 mt-3 text-left">
                    Téléphone :
                  </h4>
                </div>
              </div>
              <div class="col form-group mt-n1">
                <input type="text"
                  class="form-control d-block" maxlength="14" name="Tel" id="" placeholder="" value="{{ $cabinet->Tel }}" />
                  @if($errors->has('Tel'))
                    <div class="alert alert-danger d-block alert-dismissible fade show" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                      </button>
                      {{$errors->first('Tel')}}
                    </div>
                  @endif
              </div>
            </div>

            <div class="row w-75 mx-auto mt-3 pr-5">
              <div class="col text-left">
                <div class="d-block ml-auto" style="width: fit-content;">
                  <h4 class="h4 mt-3 text-left">
                  Fax :
                  </h4>
                </div>
              </div>
              <div class="col form-group mt-n1">
                <input type="text"
                  class="form-control d-block" maxlength="14" name="Fax" id="" placeholder="" value="{{ $cabinet->Fax }}" />
                  @if($errors->has('Fax'))
                    <div class="alert alert-danger d-block alert-dismissible fade show" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                      </button>
                      {{$errors->first('Fax')}}
                    </div>
                  @endif
              </div>
            </div>

            <div class="row w-75 mx-auto mt-3 pr-5">
              <div class="col text-left">
                <div class="d-block ml-auto" style="width: fit-content;">
                  <h4 class="h4 mt-3 text-left">
                  Email :
                  </h4>
                </div>
              </div>
              <div class="col form-group mt-n1">
                <input type="email"
                  class="form-control d-block" maxlength="100" name="Email" id="" placeholder="" value="{{ $cabinet->Email }}" />
                  @if($errors->has('Email'))
                    <div class="alert alert-danger d-block alert-dismissible fade show" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                      </button>
                      {{$errors->first('Email')}}
                    </div>
                  @endif
              </div>
            </div>

            <div class="row w-75 mx-auto mt-3 pr-5 pl-0">
              <div class="col text-left">
                <div class="d-block ml-auto" style="width: fit-content;">
                  <h4 class="h4 mt-3 text-left">
                  Adresse  :
                  </h4>
                </div>
              </div>
              <div class="col form-group mt-n1">
              <textarea class="form-control d-block" name="Adresse" maxlength="255" id="" style="resize: none;" rows="3">{{ $cabinet->Adresse }}</textarea>
                @if($errors->has('Adresse'))
                    <div class="alert alert-warning d-block alert-dismissible fade show" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                      </button>
                      {{$errors->first('Adresse')}}
                    </div>
                  @endif
              </div>
            </div>

            <div class="row w-75 mx-auto mt-3 pr-5 pl-0">
              <div class="col text-left">
                <div class="d-block ml-auto" style="width: fit-content;">
                  <h4 class="h4 mt-3 text-left">
                  Description  :
                  </h4>
                </div>
              </div>
              <div class="col form-group mt-n1">
              <textarea class="form-control d-block" name="Description" maxlength="255" id="" style="resize: none;" rows="3">{{ $cabinet->Description }}</textarea>
                @if($errors->has('Description'))
                    <div class="alert alert-warning d-block alert-dismissible fade show" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                      </button>
                      {{$errors->first('Description')}}
                    </div>
                  @endif
              </div>
            </div>

            <div class="row w-75 mx-auto mt-4 mb-n4 pr-5">
              <div class="col text-left">
                <div class="d-block ml-auto" style="width: fit-content;">
                  <h4 class="h4 mt-3 text-left">
                  votre mot de passe :
                  </h4>
                </div>
              </div>
              <div class="col form-group mt-n1">
                <input type="password"
                  class="form-control" name="password" id="" placeholder="" />
                  @if($errors->has('password'))
                    <div class="alert alert-warning d-block alert-dismissible fade show" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                      </button>
                      {{$errors->first('password')}}
                    </div>
                  @elseif(session('wrongPwd'))
                    <div class="alert alert-danger d-block alert-dismissible fade show" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                      </button>
                      Mot de passe erroné !
                    </div>
                  @endif
              </div>
            </div>

            <div class="row w-75 mx-auto mt-n4 text-center pl-4 mb-4">
              <small class="text-center text-muted d-block mx-auto"> *Le mot de passe de l'administrateur est nécessaire pour toute modification. </small>
            </div>


            <div class="row w-50 mx-auto mt-5 pl-5">
              <div class="col text-left">
                <a class="btn btn-danger py-2 px-4" href="{{url('/CabinetInfos')}}" role="button"><i class="fa fa-times fa-lg"></i> Annuler</a>
              </div>
              <div class="col text-right">
                <button type="submit" name="submit"  class="btn btn-success px-4 py-2" btn-lg btn-block"><i class="fas fa-save"></i> Sauvegarder</button>
              </div>
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
    <script>
      $('#DeleteLogo').click(function(e){
        const res = confirm('Voulez vous supprimer le logo du cabinet ?');
        if(res){
          $('#logodelete').val('1');
          $('#CabinetLogo').addClass('invisible');
          $(this).addClass('invisible');
        }
      });
      $('#customFile').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })
    </script>
@endsection