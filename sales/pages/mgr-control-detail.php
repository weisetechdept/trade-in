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

    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- Plugins css -->
    <link href="/assets/plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@100;200;300;400;500;600;700;800&family=Kanit:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- App css -->
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
            width: 85px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
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
                            <div class="page-title-box d-flex align-items-center justify-content-between pb-3">
                                <h4 class="mb-0 font-size-18">เซลล์</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Trade-in</a></li>
                                        <li class="breadcrumb-item active">รถยนต์</li>
                                    </ol>
                                </div>
                                
                            </div>

                            <?php if($status == 'wait'){?>
                                <div class="alert alert-warning" role="alert">
                                    รอเซลล์แจ้งสถานะลูกค้า
                                </div>
                            <?php } elseif($status == 'sold'){?>
                                <div class="alert alert-success" role="alert">
                                    ลูกค้าขายให้พ่อสื่อ
                                </div>
                            <?php } elseif($status == 'cancel'){?>
                                <div class="alert alert-danger" role="alert">
                                    ลูกค้าไม่ขาย หรือขายที่อื่น
                                </div>
                            <?php } ?>


                        </div>
                    </div>   

                    <div class="row" id="App">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">ตารางรถยนต์</h4>

                                    <table id="datatable" class="table dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>รหัส ID</th>
                                                <th>รูป</th>
                                                <th>รุ่น</th>
                                                <th>จัดการ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
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

    <script>
        var App = new Vue({
            el: '#App',
            data: {
                sales: ''
            },
            mounted() {
                $('#datatable').DataTable({
                    "order": [[ 0, "desc" ]],
                    "language": {
                        "paginate": {
                            "previous": "<i class='mdi mdi-chevron-left'>",
                            "next": "<i class='mdi mdi-chevron-right'>"
                        },
                        "lengthMenu": "แสดง _MENU_ รายชื่อ",
                        "zeroRecords": "ขออภัย ไม่มีข้อมูล",
                        "info": "หน้า _PAGE_ ของ _PAGES_",
                        "infoEmpty": "ไม่มีข้อมูล",
                        "search": "ค้นหา:",
                    },
                    "drawCallback": function () {
                        $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
                    },
                    ajax: '/sales/system/mgr-control-detail.api.php?sales=<?php echo $id; ?>&year=<?php echo $year; ?>&month=<?php echo $month; ?>&status=<?php echo $status; ?>',
                    "columns" : [
                        {'data':'0'},
                        {'data':'1',
                            "render": function(data, type, row, meta){
                                return '<img src="'+data+'" class="car-thumb">';
                            }
                        
                        },
                        {'data':'2'},
                        {'data':'0',
                            "render": function(data, type, row, meta){
                                return '<a href="/sales/de/mgr/'+data+'" class="btn btn-outline-primary btn-sm">ดูข้อมูล</a>';
                            }
                        
                        }
                    ]
                });
                
            }
        });

    </script>

    <!-- App js -->
    <script src="/assets/js/theme.js"></script>

</body>

</html>
<?php } ?>