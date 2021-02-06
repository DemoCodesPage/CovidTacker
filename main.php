<?php
    $get_data = file_get_contents('https://covid19.th-stat.com/api/open/today');
    $covid_data = json_decode($get_data);

    print_r($covid_data);

    $comfirmed = $covid_data->Comfirmed;
?>