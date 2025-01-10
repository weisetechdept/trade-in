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
    <title>Trade-In Partner List</title>
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
            width: 85px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }
        .avatar {
            width: 35px;
            border-radius: 50%;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div id="layout-wrapper">
        <?php 
                include_once('inc-pages/nav.php');
                include_once('inc-pages/sidebar.php');
        ?>
        <div class="main-content" id="partner">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">ข้อมูลสถิติ (พันธมิตร)</h4>
                                
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Trade-in</a></li>
                                        <li class="breadcrumb-item active">ข้อมูลสถิติ</li>
                                    </ol>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12  col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    
                                    <div class="form-group">
                                        <label for="from">เดือน</label>
                                        <select class="form-control" v-model="search" @change="partnerStat">
                                            <option value="">โปรดเลือกเดือน</option>
                                            <option v-for="tmy in thai_month_year" :value="tmy.value">{{ tmy.month }} {{ tmy.year }}</option>
                                        </select>
                                    </div>

                                </div> 
                            </div>
                        </div>
                    </div>

                    <h4>จำนวนการเสอราคาทั้งหมด {{ count_all }}</h4>

                    <div class="row">
                        <div class="col-12 col-md-8 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4>ส่วนของพันธมิตรเสนอผ่านระบบ</h4>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="65px">รหัส</th>
                                                <th>ชื่อ - นามสกุล</th>
                                                <th>ชื่อธุระกิจ / เต้นท์</th>
                                                <th width="100px">เสนอราคา</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="part in partData" v-if="part.id !== 0 && part.id !== 1">
                                                <td>{{ part.id }}</td>
                                                <td>{{ part.name }}</td>
                                                <td>{{ part.partbus }}</td>
                                                <td class="text-center">{{ part.count }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div> 
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-8 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4>ส่วนของพ่อสื่อใส่ราคาแทนพันธมิตร</h4>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ชื่อ - นามสกุล</th>
                                                <th width="100px">เสนอราคา</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="part in partData" v-if="part.id == 0">
                                                <td>{{ part.name }}</td>
                                                <td class="text-center">{{ part.count }}</td>
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
    <!-- third party js ends -->

    <!-- Datatables init -->
    <script>
        var partner = new Vue({
            el: '#partner',
            data: {
                partData: [],
                count_all:0,
                thai_month_year: [],
                search: ''
            },
            mounted() {
                this.partnerSearch();
            },
            methods: {
                partnerSearch() {
                    axios.get('/admin/system/partner-stat.api.php?fetch=date')
                    .then(function (response) {
                        partner.thai_month_year = response.data.thai_month_year;
                    })
                },
                partnerStat() {
                    axios.get('/admin/system/partner-stat.api.php?fetch=find&search='+this.search)
                    .then(function (response) {
                        partner.partData = response.data;
                        partner.count_all = response.data.count_all;
                    })
                }
            }
        });
    </script>

    <!-- App js -->
    <script src="/assets/js/theme.js"></script>

</body>

</html>
<?php } ?>