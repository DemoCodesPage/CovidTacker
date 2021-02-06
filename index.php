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

    $up = "<i class='fas fa-angle-double-up'></i> เพิ่มขึ้น";
    $down = "<i class='fas fa-angle-double-down'></i> ลดลง";
    $equal = "<i class='fas fa-equals'></i> คงที่";

    $tl_Date = $covid_timeline->Data;
    // echo "<pre>";
    // print_r($tl_Date[0]);
    // echo "</pre>";
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
                        <a href="#chart" class="nav-link">กราฟ</a>
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
                                <div class="status p-sm-2 mt-md-4 justify-content-between">
                                    <span>
                                        <?php echo ($NewConfirmed != 0 ? ($NewConfirmed > 0 ? $up : $down) : $equal); ?>
                                    </span>
                                    <span><?php echo abs(number_format($NewConfirmed)); ?></span>
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
                                    <div class="status p-sm-2 justify-content-between">
                                        <span>
                                            <?php echo ($NewHospitalized != 0 ? ($NewHospitalized > 0 ? $up : $down) : $equal); ?>
                                        </span>
                                        <span><?php echo abs(number_format($NewHospitalized)); ?></span>
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
                                    <div class="status p-sm-2 justify-content-between">
                                        <span>
                                            <?php echo ($NewRecovered != 0 ? ($NewRecovered > 0 ? $up : $down) : $equal); ?>
                                        </span>
                                        <span><?php echo abs(number_format($NewRecovered)); ?></span>
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
                                    <div class="status p-sm-2 justify-content-between">
                                        <span>
                                            <?php echo ($NewDeaths != 0 ? ($NewDeaths > 0 ? $up : $down) : $equal); ?>
                                        </span>
                                        <span><?php echo abs(number_format($NewDeaths)); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- <section class="" id="chart">
        <div class="container-lg">
            <div class="row">
                <div class="col">
                    <h1>แนวโน้มการติดโควิด</h1>
                    <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-lg">
            <div class="row">
                <div class="col"></div>
            </div>
        </div>
    </section> -->

    
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: [<?php
                            $n = 0;
                            foreach ($tl_Date as $value) {
                                echo $tl_Date[$n]->Date . ', ';
                                $n += 1;
                            }
                            ?>],
                datasets: [{
                        label: 'ผู้ติดเชื้อ',
                        fill: false,
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: [<?php
                                $n = 0;
                                foreach ($tl_Date as $value) {
                                    echo $tl_Date[$n]->NewConfirmed . ', ';
                                    $n += 1;
                                }
                                ?>],
                        borderWidth: 1
                    },
                    {
                        label: 'กำลังรักษา',
                        fill: false,
                        backgroundColor: '#f2c94c',
                        borderColor: '#f2c94c',
                        data: [<?php
                                $n = 0;
                                foreach ($tl_Date as $value) {
                                    echo $tl_Date[$n]->NewHospitalized . ', ';
                                    $n += 1;
                                }
                                ?>],
                        borderWidth: 1
                    },
                    {
                        label: 'หายแล้ว',
                        fill: false,
                        backgroundColor: '#039245',
                        borderColor: '#039245',
                        data: [<?php
                                $n = 0;
                                foreach ($tl_Date as $value) {
                                    echo $tl_Date[$n]->NewHospitalized . ', ';
                                    $n += 1;
                                }
                                ?>],
                        borderWidth: 1
                    },
                    {
                        label: 'เสียชีวิต',
                        fill: false,
                        backgroundColor: '#d22d36',
                        borderColor: '#d22d36',
                        data: [<?php
                                $n = 0;
                                foreach ($tl_Date as $value) {
                                    echo $tl_Date[$n]->NewHospitalized . ', ';
                                    $n += 1;
                                }
                                ?>],
                        borderWidth: 1
                    }

                ]
            },

            // Configuration options go here
            options: {

            }
        });
    </script>
    
    <!-- <script src="assets/js/ChartJs.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.5/lottie.min.js" integrity="sha512-0bCDSnaX8FOD9Mq8WbHcDwshXwCB5V4EP+UBu87WQgga2b7lAsuEbaSmIZjH/XEmNhJuhrPbFHemre5HZwrk9w==" crossorigin="anonymous"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>