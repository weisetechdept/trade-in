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
            width: 135px;
            border-radius: 50%;
        }
        .profile {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }
        .swal-footer {
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
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid" id="partner">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">พันธมิตร</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Trade-in</a></li>
                                        <li class="breadcrumb-item active">พันธมิตร</li>
                                    </ol>
                                </div>
                                
                            </div>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="profile">
                                <img :src="partner.profile_img" alt="" class="avatar">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td width="135px">รหัสพันธมิตร</td>
                                                <td>{{ partner.id }}</td>
                                            </tr>
                                            <tr>
                                                <td>ชื่อพันธมิตร</td>
                                                <td>{{ partner.name }}</td>
                                            </tr>
                                            <tr>
                                                <td>เบอร์โทร</td>
                                                <td>{{ partner.tel }}</td>
                                            </tr>
                                            <tr>
                                                <td>บริษัท</td>
                                                <td>
                                                    <span v-if="partner.busi_match == '0'">ยังไม่ได้เลือก</span>
                                                    <span v-else>{{ partner.busi_match }}</span>
                                                     ({{ partner.busi_name }})
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>กลุ่มพันธมิตร</td>
                                                <td v-if="partner.group == '0'">Basic</td>
                                            </tr>

                                            <tr>
                                                <td>สถานะ</td>
                                                <td v-if="partner.status == '0'"><span class="badge badge-warning">รอตรวจสอบ</span></td>
                                                <td v-if="partner.status == '1'"><span class="badge badge-success">อนุมัติ</span></td>
                                                <td v-if="partner.status == '10'"><span class="badge badge-danger">ไม่อนุมัติ</span></td>
                                            </tr>
                                            <tr>
                                                <td>วันที่สมัคร</td>
                                                <td>
                                                    {{ partner.create_date }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div> 
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">จัดการ</h3>
                                    <button type="button" class="btn btn-outline-warning mr-2">แก้ไข</button>
                                    <button type="button" @click="verify" class="btn btn-outline-info mr-2">นำเข้าบริษัท</button>
                                    <button type="button" @click="verify" class="btn btn-success mr-2">อนุมัติสมาชิก</button>
                                </div> 
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">ประวัติการเสนอราคา</h3>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>วันที่</th>
                                                <th>รหัสรถ</th>
                                                <th>ราคา (บาท)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>01/01/2021</td>
                                                <td>414</td>
                                                <td>100,000</td>
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
                partner: []
            },
            mounted: function(){
                this.getPartner();
            },
            methods: {
                getPartner: function(){
                    axios.get('/admin/system/partner-detail.api.php?id=<?php echo $id; ?>')
                    .then(function (response) {
                        console.log(response.data);
                        partner.partner = response.data.detail;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                },
                verify(){
                    if(this.partner.busi_match == '0'){
                        swal("ไม่สามารถดำเนินการได้","กรุณาเลือกบริษัทก่อนทำการอนุมัติ","warning"
                        ,{
                            button: "ตกลง",
                        })
                    } else {

                        swal({
                            title: "ยืนยันการอนุมัติ",
                            text: "คุณต้องการอนุมัติสมาชิกคนนี้ใช่หรือไม่?",
                            icon: "warning",
                            buttons: true,
                            dangerMode: false,
                        })
                    }
                    
                }
            
            },
        });
        
    </script>

    <!-- App js -->
    <script src="/assets/js/theme.js"></script>

</body>

</html>
<?php } ?>