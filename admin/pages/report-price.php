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
            width: 120px;
            height: 85px;
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
                                        <li class="breadcrumb-item">Trade-in</li>
                                        <li class="breadcrumb-item">รถยนต์</li>
                                    </ol>
                                </div>
                                
                            </div>
                        </div>
                    </div>  

                <div class="row" id="count">

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>ค้นหา - เดือน</label>
                                                <select class="form-control" @change="searchData" v-model="selected.month">
                                                    <option value="0">= เลือกเดือนที่ต้องการดูข้อมูล =</option>
                                                    <option v-for="d in select.month_prv" :value="d.date_from">{{ d.name }}</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>ส่วนต่างราคา</label>
                                                <select class="form-control"  @change="searchData" v-model="selected.price">
                                                    <option value="-50000">น้อยกว่าหรือเท่ากับ 50,000 บาท</option>
                                                    <option value="-25000">น้อยกว่าหรือเท่ากับ 25,000 บาท</option>
                                                    <option value="-10000000">ทั้งหมด</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                          
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-3">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <a href="#">
                                    <div class="card bg-success border-success">
                                        <div class="card-body">
                                            <div class="mb-2">
                                                <h5 class="card-title mb-0 text-white">ส่วนต่างในเงื่อนใข</h5>
                                            </div>
                                            <div class="row d-flex align-items-center mb-2">
                                                <div class="col-8">
                                                    <h2 class="d-flex align-items-center text-white mb-0">
                                                        {{ count }}
                                                    </h2>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-3">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <a href="#">
                                    <div class="card bg-secondary border-secondary">
                                        <div class="card-body">
                                            <div class="mb-2">
                                                <h5 class="card-title mb-0 text-white">รถยนต์ทั้งหมด</h5>
                                            </div>
                                            <div class="row d-flex align-items-center mb-2">
                                                <div class="col-8">
                                                    <h2 class="d-flex align-items-center text-white mb-0">
                                                        {{ count }}
                                                    </h2>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    
<!--
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">

                            <div id="morris-line-example" class="morris-chart"></div>
                    
                          
                            </div>
                        </div>
                    </div>
-->
                </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="datatable" class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th width="50px">รหัส ID</th>
                                                <th>รูปภาพ</th>
                                                <th>ลูกค้าต้องการ</th>
                                                <th>เสนอสูงสุด</th>
                                                <th>ส่วนต่าง</th>
                                                <th>%</th>
                                                <th>ชื่อพันธมิตร</th>
                                                <th>ชื่อเซล์</th>
                                                <th>ทีม</th>
                                                <th>วันที่เพิ่ม</th>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script src="/assets/plugins/morris-js/morris.min.js"></script>
    <script src="/assets/plugins/raphael/raphael.min.js"></script>

    <script>

        var count = new Vue({
            el: '#count',
            data: {
                count: 0,
                search: {
                    status: 'all'
                },
                select: {
                    month_prv: [],
                },
                selected:{
                    month: '0',
                    price: '-50000'
                }
            },
            mounted() {

                $('#datatable').DataTable({
                    initComplete: function () {
                        this.api()
                            .columns()
                            .every(function () {
                                let column = this;
                                let title = column.header().textContent;
                
                                let input = document.createElement('input');
                                input.placeholder = title;
                                column.header().replaceChildren(input);
                
                               
                                input.addEventListener('keyup', () => {
                                    if (column.search() !== input.value) {
                                        column.search(input.value).draw();
                                    }
                                });
                                
                            });
                    },
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'print'
                    ],
                    order: [[ 0, "desc" ]],
                    pageLength: 20,
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
                    "ajax": {
                        "url": "/admin/system/price-report.api.php?get=data&date=0",
                        "type": "POST"
                    },
                    "columns": [
                        { "data": "0" },
                        { "data": "9",
                            "render": function(data, type, row, meta){
                                return '<img src="'+data+'" class="car-thumb">';
                            }
                         },
                        { "data": "1" },
                        { "data": "2" },
                        { "data": "3" },
                        { "data": "4" },
                        { "data": "5" },
                        { "data": "6" },
                        { "data": "7" },
                        { "data": "8" },
                        { "data": "0",
                            sortable: false,
                            "render": function(data, type, row, meta){
                                return '<a href="/admin/detail/'+data+'" class="btn btn-outline-primary btn-sm">ดูข้อมูล</a>';
                            }
                        }
                    ]
                });

                axios.post('/admin/system/price-report.api.php?get=current').then(function(response){
                    count.select.month_prv = response.data.month_prv;
                    //count.fetch.chartAvg = response.data.chartAvg;
                });
    /*            
                $(function() {
                    'use strict';
                    if ($('#morris-line-example').length) {
                        Morris.Line({
                            element: 'morris-line-example',
                            gridLineColor: '#eef0f2',
                            lineColors: ['#e83e8c', '#23b5e2' , '#23e29e'],
                            data: count.fetch.chartAvg,
                            xkey: 'y',
                            ymax: '350000',
                            height: 100,
                            ykeys: ['a', 'b' , 'c'],
                            hideHover: 'auto',
                            resize: true,
                            labels: ['Offer Avg.', 'Need Avg.', 'Range Avg.'],
                        });
                    }
                });
*/
            },
            methods: {
                searchData() {
                    swal({
                        title: "กำลังโหลดข้อมูล",
                        text: "โปรดรอสักครู่...",
                        icon: "info",
                        buttons: false,
                        closeOnClickOutside: false,
                        closeOnEsc: false
                    });

                    $('#datatable').DataTable().ajax.url('/admin/system/price-report.api.php?get=data&date='+count.selected.month+'&price='+count.selected.price).load(function() {
                        swal.close();
                        count.count = $('#datatable').DataTable().rows().count();
                    });
                }
            }
        });

    
 
    </script>

    <!-- App js -->
    <script src="/assets/js/theme.js"></script>

</body>

</html>

<?php } ?>