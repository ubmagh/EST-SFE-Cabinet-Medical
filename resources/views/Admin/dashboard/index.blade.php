@extends('Admin.Parts.pageLayout')

@section('title','Administrateur : Acceuil')

@section('content')
        <div class="content-wrapper mx-auto" style="max-width: 80%;">
            <div class="row w-100 mx-auto my-2">
                <div class="col-md-8 col-12 grid-margin stretch-card">

                    <div class="card w-100 mx-auto my-2 LoaderSec">
                        <div class="card-body w-100 grid-margin  stretch-card" style="height: 400px;" >
                            <div class="loader-demo-box border-0">
                                <div class="dot-opacity-loader">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card d-none ContentSec">
                        <h4 class="h4 card-title mt-3 ml-3">Stockage de L'application : </h4>
                        <div class="card-body my-3  d-flex align-items-center">
                            <canvas id="doughnutChart"></canvas>
                        </div>  
                    </div>  
                </div>  


                <div class="col-md-4 row col-12 grid-margin stretch-card">
                    <div class="col-12 grid-margin mb-md-n5 mb-2 d-md-block" style="height: fit-content;">
                        <div class="card">
                            <div class="card-body w-100 LoaderSec stretch-card h-100" style="height: 100px;" >
                                <div class="loader-demo-box border-0  mt-3 mb-2">
                                    <div class="dot-opacity-loader mb-3">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-none ContentSec">
                                <p class="card-title text-md-center text-xl-left"> Nombre des utilisateurs : </p>

                                <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center mt-3 mb-3">
                                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0  text-success">{{ $medcins>1? $medcins.' Medecins':$medcins.' Medecin' }}</h3>
                                    <i class="fas fa-user-md fa-3x text-success mb-0 mb-md-3 mb-xl-0"></i>
                                </div>
                                <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center mt-4 mb-3">
                                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0  text-warning">{{ $secs>1? $secs.' Secretaires':$secs.' Secretaire' }}</h3>
                                    <i class="fas fa-user fa-3x text-warning mb-0 mb-md-3 mb-xl-0"></i>
                                </div>  
                            </div>
                        </div>
                    </div>


                    <div class="col-12 grid-margin mt-1 d-md-block">
                        <div class="card">
                            <div class="card-body w-100 LoaderSec stretch-card h-100" style="height: 100px;" >
                                <div class="loader-demo-box border-0  mt-3 mb-2">
                                    <div class="dot-opacity-loader mb-3">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-none ContentSec">
                                <p class="card-title text-md-center text-xl-left"> Rapelles SMS: </p>

                                <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center mt-3 mb-0">
                                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0  h3 text-info">{{ $Sms->nbr }} sms</h3>
                                    <i class="fas fa-sms fa-3x text-info mb-0 mb-md-3 mb-xl-0"></i>
                                </div>
                                <p class="mb-0 mt-0 text-info"> jusqu'à maintenant</p>

                                @if ($Sms->lastDate)
                                    <div class="d-block w-100 mx-auto mt-4 mb-3">
                                        <h3 class=" text-center mx-auto h5 text-secondary"> <i class="fas fa-clock"></i> Dernier envoie: <span id="last"></span> </h3>
                                    </div> 
                                @endif 
                            </div>
                        </div>
                    </div>


                </div> 
            </div>  
        </div>
@endsection

@section('script')
<script>

    function humanFileSize(bytes) {
        var thresh =1000;
        if (Math.abs(bytes) < thresh) {
            return bytes + " B";
        }
        var units =  ["ko", "Mo", "Go", "To", "Po", "Eo", "Zo", "Yo"];
        var u = -1;
        do {
            bytes /= thresh;
            ++u;
        } while (Math.abs(bytes) >= thresh && u < units.length - 1);
        return bytes.toFixed(1) + " " + units[u];
    }

    var doughnutPieData = {
        datasets: [{
        data: [ {{ $stockage->FreeSpace }}, {{ $stockage->pdf->sum }}, {{ $stockage->zip->sum }}, {{ $stockage->image->sum }}, {{ $stockage->video->sum }}],
        backgroundColor: [
            '#76C1FA',
            '#F36368',
            '#63CF72',
            '#FABA66',
            'rgba(153, 102, 255, 1)',
        ],
        borderColor: [
            '#76C1FA',
            '#F36368',
            '#63CF72',
            '#FABA66',
            'rgba(153, 102, 255, 1)',
        ],
        }],

        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: [
        'Espace libre sur le Disk',
        'les fichiers PDF',
        'les fichiers ZIP',
        'les images',
        'les videos',
        ]
    };
    var doughnutPieOptions = {
        responsive: true,
        animation: {
        animateScale: true,
        animateRotate: true
        },
        tooltips: {
            callbacks: {
                title: function(tooltipItem, data) {
                return data['labels'][tooltipItem[0]['index']];
                },
                label: function(tooltipItem, data) {
                return humanFileSize(data['datasets'][0]['data'][tooltipItem['index']],true);
                },
                afterLabel: function(tooltipItem, data) {
                    var dataset = data['datasets'][0];
                    var percent = Math.round((dataset['data'][tooltipItem['index']] / dataset["_meta"][0]['total']) * 100)
                    return '(' + percent + '%)';
                }
            }
        },
    };
    var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
   

    document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.LoaderSec').forEach(node=>{
                node.classList.add('d-none');
            });
            document.querySelectorAll('.ContentSec').forEach(node=>{
                node.classList.remove('d-none');
            });
            var doughnutChart = new Chart(doughnutChartCanvas, {
                type: 'doughnut',
                data: doughnutPieData,
                options: doughnutPieOptions
            });
            
            @if ($Sms->lastDate)
                moment.locale('fr', {
                    months : 'janvier_février_mars_avril_mai_juin_juillet_août_septembre_octobre_novembre_décembre'.split('_'),
                    monthsShort : 'janv._févr._mars_avr._mai_juin_juil._août_sept._oct._nov._déc.'.split('_'),
                    monthsParseExact : true,
                    weekdays : 'dimanche_lundi_mardi_mercredi_jeudi_vendredi_samedi'.split('_'),
                    weekdaysShort : 'dim._lun._mar._mer._jeu._ven._sam.'.split('_'),
                    weekdaysMin : 'Di_Lu_Ma_Me_Je_Ve_Sa'.split('_'),
                    weekdaysParseExact : true,
                    longDateFormat : {
                        LT : 'HH:mm',
                        LTS : 'HH:mm:ss',
                        L : 'DD/MM/YYYY',
                        LL : 'D MMMM YYYY',
                        LLL : 'D MMMM YYYY HH:mm',
                        LLLL : 'dddd D MMMM YYYY HH:mm'
                    },
                    calendar : {
                        sameDay : '[Aujourd’hui à] LT',
                        nextDay : '[Demain à] LT',
                        nextWeek : 'dddd [à] LT',
                        lastDay : '[Hier à] LT',
                        lastWeek : 'dddd [dernier à] LT',
                        sameElse : 'L'
                    },
                    relativeTime : {
                        future : 'dans %s',
                        past : 'il y a %s',
                        s : 'quelques secondes',
                        m : 'une minute',
                        mm : '%d minutes',
                        h : 'une heure',
                        hh : '%d heures',
                        d : 'un jour',
                        dd : '%d jours',
                        M : 'un mois',
                        MM : '%d mois',
                        y : 'un an',
                        yy : '%d ans'
                    },
                    dayOfMonthOrdinalParse : /\d{1,2}(er|e)/,
                    ordinal : function (number) {
                        return number + (number === 1 ? 'er' : 'e');
                    },
                    meridiemParse : /PD|MD/,
                    isPM : function (input) {
                        return input.charAt(0) === 'M';
                    },
                    meridiem : function (hours, minutes, isLower) {
                        return hours < 12 ? 'PD' : 'MD';
                    },
                    week : {
                        dow : 1, // Monday is the first day of the week.
                        doy : 4  // Used to determine first week of the year.
                    }
                });
                let text = "{{ $Sms->lastDate->DateEnvoi }}";
                setTimeout( ()=> $('#last').text(moment(text, "YYYY-MM-DD HH:mm:ss").fromNow()), 1000);
            
            @endif
        });

        
</script>

@endsection
