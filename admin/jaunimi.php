<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style_main.css">
    <title>Jaunimi</title>
</head>
<body>
    <?php
        require "header.php";
        require "navigation.php";
    ?>

    <section id="admin-section">
        <div class="table-heading">...aktualitātes</div>
        <table>
            <th>Āttels</th>
            <th>Virsraksts</th>
            <th>Saturs</th>
            <th>Datums</th>
            <th></th>
        </table>

    <!-- <td>
            <form method='post' action='??.php'>
                <button type='submit' name='edit' class='btn' value='{$piet['Audzeknis_ID']}'><i class='fas fa-edit'></i></button>
                <button type='submit' name='detele' class='btn' value='{$piet['Audzeknis_ID']}'><i class='fas fa-times'></i></button>
            </form>
        </td> -->
    </section>

    <?php
        require "../assets/footer.php"
    ?>
</body>
</html>





