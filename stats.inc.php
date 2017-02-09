<h2>Statistiques</h2>
<div id="statistiques">
    <?php
    $objects_unsorted = $db->getAll('objet');

    usort($objects_unsorted, 'etat');

    $objects = [];
    foreach ($objects_unsorted as $key => $item) {
        $objects[$item['etat']][$key] = $item;
    }

    ksort($objects, SORT_NUMERIC);

    foreach ($objects as $k => $v) {
        $objects[$k] = sizeof($v);
    }

    for ($i = 0; $i < 4; $i++) {
        $objects[$i] = max($objects[$i], 0);
    }

    ksort($objects, SORT_NUMERIC);

    $objects_str = str_replace('null', '0', json_encode($objects));
    ?>
    <div class="stat-table">
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
            <thead>
            <tr>
                <th class="mdl-data-table__cell--non-numeric">État</th>
                <th>Quantité</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">Perdu</td>
                <td><?= $objects[0] ?></td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">Trouvé</td>
                <td><?= $objects[1] ?></td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">Rendu</td>
                <td><?= $objects[2] ?></td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">Abandonné</td>
                <td><?= $objects[3] ?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="stat-chart-container">
        <canvas id="stat-chart" width="400" height="400"></canvas>
    </div>
    <script type="application/javascript" src="js/Chart.js"></script>
    <script type="application/javascript">
        var myDoughnutChart = new Chart(document.getElementById("stat-chart"), {
            type: 'doughnut',
            data: {
                labels: ["Perdu", "Trouvé", "Rendu", "Abandonné"],
                datasets: [{
                    label: 'Statistiques',
                    data: <?= $objects_str ?>,
                    backgroundColor: [
                        '#ffc107',
                        '#2196f3',
                        '#4caf50',
                        '#f44336'
                    ],
                    borderColor: [
                        'rgba(0, 0, 0, 0.33)',
                        'rgba(0, 0, 0, 0.33)',
                        'rgba(0, 0, 0, 0.33)',
                        'rgba(0, 0, 0, 0.33)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                /*scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }*/
                rotation: -1 * Math.PI
            }
        });
    </script>
</div>