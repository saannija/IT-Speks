    <?php
        require "header.php";
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

            <div class="stat-box">
                <span>25</span>
                <p>Pieejamās vakances</p>
            </div>
        </div>

        <div class="wrapper">
            <div class="container">
                <div class="table-heading"><strong>Jaunākie pieteikumi</strong></div>
                <table>
                    <tr>
                        <th>Vārds</th>
                        <th>Uzvārds</th>
                        <th>Datums</th>
                    </tr>
                    <tr><td>John</td><td>Doe</td><td>1990-05-15</td></tr>
                    <tr><td>Jane</td><td>Smith</td><td>1985-07-20</td></tr>
                    <tr><td>Michael</td><td>Johnson</td><td>1978-11-02</td></tr>
                    <tr><td>Emily</td><td>Davis</td><td>1992-03-18</td></tr>
                    <tr><td>David</td><td>Wilson</td><td>1988-09-30</td></tr>
                    <tr><td>Emma</td><td>Garcia</td><td>1995-12-12</td></tr>
                    <tr><td>James</td><td>Martinez</td><td>1982-04-07</td></tr>
                    <tr><td>Olivia</td><td>Hernandez</td><td>1993-08-24</td></tr>
                    <tr><td>Robert</td><td>Lopez</td><td>1975-06-14</td></tr>
                    <tr><td>Ava</td><td>Gonzalez</td><td>2000-01-05</td></tr>
                    <!-- max 10 -->
                </table>
            </div>

            <div class="chart-container">
                <div class="table-heading"><strong>Pieprasītākās vakances</strong></div>
                <canvas id="vacancy-chart"></canvas>
            </div>
        </div>
        
    </section>
    
    <?php
        require "../assets/footer.php";
    ?>
</body>
</html>