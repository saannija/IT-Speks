<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style_main.css">
    <script src="../assets/script.js" defer></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <title>Sākumlapa</title>
</head>
<body>
    <?php
        require "header.php";
        require "navigation.php";
    ?>

    <section id="admin-section">
        <h2>Pārskats</h2>
        <div class="content">
            <div class="stat-box">
                <span>20</span>
                <p>Jauni pieteikumi</p>
            </div>

            <div class="stat-box">
                <span>25</span>
                <p>Pieteikumi pēdējo 24h laikā</p>
            </div>

            <div class="stat-box">
                <span>25</span>
                <p>Pieteikumi kopā</p>
            </div>
        </div>

        <div class="wrapper">
            <div class="container default-borders">
                <div class="table-heading">Jaunākie pieteikumi:</div>
                <table>
                    <tr>
                        <th>Vārds</th>
                        <th>Uzvārds</th>
                        <th>Datums</th>
                    </tr>
                    <tr>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                    </tr>
                    <tr>
                        <td>123</td>
                        <td>123</td>
                        <td>123</td>
                    </tr>
                </table>
            </div>

            <div class="container">
                <h2>Pieprasītākās vakances</h2>
                <div id="vacancy-chart"></div>
            </div>

        </div>
        
    </section>
    
    <?php
        require "../assets/footer.php";
    ?>
</body>
</html>