@extends('Medcin.Parts.pageLayout')



@section('title')
    Liste des consultations
@endsection


@section('content')



      <div class="card h-100">
        <div class="card-body">
            <div class="d-block w-100 mb-n5 text-center mt-3">
                <a name="" id="" class="btn btn-primary mx-auto text-center text-white mb-n5 mt-3" role="button"
                    data-toggle="modal" data-target="#AddModal" type="button"> <i class="fa fa-plus-circle fa-lg"
                        aria-hidden="true"></i> Ajouter une consultation </a>
            </div>
        <div  class="row mt-n3">
            <div class="col-12">
              <div   class="table-responsive">

   
                <table id="order-listing" class="table">
                 
                  <thead>
                    
                    <tr>
                        <th class="text-center">Num Consultation</th>
                        <th class="text-center">Date de consultation</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Patient </th>
                        <th class="text-center">Medecin</th>
                        <th class="text-center">Urgent</th>
                        <th class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($consultations as $consultation)
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="px-0 text-center">

                          <!-- -------------------- EDIT BUTTON   ------------------------- -->
                        <button   
                        
                        data-toggle="modal" data-target="#modal_edit"   role="button" type="button" 
                             class="btn btn-outline-success py-2 ">
                             <i class="far fa-edit"></i> Modifier</button>

                          <!-- -------------------- DELETE BUTTON   ------------------------- -->
                        <button  data-toggle="modal" data-target="#ModalDelete" 
                          role="button" type="button" class="btn btn-outline-danger py-2 ">
                          <i class="fas fa-trash-alt"></i> Supprimer</button>

                          

                        

                    </tr>
                    @endforeach                     
                  </tbody>
                  
                  
                </table>

<!-- -------------------- INSERT Modal   ------------------------- -->


<div class="modal fade left" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog model-notify modal-md modal-right modal-info" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nouvelle consultation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form id="addform" action="####here" method="POST"> 
        <div  class="modal-body">
        {{csrf_field()}}



        <div class="col-auto" style="width : 55%; margin-left: 22%">
            <label class="sr-only" for="inlineFormInputGroup">Identifiant Civil</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text">@</div>
              </div>
              <input type="text" class="form-control" id="inlineFormInputGroup" 
              placeholder="Identifiant civil">
            </div>
        </div><br>

          <div class="form-group">
            <label for="exampleFormControlInput1">Nom du patient </label>
            <input name="Nom" type="text" class="form-control" placeholder="Entrer le nom">
          </div>
  
          <div class="form-group">
            <label for="exampleFormControlInput1">Prénom du patient </label>
            <input name="Prenom" type="text" class="form-control" placeholder="Entrer le prénom">
          </div>

          <div class="form-group">
            <label for="Mutuel">Type de la consultation</label>
            <select name="typeMutuel" class="form-control">
              <option>1</option>
              
            </select>
          </div>


          @foreach($medecins as $medecin)
          <div class="form-group">
            <label for="Mutuel">Médecin</label>
            <select name="typeMutuel" class="form-control">
              <option>{{$medecin['Nom']}} {{$medecin['Prenom']}}</option>
              
            </select>
          </div>
          @endforeach

          @foreach($secretaires as $secretaire)
          <div class="form-group">
            <label for="Mutuel">Secrétaire</label>
            <select name="typeMutuel" class="form-control">
              <option>{{$secretaire['Nom']}} {{$secretaire['Prenom']}}</option>
              
            </select>
          </div>
          @endforeach

          <div class="form-group">
            <label for="exampleFormControlTextarea1">Description de la consultation</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label for="exampleFormControlTextarea1">Urgent (Optionnel)</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>

          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-times-circle"></i> Annuler</button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>

            </form>
    
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

    <script>
    const dataTable_Place_Holder = "Consultation";
    const dataTable_Search_label = "Chercher : ";
    const dataTable_nbr_lines_language = "Afficher _MENU_ lignes";
    const dataTable_Order_string = "asc"; /// "desc" for descendent order
    const dataTable_can_sort_columns__ = [{
        "orderable": false,
        "targets": [6]
    }];
   </script>  
    


    <script src=" {{ asset('js/FontAwesomeAll.min.js') }}"></script>
    <script src=" {{ asset('js/data-table.js') }}"></script>
    




    @endsection