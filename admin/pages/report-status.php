<?php
    session_start();
    if($_SESSION['tin_admin'] != true){
        header("location: /404");
        exit();
    } else {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Trade-In List</title>
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
            padding: calc(70px + 24px) calc(5px / 2) 70px calc(5px / 2);
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
        .btn-group, .btn-group-vertical {
            margin-bottom: 15px;
        }
        .search-btn {
            margin-top: 27px;
        }
        .car-thumb {
            width: 100px;
            height: 70px;
            object-fit: cover;
            border-radius: 5px;
        }
        .text-center {
            text-align: center;
        }
        .bg-soft-light {
            background-color: #f7f7f7;
        }
    </style>
</head>

<body>
    <div id="layout-wrapper">
        <?php 
                include_once('inc-pages/nav.php');
                include_once('inc-pages/sidebar.php');
        ?>
        <div class="main-content" id="count">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">รายงานสถานะ</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">Trade-in</li>
                                        <li class="breadcrumb-item">รายงานสถานะ</li>
                                    </ol>
                                </div>
                                
                            </div>
                        </div>
                    </div>  

                <div class="row">

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>ค้นหา - เดือน</label>
                                                <select @change="searchReport" class="form-control">
                                                    <option value="0">= เลือกเดือนที่ต้องการดูข้อมูล =</option>
                                                    <option v-for="date in dateSearch" :value="date.month">{{ date.monthName }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                          
                            </div>
                        </div>
                    </div>
                    
                </div>

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr class="bg-soft-light">
                                            <td width="180px">จบเก่า / จองรถใหม่</td>
                                            <td v-text="statusReport.s1" colspan="6"></td>
                                        </tr>
                                        <tr class="bg-soft-light">
                                            <td>จบรถเก่า / ไม่จองรถใหม่</td>
                                            <td v-text="statusReport.s2" colspan="6"></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>ลูกค้าไม่พร้อมขาย</td>
                                            <td class="text-center">0</td>
                                            <td>ไม่ขายแล้ว</td>
                                            <td class="text-center">0</td>
                                        </tr>
                                        <tr class="bg-soft-light">
                                            <td>ไม่จบรถเก่า / จองรถใหม่</td>
                                            <td v-text="statusReport.s3" colspan="6"></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>ลูกค้าไม่พร้อมขาย</td>
                                            <td class="text-center">0</td>
                                            <td>ไม่ขายแล้ว</td>
                                            <td class="text-center">0</td>
                                            <td>รอหาผู้ซื้อ</td>
                                            <td class="text-center">0</td>
                                        </tr>
                                        <tr class="bg-soft-light">
                                            <td>ไม่จบรถเก่า / ไม่จองรถใหม่</td>
                                            <td v-text="statusReport.s4"  colspan="6"></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>ลูกค้าไม่พร้อมขาย</td>
                                            <td class="text-center">0</td>
                                            <td>ไม่ขายแล้ว</td>
                                            <td class="text-center">0</td>
                                        </tr>
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

    <!-- jQuery  -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/metismenu.min.js"></script>
    <script src="/assets/js/waves.js"></script>
    <script src="/assets/js/simplebar.min.js"></script>

    <!-- third party js -->
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

    <script src="/assets/plugins/morris-js/morris.min.js"></script>
    <script src="/assets/plugins/raphael/raphael.min.js"></script>

    <script>

        var count = new Vue({
            el: '#count',
            data: {
                dateSearch: [],
                statusReport: {
                    's1': 0,
                    's2': 0,
                    's3': 0,
                    's4': 0
                }
            },
            mounted() {

                axios.get('/admin/system/report-status.api.php?get=info')
                .then((response) => {
                    this.dateSearch = response.data.monthList;
                })

            },
            methods: {

                searchReport() {
                    var month_year = $('select').val();
                    if(month_year == 0) {
                        swal("แจ้งเตือน", "กรุณาเลือกเดือนที่ต้องการดูข้อมูล", "warning");
                    } else {
                        axios.get('/admin/system/report-status.api.php?get=search&month_year='+ month_year)
                        .then(function (response) {
                            console.log(response.data);
                            count.statusReport = response.data.statusReport;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    }
                }

            }
        });

    </script>

    <!-- App js -->
    <script src="/assets/js/theme.js"></script>

</body>

</html>

<?php } ?>
