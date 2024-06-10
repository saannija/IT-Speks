    <?php
        require "header.php";
        require "vakance.php";

        if(isset($_POST['detele-vac'])) {
            $vacId = $_POST['detele-vac'];

            $sql_query_delete = "UPDATE it_speks_vakances SET Izdzests = 1 WHERE Vakance_ID = '$vacId'";
            mysqli_query($savienojums, $sql_query_delete);
            header('location: vakances.php');
        }
    ?>
    <main>
    <section id="admin-section">
        <div class="table-heading">Pieejamās vakances
            <form method="post">
                <button class="default-button" onclick="showWindow('edit-vacancy-window')" value="" name="edit-vac" type="submit"><i class="fa-solid fa-circle-plus"></i> Pievienot vakanci</button>
            </form>
        </div>
        <table id="vacancy-table">
        <colgroup>
        <col style="width: 7rem;"><col class="name"><col class="name"><col><col><col><col><col><col><col><col>
        </colgroup>
        <tr>
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
            <th></th>
        </tr>

        <?php
            require "../assets/connect_db.php";
            require "../assets/pagination.php";

            $vac_SQL = "SELECT * FROM it_speks_vakances WHERE Izdzests = 0 ORDER BY Datums DESC LIMIT $offset, $rindas_lapa"; //WHERE Izdzests = 0 
            $select_vac = mysqli_query($savienojums, $vac_SQL);
        
            while ($vac = mysqli_fetch_array($select_vac)) {
                // $deletedClass = ($vac['Izdzests'] == 1) ? 'deleted' : ''; //iespeja atdzivinat izdzestos ? 
        
                $logo = ($vac['Logo'] == 0) ? "<img src='../images/image-placeholder.jpg' class='default-borders'>" :
                                              "<img src='../images/image.php?id={$vac['Logo']}' class='default-borders'>";
                // tr class='{$deletedClass}'
                echo "
                    <tr>
                        <td>{$logo}</td>
                        <td>{$vac['Profesija']}</td>
                        <td>{$vac['Kompanija']}</td>
                        <td>{$vac['Darba_vieta']}</td>
                        <td>{$vac['Atrasanas_vieta']}</td>
                        <td>{$vac['Slodze']}</td>
                        <td>{$vac['Alga']}</td>
                        <td class='descrip'>{$vac['Apraksts']}</td>
                        <td>" . date("d.m.Y.", strtotime($vac['Datums'])) . "</td>
                        <td>
                            <form method='post'>
                                <button type='submit' name='edit-vac' class='default-button' onclick='showWindow(\"edit-vacancy-window\")' value='{$vac['Vakance_ID']}'><i class='fas fa-edit'></i></button>
                            </form>
                        </td>
                        <td>
                            <form method='post'>
                                <button type='submit' name='detele-vac' value='{$vac['Vakance_ID']}' class='default-button'><i class='fas fa-times'></i></button>
                            </form>
                        </td>
                    </tr>
                ";
            }
        
        ?>

        </table>
        <div class="pagination">
            <a href="?lapa=<?php echo $sobrideja_lapa - 1; ?>" class="pagination-arrow <?php if ($sobrideja_lapa == 1) echo 'hidden'; ?>"><i class="fa-solid fa-backward-step"></i></a>
            
            <?php for ($i = 1; $i <= $visas_lapas; $i++): ?>
                <a href="?lapa=<?php echo $i; ?>" <?php if ($i == $sobrideja_lapa) echo 'class="sobrideja_lapa"'; ?>><?php echo $i; ?></a>
            <?php endfor; ?>
            
            <a href="?lapa=<?php echo $sobrideja_lapa + 1; ?>" class="pagination-arrow <?php if ($sobrideja_lapa == $visas_lapas) echo 'hidden'; ?>"><i class="fa-solid fa-forward-step"></i></a>
        </div>
    </section>
    </main>
    <?php
        require "../assets/footer.php"
    ?>
</body>
</html>
