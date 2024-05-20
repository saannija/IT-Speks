    <?php
        require "header.php";
        require "navigation.php";
    ?>

    <section id="admin-section">
        <div class="table-heading">Darbinieku saraksts</div>
        <table>
            <th>Lietotājvārds</th>
            <th>E-pasts</th>
            <th>Parādāmais vārds</th>
            <th>Pieejas tiesības</th>
            <th>Parole</th>
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








