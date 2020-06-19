<!DOCTYPE html>
<html lang="fr">

<head>
    <style media="all">
            @page :first{
                margin-bottom: 0.7in;
            }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"
        href="{{ ltrim(public_path('css/styleOrdo.css'), '/') }}" />

    <title>Lettre au Confrère</title>
    
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
    

    <main style="width: 95%;  margin: 0 auto;">
        
        <div style="margin-left: 5%; max-width: 50%;">
            
            <p class="coo"> 
                <span style="font-weight: bold;">A: </span>
                {{$confrere->Nom}}
            </p>
            
            <p class="coo" style="margin-left : 10px;"> 
                {{$confrere->Specialite}}
            </p>

            

            @if($confrere->Tel)
                <p class="coo"> 
                    <span style="font-weight: bold;">TEL: </span>
                    {{$confrere->Tel}}
                    @if($confrere->Fax)
                        <span style="font-weight: bold;"> / FAX: </span>
                        {{$confrere->Fax}}
                    @endif
                </p>
            @endif

            @if($confrere->Email)
                <p class="coo" style="color: darkslategray;"> 
                    {{$confrere->Email}}
                </p>
            @endif

            <p class="coo"> 
                {{$confrere->adresse}},{{ ' '.$confrere->Ville}}. 
            </p>


        </div>

        <div style="margin-left: 65%; max-width: 40%; margin-top: -10 px;">
       
            <p class="coo">
                <span style="font-weight: bold;"> Dr. </span>{{$medecin->Nom}} {{$medecin->Prenom}}
            </p>
            <p class="coo">
                <span style="font-weight: bold;">TEL: </span>
                {{$medecin->Tel}}
            </p>

             <p class="coo">
                {{$medecin->Email}}
            </p>

            <p class="coo" style="color: darkslategray;">
                {{$cabinet->Nom}}
            </p>
           

        </div>

        <div style="margin-left: 13%; margin-top: 20px; margin-bottom: 30px;">
            <h3 style="font-weight: normal;font-size: large;"> <span style="font-weight: bolder;"> Objet :</span> {{$lettre->Titre}} </h3>
        </div>

        <div style="width: 84%; margin-left: auto; margin-right: auto; margin-top: 19px;line-break: auto; word-wrap: break-word; " >


            <p style="  ">
                {!! $lettre->Message !!}
            </p>

        </div>


        <div style="width: 85%; margin-left: auto; margin-right: auto; margin-top: 10px;line-break: auto; word-wrap: break-word; " >

            @if( $patient )
                <div style="position: relative; display: inline-block; margin-top: 5%; margin-bottom: 0px; width: 45%; ">
                    <h5 style="font-size: medium; margin-bottom: 0px;"> infos du Patient : </h5>
                    <div style="margin-top: 0px; margin-left : 24px;">
                        <p style="margin-top: 8px;"> Nom:  {{ $patient->Nom }} {{ $patient->Prenom }} </p>
                        <p style="margin-top: -3px;"> Identifiant Civile: {{ $patient->id_civile }} </p>
                        @if($patient->typeMutuel)
                            <p style="margin-top: -3px;"> Mutuel : {{ $patient->typeMutuel }}  - ref : {{ $patient->ref_mutuel }} </p>
                        @endif
                        @if($age)
                        <p style="margin-top: -3px;">Age : {{ $age }} ans </p>
                        @endif
                    </div>
                </div>
            @endif



            <div style=" font-size: 1.3em; width: 53%; margin-left: 20%; display: inline-block; position: relative;">
            <span style="font-size: 1.1em; color: #2D1832;">
                Le {{ date_format(  DateTime::createFromFormat("Y-m-d H:i:s", $lettre->date),"d / m / Y") }}
            </span>
            @if($medecin->Signature)
                <img src="{{ storage_path('Signatures/'.$medecin->Signature) }}" class="Signature" alt="Signature" />
            @endif
            <h6 style="text-align: center; font-size: 0.8em;color: black; margin-top: 10px; width: 100%;">
                {{ $medecin->Nom.' '.$medecin->Prenom }}
            </h6>
            </div>
        </div>

    </main>

    
    <footer>
        Adresse : {{ $cabinet->Adresse }} / Tél : {{ $cabinet->Tel }} / Fax : {{ $cabinet->Fax  }} / Email : {{ $cabinet->Email }}
    </footer>

</body>
</html>