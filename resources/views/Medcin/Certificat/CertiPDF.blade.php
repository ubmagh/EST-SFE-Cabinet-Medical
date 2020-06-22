<!DOCTYPE html>
<html lang="fr">

<head>
    <style media="all">
            @page :first{
                margin-bottom: 0.2in;
            }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"
        href="{{ ltrim(public_path('css/styleOrdo.css'), '/') }}" />

    <title>Certificate</title>
</head>

<body>
    
    
    <header class="clearfix" >
        <div id="logo">
            <img
                src="{{ ltrim(public_path('/images/logo/').'/'.$cabinet->logo,'/') }}">
        </div>
        <div style="float: none; display: inline-block;  width: 50%; margin-bottom: 0px; padding-bottom: 0px;">
            <div class="to" style="margin-top: 25px; display: inline-block; width:100%; margin-bottom: 0px;  ">
                <h2
                    style="display: block; text-align: left; margin-bottom: 0px; margin-top: 10px;word-wrap: break-word; ">
                    {{ $cabinet->Nom }} </h2>
                <h4 class="name"
                    style="display: block; margin-top: 7px; margin-left: 80px !important; word-wrap: break-word;">
                    {{ $cabinet->Specialites }} </h4>
            </div>
        </div>
        <div
            style=" float: right; position: relative; display: inline; width: 50%; margin-bottom: 0px; padding-bottom: 0px; margin-top: -70px;">
            <div class="to" style="margin-top: 0px; width:100%; text-align: center; margin-bottom: 0px; ">
                <h2 style=" margin-bottom: 0px;  word-wrap: break-word; "> Docteur : {{ $medecin->Nom.' '.$medecin->Prenom }} </h2>
                <h3 class="name" style=" margin-top: 7px;  word-wrap: break-word;">Spécialité :
                    {{ $medecin->Specialite }} </h3>
            </div>
        </div>
    </header>


    <main>
        <div id="details" class="clearfix" style="margin-bottom: 32px;margin-top: 35px;">
            <div id="">
                
                <div style="text-align: center; font-size: large; color: black;">
                    <h2 class="name">Certificat Médical</h2>
                </div>
            </div>
        </div>

        <div style="width: 85%; margin: 0 auto;">
            <div>
                <p>Je soussigné, Docteur {{ $medecin->Nom.' '.$medecin->Prenom }}</p>
            </div>
            <br>

            <div>
                <p> Certifie avoir examiné ce jour le patient {{ $patient->Prenom }} {{ $patient->Nom }}, 
                    son état de santé nécessite un congé médical de {{$data->Duree}}, pour le motif : {{$data->Motif}},
                    à compter du {{$date}} .
                </p>
            </div>
            <br>

            <div>
                <p>Certificat remis en mains propres à l'intéressé pour faire valoir ce que de droit.</p>
            </div>
        </div>


            

        <div style=" font-size: 1.3em; width: 40%; margin-left:60%; margin-top: 50px; display: block; position: relative;">
          <span style="font-size: 1.1em; color: #2D1832;">
            Le {{ date_format(  DateTime::createFromFormat("Y-m-d H:i:s", $data->date),"d / m / Y") }}
          </span>
          @if($medecin->Signature)
            <img src="{{ storage_path('Signatures/'.$medecin->Signature) }}" class="Signature" style="max-width: 150px; max-height:120px; margin-left: -120px; margin-top: 40px;" alt="Signature" />
          @endif
          <h6 style="text-align: center; font-size: 0.8em;color: black; margin-top: 10px; width: 100%;">
            {{ $medecin->Nom.' '.$medecin->Prenom }}
          </h6>
        </div>

    </main>
    <footer>
        Adresse : {{ $cabinet->Adresse }} / Tél : {{ $cabinet->Tel }} / Fax : {{ $cabinet->Fax  }} / Email : {{ $cabinet->Email }}
    </footer>





</body>

</html>
