<?php

namespace PHPMaker2020\bansos;

// $url_master = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"]; //Prod

use function PHPMaker2020\bansos\_query;
use function PHPMaker2020\bansos\get1row;

$url_master = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . "/" . explode('/', $_SERVER['REQUEST_URI'])[1]; // Dev


$get_total_warga = get1row("SELECT COUNT(`id`) AS total FROM `master_warga` WHERE `na` = 'n'");
$total_warga = $get_total_warga['total'];

$get_total_rw = get1row("SELECT COUNT(`id`) AS total FROM `rw`");
$total_rw = $get_total_rw['total'];

$get_total_rt = get1row("SELECT COUNT(`id`) AS total FROM `rt`");
$total_rt = $get_total_rt['total'];

$get_total_bantuan = get1row("SELECT COUNT(*) AS total FROM `bantuan`");
$total_bantuan = $get_total_bantuan['total'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="css/tempusdominus-bootstrap-4.css">
    <style>
        .input-nik {
            width: 1% !important;
            position: relative !important;
            -webkit-flex: 1 1 auto !important;
            -ms-flex: 1 1 auto !important;
            flex: 1 1 auto !important;
            width: 1% !important;
            min-width: 0 !important;
            margin-bottom: 0 !important;
        }

        /* Styles for wrapping the search box */

        .main {
            width: 50%;
            margin: 50px auto;
        }

        /* Bootstrap 4 text input with search icon */

        .has-search .form-control {
            padding-left: 2.375rem;
        }

        .has-search .form-control-feedback {
            position: absolute;
            z-index: 2;
            display: block;
            width: 2.375rem;
            height: 2.375rem;
            line-height: 2.375rem;
            text-align: center;
            pointer-events: none;
            color: #aaa;
        }
    </style>
    <!-- Select2 -->
    <link rel="stylesheet" href="custom/js/select2/css/select2.css">
    <link rel="stylesheet" href="custom/js/select2/css/select2.min.css">
</head>

<body class="layout-fixed" dir="ltr" style="height: auto;">
    <div class="wrapper ew-layout">

        <nav class="main-header navbar navbar-expand navbar-danger navbar-dark" style="margin-left:0;">
            <ul class="navbar-nav">
                <li id="11" name="mi_cari_bantuan" class="nav-item ew-navbar-item d-none d-md-block">
                    <a href="./rekap_bantuan2list.php" onclick="return true;" class="nav-link active">
                        <i class="fa fa-home"></i>
                        <span>Home</span>
                    </a>
                </li>
            </ul>
            <ul id="ew-navbar-right" class="navbar-nav ml-auto">
            </ul>
        </nav>

        <div class="content-wrapper" style="margin-left:0;">
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center mt-3 font-weight-bold">Cari Data Bantuan</h1>
                        <div class="main">
                            <div class="input-group" style="justify-content: center;">
                                <input type="number" class="form-control form-control-lg input-nik" id="input-nik" placeholder="Masukkan NIK anda disini...">
                                <div class="input-group-append">
                                    <button class="btn btn-lg btn-secondary find" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Bantuan  -->
                    <div class="card" id="detail-data">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#datadiri" data-toggle="tab">Data Diri</a></li>
                                <li class="nav-item"><a class="nav-link" href="#bantuan" data-toggle="tab">Bantuan</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="datadiri">
                                <div class="card card-widget widget-user-2 pl-3 pr-3 shadow-sm">
                                    <div class="card-footer p-0">
                                        <ul class="list-group list-group-unbordered mb-3" id="detail-warga">
                                            <li class="list-group-item">
                                                <b>Nama</b> <a class="float-right">-</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Alamat</b> <a class="float-right">-</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Kelurahan</b> <a class="float-right">-</a>
                                            </li>
                                            <!-- <li class="list-group-item">
                                                <b>Kecamatan</b> <a class="float-right">-</a>
                                            </li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="bantuan">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-striped table-valign-middle">
                                        <thead>
                                            <tr>
                                                <th>Jenis Bantuan</th>
                                                <th>Nama Bantuan</th>
                                                <th>Keterangan Bantuan</th>
                                                <!-- <th>Status</th> -->
                                            </tr>
                                        </thead>
                                        <tbody id="tbantuan">
                                            <tr>
                                                <td>
                                                    -
                                                </td>
                                                <td>-</td>
                                                <td>
                                                    -
                                                </td>
                                                <!-- <td>
                                                    <span class="badge bg-success">Sudah diterima</span>
                                                </td> -->
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- <div class="cad-body">
                    </div> -->
                </div>


                <h1 class="text-center pt-5 pb-5 font-weight-bold">Rekapitulasi Data Bantuan</h1>



                <!-- Info Box  -->
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-gradient-info">
                            <span class="info-box-icon bg-gradient-info"><i class="fas fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Warga</span>
                                <span class="info-box-number"><?= $total_warga ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-gradient-success">
                            <span class="info-box-icon bg-gradient-success"><i class="fas fa-city"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Rw</span>
                                <span class="info-box-number"><?= $total_rw ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-gradient-warning">
                            <span class="info-box-icon bg-gradient-warning"><i class="fas fa-hotel"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Rt</span>
                                <span class="info-box-number"><?= $total_rt ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-gradient-danger">
                            <span class="info-box-icon bg-gradient-danger"><i class="fas fa-boxes"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Bantuan</span>
                                <span class="info-box-number"><?= $total_bantuan ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>



                <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            <div class="form-group">
                                <label>Tahun</label>
                                <div class="input-group date" id="select-tahun" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#select-tahun" />
                                    <div class="input-group-append" data-target="#select-tahun" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Perhatian!</h5>
                    Silahkan klik chart untuk melihat detail data bantuan selanjutnya.
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <canvas id="chart-kecamatan"></canvas>
                    </div>

                    <div class="col-md-6">
                        <canvas id="chart-kelurahan"></canvas>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <canvas id="chart-rw"></canvas>
                    </div>

                    <div class="col-md-6">
                        <canvas id="chart-rt"></canvas>
                    </div>
                </div>



            </section>

        </div>


    </div>

    <?php AddClientScript("custom/js/tempusdominus-bootstrap-4.min.js"); ?>



    <script src="custom/js/jquery.min.js"></script>
    <script src="custom/js/moment.min.js"></script>
    <!-- <script src="custom/js/daterangepicker.js"></script> -->
    <!-- Tempusdominus Bootstrap 4 -->
    <!-- <script src="custom/js/tempusdominus-bootstrap-4.min.js"></script> -->
    <script src="custom/js/select2/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        // jqueryjs.push("custom/js/tempusdominus-bootstrap-4.min.js");
        loadjs.ready("head", async function() {
            // loadjs(["custom/js/tempusdominus-bootstrap-4.min.js"]);
            // await $(async function() {

            // Chart Kecamatan 
            var kecamatanCtx = document.getElementById('chart-kecamatan');
            var kecamatanChart = new Chart(kecamatanCtx, {
                type: 'bar',
                data: {
                    labels: [],
                    labels_id: [],
                    datasets: [{
                        label: 'Bantuan',
                        data: [],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
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
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
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
                    },

                    title: {
                        display: true,
                        text: 'Data Bantuan By Kecamatan'
                    }
                },
            });

            // Chart Kelurahan 
            var kelurahanCtx = document.getElementById('chart-kelurahan');
            var kelurahanChart = new Chart(kelurahanCtx, {
                type: 'bar',
                data: {
                    labels: [],
                    labels_id: [],
                    datasets: [{
                        label: 'Bantuan',
                        data: [],
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
                    },
                    title: {
                        display: true,
                        text: 'Data Bantuan By Kelurahan'
                    }
                }
            });


            // Chart RW 
            var rwCtx = document.getElementById('chart-rw');
            var rwChart = new Chart(rwCtx, {
                type: 'bar',
                data: {
                    labels: [],
                    labels_id: [],
                    datasets: [{
                        label: 'Bantuan',
                        data: [],
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
                    },
                    title: {
                        display: true,
                        text: 'Data Bantuan By Rw'
                    }
                }
            });

            // Chart Rt 
            var chartRt = document.getElementById('chart-rt');
            var rtChart = new Chart(chartRt, {
                type: 'bar',
                data: {
                    labels: [],
                    labels_id: [],
                    datasets: [{
                        label: 'Bantuan',
                        data: [],
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
                    },
                    title: {
                        display: true,
                        text: 'Data Bantuan By Rt'
                    }
                }
            });


            kecamatanCtx.onclick = async function(evt) {
                var activePoints = kecamatanChart.getElementsAtEvent(evt);
                // console.log(activePoints)
                if (activePoints[0]) {
                    var chartData = activePoints[0]['_chart'].config.data;

                    var idx = activePoints[0]['_index'];

                    var label = chartData.labels[idx];
                    var kecamatan_id = chartData.labels_id[idx];
                    var value = chartData.datasets[0].data[idx];

                    let dataKelurahan = await loadDataKelurahan(kecamatan_id);

                    // // Update Chart Kelurahan
                    kelurahanChart.data.datasets[0].data = dataKelurahan.total_bantuan;
                    kelurahanChart.data.labels = dataKelurahan.nama_kelurahan;
                    kelurahanChart.data.labels_id = dataKelurahan.kelurahan_id;
                    kelurahanChart.update();
                }
            };

            kelurahanCtx.onclick = async function(evt) {
                var activePoints = kelurahanChart.getElementsAtEvent(evt);
                // console.log(activePoints)
                if (activePoints[0]) {
                    var chartData = activePoints[0]['_chart'].config.data;

                    var idx = activePoints[0]['_index'];

                    var label = chartData.labels[idx];
                    var kelurahan_id = chartData.labels_id[idx];
                    var value = chartData.datasets[0].data[idx];

                    let dataRw = await loadDataRw(kelurahan_id);

                    // // Update Chart Rw
                    rwChart.data.datasets[0].data = dataRw.total_bantuan;
                    rwChart.data.labels = dataRw.nama_rw;
                    rwChart.data.labels_id = dataRw.rw_id;
                    rwChart.update();
                }
            };

            rwCtx.onclick = async function(evt) {
                var activePoints = rwChart.getElementsAtEvent(evt);
                // console.log(activePoints)
                if (activePoints[0]) {
                    var chartData = activePoints[0]['_chart'].config.data;

                    var idx = activePoints[0]['_index'];

                    var label = chartData.labels[idx];
                    var rw_id = chartData.labels_id[idx];
                    var value = chartData.datasets[0].data[idx];

                    let dataRt = await loadDataRt(rw_id);

                    // // Update Chart Rw
                    rtChart.data.datasets[0].data = dataRt.total_bantuan;
                    rtChart.data.labels = dataRt.nama_rt;
                    rtChart.data.labels_id = dataRt.rt_id;
                    rtChart.update();
                }
            };


            $('#select-tahun').datetimepicker({
                defaultDate: moment(),
                viewMode: 'years',
                format: 'YYYY',
                useCurrent: true
            });

            let dataKecamatan = await loadDataKecamatan();

            // Update Chart Kecamatan 
            kecamatanChart.data.datasets[0].data = dataKecamatan.total_bantuan;
            kecamatanChart.data.labels = dataKecamatan.nama_kecamatan;
            kecamatanChart.data.labels_id = dataKecamatan.kecamatan_id;
            kecamatanChart.update();

            $("#select-tahun").on("change.datetimepicker", async function(e) {
                let tahun = moment(e.date).format('YYYY');

                let dataKecamatan = await loadDataKecamatan();
                console.log(dataKecamatan);

                // Update Chart Kelurahan 
                kecamatanChart.data.datasets[0].data = dataKecamatan.total_bantuan;
                kecamatanChart.data.labels = dataKecamatan.nama_kecamatan;
                kecamatanChart.data.labels_id = dataKecamatan.kecamatan_id;
                kecamatanChart.update();

                // // Update Chart Rt 
                kelurahanChart.data.datasets[0].data = [];
                kelurahanChart.data.datasets[0].label = `Bantuan`;
                kelurahanChart.data.labels = [];
                kelurahanChart.update();

                // // Update Chart Rw 
                rwChart.data.datasets[0].data = [];
                rwChart.data.datasets[0].label = `Bantuan`;
                rwChart.data.labels = [];
                rwChart.update();

                // // Update Chart Rt 
                rtChart.data.datasets[0].data = [];
                rtChart.data.datasets[0].label = `Bantuan`;
                rtChart.data.labels = [];
                rtChart.update();
            });
            // });
        });
    </script>

    <script>
        async function loadDataKecamatan() {
            return await new Promise(async (resolve, reject) => {
                let tahun = moment($('#select-tahun').datetimepicker('viewDate')).format('YYYY');

                let API_URL = `<?php echo $url_master ?>` + '/api/';
                let action = `getDataKecamatan`;
                let url = API_URL + '?action=' + action;
                await $.ajax({
                        method: "GET",
                        url: `${url}`,
                        data: {
                            tahun: tahun,
                        }
                    })
                    .done(function(res) {
                        return resolve(res);
                    }).fail(function(err) {
                        console.log("respon error data------> ", err);
                        console.log(err)
                        return reject(err);
                    });
            });
        }

        async function loadDataKelurahan(kecamatan_id) {
            return await new Promise(async (resolve, reject) => {
                let tahun = moment($('#select-tahun').datetimepicker('viewDate')).format('YYYY');

                let API_URL = `<?php echo $url_master ?>` + '/api/';
                let action = `getDataKelurahan`;
                let url = API_URL + '?action=' + action;
                await $.ajax({
                        method: "GET",
                        url: `${url}`,
                        data: {
                            tahun: tahun,
                            kecamatan_id: kecamatan_id,
                        }
                    })
                    .done(function(res) {
                        return resolve(res);
                    }).fail(function(err) {
                        console.log("respon error data------> ", err);
                        console.log(err)
                        return reject(err);
                    });
            });
        }

        async function loadDataRw(kelurahan_id) {
            return await new Promise(async (resolve, reject) => {
                let tahun = moment($('#select-tahun').datetimepicker('viewDate')).format('YYYY');

                let API_URL = `<?php echo $url_master ?>` + '/api/';
                let action = `getDataRw`;
                let url = API_URL + '?action=' + action;
                await $.ajax({
                        method: "GET",
                        url: `${url}`,
                        data: {
                            tahun: tahun,
                            kelurahan_id: kelurahan_id,
                        }
                    })
                    .done(function(res) {
                        return resolve(res);
                    }).fail(function(err) {
                        console.log("respon error data------> ", err);
                        console.log(err)
                        return reject(err);
                    });
            });
        }

        async function loadDataRt(rw_id) {
            return await new Promise(async (resolve, reject) => {
                let tahun = moment($('#select-tahun').datetimepicker('viewDate')).format('YYYY');
                let API_URL = `<?php echo $url_master ?>` + '/api/';
                let action = `getDataRt`;
                let url = API_URL + '?action=' + action;
                await $.ajax({
                        method: "GET",
                        url: `${url}`,
                        data: {
                            tahun: tahun,
                            rw_id: rw_id,
                        }
                    })
                    .done(function(res) {
                        return resolve(res);
                    }).fail(function(err) {
                        console.log("respon error data------> ", err);
                        console.log(err);
                        return reject(err);
                    });
            });
        }
    </script>


    <script>
        ew.ready(ew.bundleIds, "js/userevt.js", "load", function() {
            const BASE_URL = `<?php echo $url_master ?>` + '/api/';
            $("#detail-data").hide();
            $(".find").click(function() {
                const nik = $("#input-nik").val();
                let action = `getBantuanById`;
                let url = BASE_URL + '?action=' + action;
                if (nik > 0) {
                    $.ajax({
                            method: "GET",
                            url: `${url}`,
                            data: {
                                nik: nik,
                            }
                        })
                        .done(function(res) {
                            // console.log(res);
                            if (res) {
                                $("#detail-data").show();
                                let data_warga = res.warga;
                                let data_bantuan = res.bantuan;



                                if (data_warga) {
                                    console.log(data_warga);
                                    var newDetail = `<ul class="list-group list-group-unbordered mb-3" id="detail-warga">`;
                                    // nama 
                                    newDetail += `<li class='list-group-item'>`;
                                    newDetail += `<b>Nama</b> <a class="float-right">${data_warga.nama}</a>`;
                                    newDetail += `</li>`;

                                    // alamat 
                                    newDetail += `<li class='list-group-item'>`;
                                    newDetail += `<b>Alamat</b> <a class="float-right">${data_warga.alamat} No.${data_warga.nomor_rumah} Rt.${data_warga.rt} Rw.${data_warga.rw}</a>`;
                                    newDetail += `</li>`;

                                    // alamat 
                                    newDetail += `<li class='list-group-item'>`;
                                    newDetail += `<b>Keluruahan</b> <a class="float-right">KARANGANYAR</a>`;
                                    newDetail += `</li>`;

                                    newDetail += `</ul>`;
                                    $('#detail-warga').replaceWith(newDetail);

                                } else {
                                    var emptyWarga = `<h2 id="detail-warga" class='text-center text-danger pt-1 pb-1'>Data warga tidak ditemukan</h2>`;
                                    $('#detail-warga').replaceWith(emptyWarga);
                                }



                                if (data_bantuan) {
                                    var newRow = '<tbody id="tbantuan">';
                                    data_bantuan.forEach(bantuan => {
                                        newRow += '<tr>';
                                        newRow += `<td>${bantuan.jenis_bantuan}</td>`;
                                        newRow += `<td>${bantuan.nama_bantuan}</td>`;
                                        newRow += `<td>${bantuan.keterangan_bantuan}</td>`;
                                        newRow += '</tr>';
                                    });
                                    newRow += '</tbody>';
                                    // console.log(newRow);
                                    $('#tbantuan').replaceWith(newRow);
                                } else {
                                    var emptybantuan = `<tbody id="tbantuan" class='text-center'>`;
                                    emptybantuan += '<tr>';
                                    emptybantuan += `<td colspan="3"><h2 class='text-center text-danger'>Data bantuan tidak ditemukan</h2></td>`;
                                    // emptybantuan += `<h1 class='text-center'>Data bantuan tidak ditemukan</h1>`;
                                    emptybantuan += '</tr>';
                                    emptybantuan += '</tbody>';
                                    $('#tbantuan').replaceWith(emptybantuan);
                                }


                            }

                        }).fail(function(err) {
                            console.log(err)
                        });
                } else {
                    alert("NIK tidak valid !");
                }

            });
        });
    </script>

</body>

</html>