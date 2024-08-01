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
        <title>Car Detail</title>
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

        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
        <style>
            body {
                font-family: 'Chakra Petch', sans-serif;
            }
            .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
                font-family: 'Kanit', sans-serif;
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
            .swal-text {
                text-align: center;
            }
            .swal-footer {
                text-align: center;
            }
            .radio-control{
                float: left;
                margin-right: 10px;
            }
            .swal-button, .swal-button:not([disabled]):hover {
                background-color: #7266bb;
            }
            .card-map {
                padding: 0.5rem 0.25rem 0.25rem 0.25rem;
            }
            .card-topic {
                padding: 0.5rem 0 0 1rem;
            }
            .edit-warning {
                border: 1pt solid #FF0000;
                color: #FF0000;
                padding: 10px;
                border-style: dashed;
            }
            .car_img {
                height: 300px;
                object-fit: cover;
            }
            .car_select {
                background-color: #ffffdc;
            }
            #serie, #section, #year {
                display: none;
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
                      <div>
                        <div class="row">
                            <div class="col-12" >
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">เปลี่ยนผู้ดูแล</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">A77</a></li>
                                            <li class="breadcrumb-item active">สมาชิก</li>
                                        </ol>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-6 col-md-12" id="owner">

                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-2 font-size-18">ข้อมูลสมาชิก</h4>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th width="120px">รหัส ID</th>
                                                        <td>{{ id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>ชื่อผู้ขาย</th>
                                                        <td>{{ seller_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>รถยนต์</th>
                                                        <td>{{ car }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>เซลล์ผู้ดูแล</th>
                                                        <td>
                                                            <div class="form-group">
                                                                <select class="form-control search-sales"></select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                            <div class="form-group mt-3">
                                                <button type="submit" @click="editOwner" class="btn btn-success waves-effect waves-light ml-2">บันทึก</button>
                                            </div>
                                        </div>
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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


        <script>
            var owner = new Vue({
                el: '#owner',
                data () {
                    return {
                        sales: '0',
                        id: '',
                        seller_name: '',
                        car: ''
                    }
                },
                mounted () {
                    axios.post('/admin/system/car_owner.api.php?id=<?php echo $id; ?>').then(function(response) {
                      
                        $('.search-sales').select2({
                            data: response.data.sales
                        });

                        $('.search-sales').on('change', function(e) {
                            owner.sales = e.target.value;
                        });

                        //console.log(response.data);
                        owner.id = response.data.custData.id,
                        owner.seller_name = response.data.custData.seller_name,
                        owner.car = response.data.custData.car
                        
                    });
                },
                methods: {
                    onChange(e) {
                        this.sales = e.target.value;
                    },
                    editOwner() {

                        if(this.sales == '0'){
                            swal("กรุณาเลือกเซลล์ผู้ดูแล", {
                                icon: "warning",
                            });
                            return;
                        } else {

                            swal({
                                title: "คุณต้องการเปลี่ยนผู้ดูแลใช่หรือไม่?",
                                text: "กรุณายืนยันการเปลี่ยนผู้ดูแล",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            })
                            .then((willDelete) => {
                                if (willDelete) {
                                        
                                        axios.post('/admin/system/car_owner.edt.php', {
                                            id: owner.id,
                                            sales: owner.sales
                                        }).then(function(response) {
                                            if(response.data.status == 'success'){
                                                swal("เปลี่ยนผู้ดูแลสำเร็จ", {
                                                    icon: "success",
                                                }).then((value) => {
                                                    window.location.href = '/admin/detail/' + response.data.id;
                                                });
                                            } else {
                                                swal("เปลี่ยนผู้ดูแลไม่สำเร็จ", {
                                                    icon: "error",
                                                });
                                            }
                                        });


                                } else {
                                    swal("ยกเลิกการเปลี่ยนผู้ดูแล");
                                }
                            });

                        }
                        
                    }
                },
            });
                
        </script>

        <script src="/assets/js/theme.js"></script>

    </body>
</html>
<?php } ?>