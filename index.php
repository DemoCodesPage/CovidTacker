<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/font-awesome/css/all.css">
    <script defer src="/assets/font-awesome/js/all.js"></script>
    <!-- <link rel="stylesheet" href="/node_modules/chart.js/dist/Chart.min.css">
    <script src="/node_modules/chart.js/dist/Chart.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <title>Covid-19</title>
</head>

<body>
    <?php
    $get_SumCase = file_get_contents('https://covid19.th-stat.com/api/open/cases/sum');
    $get_dataToday = file_get_contents('https://covid19.th-stat.com/api/open/today');
    $get_timeline = file_get_contents('https://covid19.th-stat.com/api/open/timeline');
    $covid_data = json_decode($get_dataToday);
    $covid_case = json_decode($get_SumCase);
    $covid_timeline = json_decode($get_timeline);

    // echo "<pre>";
    // print_r($covid_timeline);
    // echo "</pre>";

    $Confirmed = $covid_data->Confirmed;
    $Recovered = $covid_data->Recovered;
    $Hospitalized = $covid_data->Hospitalized;
    $Deaths = $covid_data->Deaths;
    $NewConfirmed = $covid_data->NewConfirmed;
    $NewRecovered = $covid_data->NewRecovered;
    $NewHospitalized = $covid_data->NewHospitalized;
    $NewDeaths = $covid_data->NewDeaths;
    $UpdateDate = $covid_data->UpdateDate;

    $Province = $covid_case->Province;
    $Nation = $covid_case->Nation;
    $Gender = $covid_case->Gender;

    $tl_Date = $covid_timeline->Data;
    echo "<pre>";
    print_r($tl_Date[0]);
    echo "</pre>";
    $i = 0;
    // foreach ($tl_Date as $value) {
    //     echo $tl_Date[$i]->Date . " ";
    //     $i += 30;
    // }

    // $n = 0;
    // foreach($tl_Date as $value) {
    //     $time = strtotime($tl_Date[$n]->Date);
    //     $newformat = date("d/m/Y", $time);
    //     echo $newformat . "<br>";
    //     $n += 1;
    // }

    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
        <div class="container">
            <a href="#" class="navbar-brand">Covid Tracker</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="#" class="nav-link active" aria-current="page">ประเทศไทย</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">กราฟ</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">ทั่วโลก</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="text-white">
        <div class="container-lg h-100">
            <div class="row h-100 align-items-center">
                <div class="col-sm-12 col-lg-6 header-text">
                    <h5>ยืนยันตัวเลขผู้ติดเชื้อ</h5>
                    <h1>COVID-19</h1>
                    <h5>ทั้งหมดในประเทศไทย</h5>
                </div>
                <div class="col-sm-12 col-lg-6 position-absolute">
                    <div id="covid-home"></div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <span class="font-style"><?php echo $UpdateDate ?></span>
                    <div class="card shadow-sm card-1 p-lg-3 mb-4">
                        <div class="card-body d-flex justify-content-between">
                            <div class="col-4">
                                ผู้ติดเชื้อสะสม
                                <div class="status p-sm-2 mt-md-4">
                                    <?php echo ($NewConfirmed != 0 ? "<i class='fas fa-angle-double-up'></i>เพิ่มขึ้น" : "<i class='fas fa-equals'></i>คงที่"); ?>
                                    <?php echo number_format($NewConfirmed); ?>
                                </div>
                            </div>
                            <div class="col-8">
                                <h1><?php echo number_format($Confirmed); ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="card shadow-sm card-2">
                                <div class="card-body">
                                    <div class="card-title card-style">
                                        กำลังรักษา
                                    </div>
                                    <h1><?php echo number_format($Hospitalized); ?></h1>
                                    <div class="status p-sm-2">
                                        <?php echo ($NewHospitalized != 0 ? "<i class='fas fa-angle-double-up'></i> เพิ่มขึ้น" : "<i class='fas fa-equals'></i> คงที่"); ?>
                                        <?php echo number_format($NewHospitalized); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card shadow-sm card-3">
                                <div class="card-body">
                                    <div class="card-title card-style">
                                        หายแล้ว
                                    </div>
                                    <h1><?php echo number_format($Recovered); ?></h1>
                                    <div class="status p-sm-2">
                                        <?php echo ($NewRecovered != 0 ? "<i class='fas fa-angle-double-up'></i> เพิ่มขึ้น" : "<i class='fas fa-equals'></i> คงที่"); ?>
                                        <?php echo number_format($NewRecovered); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card shadow-sm card-4">
                                <div class="card-body">
                                    <div class="card-title card-style">
                                        เสียชีวิต
                                    </div>
                                    <h1><?php echo number_format($Deaths); ?></h1>
                                    <div class="status p-sm-2">
                                        <?php echo ($NewDeaths != 0 ? "<i class='fas fa-angle-double-up'></i> เพิ่มขึ้น" : "<i class='fas fa-equals'></i> คงที่"); ?>
                                        <?php echo number_format($NewDeaths); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="card">
        <div class="container-lg">
            <div class="row">
                <div class="col">
                    <h1>แนวโน้มการติดโควิด</h1>
                </div>
            </div>
        </div>
    </div>

    <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
    <h1 id="date"></h1>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [<?php $n = 0;
                            foreach ($tl_Date as $value) {
                                $time = strtotime($tl_Date[$n]->Date);
                                $newformat = date($time);
                                echo $newformat . ", ";
                                $n += 1;
                            }
                            ?>],
                datasets: [{
                        label: 'ผู้ติดเชื้อ',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            '#ea5771',
                        ],
                        borderColor: [
                            '#ea5771',
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'กำลังรักษา',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            '#f2c94c',

                        ],
                        borderColor: [
                            '#f2c94c',
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'หายแล้ว',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            '#039245',

                        ],
                        borderColor: [
                            '#039245',
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'เสียชีวิต',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            '#d22d36',

                        ],
                        borderColor: [
                            '#d22d36',
                        ],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

    <!-- <script src="assets/js/ChartJs.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.5/lottie.min.js" integrity="sha512-0bCDSnaX8FOD9Mq8WbHcDwshXwCB5V4EP+UBu87WQgga2b7lAsuEbaSmIZjH/XEmNhJuhrPbFHemre5HZwrk9w==" crossorigin="anonymous"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>