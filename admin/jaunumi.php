    <?php
        require "header.php";
        require "navigation.php";
    ?>

    <section id="admin-section">
        <div class="table-heading">Jaunumu saraksts</div>
        <table>
            <colgroup>
            <col style="width: 7rem;"><col><col style="width: 45rem;"><col><col style="width: 8rem;"><col style="width: 8rem;">
            </colgroup>

            <th>Āttels</th>
            <th>Virsraksts</th>
            <th>Saturs</th>
            <th>Datums</th>
            <th></th>
            <th></th>

            <?php
            for($i = 0; $i < 9; $i++){
                echo "
                    <tr>
                        <td>
                            <img src='../images/example2.jpg' class='default-borders'>
                        </td>
                        <td>Virsraksts</td>
                        <td>Saturs</td>
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
        </table>
    </section>

    <?php
        require "../assets/footer.php"
    ?>
</body>
</html>




