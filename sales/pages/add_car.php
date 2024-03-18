<?php
    session_start();

    /*
    if($_SESSION['tin_admin'] != true){
        header("location: /404");
        exit();
    }
    */
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
            .page-content {
                padding: 20px 0px;
            }
            #agent {
                margin-top: 70px;
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
                      <div id="agent">
                        <div class="row">
                            <div class="col-12" >
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">เพิ่มรถยนต์ใหม่</h4>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th width="150px">ยี่ห้อ ซีรี่ รุ่น ปี</th>
                                                        <p>แจ้งเตือน : หากไม่ทราบรุ่นย่อย ให้เลื่อกรุ่นใกล้เคียง ทีมพ่อสื่อจะเช็ครายละเอียดและเปลี่ยนรุ่นให้ถูกต้องในภายหลัง</p>
                                                        <td>
                                                            <select class="form-control" v-model="for_change" @change="onChange($event)">
                                                                <option value="0">= โปรดเลือกยี่ห้อรถยนต์ =</option>
                                                                <option v-for="brand in select" :value="brand">{{ brand }}</option>
                                                            </select>
                                                            <select id="serie" class="form-control mt-3" v-model="for_serie" @change="onChangeSerie($event)">
                                                                <option v-for="serie in select_serie" :value="serie">{{ serie }}</option>
                                                            </select>
                                                            <select id="year" class="form-control mt-3" @change="onChangeSec($event)">
                                                                <option v-for="year in select_year" :value="year">{{ year }}</option>
                                                            </select>
                                                            <select id="section" v-model="for_section" class="form-control mt-3">
                                                                <option  v-for="section in select_section"  :value="section.id">{{ section.name }}</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>เกียร์</th>
                                                        <td>
                                                            <select class="form-control" v-model="transmission">
                                                                <option value="0">= โปรดเลือกเกียร์ =</option>
                                                                <option value="MT">เกียร์อัตโนมัติ</option>
                                                                <option value="AT">เกียร์ธรรมดา</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>ราคาที่ยอมรับได้</th>
                                                        <td><input type="text" class="form-control" v-model="price"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>ชื่อ ผู้ขาย</th>
                                                        <td><input type="text" class="form-control" v-model="seller_name"></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <th>เบอร์โทร ผู้ขาย</th>
                                                        <td><input type="text" class="form-control" v-model="tel" maxlength="10"></td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                            <div class="form-group mt-3">
                                                <button @click="sendData" type="submit" class="btn btn-success waves-effect waves-light mr-1">บันทึก</button>
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
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


        <script>
            
                var agent_detail = new Vue({
                    el: '#agent',
                    data () {
                        return {
                            id: '',
                            license: '',
                            brand: '',
                            serie: '',
                            section: '',
                            transmission: '',
                            color: '',
                            price: '',
                            sales: '',
                            sales_team: '',
                            status: '',
                            car_year: '',
                            reg_year: '',
                            transmission: '',
                            option: '',
                            vin: '',
                            mileage: '',
                            select: '',
                            select_serie: '',
                            select_year: '',
                            select_section: '',
                            for_serie: '',
                            for_section: '',
                            for_change: '0',
                            tel: '',
                            seller_name: '',
                            user: {
                                id: '',
                            }
                        }
                    },
                    mounted () {
                        axios.get('/sales/system/add_car.api.php')
                            .then(response => {
                                console.log(response.data);
                                if(response.data.status == 404)
                                    swal("เกิดข้อผิดพลาดบางอย่าง", "อาจมีบางอย่างผิดปกติ (error : 404)", "warning",{ 
                                        button: "ตกลง"
                                    }).then((value) => {
                                        window.location.href = "/home";
                                    });
                                this.select = response.data.brand;
                                this.user.id = response.data.user.id;
                            })
                    },
                    methods: {
                        onChange(e) {
                            axios.get("/sales/system/car_select.api.php?b="+e.target.value)
                                .then(response => {
                                    if(e.target.value == '0'){
                                        $("#serie").css("display", "none");
                                        $("#year").css("display", "none");
                                        $("#section").css("display", "none");
                                    }
                                    this.select_serie = response.data.serie;
                                    $("#serie").css("display", "block");
                                    $("#year").css("display", "none");
                                    $("#section").css("display", "none");
                                })
                        },
                        onChangeSerie(e) {
                            axios.get("/sales/system/car_select.api.php?s="+e.target.value)
                                .then(response => {
                                    this.select_year = response.data.year;
                                    $("#year").css("display", "block");
                                    $("#section").css("display", "none");
                                })
                        },
                        onChangeSec(e) {
                            axios.get("/sales/system/car_select.api.php?serie="+this.for_serie+'&t='+e.target.value)
                                .then(response => {
                                    this.select_section = response.data.section;
                                    $("#section").css("display", "block");
                                })
                        },
                        sendData(e) {
                            e.preventDefault();
                            axios.post('/sales/system/new_car.inc.php', {
                                price: this.price,
                                for_section: this.for_section,
                                sales: this.sales,
                                sales_team: this.sales_team,
                                tel: this.tel,
                                user_id: this.user.id,
                                seller_name: this.seller_name
                                
                            }).then(res => {
                                console.log(res);
                                if(res.data.status == 200) 
                                    swal("สำเร็จ", "เพิ่มสมาชิกเรียบร้อย", "success",{  
                                        button: "ตกลง"
                                    }).then((value) => {
                                        window.location.href = "/sales/detail/"+res.data.id
                                    });

                                if(res.data.status == 505) 
                                    swal("ทำรายการไม่สำเร็จ", "อาจมีบางอย่างผิดปกติ โปรดตรวจสอบเงื่อนไขการสมัครสมาชิกให้ถูกต้อง และครบถ้วน หรือติดต่อเจ้าหน้าที่", "warning",{ 
                                        button: "ตกลง"
                                    }
                                );
                                if(res.data.status == 400) 
                                    swal("ทำรายการไม่สำเร็จ", "สมาชิกไม่เข้าเงื่อนใขการสมัคร โปรดตรวจสอบคุณสมบัติอีกครั้ง (เป็นสมาชิก Paragon Family)", "warning",{ 
                                        button: "ตกลง"
                                    }
                                );
                            });
                        }
                    }
                });
                
        </script>

              <!-- App js -->
              <script src="/assets/js/theme.js"></script>

    </body>
</html>