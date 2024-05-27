<?php
    $pdfFiles = [ 
    ["file" => "../images/sample-cv.pdf", "description" => "File 1 Description"]
    ];

    $example = $pdfFiles[0];
?>

<div id="edit-appl-window" class="default-popup">
    <div class="row">
        <h2>Rediģēt</h2>
        <button class="default-button" onclick="hideWindow('edit-appl-window')"><i class="fas fa-times"></i></button>
    </div>

    <hr>

    <table id="pieteikums-table">
        <tr>
            <td>Vārds, uzvārds</td>
            <td class="value">Vārds, uzvārds</td>
        </tr>
        <tr>
            <td>Tālrunis</td>
            <td class="value">Tālrunis</td>
        </tr>
        <tr>
            <td>E-pasta adrese</td>
            <td class="value">E-pasta adrese</td>
        </tr>
        <tr>
            <td>CV</td>
            <td>
                <a href="<?php echo htmlspecialchars($example['file'], ENT_QUOTES, 'UTF-8'); ?>"
                target="_blank"><span>Apskatīt</span></a>
            </td>
        </tr>
        <tr>
            <td>Absolvētā skola</td>
            <td class="value">Absolvētā skola</td>
        </tr>
        <tr>
            <td>Darba pieredze</td>
            <td class="value">Darba pieredze</td>
        </tr>
        <tr>
            <td>Reģistrēšanās datums</td>
            <td class="value">Reģistrēšanās datums</td>
        </tr>
        <tr>
            <td>Komentāri</td>
            <td class="value">Komentāri</td>
        </tr>
        <tr>
            <td>Pieteikuma stautss:</td>
            <td class="value">
                <form method="post">
                    <select name="Statuss" class="defaultBorders" required>
                        <option selected hidden>Neapskatīts</option>
                        <option value="123">Apstradē</option>
                        <option value="123">Izpildīts</option>
                        <option value="123">Neapskatīts</option>
                    </select>
                    <button type="submit" class="default-button" name="rediget">Saglabāt</button>
                </form>
            </td>
        </tr>
    </table>

</div>

<div id="background-overlay"></div>