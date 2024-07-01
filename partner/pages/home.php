<?php 
    session_start();

    if(!isset($_SESSION['tin_partner']) && $_SESSION['partner_id'] !== ''){
        header('Location: /404');
    } else {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>พันธมิตรรถยนต์</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="/partner/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/partner/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/partner/assets/css/theme.min.css" rel="stylesheet" type="text/css" />

    <link href="/partner/assets/plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/partner/assets/plugins/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/partner/assets/plugins/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/partner/assets/plugins/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'SaraBun', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Kanit', sans-serif;
        }
        .logo {
            font-family: 'Kanit', sans-serif;
            font-weight: 500;
        }
        .badge-info {
            color: #fff;
            background-color: #12c200;
        }
        .vertical-menu {
            background: #242424;
        }
        .navbar-header {
            background-color: #000000;
            border-bottom: 3px solid #12c200;
        }
        @media (max-width: 768px) {
            .logo-show {
                display: none;
            }
        }
        .mm-active .active {
            color: #ffffff !important;
        }
        .car-thumb {
            width: 80px;
            border-radius: 5pt;
        }
        .header-profile-user {
            height: 45px;
            width: 45px;
            padding: 3px;
        }
    </style>

</head>

<body>

    <div id="layout-wrapper">

        <?php include 'inc-pages/nav.php'; 
                include 'inc-pages/sidebar.php'; ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">อัพเดท</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">พันธมิตรรถยนต์</a></li>
                                        <li class="breadcrumb-item active">อัพเดท</li>
                                    </ol>
                                </div>
                                
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                    
                                    <h4 class="card-title">มาใหม่วันนี้</h4>

                                    <table class="table" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>รหัส</th>
                                                <th>รูป</th>
                                                <th>ยี่ห้อ - รุ่น</th>
                                                <th>ปี</th>
                                                <th>เกียร์</th>
                                                <th>เลขไมล์</th>
                                                <th>ข้อมูล</th>
                                            </tr>
                                        </thead>
                                        <tbody id="new-today">
                                            <tr>
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

            <?php include 'inc-pages/footer.php'; ?>

        </div>

    </div>

    <div class="menu-overlay"></div>

    <script src="/partner/assets/js/jquery.min.js"></script>
    <script src="/partner/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/partner/assets/js/metismenu.min.js"></script>
    <script src="/partner/assets/js/waves.js"></script>
    <script src="/partner/assets/js/simplebar.min.js"></script>
    <script src="/partner/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="/partner/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
    <script src="/partner/assets/plugins/morris-js/morris.min.js"></script>
    <script src="/partner/assets/plugins/raphael/raphael.min.js"></script>
    <script src="/partner/assets/pages/dashboard-demo.js"></script>
    <script src="/partner/assets/js/theme.js"></script>

    <script src="/partner/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/partner/assets/plugins/datatables/dataTables.bootstrap4.js"></script>
    <script src="/partner/assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="/partner/assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
    <script src="/partner/assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="/partner/assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="/partner/assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="/partner/assets/plugins/datatables/buttons.flash.min.js"></script>
    <script src="/partner/assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="/partner/assets/plugins/datatables/dataTables.keyTable.min.js"></script>
    <script src="/partner/assets/plugins/datatables/dataTables.select.min.js"></script>
    <script src="/partner/assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="/partner/assets/plugins/datatables/vfs_fonts.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.1/axios.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script>
        var app = new Vue({
            el: '#new-today',
            data: {
                cars: []
            },
            mounted() {
                $('#datatable').DataTable({
                    responsive: true,
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
                    ajax: '/partner/system/new-car.api.php',
                    "columns" : [
                        {'data':'3'},
                        {'data':'1',
                            "render": function ( data, type, full, meta ) {
                                return '<img src="'+ data +'" class="car-thumb">';
                            }
                        },
                        {'data':'2'},
                        {'data':'6'},
                        {'data':'5'},
                        {'data':'4'},
                        {'data':'0',
                            sortable: false,
                            "render": function ( data, type, full, meta ) {
                                return '<a href="/pt/stock/'+data+'" class="btn btn-sm btn-outline-primary editBtn" role="button"><span class="mdi mdi-account-edit"></span> ข้อมูล</a>';
                            }
                        }
                    ],
                });
            },
            methods: {
                
            }
        });


        
    </script>

</body>

</html>

<?php } ?>