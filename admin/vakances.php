<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style_main.css">
    <title>Vakances</title>
</head>
<body>
    <?php
        require "header.php";
        require "navigation.php";
    ?>

    <section id="admin-section">
        <div class="table-heading">...vakances</div>
        <table>
            <th>Logo</th>
            <th>Profesijas nosaukums</th>
            <th>Kompānijas nosaukums</th>
            <th>Darba vieta</th>
            <th>Atrašanās vieta</th>
            <th>Slodze</th>
            <th>Alga</th>
            <th>Apraksts</th>
            <th>Datums</th>
            <th></th>

            <!-- <td>
                <form method='post' action='vakance.php'>
                    <button type='submit' name='edit' class='btn' value='{$piet['Audzeknis_ID']}'><i class='fas fa-edit'></i></button>
                    <button type='submit' name='detele' class='btn' value='{$piet['Audzeknis_ID']}'><i class='fas fa-times'></i></button>
                </form>
            </td> -->
        </table>
    </section>
    
    <?php
        require "../assets/footer.php"
    ?>
</body>
</html>
