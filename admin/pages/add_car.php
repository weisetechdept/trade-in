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

                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-2 font-size-18">ข้อมูลสมาชิก</h4>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th width="150px">แก้ใขยี่ห้อ ซีรี่ รุ่น</th>
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
                                                        <th>ราคา</th>
                                                        <td><input type="text" class="form-control" v-model="price"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>ชื่อเซลล์</th>
                                                        <td><input type="text" class="form-control" v-model="sales"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>ทีมเซลล์</th>
                                                        <td><select v-model="sales_team" class="form-control">
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                                <option value="G">G</option>
                                                                <option value="I">I</option>
                                                                <option value="X">X</option>
                                                                <option value="U">U</option>
                                                                <option value="Y">Y</option>
                                                                <option value="P">P</option>
                                                                <option value="Z">Z</option>
                                                                <option value="E">E</option>
                                                                <option value="H">H</option>
                                                                <option value="K">K</option>
                                                                <option value="L">L</option>
                                                                <option value="M">M</option>
                                                                <option value="N">N</option>
                                                                <option value="R">R</option>
                                                                <option value="W">W</option>
                                                                <option value="S">S</option>
                                                                <option value="J">J</option>
                                                                <option value="T">T</option>
                                                                <option value="V">V</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>เบอร์โทรศัพท์</th>
                                                        <td><input type="text" class="form-control" v-model="tel"></td>
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
                        }
                    },
                    mounted () {
                        axios.get('/admin/system/add_car.api.php')
                            .then(response => {
                                
                                if(response.data.status == 404) 
                                    swal("เกิดข้อผิดพลาดบางอย่าง", "อาจมีบางอย่างผิดปกติ (error : 404)", "warning",{ 
                                        button: "ตกลง"
                                    }).then((value) => {
                                        window.location.href = "/home";
                                    });
                                this.select = response.data.brand;
                            })
                    },
                    methods: {
                        onChange(e) {
                            axios.get("/admin/system/car_select.api.php?b="+e.target.value)
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
                            axios.get("/admin/system/car_select.api.php?s="+e.target.value)
                                .then(response => {
                                    this.select_year = response.data.year;
                                    $("#year").css("display", "block");
                                    $("#section").css("display", "none");
                                })
                        },
                        onChangeSec(e) {
                            axios.get("/admin/system/car_select.api.php?serie="+this.for_serie+'&t='+e.target.value)
                                .then(response => {
                                    this.select_section = response.data.section;
                                    $("#section").css("display", "block");
                                })
                        },
                        sendData(e) {
                            e.preventDefault();
                            axios.post('/admin/system/new_car.inc.php', {
                                price: this.price,
                                for_section: this.for_section,
                                sales: this.sales,
                                sales_team: this.sales_team,
                                tel: this.tel
                                
                            }).then(res => {
                                console.log(res);
                                if(res.data.status == 200) 
                                    swal("สำเร็จ", "เพิ่มสมาชิกเรียบร้อย", "success",{ 
                                        button: "ตกลง"
                                    }).then((value) => {
                                        window.location.href = "/admin/detail/"+res.data.id
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