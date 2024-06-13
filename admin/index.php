    <?php
        require "header.php";
        require "../assets/connect_db.php";
        require "../assets/statistics.php";
    ?>

    <section id="admin-section">
        <h2>Pārskats</h2>
        <div class="content">
            <div class="stat-box">
                <span><?php echo $applNewCount; ?></span>
                <p>Jauni pieteikumi</p>
            </div>

            <div class="stat-box">
                <span><?php echo $applDayCount; ?></span>
                <p>Pieteikumi pēdējo 24h laikā</p>
            </div>

            <div class="stat-box">
                <span><?php echo $applCount; ?></span>
                <p>Pieteikumi kopā</p>
            </div>

            <div class="stat-box">
                <span><?php echo $vacancyCount; ?></span>
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
                    <?php
                        $select_sql = "SELECT Vards, Uzvards, Datums FROM it_speks_pieteikumi ORDER BY Datums DESC LIMIT 10;";
                        $select = mysqli_query($savienojums, $select_sql);

                        while($result = mysqli_fetch_array($select)){
                            echo "
                                <tr>
                                    <td>{$result['Vards']}</td>
                                    <td>{$result['Uzvards']}</td>
                                    <td>".date("d.m.Y.", strtotime($result['Datums']))."</td>
                                </tr>
                            ";
                        }
                    ?>
                </table>
            </div>

            <div class="chart-container">
                <div class="table-heading"><strong>Pieprasītākās vakances</strong></div>
                <canvas id="vacancy-chart"></canvas>
                <?php
                    $vacancies_SQL =  "SELECT COUNT(Pieteikums_ID), it_speks_vakances.Profesija
                    FROM it_speks_pieteikumi 
                    INNER JOIN it_speks_vakances ON it_speks_pieteikumi.ID_vakance = it_speks_vakances.Vakance_ID
                    WHERE it_speks_pieteikumi.Izdzests = 0 GROUP BY Profesija";
                   
                    $select_vacancies = mysqli_query($savienojums, $vacancies_SQL);

                    $vacanciesNum = array();
                    $vacancies = array();
                    while($result = mysqli_fetch_array($select_vacancies)){
                        array_push($vacanciesNum, (int)$result['COUNT(Pieteikums_ID)']);
                        array_push($vacancies, $result['Profesija']);
                    }

                    $jsonVacancies = json_encode($vacancies);
                    $jsonVacanciesNum = json_encode($vacanciesNum);

                ?>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const ctx = document.getElementById('vacancy-chart');

                        if (ctx) {
                            ctx.getContext('2d');

                            myChart = new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: <?php echo $jsonVacancies; ?>,
                                    datasets: [{
                                        label: 'Skaits',
                                        data: <?php echo $jsonVacanciesNum; ?>,
                                        backgroundColor: [
                                            'rgba(56, 176, 0, 0.2)',
                                            'rgba(167, 241, 168, 0.2)',
                                            'rgba(36, 118, 0, 0.2)',
                                            'rgba(90, 169, 50, 0.2)',
                                            'rgba(159, 213, 141, 0.2)',
                                            'rgba(36, 118, 0, 0.2)',
                                            'rgba(112, 209, 85, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgba(56, 176, 0, 0.5)',
                                            'rgba(167, 241, 168, 0.5)',
                                            'rgba(36, 118, 0, 0.5)',
                                            'rgba(90, 169, 50, 0.5)',
                                            'rgba(159, 213, 141, 0.5)',
                                            'rgba(36, 118, 0, 0.5)',
                                            'rgba(112, 209, 85, 0.5)'
                                        ],
                                        borderWidth: 1,
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    plugins: {
                                        legend: {
                                            display: true,
                                            position: 'right',
                                            labels: {
                                                color: '#000'
                                            }
                                        },
                                        datalabels: {
                                            formatter: (value, ctx) => {
                                                let sum = 0;
                                                let dataArr = ctx.chart.data.datasets[0].data;
                                                dataArr.forEach(data => {
                                                    sum += data;
                                                });
                                                let percentage = ((value / sum) * 100).toFixed(2) + "%";
                                                return percentage;
                                            },
                                            color: '#000'
                                        }
                                    }
                                },
                                plugins: [ChartDataLabels],
                            });
                        }
                        
                    });
                </script>
            </div>
        </div>
        
    </section>
    
    <?php
        require "../assets/footer.php";
    ?>
</body>
</html>