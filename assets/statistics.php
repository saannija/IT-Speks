<?php
    require "connect_db.php";

    // Number of vacancies
    $vacancies_count_SQL = "SELECT COUNT(Vakance_ID) FROM it_speks_vakances WHERE Izdzests = 0";
    $select_vacancies_count = mysqli_query($savienojums, $vacancies_count_SQL);

    while($result = mysqli_fetch_array($select_vacancies_count)){
        $vacancyCount = "{$result['COUNT(Vakance_ID)']}";
    }

    // Number of companies 
    $companies_count_SQL = "SELECT COUNT(DISTINCT Kompanija) FROM it_speks_vakances WHERE Izdzests = 0";
    $select_companies_count = mysqli_query($savienojums, $companies_count_SQL);

    while($result = mysqli_fetch_array($select_companies_count)){
        $companyCount = "{$result['COUNT(DISTINCT Kompanija)']}";
    }

    // Number of applications
    $appl_count_SQL = "SELECT COUNT(Pieteikums_ID) FROM it_speks_pieteikumi";
    $select_appl_count = mysqli_query($savienojums, $appl_count_SQL);

    while($result = mysqli_fetch_array($select_appl_count)){
        $applCount = "{$result['COUNT(Pieteikums_ID)']}";
    }
?>