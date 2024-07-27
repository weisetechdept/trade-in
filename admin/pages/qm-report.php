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
        .bg-status {
            background-color: #fbffe1;
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

            <div class="page-content" id="count">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">รายงานเปรียบเทียบ</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Trade-in</a></li>
                                        <li class="breadcrumb-item active">รายงานเปรียบเทียบ</li>
                                    </ol>
                                </div>
                                
                            </div>
                        </div>
                    </div>  

                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                
                                    <div class="form-row">
                                        <div class="col-md-3 mb-1">
                                            <label>ตั้งแต่</label>
                                            <input type="date" class="form-control" v-model="search.start">
                                        </div>

                                        <div class="col-md-3">
                                            <label>ถึง</label>
                                            <input type="date" class="form-control" v-model="search.end">
                                        </div>

                                        <div class="col-md-3">
                                            <button class="btn btn-primary search-btn" @click="searchData()" type="submit">ค้นหา</button>
                                        </div>
                                    </div>
                          
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>สถานะล่าสุด</th>
                                            <th v-for="c in count">{{ c.team }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>ยอดจองรถใหม่</td>
                                            <td v-for="c in count">{{ c.value }}</td>
                                        </tr>
                                        <tr>
                                            <td>ได้ประเมินราคา</td>
                                            <td v-for="c in count">{{ c.trade }}</td>
                                        </tr>
                                        <tr class="gray">
                                            <td>%</td>
                                            <td v-for="c in count">{{ c.percentage }}</td>
                                        </tr>
                                        <tr>
                                            <td>ซื้อรถคันแรก</td>
                                            <td v-for="c in count">{{ c.objFirst }}</td>
                                        </tr>
                                        <tr>
                                            <td>ซื้อรถทดแทน</td>
                                            <td v-for="c in count">{{ c.objReplace }}</td>
                                        </tr>
                                        <tr>
                                            <td>ซื้อเพิ่มเติม</td>
                                            <td v-for="c in count">{{ c.objAddon }}</td>
                                        </tr>
                                        <tr class="bg-status">
                                            <td>รอสถานะ</td>
                                            <td v-for="c in count">{{ c.wait_value }}</td>
                                        </tr>
                                        <tr class="bg-status">
                                            <td>ขายกับเรา</td>
                                            <td></td>
                                        </tr>
                                        <tr class="bg-status">
                                            <td>ลค.ขายเอง</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                            </div> 
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ประเภท</th>
                                            <th>จำนวน</th>
                                            <th>%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="150px">ซื้อรถคันแรก</td>
                                            <td>{{ type.first }}</td>
                                            <td>{{ type.first_per }}</td>
                                        </tr>
                                        <tr>
                                            <td>ซื้อรถทดแทน</td>
                                            <td>{{ type.replace }}</td>
                                            <td>{{ type.replace_per }}</td>
                                        </tr>
                                        <tr>
                                            <td>ซื้อเพิ่มเติม</td>
                                            <td>{{ type.addon }}</td>
                                            <td>{{ type.addon_per }}</td>
                                        </tr>
                                        <tr class="gray">
                                            <td>รวม</td>
                                            <td>{{ type.all }}</td>
                                            <td>100%</td>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.1/axios.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script>

        var count = new Vue({
            el: '#count',
            data: {
                count: [],
                type: [],
                search: {
                    start: '<?php echo date('Y-m-01'); ?>',
                    end: '<?php echo date('Y-m-d'); ?>',
                    status: 'all'
                }
            },
            mounted() {
                axios.get('/admin/system/qm-report.api.php?start=<?php echo date('Y-m-01'); ?>&end=<?php echo date('Y-m-d'); ?>').then(res => {
                    console.log(res.data);
                    this.count = res.data.count;
                    this.type = res.data.type;
                });
            },
            methods: {
                searchData() {
                    swal("กำลังโหลด...", {
                        buttons: false
                    });
                    axios.get('/admin/system/qm-report.api.php?start=' + this.search.start + '&end=' + this.search.end).then(res => {
                        this.count = res.data.count;
                        this.type = res.data.type;
                        swal.close();
                    });
                },
            }
        });

    </script> 

    <!-- App js -->
    <script src="/assets/js/theme.js"></script>

</body>

</html>
<?php } ?>