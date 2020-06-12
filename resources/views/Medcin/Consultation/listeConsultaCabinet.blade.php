@extends('Medcin.Parts.pageLayout')



@section('title')
Liste des consultation
@endsection



@section('content')


<div class="content-wrapper">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            
            <div class="row grid-margin">
              <div class="col-12">
                
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="table-responsive">
                  <table id="order-listing" class="table">
                    <thead>
                      <tr class="bg-primary text-white">
                          <th class="text-center">#</th>
                          <th class="text-center">Nom</th>
                          <th class="text-center">Prénom</th>
                          <th class="text-center">Date</th>
                          <th class="text-center">Type de consultation</th>
                          <th class="text-center">Description</th>
                          <th class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($consultation as $consultations)
                      <tr>
                          <td class="text-center">{{$consultations->id}}</td>
                          <td class="text-center">{{$consultations->patient->Nom}}</td>
                          <td class="text-center">{{$consultations->patient->Prenom}}</td>
                          <td class="text-center">{{$consultations->Date}}</td>
                          <td class="text-center">{{$consultations->Type}}</td>
                          <td class="text-center">{{$consultations->Description}}</td>
                          <td class="px-0 text-center">
                            <button 
                          data-id="{{$consultations->id}}"
                          data-Type="{{$consultations->Type}}"
                          data-Description="{{$consultations->Description}}"
                          data-Type="{{$consultations->Type}}"
                          data-Urgent="{{$consultations->Urgent}}"
                          data-ExamensAfaire="{{$consultations->ExamensAfaire}}"
                            data-toggle="modal" data-target="#modal_edit" class="btn btn-light">
                              <i class="ti-check-box text-primary"></i>Modifier
                            </button>
                            <button 
                              data-id_delete="{{ $consultations['id'] }}"
                              data-toggle="modal" data-target="#ModalDelete"
                              class="btn btn-light">
                              <i class="ti-close text-danger"></i>Supprimer
                            </button>
                          </td>
                      </tr>
                     @endforeach
                    </tbody>
                </table>

                   <!-- -------------------- DELETE Modal  ------------------------- -->

                   <div class="modal fade left" id="ModalDelete" tabindex="-1" role="dialog"
                   aria-labelledby="exampleModalLabel" aria-hidden="true">
                   <div class="modal-dialog model-notify modal-md modal-right modal-info" role="document">
                       <div class="modal-content">
                           <div class="modal-header">
                               <h5 class="modal-title" id="exampleModalLabel">Suppression du Consultation</h5>
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                   <span aria-hidden="true">&times;</span>
                               </button>
                           </div>
                           <div class="modal-body">
                               <form id="deleteform">
                                   {{ csrf_field() }}
                                   {{ method_field('delete') }}



                                   <input type="hidden" id="id_delete" name="id_delete">
                                   <p class="text-center" style="font-size : 20px">Voulez-vous vraiment
                                       supprimer
                                       cette consultation ?</p><br>



                                   <button type="button" class="btn btn-primary" data-dismiss="modal"
                                       style="margin-left : 12%"><i class="far fa-times-circle"></i>
                                       Non/Annuler</button>
                                   <button type="submit" class="btn btn-danger" style="margin-left : 12%"><i
                                           class="fas fa-trash-alt"></i> Oui/Supprimer</button>
                           </div>
                           </form>

                           <div id="msgSucc-delete" role="alert" style="background: rgb(214,233,198);background: linear-gradient(0deg, rgba(214,233,198,1) 0%, 
rgba(198,233,229,1) 100%);" class="alert alert-success d-none">
                               <i class="fa fa-check"></i> <strong>Succés!</strong> La consultation est supprimée
                               avec
                               succés !
                           </div>

                           <div id="msgDanger-delete" style="background: rgb(235,204,209);background: linear-gradient(0deg, rgba(235,204,209,1) 0%, 
rgba(235,204,221,0.927608543417367) 100%);" role="alert" class="alert alert-danger d-none">
                               <i class="fa fa-times"></i> <strong>Danger !</strong> La consultation n'est pas été
                               supprimée !
                           </div>

                       </div>
                   </div>
               </div>


 <!-- -------------------- EDIT Modal  ------------------------- -->


 <div class="modal fade left" id="modal_edit" tabindex="-1" role="dialog"
 aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog model-notify modal-md modal-right modal-info" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Modication de la consultation</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>

         <form id="editform">
             <div class="modal-body">
                 {{ csrf_field() }}
                 {{ method_field('PUT') }}

                 <input type="hidden" id="id" name="id_consultation">


                 <div class="form-group">
                     <label class=" font-weight-bold " for="Type">Type de consultation</label>
                     <select name="Type" id="type" class="form-control">
                         <option>Normale</option>
                         <option>Contrôle</option>
                         <option>à Domicile</option>
                     </select>
                 </div>

                 <div class="form-group">
                    <label class=" font-weight-bold " for="Urgent">Urgente</label>
                    <select name="Urgent" id="urgent" class="form-control">
                        <option>Oui</option>
                        <option>Non</option>
                    </select>
                </div>

                 <div class="form-group" >
                    <label class=" font-weight-bold ">Description</label>
                    <textarea class="form-control" name="Description" id="description" rows="8" maxlength="450"></textarea>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="analysesAlert">
                        <span id="analysesError"></span>
                    </div>
                </div>

                <div class="form-group" >
                    <label class=" font-weight-bold ">Examens à faire (Optionnel)</label>
                    <textarea class="form-control" name="ExamensAfaire" id="examen" rows="8" maxlength="450"></textarea>
                    <div class="alert alert-danger alert-dismissible fade mt-n5 d-none " role="alert"
                        id="analysesAlert">
                        <span id="analysesError"></span>
                    </div>
                </div>

                 


                 <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                         class="far fa-times-circle"></i> Annuler</button>
                 <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i>
                     Modifier</button>
             </div>
         </form>

         <div id="msgSucc-edit" role="alert" style="background: rgb(214,233,198);background: linear-gradient(0deg, rgba(214,233,198,1) 0%, 
rgba(198,233,229,1) 100%);" class="alert alert-success d-none">
             <i class="fa fa-check"></i> <strong>Succés!</strong> La consultation est modifiée avec
             succés !
         </div>

         <div id="msgDanger-edit" style="background: rgb(235,204,209);background: linear-gradient(0deg, rgba(235,204,209,1) 0%, 
rgba(235,204,221,0.927608543417367) 100%);" role="alert" class="alert alert-danger d-none">
             <i class="fa fa-times"></i> <strong>Danger !</strong> La consultation n'est pas été
             modifiée !
         </div>


     </div>
 </div>
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

    //*******************************Delete Form*****************************************

    $('#ModalDelete').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        const id = button.data('id_delete');
        let modal = $(this);
        $('#id_delete').val("" + id);
    });


    document.getElementById('deleteform').onsubmit =
        function (e) {
            e.preventDefault();
            var Deletedid = $('#id_delete').val();
            $.ajax({
                type: "DELETE",
                url: "/ListeConsultationCabinet/delete/" + Deletedid,
                data: $('#deleteform').serialize(),
                success: function (response) {
                    $("#msgSucc-delete").removeClass('d-none').addClass('d-block');
                    $("#deleteform").addClass('d-none');
                    location.reload();
                },

                error: function (error) {
                    console.log(error)
                    $("#msgDanger-delete").removeClass('d-none').addClass('d-block');
                    $("#deleteform").addClass('d-none');
                    location.reload();
                }

            });
        };

        //*******************************Edit Form*****************************************


    $('#modal_edit').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        var Type = button.data('type');
        var Description = button.data('description');
        var Urgent = button.data('urgent');
        var ExamensAfaire = button.data('examensafaire');
        var id = button.data('id');

        let modal = $(this);
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #type').val(Type);
        modal.find('.modal-body #description').val(Description);
        modal.find('.modal-body #examen').val(ExamensAfaire);


        if(Urgent == 1){
        Urgent = 'Oui';
        modal.find('.modal-body #urgent').val(Urgent); 
        }
        if(Urgent == 0){
        Urgent = 'Non';
        modal.find('.modal-body #urgent').val(Urgent); 
        }

        modal.find('.modal-body #examen').val(ExamensAfaire);
        


    });

    document.getElementById('editform').onsubmit =
        function (e) {
            e.preventDefault();
            var id = $('#id').val();
            $.ajax({
                type: "PUT",
                url: "/ListeConsultationCabinet/edit/" + id,
                data: $('#editform').serialize(),
                success: function (response) {
                    $("#msgSucc-edit").removeClass('d-none').addClass('d-block');
                    $("#editform").addClass('d-none');
                    location.reload();
                },

                error: function (error) {
                    $("#msgDanger-edit").removeClass('d-none').addClass('d-block');
                    $("#editform").addClass('d-none');

                }
            });
        };


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
