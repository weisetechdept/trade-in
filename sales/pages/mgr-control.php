<?php
    session_start();
    /*
    if($_SESSION['tin_admin'] != true){
        header("location: /404");
        exit();
    }
    */
    if($_SESSION['tin_login'] != true){
        header("location: /404");
        exit();
    } else { 
    $get = $_GET['get'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Trade-In Team List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="A77" name="description" />
    <meta content="A77" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <link href="/assets/plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@100;200;300;400;500;600;700;800&family=Kanit:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/theme.min.css" rel="stylesheet" type="text/css" />
    <style>
        body {
            font-family: 'Chakra Petch', sans-serif;
        }
        .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
            font-family: 'Kanit', sans-serif;
            font-weight: 400;
        }
        .page-content {
            padding: calc(15px + 24px) calc(5px / 2) 70px calc(5px / 2);
        }
        .table {
            width: 100% !important;
        }
        .dtr-details {
            width: 100%;
        }
        .card-body {
            padding: 1rem;
        }
        .card {
            margin-bottom: 10px;
        }
        .car-thumb {
            width: 130px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }
        .t-center {
            text-align: center;
        }
        .sum-imp {
            background-color: #f5f5f5;
        }
        .sum-total-imp {
            background-color: #dfdfdf;
        }
    </style>
</head>

<body>
    <div id="layout-wrapper">
        <?php 
                include_once('inc-pages/nav.php');
                include_once('inc-pages/sidebar.php');
        ?>
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">ติดตามงาน</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Trade-in</a></li>
                                        <li class="breadcrumb-item active">ติดตามงาน</li>
                                    </ol>
                                </div>
                                
                            </div>
                        </div>
                    </div>   

                    <div class="row" id="appData">
                        <div class="col-12 col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-8">
                                            <select class="form-control" @change="searchData" v-model="search.month">
                                                <option value="01">มกราคม</option>
                                                <option value="02">กุมภาพันธ์</option>
                                                <option value="03">มีนาคม</option>
                                                <option value="04">เมษายน</option>
                                                <option value="05">พฤษภาคม</option>
                                                <option value="06">มิถุนายน</option>
                                                <option value="07">กรกฎาคม</option>
                                                <option value="08">สิงหาคม</option>
                                                <option value="09">กันยายน</option>
                                                <option value="10">ตุลาคม</option>
                                                <option value="11">พฤศจิกายน</option>
                                                <option value="12">ธันวาคม</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <div class="d-flex align-items-center" style="height: 100%;">
                                                ปี {{ search.year }}
                                            </div>
                                        </div> 
                                    </div>
                                    <p>
                                    รอ = รอเซลล์แจ้งสถานะลูกค้า <br>
                                    จบ = ลูกค้าขายให้พ่อสื่อ <br>
                                    ไม่จบ = ลูกค้าไม่ขาย หรือขายที่อื่น
                                    </p>
                                    <table class="table dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>เซลล์</th>
                                                <th class="t-center">รอ</th>
                                                <th class="t-center">จบ</th>
                                                <th class="t-center">ไม่จบ</th>
                                                <th class="t-center sum-imp">รวม</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="d in data">
                                                <td>{{ d.name }}</td>
                                                <td class="t-center"><a :href="'/mgr/follow/wait/' + d.id +'/'+ search.month +'/'+ search.year">{{ d.wait }}</a></td>
                                                <td class="t-center"><a :href="'/mgr/follow/sold/' + d.id +'/'+ search.month +'/'+ search.year">{{ d.sold }}</a></td>
                                                <td class="t-center"><a :href="'/mgr/follow/cancel/' + d.id +'/'+ search.month +'/'+ search.year">{{ d.cancel }}</a></td>
                                                <td class="t-center sum-imp">{{ d.wait + d.sold + d.cancel }}</td>
                                            </tr>
                                            <tr>
                                                <th class="sum-imp">รวม</th>
                                                <th class="t-center sum-imp">{{ data.reduce((a, b) => a + b.wait, 0) }}</th>
                                                <th class="t-center sum-imp">{{ data.reduce((a, b) => a + b.sold, 0) }}</th>
                                                <th class="t-center sum-imp">{{ data.reduce((a, b) => a + b.cancel, 0) }}</th>
                                                <th class="t-center sum-total-imp">{{ data.reduce((a, b) => a + b.wait + b.sold + b.cancel, 0) }}</th>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div> 
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            2023 © Weise Tech.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block">
                                Design & Develop by Weise Tech
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>

    </div>
  
    <div class="menu-overlay"></div>

    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/metismenu.min.js"></script>
    <script src="/assets/js/waves.js"></script>
    <script src="/assets/js/simplebar.min.js"></script>

    <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatables/dataTables.bootstrap4.js"></script>
    <script src="/assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="/assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="/assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="/assets/plugins/datatables/buttons.flash.min.js"></script>
    <script src="/assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="/assets/plugins/datatables/dataTables.keyTable.min.js"></script>
    <script src="/assets/plugins/datatables/dataTables.select.min.js"></script>
    <script src="/assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="/assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.1/axios.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script>
        var appData = new Vue({
            el: '#appData',
            data: {
                data: [],
                search: {
                    month: '<?php echo date('m'); ?>',
                    year: '<?php echo date('Y'); ?>',
                },
            },
            mounted() {
                this.getData()
            },
            methods: {
                getData() {
                    axios.get('/sales/system/mgr-list-report.api.php?month=' + this.search.month + '&year=' + this.search.year)
                    .then(response => {
                        this.data = response.data.team
                    })
                },
                searchData() {
                    this.getData()
                }
            }
        })
    </script>
    <script src="/assets/js/theme.js"></script>
</body>

</html>
<?php } ?> 