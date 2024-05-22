    <?php
        require "header.php";
        require "navigation.php";
    ?>

    <section id="admin-section">
        <div class="table-heading">Pieejamās vakances</div>
        <table>
        <colgroup>
        <col style="width: 7rem;"><col style="width: 13rem;"><col style="width: 13rem;"><col><col><col><col><col style="width: 35rem;"><col><col><col>
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
            for($i = 0; $i < 9; $i++){
                echo "
                    <tr>
                        <td>
                            <img src='../images/example.jpg' class='default-borders'>
                        </td>
                        <td>Profesijas nosaukums</td>
                        <td>Kompānijas nosaukums</td>
                        <td>Darba vieta</td>
                        <td>Atrašanās vieta</td>
                        <td>Slodze</td>
                        <td>Alga</td>
                        <td>Apraksts</td>
                        <td>Datums</td>
                        <td>
                            <form method='post' action='vakance.php'>
                                <button type='submit' name='edit' class='default-button'><i class='fas fa-edit'></i></button>
                            </form>
                        </td>
                        <td>
                            <form method='post' action='vakance.php'>
                                <button type='submit' name='detele' class='default-button'><i class='fas fa-times'></i></button>
                            </form>
                        </td>
                    </tr>
                ";
            }
        
        ?>
        <!-- value='{$piet['Audzeknis_ID']}' -->

        </table>
    </section>
    
    <?php
        require "../assets/footer.php"
    ?>
</body>
</html>
