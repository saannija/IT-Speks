<?php
    require "connect_db.php";

    // Vacancies amount
    $vacancies_count_SQL = "SELECT COUNT(Vakance_ID) FROM it_speks_vakances WHERE Deleted = 0";
    $select_vacancies_count = mysqli_query($savienojums, $vacancies_count_SQL);

    while($result = mysqli_fetch_array($select_vacancies_count)){
        $vacancyCount = "{$result['COUNT(Vakance_ID)']}";
    }

    //Companies amount
    $companies_count_SQL = "SELECT COUNT(DISTINCT Kompanija) FROM it_speks_vakances WHERE Deleted = 0";
    $select_companies_count = mysqli_query($savienojums, $companies_count_SQL);

    while($result = mysqli_fetch_array($select_companies_count)){
        $companyCount = "{$result['COUNT(DISTINCT Kompanija)']}";
    }

    //Applications amount
    // $appl_count_SQL = "SELECT Pieteikumi_ID FROM it_speks_pieteikumi";
    // $select_appl_count = mysqli_query($savienojums, $appl_count_SQL);

    // while($result = mysqli_fetch_array($select_appl_count)){
    //     $applCount = "{$result['Pieteikumi_ID']}";
    // }
?>