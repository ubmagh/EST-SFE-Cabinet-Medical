<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"
        href="{{ ltrim(public_path('css/styleOrdo.css'), '/') }}" />

    <title>Ordonnance</title>
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img
                src="{{ ltrim(public_path('/images/logo/').'/'.$cabinet->logo,'/') }}">
        </div>
        <div style="float: none; display: inline-block;  width: 50%; margin-bottom: 0px; padding-bottom: 0px;">
            <div class="to" style="margin-top: 25px; display: inline-block; width:100%; margin-bottom: 0px; ">
                <h2
                    style="display: block; text-align: left; margin-bottom: 0px; margin-top: 10px;word-wrap: break-word; ">
                    {{ $cabinet->Nom }} </h2>
                <h4 class="name"
                    style="display: block; margin-top: 7px; margin-left: 80px !important; word-wrap: break-word;">
                    {{ $cabinet->Specialites }} </h4>
            </div>
        </div>
        <div
            style=" float: none; display: block; width: 100%; margin-bottom: 0px; padding-bottom: 0px; margin-top: -30px;">
            <div class="to" style="margin-top: 0px; width:100%; text-align: center; margin-bottom: 0px; ">
                <h2 style=" margin-bottom: 0px;  word-wrap: break-word; "> Docteur : {{ $medecin->Nom.' '.$medecin->Prenom }} </h2>
                <h3 class="name" style=" margin-top: 7px;  word-wrap: break-word;">Spécialité :
                    {{ $medecin->Specialite }} </h3>
            </div>
        </div>
    </header>


    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <h3>
                    Patient :
                </h3>
                <div style="text-align: center;">
                    <h2 class="name">{{ $patient->Prenom }} {{ $patient->Nom }}</h2>
                </div>
            </div>
        </div>

        @if( count($medi)>0 )
          <table cellspacing="0" cellpadding="0">
              <thead>
                  <tr>
                      <th class="desc" style="width: 45%;">Médicament</th>
                      <th class="unit" style="width: 27.5%;">prises par jour</th>
                      <th class="qty" style="width: 27.5%;">Période</th>

                  </tr>
              </thead>
              <tbody>
                  @foreach($medi as $medis)
                      <tr>

                          <td class="desc">{{ $medis->medicament->Nom }}</td>
                          @if( $medis->medicament->Quand!='indifinie' )
                            <td class="unit">{{ $medis->NbrParJour.' '.$medis->medicament->Prise.', '.$medis->medicament->Quand}}</td>
                          @else
                            <td class="unit">{{ $medis->NbrParJour.' '.$medis->medicament->Prise }}</td>
                          @endif
                          <td class="qty">{{ $medis->Periode }}</td>

                      </tr>
                  @endforeach
              </tbody>
          </table>
          <br><br>
        @endif
        

        @if(  $ordonnance->Description )
          <div id="notices">
              <h3 style="padding-top: 6px; padding-bottom: 7px;">
                  Remarques :
              </h3>
          </div>
          <div class="notice remarques">
            <p>
              {{ $ordonnance->Description }}
            </p>
          </div>
          <br><br>
        @endif


        @if( $consultation->ExamensAfaire )
          <div id="notices">
              <h3 style="padding-top: 6px; padding-bottom: 7px;">
                  Analyses à faire :
              </h3>
          </div>
          <div class="notice afaire">
            <p>
              {{ $consultation->ExamensAfaire }}
            </p>
          </div>
        @endif

        <div id="thanks">
          <span style="font-size: 1.1em; color: #2D1832;">
            Le {{ date_format(  DateTime::createFromFormat("Y-m-d H:i:s", $consultation->Date),"d / m / Y") }}
          </span>
          @if($medecin->Signature)
            <img src="{{ storage_path('Signatures/'.$medecin->Signature) }}" class="Signature" alt="Signature" />
          @endif
          <h6 style="text-align: center; font-size: 0.8em;color: black;">
            {{ $medecin->Nom.' '.$medecin->Prenom }}
          </h6>

        </div>

    </main>
    <footer>
        Adresse : {{ $cabinet->Adresse }} / Tél : {{ $cabinet->Tel }} / Fax : {{ $cabinet->Fax  }} / Email : {{ $cabinet->Email }}
    </footer>





</body>

</html>
