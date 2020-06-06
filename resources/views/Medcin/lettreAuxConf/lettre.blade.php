<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
    
    <div style="margin-left: 10%">
	<p>Dr. {{$confrere->Nom}} {{$confrere->Prenom}}</p>
	<p>{{$confrere->Tel}}</p>
	<p>{{$confrere->adresse}}</p>
	<p>{{$confrere->Email}}</p>
    </div>

    <div style="margin-left: 60%">
	<p>Dr. {{$medecin->Nom}} {{$medecin->Nom}}</p>
	<p>{{$medecin->Tel}}</p>
	<p>{{$medecin->Adresse}}</p>
	<p>{{$medecin->Email}}</p>
    </div>

    <div style="margin-left: 10%">
	<p>Objet : {{$lettre->Titre}}</p>
	<p>{{$lettre->Message}}</p>
    </div>

    

    <div style="margin-top:  10%; margin-left: 60%">
	<p>Dr. {{$medecin->Nom}} {{$medecin->Nom}}</p>
	<p>Signature</p>
    </div> 

    

    

</body>
</html>