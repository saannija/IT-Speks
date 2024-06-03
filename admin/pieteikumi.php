    <?php
        require "header.php";
        require "pieteikums.php";

        if(isset($_POST['detele-appl'])) {
            $applId = $_POST['detele-appl'];

            $sql_query_delete = "UPDATE it_speks_pieteikumi SET Izdzests = 1 WHERE Pieteikums_ID = '$applId'";
            mysqli_query($savienojums, $sql_query_delete);
            header('location: pieteikumi.php');
        }
    ?>
    
    <section id="admin-section">
        <div class="table-heading">Pieteikumu saraksts</div>
            <table>
                <th>Vakance</th>
                <th>Vārds</th>
                <th>Uzvārds</th>
                <th>Tālrunis</th>
                <th>E-pasts</th>
                <th>CV</th>
                <th>Komentāri</th>
                <th>Datums</th>
                <th>Statuss</th>
                <th></th>
                <th></th>

                <?php
                    require "../assets/connect_db.php";
                    $appl_SQL = "SELECT it_speks_pieteikumi.*, it_speks_vakances.Profesija
                        FROM it_speks_pieteikumi 
                        INNER JOIN it_speks_vakances ON it_speks_pieteikumi.ID_vakance = it_speks_vakances.Vakance_ID
                        WHERE it_speks_pieteikumi.Izdzests = 0 ORDER BY Datums";
                    $select_appl = mysqli_query($savienojums, $appl_SQL);

                    while($appl = mysqli_fetch_array($select_appl)){
                        $Komentars = (empty($appl['Komentari'])) ?
                             "<i class='fas fa-times'></i>" : "<i class='fas fa-check'></i>";

                        $CV = ($appl['CV'] == 0) ?
                            "<i class='fas fa-times'></i>" : "<i class='fas fa-check'></i>";

                        echo "
                            <tr>
                                <td>{$appl['Profesija']}</td>
                                <td>{$appl['Vards']}</td>
                                <td>{$appl['Uzvards']}</td>
                                <td>{$appl['Talrunis']}</td>
                                <td>{$appl['Epasts']}</td>  
                                <td>{$CV}</td>
                                <td>{$Komentars}</td>
                                <td>".date("d.m.Y. H:i:s", strtotime($appl['Datums']))."</td>
                                <td>{$appl['Statuss']}</td>
                                <td>
                                    <form method='post'>
                                        <button type='submit' name='edit-appl' class='default-button' value='{$appl['Pieteikums_ID']}' onclick='showWindow(\"edit-appl-window\")'><i class='fas fa-edit'></i></button>
                                    </form>
                                </td>
                                <td>
                                    <form method='post'>
                                        <button type='submit' name='detele-appl' value='{$appl['Pieteikums_ID']}' class='default-button'><i class='fas fa-times'></i></button>
                                    </form>
                                </td>
                            </tr>
                        ";
                    }

        
        ?>
            </table>
    </section>

    <?php
        require "../assets/footer.php"
    ?>
</body>
</html>











