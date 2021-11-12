<template>
    <div class="container-fluid">
        <div class="row">
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-warning text-center">
                        <a href="/home">
                            <h1 class="font-light text-white">
                                <i class="fas fa-home"></i>
                            </h1>
                            <h6 class="text-white">Dashboard</h6>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-olive text-center">
                        <a href="/import">
                            <h1 class="font-light text-white">
                                <i class="fas fa-file-csv"></i>
                            </h1>
                            <h6 class="text-white">Excel / CSV</h6>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-orange text-center">
                        <a href="/declaraciones_juradas">
                            <h1 class="font-light text-white">
                                <i class="fas fa-book"></i>
                            </h1>
                            <h6 class="text-white">Declaraciones Juradas</h6>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-danger text-center">
                        <a href="/users">
                            <h1 class="font-light text-white">
                                <i class="fas fa-users"></i>
                            </h1>
                            <h6 class="text-white">Usuarios</h6>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-info text-center">
                        <a href="/computos">
                            <h1 class="font-light text-white">
                                <i class="fas fa-calculator"></i>
                            </h1>
                            <h6 class="text-white">Computos</h6>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-md-6 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-danger text-center">
                        <a href="/liquidacion">
                            <h1 class="font-light text-white">
                                <i class="fas fa-file-invoice-dollar"></i>
                            </h1>
                            <h6 class="text-white">Liquidaciones</h6>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-info text-center">
                        <a href="/hlaborales">
                            <h1 class="font-light text-white">
                                <i class="fas fa-stream"></i>
                            </h1>
                            <h6 class="text-white">Historias Laborales</h6>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-warning text-center">
                        <a href="/conceptos">
                            <h1 class="font-light text-white">
                                <i class="fas fa-cogs"></i>
                            </h1>
                            <h6 class="text-white">Configuraciones</h6>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-olive text-center">
                        <h1 class="font-light text-white">
                            <i class="fas fa-building"></i>
                        </h1>
                        <h6 class="text-white">Departamentos</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-orange text-center">
                        <a href="/subtipo-codigos">
                            <h1 class="font-light text-white">
                                <i class="fas fa-list"></i>
                            </h1>
                            <h6 class="text-white">Codigos</h6>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- AREA CHART -->
                <div class="card card-olive">
                    <div class="card-header">
                        <h3 class="card-title">Periodos Anuales</h3>
                        <div class="card-tools">
                            <button
                                type="button"
                                class="btn btn-tool"
                                data-card-widget="collapse"
                            >
                                <i class="fas fa-minus"></i>
                            </button>
                            <button
                                type="button"
                                class="btn btn-tool"
                                data-card-widget="remove"
                            >
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas
                                id="areaChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"
                            ></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- DONUT CHART -->
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Donut Chart</h3>
                        <div class="card-tools">
                            <button
                                type="button"
                                class="btn btn-tool"
                                data-card-widget="collapse"
                            >
                                <i class="fas fa-minus"></i>
                            </button>
                            <button
                                type="button"
                                class="btn btn-tool"
                                data-card-widget="remove"
                            >
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas
                            id="donutChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"
                        ></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- PIE CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Pie Chart</h3>
                        <div class="card-tools">
                            <button
                                type="button"
                                class="btn btn-tool"
                                data-card-widget="collapse"
                            >
                                <i class="fas fa-minus"></i>
                            </button>
                            <button
                                type="button"
                                class="btn btn-tool"
                                data-card-widget="remove"
                            >
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas
                            id="pieChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"
                        ></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col (LEFT) -->
            <div class="col-md-6">
                <!-- LINE CHART -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Line Chart</h3>
                        <div class="card-tools">
                            <button
                                type="button"
                                class="btn btn-tool"
                                data-card-widget="collapse"
                            >
                                <i class="fas fa-minus"></i>
                            </button>
                            <button
                                type="button"
                                class="btn btn-tool"
                                data-card-widget="remove"
                            >
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas
                                id="lineChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"
                            ></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- BAR CHART -->
                <div class="card card-olive">
                    <div class="card-header">
                        <h3 class="card-title">Bar Chart</h3>
                        <div class="card-tools">
                            <button
                                type="button"
                                class="btn btn-tool"
                                data-card-widget="collapse"
                            >
                                <i class="fas fa-minus"></i>
                            </button>
                            <button
                                type="button"
                                class="btn btn-tool"
                                data-card-widget="remove"
                            >
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas
                                id="barChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"
                            ></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- STACKED BAR CHART -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Stacked Bar Chart</h3>
                        <div class="card-tools">
                            <button
                                type="button"
                                class="btn btn-tool"
                                data-card-widget="collapse"
                            >
                                <i class="fas fa-minus"></i>
                            </button>
                            <button
                                type="button"
                                class="btn btn-tool"
                                data-card-widget="remove"
                            >
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas
                                id="stackedBarChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"
                            ></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</template>

<script>
// $(function () {

// });
export default {
    data: function() {
        return {
            periodoAnual: [],
            total_aportes: []
        };
    },
    mounted() {
        console.log("home mounted.");
        this.aporteAnual();
        this.chartsJS();
    },
    methods: {
        aporteAnual: function() {
            axios.get("api/computo/periodo-anual/2020").then(response => {
                this.periodoAnual = response.data;
                this.periodoAnual.forEach(total_aportes => {
                    this.total_aportes.push(
                        total_aportes.total_aporte_personal
                    );
                });
            });
        },
        chartsJS: function() {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            //--------------
            //- AREA CHART -
            //--------------

            // Get context with jQuery - using jQuery's .get() method.
            var areaChartCanvas = $("#areaChart")
                .get(0)
                .getContext("2d");

            var areaChartData = {
                labels: [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre"
                ],
                datasets: [
                    {
                        label: "Sisper",
                        backgroundColor: "rgba(60,141,188,0.9)",
                        borderColor: "rgba(60,141,188,0.8)",
                        pointRadius: false,
                        pointColor: "#3b8bba",
                        pointStrokeColor: "rgba(60,141,188,1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(60,141,188,1)",
                        data: [29, 83, 12, 88, 88, 62, 80, 52, 59, 100, 29, 28]
                    },
                    {
                        label: "Municipio",
                        backgroundColor: "rgba(210, 214, 222, 2)",
                        borderColor: "rgba(210, 214, 222, 1)",
                        pointRadius: false,
                        pointColor: "rgba(210, 214, 222, 0)",
                        pointStrokeColor: "#c1c7d1",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [65, 59, 80, 81, 56, 55, 80, 52, 74, 102, 23, 35]
                    },
                    {
                        label: "Entidades Autonomas",
                        backgroundColor: "rgba(210, 128, 198, 9)",
                        borderColor: "rgba(210, 128, 198, 1)",
                        pointRadius: false,
                        pointColor: "rgba(210, 128, 198, 0)",
                        pointStrokeColor: "#b1d7d1",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [
                            99,
                            68,
                            102,
                            25,
                            70,
                            55,
                            68,
                            52,
                            74,
                            88,
                            101,
                            105
                        ]
                    }
                ]
            };

            var areaChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [
                        {
                            gridLines: {
                                display: false
                            }
                        }
                    ],
                    yAxes: [
                        {
                            gridLines: {
                                display: false
                            }
                        }
                    ]
                }
            };

            // This will get the first returned node in the jQuery collection.
            new Chart(areaChartCanvas, {
                type: "line",
                data: areaChartData,
                options: areaChartOptions
            });

            //-------------
            //- LINE CHART -
            //--------------
            var lineChartCanvas = $("#lineChart")
                .get(0)
                .getContext("2d");
            var lineChartOptions = $.extend(true, {}, areaChartOptions);
            var lineChartData = $.extend(true, {}, areaChartData);
            lineChartData.datasets.forEach(dataSet => {
                dataSet.fill = false;
            });
            lineChartOptions.datasetFill = false;
            var lineChart = new Chart(lineChartCanvas, {
                type: "line",
                data: lineChartData,
                options: lineChartOptions
            });

            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas = $("#donutChart")
                .get(0)
                .getContext("2d");
            var donutData = {
                labels: [
                    "Chrome",
                    "IE",
                    "FireFox",
                    "Safari",
                    "Opera",
                    "Navigator"
                ],
                datasets: [
                    {
                        data: [700, 500, 400, 600, 300, 100],
                        backgroundColor: [
                            "#f56954",
                            "#00a65a",
                            "#f39c12",
                            "#00c0ef",
                            "#3c8dbc",
                            "#d2d6de"
                        ]
                    }
                ]
            };
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true
            };
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas, {
                type: "doughnut",
                data: donutData,
                options: donutOptions
            });

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $("#pieChart")
                .get(0)
                .getContext("2d");
            var pieData = donutData;
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true
            };
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(pieChartCanvas, {
                type: "pie",
                data: pieData,
                options: pieOptions
            });

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $("#barChart")
                .get(0)
                .getContext("2d");
            var barChartData = $.extend(true, {}, areaChartData);
            var temp0 = areaChartData.datasets[0];
            var temp1 = areaChartData.datasets[1];
            barChartData.datasets[0] = temp1;
            barChartData.datasets[1] = temp0;

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            };

            new Chart(barChartCanvas, {
                type: "bar",
                data: barChartData,
                options: barChartOptions
            });

            //---------------------
            //- STACKED BAR CHART -
            //---------------------
            var stackedBarChartCanvas = $("#stackedBarChart")
                .get(0)
                .getContext("2d");
            var stackedBarChartData = $.extend(true, {}, barChartData);

            var stackedBarChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [
                        {
                            stacked: true
                        }
                    ],
                    yAxes: [
                        {
                            stacked: true
                        }
                    ]
                }
            };

            new Chart(stackedBarChartCanvas, {
                type: "bar",
                data: stackedBarChartData,
                options: stackedBarChartOptions
            });
        }
    }
};
</script>
