<!-- Begin Page Content -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Panel Administrateur</h1>

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-8 col-lg-7">

            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistiques CA</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas width="100%" height="0px"  id="statsCA"></canvas>
                    </div>
                    <hr>
                </div>
            </div>


        </div>

        <!-- Donut Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistiques abonnés / total inscrit</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <canvas width="100%" height="0px" id="statsAbos"></canvas>
                    </div>
                    <hr>
                    <br>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!-- Page level plugins -->

<?php
$gains = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

foreach($this->transactions as $transaction){
    $r = date_format(date_create($transaction['monthlyPayment']), 'm');
    $r = str_replace('0', '', $r);
    $gains[$r-1] += 29;
}

?>

<script>
    let ctx = document.getElementById('statsCA').getContext('2d');
    let myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Fev", "Mar", "Avr", "Mai", "Juin", "Juil", "Aou", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: 'Gains',
                data: [<?php foreach($gains as $gain){

                    echo $gain .',';
                }
                    ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    let ctx2 = document.getElementById('statsAbos').getContext('2d');
    let statsAbos = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ["Abonné", "Non-Abonné"],
            datasets: [{
                label: 'Gains',
                data: [<?= $this->subscribeCount . ','. ($this->userCount - $this->subscribeCount) ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

</script>