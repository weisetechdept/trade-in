<?php
    session_start();
    if($_SESSION['tin_admin'] != true){
        header("location: /404");
        exit();
    }
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
            width: 130px;
            height: 100px;
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
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">รถยนต์</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Trade-in</a></li>
                                        <li class="breadcrumb-item active">รถยนต์</li>
                                    </ol>
                                </div>
                                
                            </div>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="datatable" class="table dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>รหัส</th>
                                                <th>รูปภาพ</th>
                                                <th>จำนวนรูป</th>
                                                <th>ทะเบียน</th>
                                                <th>ปี</th>
                                                <th>รถยนต์</th>
                                                <th>สี</th>
                                                <th>ราคาที่รับได้</th>
                                                <th>เซลล์</th>
                                                <th>ทีม</th>
                                                <th>สถานะ</th>
                                                <th>วันที่ส่ง</th>
                                                <th>จัดการ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
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
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- third party js ends -->

    <!-- Datatables init -->
    <script>
        $('#datatable').DataTable({
            order: [[ 0, "desc" ]],
            responsive: true,
            dom: 'Blfrtip',
            buttons: [
                'copy', 'print'
            ],
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
            ajax: '/admin/system/trast.api.php?get=list',
            "columns" : [
                {'data':'0'},
                {'data':'8',
                    "render": function ( data, type, full, meta ) {
                        return '<img src="'+ data +'" class="car-thumb">';
                    }
                },
                {'data':'11'},
                {'data':'1'},
                {'data':'9'},
                {'data':'2'},
                {'data':'3'},
                {'data':'4'},
                {'data':'5'},
                {'data':'10'},
                { 
                    'data': '6',
                    sortable: false,
                    "render": function ( data, type, full, meta ) {
                        if(data == '0'){
                            return '<span class="badge badge-soft-primary">ไม่มีสถานะ</span>';
                        } else if(data == '1'){
                            return '<span class="badge badge-soft-primary">ติดตามลูกค้า</span>';
                        } else if(data == '2') {
                            return '<span class="badge badge-soft-warning">ไม่ได้สัมผัสรถ</span>';
                        } else if(data == '3') {
                            return '<span class="badge badge-soft-danger">ลูกค้าขายเอง / ขายที่อื่น</span>';
                        } else if(data == '4') {
                            return '<span class="badge badge-soft-success">สำเร็จ</span>';
                        } 
                    }
                },
                {'data':'7'},
                { 
                    'data': '0',
                    sortable: false,
                    "render": function ( data, type, full, meta ) {
                        return '<a href="/admin/detail/'+data+'" class="btn btn-sm btn-outline-primary editBtn" role="button"><span class="mdi mdi-account-edit"></span> ดูข้อมูล</a>';
                    }
                }
            ],
        });

    </script>

    <!-- App js -->
    <script src="/assets/js/theme.js"></script>

</body>

</html>