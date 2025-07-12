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
            width: 130px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }
        .gray {
            background-color: #f9f9f9;
        }
        .gray-imp {
            background-color: #ededed;
        }
        .bg-status {
            background-color: #fbffe1;
        }
        .month-header {
            font-weight: bold;
            text-align: center;
        }
        .highlight-100 {
            text-align: center;
        }
        .percentage {
            text-align: center;
        }
        .mark {
            background-color: #f0f0f0;
            font-weight: bold;
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

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <div id="main-table" class="table table-responsive tab-content active">

                                        <h3>📋 ทุกทีม x 3เดือน</h3>
                                        
                                        <div class="responsive-wrapper">
                                            <table id="mainDataTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="3">ทีม</th>

                                                        <template v-for="(item, index) in reportData.A" :key="index">
                                                            <th colspan="10" class="category-section">{{ item.month_year }}</th>
                                                        </template>

                                                        <th colspan="2" class="summary-row">รวม</th>
                                                    </tr>
                                                    <tr>
                                                        <!-- B/K -->
                                                         <template v-for="(item, index) in reportData.A" :key="index">
                                                            <th colspan="2" class="month-header">BOOKING</th>
                                                            <th colspan="2" class="month-header">ประเมิน</th>
                                                            <th colspan="2" class="month-header">สัมผัส</th>
                                                            <th colspan="2" class="month-header">จบเก่า</th>
                                                            <th colspan="2" class="month-header">ไม่สัมผัส</th>
                                                        </template>

                                                        <!-- สรุป -->
                                                        <th class="summary-row" rowspan="3">เฉลี่ย</th>
                                                        <th class="summary-row" rowspan="3">แนวโน้ม</th>
                                                    </tr>

                                                    <tr>
                                                        <template v-for="(item, index) in reportData.A" :key="index">
                                                            <th class="month-header mark">BK</th>
                                                            <th class="month-header">C</th>
                                                            <th class="month-header">V</th>
                                                            <th class="month-header">%</th>
                                                            <th class="month-header">V</th>
                                                            <th class="month-header">%</th>
                                                            <th class="month-header">B/O</th>
                                                            <th class="month-header">N</th>
                                                            <th class="month-header">V</th>
                                                            <th class="month-header">%</th>
                                                        </template>
                                                        
                                                    </tr>
                                                    
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(item, index) in reportData" :key="index">
                                                        <td class="team-header">{{index}}</td>
                                                        
                                                        <!-- B/K -->
                                                        <template v-for="(month, monthIndex) in item" :key="monthIndex">
                                                            <td class="highlight-100 mark">{{ month.bkn }}</td>
                                                            <td class="highlight-100">{{ month.canceln }}</td>
                                                            <td class="highlight-100">{{ month.trade_in }}</td>
                                                            <td class="highlight-100">{{ month.trade_in_per }}</td>
                                                            <td class="highlight-100">{{ month.touch }}</td>
                                                            <td class="highlight-100">{{ month.touch_per }}</td>
                                                            <td class="percentage">{{ month.trade_bo_rs }}</td>
                                                            <td class="percentage">{{ month.trade_n_rs }}</td>
                                                            <td class="percentage">{{ month.no_touch }}</td>
                                                            <td class="percentage">{{ month.no_touch_per }}</td>
                                                        </template>
                                                        

                                                        <td class="percentage"></td>
                                                        <td class="percentage"></td>


                                                        
                                                    </tr>
                                                    
                                                    <!-- แถวสรุป -->
                                                    <tr class="summary-row">
                                                        <td><strong>เฉลี่ยรวม</strong></td>

                                                       
                                                        <!-- B/K เฉลี่ย -->
                                                    
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.1/axios.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script>

        var count = new Vue({
            el: '#count',
            data: {
                reportData: [],
            },
            mounted() {
                axios.get('/admin/system/report-mgr.api.php')
                    .then(response => {
                        console.log(response.data);
                        this.reportData = response.data.team;
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    })
            },
            methods: {
                
            }
        });

    </script> 

    <!-- App js -->
    <script src="/assets/js/theme.js"></script>

</body>

</html>
<?php } ?>