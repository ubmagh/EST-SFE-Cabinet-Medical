@extends('Secretaire.Parts.pageLayout')

@section('title','Secretaire : Medicaments')




@section('content')
<div class="card">
    <div class="card-body">
      <h4 class="card-title">Data table</h4>
      <div class="row">
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
                    <a name="" id="" class="btn btn-outline-secondary py-2 " href="#" role="button"><i class="far fa-edit"></i> Modifier </a>
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