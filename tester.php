<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>

<body>
    <?php
    $get_data = file_get_contents('https://covid19.th-stat.com/api/open/today');
    $covid_data = json_decode($get_data);

    echo "<pre>";
    print_r($covid_data);
    echo "</pre>";

    $Confirmed = $covid_data->Confirmed;
    $Recovered = $covid_data->Recovered;
    $Hospitalized = $covid_data->Hospitalized;
    $Deaths = $covid_data->Deaths;
    $NewConfirmed = $covid_data->NewConfirmed;
    $NewRecovered = $covid_data->NewRecovered;
    $NewHospitalized = $covid_data->NewHospitalized;
    $NewDeaths = $covid_data->NewDeaths;
    $UpdateDate = $covid_data->UpdateDate;
    ?>

    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">
                Covid-19
            </a>
            <form action="" class="d-flex">
                <input type="search" class="form-control me-2" placeholder="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="container-md">
        <label for="row"><?php echo $UpdateDate ?></label>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="icon">
                            <box-icon name='virus' type='solid' color='#ff0000'></box-icon>
                            <h5 class="card-title">ติดเชื้อสะสม</h5>
                        </div>
                        <p><?php echo $Confirmed; ?></p>
                        <hr>
                        <p><?php echo $NewConfirmed; ?></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">หายแล้ว</h5>
                        <p><?php echo $Recovered; ?></p>
                        <hr>
                        <p><?php echo $NewRecovered; ?></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">รักษาอยู่ใน รพ.</h5>
                        <p><?php echo $Hospitalized; ?></p>
                        <hr>
                        <p><?php echo $NewHospitalized; ?></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">เสียชีวิต</h5>
                        <p><?php echo $Deaths; ?></p>
                        <hr>
                        <p><?php echo $NewDeaths; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>