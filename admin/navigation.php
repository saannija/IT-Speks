<?php
    require "../assets/connect_db.php";

    $name = $_SESSION['lietotajvards'];
    $sql_user_data = "SELECT * FROM it_speks_darbinieki WHERE Lietotajvards = '$name'";
    $result = mysqli_query($savienojums, $sql_user_data);
    $user = mysqli_fetch_assoc($result);

?>

<nav id="nav-content">
    <strong><?php echo $user['Tiesibas']; ?></strong>
    <a href="index.php">Sākumlapa</a>
    <a href="vakances.php">Vakances</a>
    <a href="jaunumi.php">Jaunumi</a>
    <a href="pieteikumi.php">Pieteikumi</a>
    <a href="lietotaji.php">Lietotāji</a>
    <?php echo ($user['Tiesibas'] == 'Administrators') ? "<a href='darbinieki.php'>Darbinieki</a>" : ""; ?>
    <a href="../" target="_blank">Uz galveno vietni</a>
</nav>