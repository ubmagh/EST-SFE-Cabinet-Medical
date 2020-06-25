@extends('Medcin.Parts.pageLayout')

@section('title','Medecin : Acceuil')

@section('content')

<div class="content-wrapper">
    
        <div class="row">
          <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title text-md-center text-xl-left">nombre des Rendez-vous </p>
                
                <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                  <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$nb_rdv}}</h3>
                  <i class="ti-calendar icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                </div>  
                <p class="mb-0 mt-2 text-warning">Aujourd'hui <span class="text-black ml-1"><small></small></span></p>
              </div>
            </div>
          </div>
          <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title text-md-center text-xl-left">nombre de patient en attente</p>
                               
                <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                  <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$nb_attente}}</h3>
                  <i class="ti-user icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                </div> 
                <p class="mb-0 mt-2 text-warning">Maintenant <span class="text-black ml-1"><small></small></span></p>
              </div>
            </div>
          </div>
          <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title text-md-center text-xl-left">nombre des cas d'urgence</p>
                <p class="card-title text-md-center text-xl-left"></p>
                <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                  <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$nb_urgence}}</h3>
                  <i class="ti-agenda icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                </div>  
                <p class="mb-0 mt-2 text-warning">Maintenant <span class="text-black ml-1"><small></small></span></p>
              </div>
            </div>
          </div>
          <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title text-md-center text-xl-left">Totals des consultations</p>
                <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                  <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$nb_consultation}}</h3>
                  <i class="ti-layers-alt icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                </div>  
                <p class="mb-0 mt-2 text-warning">Aujourd'hui <span class="text-black ml-1"><small></small></span></p>
              </div>
            </div>
          </div>
        </div>
        <div class="row" id="body" >  
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Patient de cabinet Par Année</h4>
                  <div class="dropdown">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Détails | Choisir l'année:
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2" id="type">
                      @foreach ($year_patient as $row)
                          <button class="dropdown-item" type="button" value={{$row}}>{{$row}}</button> 
                      @endforeach
                    </div>
                  </div>
                  <canvas id="areaChart"></canvas>
                </div>
              </div>
            </div>

            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Recettes et Dépenses du cabinet Par Année </h4>
                  <div class="dropdown">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Détails | Choisir l'année:
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2" id="compta">
                      @foreach ($year_compta as $row)
                          <button class="dropdown-item" type="button" value={{$row}}>{{$row}}</button> 
                      @endforeach
                    </div>
                  </div>
                  <div id="morris-bar-example"></div>
                </div>
              </div>
            </div>

          




        </div> 
      
</div>

@endsection

@section('script')

<script>
    var url = "{{url('/YearPatient')}}";
    
    $.get(url, function(response){
          var areaOptions = {
                plugins: {
                  filler: {
                    propagate: true
                  }
                }
              }
        var areaData = {
                labels: response.months,
                datasets: [{
                  label: 'Patient par Année',
                  data: response.post_count_data,
                  backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                  ],
                  borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                  ],
                  borderWidth: 1,
                  fill: true, // 3: no fill
                }]
        };
            if ($("#areaChart").length) {
                var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
                var areaChart = new Chart(areaChartCanvas, {
                  type: 'line',
                  data: areaData,
                  options: areaOptions
                });
              }
    });
</script> 

<script>    

  var bool = false;
  $(document).ready(function(){
              let tmp='';
              for(let i=0 ; i< $("#type button").length ;i++){
                  $("#type button").eq(i).click(function(){                          
                      tmp =$("#type button").eq(i).val();            
                      $.ajax({
                        type: 'GET',        
                        url: './MonthDayPatient',
                        data: 'tmp='+tmp,
                        success: function (response) {
                                  let poi =response.months,arr= [], arr_number=[];
                                      Object.keys(poi).forEach(e =>{ 
                                    arr.push(poi[e]);
                                    arr_number.push(e);
                                  });                     
                          var new_component=`
                              <div class="col-lg-6 grid-margin stretch-card" id="div2">
                                  <div class="card">
                                    <div class="card-body">
                                      <h4 class="card-title">Patient de cabinet Par Mois | Année `+tmp+`</h4>
                                      <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Détails | Choisir le Mois:
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2" id="drop" >                                                                                                                                           
                                        </div>
                                      </div>
                                      <canvas id="areaChart1"></canvas>
                                    </div>
                                  </div>
                              </div>          
                          `;
                            var newline='';
                              $("#div_compta").remove();
                              $("#div2").remove();
                              $("#div_compta_2").remove();  
                              $("#div3").remove();
                              $("#body").append(new_component);

                          for (let index = 0; index < arr_number.length ; index++) {
                            newline=`
                                <button class="dropdown-item" type="button" id="`+arr_number[index]+`" value=`+arr_number[index]+`>`+arr_number[index]+`</button> 
                            `                                                                     
                              $("#drop").append(newline); 
                          }  
                          bool = true;  
                          //console.log("1 "+bool);
                              var areaOptions = {
                                    plugins: {
                                      filler: {
                                        propagate: true
                                      }
                                    }
                                  };
                            var areaData = {
                                    labels: arr,
                                    datasets: [{
                                      label: 'Patient par Mois',
                                      data: response.patient_count_data,
                                      backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                      ],
                                      borderColor: [
                                        'rgba(255,99,132,1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                      ],
                                      borderWidth: 1,
                                      fill: true, // 3: no fill
                                    }]
                            }; 
                            
                                if ($("#areaChart1").length) {
                                    var areaChartCanvas = $("#areaChart1").get(0).getContext("2d");
                                    var areaChart = new Chart(areaChartCanvas, {
                                      type: 'line',
                                      data:areaData ,
                                      options: areaOptions
                                    });
                                }
                                if(bool){ 
                                  let tmp_1='';                           
                                    for(let k = 0 ; k< $('#drop button').length ; k++){
                                          $('#drop button').eq(k).click(function(){                          
                                              tmp_1 =$('#div2').find('#drop button').eq(k).val();  
                                              $.ajax({
                                                  type: 'GET',        
                                                  url: './MonthDayPatient',
                                                  data: {
                                                    'tmp': tmp,
                                                    'tmp_1': tmp_1                                              
                                                  },
                                                  success: function (response) {
                                                  let poi_1 =response.day, arr_1=[], arr_number_1=[];
                                                        Object.keys(poi_1).forEach(e_1 =>{                                                     
                                                      arr_1.push(poi_1[e_1]);
                                                      arr_number_1.push(e_1);
                                                    }); 
                                                      new_component=`
                                                          <div class="col-lg-6 grid-margin stretch-card" id="div3">
                                                              <div class="card">
                                                                <div class="card-body">
                                                                  <h4 class="card-title">Patient de cabinet Par jours | Mois `+tmp_1+` | Année `+tmp+`</h4>
                                                                  <canvas id="areaChart2"></canvas>
                                                                </div>
                                                              </div>
                                                          </div>          
                                                      `; 
                                                      $("#div3").remove();
                                                      $("#body").append(new_component);
                                                      var areaOptions = {
                                                          plugins: {
                                                            filler: {
                                                              propagate: true
                                                            }
                                                          }
                                                      };
                                                      var areaData = {
                                                              labels: arr_number_1,
                                                              datasets: [{
                                                                label: 'Patient par Jours',
                                                                data:arr_1 ,
                                                                backgroundColor: [
                                                                  'rgba(255, 99, 132, 0.2)',
                                                                  'rgba(54, 162, 235, 0.2)',
                                                                  'rgba(255, 206, 86, 0.2)',
                                                                  'rgba(75, 192, 192, 0.2)',
                                                                  'rgba(153, 102, 255, 0.2)',
                                                                  'rgba(255, 159, 64, 0.2)'
                                                                ],
                                                                borderColor: [
                                                                  'rgba(255,99,132,1)',
                                                                  'rgba(54, 162, 235, 1)',
                                                                  'rgba(255, 206, 86, 1)',
                                                                  'rgba(75, 192, 192, 1)',
                                                                  'rgba(153, 102, 255, 1)',
                                                                  'rgba(255, 159, 64, 1)'
                                                                ],
                                                                borderWidth: 1,
                                                                fill: true, // 3: no fill
                                                              }]
                                                      }; 
                            
                                                      if ($("#areaChart2").length) {
                                                          var areaChartCanvas = $("#areaChart2").get(0).getContext("2d");
                                                          var areaChart = new Chart(areaChartCanvas, {
                                                            type: 'line',
                                                            data:areaData ,
                                                            options: areaOptions
                                                          });
                                                      }
                                                    
                                                  }
                                              });                                                                                                                                                         
                                          });  
                                    }                           
                                } 
                                
                              
                                  
                        },
                        error: function (error) {

                        }                
                      });  
                                                                                                                                                                              
                  });                                    
              }
          
            

              

  });

                                
                                
              
          
</script>


<script>
   var buffer= false;
   var url = "{{url('/YearCompa')}}";
   $.get(url, function(response){    
    if ( $("#morris-bar-example").length && response.length) {
      Morris.Bar({
        element: 'morris-bar-example',
        barColors: ['#63CF72', '#F36368', '#76C1FA', '#FABA66'],
        data: response,
        xkey: 'Année',
        ykeys: ['Recette', 'Dépense'],
        labels: ['Recette', 'Dépense']
      });
    }           
  });                  
</script>
<script>
   $(document).ready(function(){
              let a='';
              for(let i=0 ; i< $("#compta button").length ;i++){
                  $("#compta button").eq(i).click(function(){                          
                      a =$("#compta button").eq(i).val();          
                      $.ajax({
                        type: 'GET',        
                        url: './DetailYearCompta',
                        data: 'tmp='+a,
                        success: function (response) {           
                                var new_component=`
                                <div class="col-lg-6 grid-margin stretch-card" id="div_compta">
                                  <div class="card">
                                    <div class="card-body">
                                      <h4 class="card-title">Recettes et Dépenses du cabinet Par mois | Année `+a+` </h4>
                                      <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Détails | Choisir le mois:
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2" id="compta_1">
                                        </div>
                                      </div>
                                      <div id="morris-bar-example_1"></div>
                                    </div>
                                  </div>
                                </div>
                                `;
                                  var newline='';
                              $("#div2").remove();
                              $("#div3").remove();
                              $("#div_compta").remove();   
                              $("#div_compta_2").remove();     
                              $("#body").append(new_component);
                                

                                for (let ind = 0; ind < response.month_number.length ; ind++) {
                                  newline=`
                                      <button class="dropdown-item" type="button" id="`+ response.month_number[ind]+`" value=`+ response.month_number[ind]+`>`+ response.month_number[ind]+`</button> 
                                  `                                                                     
                                    $("#compta_1").append(newline); 
                                }  
                                    
                                if ($("#morris-bar-example_1").length) {
                                  Morris.Bar({
                                    element: 'morris-bar-example_1',
                                    barColors: ['#63CF72', '#F36368', '#76C1FA', '#FABA66'],
                                    data: response.data,
                                    xkey: 'Mois',
                                    ykeys: ['Recette', 'Dépense'],
                                    labels: ['Recette', 'Dépense']
                                  });
                                }
                                buffer= true;   
                                if(buffer){ 
                                  let a_1='';                           
                                    for(let c = 0 ; c< $('#compta_1 button').length ; c++){
                                          $('#compta_1 button').eq(c).click(function(){                          
                                              a_1 = $('#compta_1 button').eq(c).val(); 
                                              $.ajax({
                                                  type: 'GET',        
                                                  url: './DetailYearCompta',
                                                  data: {
                                                    'tmp': a,
                                                    'tmp_1': a_1                                              
                                                  },
                                                  success: function (response) {
                                                   var new_component=`
                                                      <div class="col-lg-6 grid-margin stretch-card" id="div_compta_2">
                                                        <div class="card">
                                                          <div class="card-body">
                                                            <h4 class="card-title">Recettes et Dépenses du cabinet Par Jours | Mois `+a_1+` | Année `+a+` </h4>
                                                            <div id="morris-bar-example_2"></div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                      `;    
                                                      $("#div_compta_2").remove();     
                                                      $("#body").append(new_component);
                                                      if ($("#morris-bar-example_2").length) {
                                                          Morris.Bar({
                                                            element: 'morris-bar-example_2',
                                                            barColors: ['#63CF72', '#F36368', '#76C1FA', '#FABA66'],
                                                            data: response.data,
                                                            xkey: 'Jours',
                                                            ykeys: ['Recette', 'Dépense'],
                                                            labels: ['Recette', 'Dépense']
                                                          });
                                                        }
                                                    
                                                  }
                                              });                                                                                                                                                         
                                          });  
                                    }                           
                                }          
                        },
                        error: function (error) {

                        }                
                      });  
                                                                                                                                                                              
                  });                                    
              }
          
            

              

  });

</script>



@endsection