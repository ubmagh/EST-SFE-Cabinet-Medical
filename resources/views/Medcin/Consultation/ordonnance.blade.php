<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ ltrim(public_path('css/styleOrdo.css'), '/') }}" />
  
  <title>Ordonnance</title>
</head>
<body>
  <header class="clearfix">
    <div id="logo">
      <img src="{{ ltrim(public_path('/images/logo/').'/'.$cabinet->logo,'/') }}">
    </div>
    <div style="float: none; display: inline-block;  width: 50%;">
        <div class="to" style="margin-top: 30px; display: inline-block; width:100%; margin-bottom: 0px; border: 1px solid black;">
          <h2 style="display: block; margin-bottom: 0px; margin-top: 10px;word-wrap: break-word;"> {{$cabinet->Nom}} </h2>
          <h4 class="name" style="display: block; margin-left: 60px !important; word-wrap: break-word;">{{$cabinet->Specialites }} </h4>
        </div>
    </div>
    <div style="display: inline; margin-left: auto;">
        <div class="to">Docteur : {{$nom}}</div>
        <h2 class="name">Spécialité : {{$medecin->Specialite}} </h2>
    </div>
  </header>


  <main>
    <div id="details" class="clearfix">
      <div id="client">
        <div class="to">Patient :</div>
        <h2 class="name">{{$patient->Prenom}} {{$patient->Nom}}</h2>
      </div>
    </div>
    <table cellspacing="0" cellpadding="0">
      <thead>
        <tr>
          <th class="desc">Médicament</th>
          <th class="unit">prises par jour</th>
          <th class="qty">Période</th>
   
        </tr>
      </thead>
      <tbody>
        @foreach($medi as $medis)
        <tr>
          
        <td class="desc">{{$medis->medicament->Nom}}</td>
          <td class="unit">{{$medis->NbrParJour}}</td>
          <td class="qty">{{$medis->Periode}}</td>
          
        </tr>
         @endforeach
      </tbody>
     
     
    </table><br><br>
    <div id="notices">
      <div>Analyses à faire</div>
      <div class="notice">{{$consultation->ExamensAfaire}}</div>
    </div><br><br>
    <div id="notices">
      <div>Remarques</div>
      <div class="notice">{{$ordonnance->Description}}</div>
    </div>

    <div id="thanks" style="margin-left: 60%; margin-top: 50%">Le 19/05/2020</div>
  </main>
  <footer>
    Adresse : {{$cabinet->Adresse}}  / Tél : {{$cabinet->Tel}} / Fax : {{$cabinet->Fax}}
  </footer>
 




</body>
</html>