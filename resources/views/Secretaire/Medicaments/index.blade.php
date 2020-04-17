@extends('Secretaire.Parts.pageLayout')

@section('title','Secretaire : Medicaments')




@section('content')
<div class="card">
    <div class="card-body">
      <h4 class=" display-4  text-center "> Medicaments : </h4>
      <div class="d-block w-100 mb-n5 text-center mt-3">
        <a name="" id="" class="btn btn-success mx-auto text-center text-white mb-n5 mt-3" role="button"
        data-toggle="modal" data-target="#ajoutModal" type="button"> <i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i> Ajouter </a>
      </div>
      <div class="row mt-n3">
        <div class="col-12">
          <div class="table-responsive">
            <table id="order-listing" class="table">
              <thead>
                <tr>
                    <th class="text-center">Num#</th>
                    <th class="text-center">Nom</th>
                    <th class="text-center">Dosage</th>
                    <th class="text-center">Prise</th>
                    <th class="text-center">Quand</th>
                    <th colspan="2" aria-colspan="2" class="text-center"> Actions </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($medicaments as $medicament)

                <tr>
                  <td class="text-center">{{ ++$counter }}</td>
                  <td >{{ $medicament['Nom'] }}</td>
                  <td class="text-center">{{ $medicament['Dosage'] }}</td>
                  <td class="text-center">{{ $medicament['Prise'] }}</td>
                  <td class="text-center">
                    @if(strtolower($medicament['Quand'])=="avant")
                    <label class="badge badge-success text-center">Avant</label>
                    @else
                    <label class="badge badge-warning text-center">Après</label>
                    @endif
                  </td>
                  <td class="px-0 text-center">
                    <a  class="btn btn-outline-secondary py-2 " role="button"
                    data-toggle="modal" data-target="#exampleModal-edit" type="button" class="btn btn-info btn-sn"
                  data-Nom="{{ $medicament['Nom'] }}" data-Dosage="{{ $medicament['Dosage']  }}" data-Prise="{{ $medicament['Prise']  }}" 
                  data-Quand="{{ $medicament['Quand'] }}" 
                    ><i class="far fa-edit"></i> Modifier </a>
                  </td>
                  <td class="px-0 text-center">
                    <a name="" id="" class="btn btn-outline-danger py-2 " href="#" role="button"><i class="fas fa-trash-alt"></i> supprimer </a>
                  </td>
              </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>





  <!-- -------------------- Create new Modal  ------------------------- -->
<div class="modal fade left" id="ajoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog model-notify modal-md modal-right modal-info" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter un nouveau medicament</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="post"> 
        @csrf
      
        <div class="form-group">
          <label for="nom">Nom de medicament: </label>
          <input name="Nom" id="Nom" type="text" minlength="2" maxlength="100" required  class="form-control" placeholder="Nom de medicament">
        </div>

        <div class="form-group">
          <label for="Dosage">Dosage:</label>
          <input name="Dosage" id="Dosage" maxlength="30" minlength="0" type="text" class="form-control" placeholder="500mg">
        </div>

        <div class="form-group">
          <label for="Prise">Prise:</label>
          <input name="Prise" id="Prise" maxlength="30" minlength="0" type="text" class="form-control" placeholder=" une Pilule, un cuiller, 3ml">
        </div>
      
          <div class="form-group">
            <label for="Quand">Quand:</label>
            <select class="form-control" name="Quand" id="Quand">
              <option value="Avant">Avant</option>
              <option value="Apres">Apres</option>
              <option value="indifini" selected>indifini</option>
            </select>
          </div>



          <div class="row w-100">
            <div class="col">
              <button type="button" class="btn btn-danger text-white" data-dismiss="modal">  <i class="fas fa-times ml-n1 mr-1"></i>Annuler</button>
        </div>
            <div class="col">
              <button type="submit" class="btn btn-info text-white d-block ml-auto mr-0"> <i class="fa fa-plus-square ml-n1 mr-1" aria-hidden="true"></i> Ajouter </button>
        </div>
          </div>
        </div>
    </form>
    </div>
  </div>
</div>
  <!-- -------------------- ENDZ Create Modal   ------------------------- -->





  <!-- -------------------- EDIT Modal  ------------------------- -->
<div class="modal fade left" id="exampleModal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog model-notify modal-md modal-right modal-info" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nouveau patient</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="post"> 
        @csrf
      
        <div class="form-group">
          <label for="nom">Nom</label>
          <input name="Nom" id="nom" type="text"  class="form-control" placeholder="Entrer le nom">
        </div>

        <div class="form-group">
          <label for="prenom">Prénom</label>
          <input name="Prenom" id="prenom" type="text" class="form-control" placeholder="Entrer le prénom">
        </div>

        <input type="hidden" id="id_patient" name="id_patient">


        <div class="form-group">
          <label for="datenaissance">Date de naissance</label>
          <input name="DateNaissance" id="datenaissance" type="date" class="form-control">
        </div>


        <div class="form-group">
          <label for="ref_mutuel">référence de la mutuelle</label>
          <input name="ref_mutuel" id="ref_mutuel" type="text" class="form-control" placeholder="Entrer la référence de la mutuelle">
        </div>
      
        

          <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-info">Modifier</button>
        </div>
    </form>
    </div>
  </div>
</div>
  <!-- -------------------- ENDZ EDIT Modal   ------------------------- -->



@endsection

@section('script')
<script>

  // define data table options
  const dataTable_Place_Holder = "medicament";
  const dataTable_Search_label = "Chercher: ";
  const dataTable_nbr_lines_language = "Afficher _MENU_ lignes";
  const dataTable_Order_string = "asc"; /// "desc" for descendent order
  const dataTable_can_sort_columns__ =  [
                                                      { "orderable": false, "targets": [5,6] }
                                                    ];  
</script>
<script src=" {{ asset('js/data-table.js') }}"></script>
<script src=" {{ asset('js/FontAwesomeAll.min.js') }}"></script>
@endsection