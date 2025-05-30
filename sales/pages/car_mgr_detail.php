<?php
    session_start();
    
    if($_SESSION['tin_login'] != true){
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
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">

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
            .swal-button--danger {
                background-color: #e64942;
            }
            .swal-button--cancel {
                color: #555;
                background-color: #efefef;
            }
            .check-list p {
                margin-bottom: 5px;
                padding-left: 10px;
                font-size: 14px;
            }
            .red {
                color: red;
            }
            .green{
                color: green;
            }
            .guide-line {
                text-align: center;
                margin-bottom: 30px;
            }
            .car_img_guide {
                width: 95%;
                border-radius: 10px;
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
                                        <h4 class="mb-0 font-size-18">รถยนต์รหัส</h4>

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

                                <div class="col-lg-6 col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="mb-2 font-size-18">ข้อมูลสมาชิก</h4>
                                            <div class="table-responsive">
                                                <table class="table mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <th width="155px">รหัส ID</th>
                                                            <td>{{ id }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>เลขไมล์</th>
                                                            <td>{{ mileage }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>ยี่ห้อ</th>
                                                            <td>{{ brand }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>ซีรี่</th>
                                                            <td>{{ serie }}</td>
                                                        <tr>
                                                            <th>รุ่น</th>
                                                            <td>{{ section }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>เกียร์</th>
                                                            <td>{{ transmission }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>สี</th>
                                                            <td>{{ color }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>รุ่นปี</th>
                                                            <td>{{ car_year }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>ราคา</th>
                                                            <td>{{ price }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>เพิ่มเติม</th>
                                                            <td>{{ option }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>สภาพ</th>
                                                            <td>{{ condition }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>ชื่อ ผู้ขาย</th>
                                                            <td>{{ sellername }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>เบอร์โทรศัพท์ ผู้ขาย</th>
                                                            <td>{{ tel }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>สถานะ</th>
                                                            <td v-if="status == '0'"><span class="badge badge-soft-success">ไม่มีสถานะ.</span></td>
                                                            <td v-if="status == '1'"><span class="badge badge-soft-success">ติดตามลูกค้า</span></td>
                                                            <td v-if="status == '2'"><span class="badge badge-soft-success">ไม่ได้สัมผัสรถ</span></td>
                                                            <td v-if="status == '3'"><span class="badge badge-soft-success">ลูกค้าขายเอง / ขายที่อื่น</span></td>
                                                            <td v-if="status == '4'"><span class="badge badge-soft-success">สำเร็จ</span></td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                                <div class="form-group mt-3">
                                                    <h4 class="mb-2 font-size-18">จัดการข้อมูล</h4>
                                                    <a :href="'/sales/edit/'+id" type="submit" class="btn btn-outline-warning waves-effect waves-light mr-1">แก้ใข</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="mb-2 font-size-18">ราคาจากพันธมิตร</h4>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>ลำดับ</th>
                                                        <th>ราคา</th>
                                                        <th>เวลา</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="off in offer">
                                                        <td>{{ off.no }}</td>
                                                        <td>{{ off.price }}</td>
                                                        <td>{{ off.date }}</td>
                                                    </tr>
                                                </tbody>

                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>

                        

                      <div class="row" id="chkimg">
                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-2 font-size-18">สถานะรูป : <span v-if="status == '0'" class="red">ยังไม่ครบ</span><span v-else-if="status == '1'" class="green">ครบถ้วน</span></h4>
                                        <div class="check-list">
                                            <p v-if="count[10] >= 1" class="green"><i class="mdi mdi-check-circle-outline"></i> ด้านหน้าตรง**</p>
                                            <p v-else class="red"><i class="mdi mdi-close-circle-outline"></i> ด้านหน้าตรง**</p>
                                            
                                            <p v-if="count[11] >= 1" class="green"><i class="mdi mdi-check-circle-outline"></i> ด้่านหลังตรง**</p>
                                            <p v-else class="red"><i class="mdi mdi-close-circle-outline"></i> ด้่านหลังตรง**</p>

                                            <p v-if="count[12] >= 1" class="green"><i class="mdi mdi-check-circle-outline"></i> มุมเฉียงหน้าซ้าย**</p>
                                            <p v-else class="red"><i class="mdi mdi-close-circle-outline"></i> มุมเฉียงหน้าซ้าย**</p>

                                            <p v-if="count[13] >= 1" class="green"><i class="mdi mdi-check-circle-outline"></i> มุมเฉียงหลังซ้าย**</p>
                                            <p v-else class="red"><i class="mdi mdi-close-circle-outline"></i> มุมเฉียงหลังซ้าย**</p>

                                            <p v-if="count[14] >= 1" class="green"><i class="mdi mdi-close-circle-outline"></i> ที่นั่งคนขับ</p>
                                            <p v-else class="red"><i class="mdi mdi-close-circle-outline"></i> ที่นั่งคนขับ</p>

                                            <p v-if="count[15] >= 1" class="green"><i class="mdi mdi-close-circle-outline"></i> ภายในหลังซ้าย</p>
                                            <p v-else class="red"><i class="mdi mdi-close-circle-outline"></i> ภายในหลังซ้าย</p>

                                            <p v-if="count[16] >= 1" class="green"><i class="mdi mdi-close-circle-outline"></i> พวงมาลัย และคอนโซล**</p>
                                            <p v-else class="red"><i class="mdi mdi-close-circle-outline"></i> พวงมาลัย และคอนโซล**</p>

                                            <p v-if="count[17] >= 1" class="green"><i class="mdi mdi-check-circle-outline"></i> หน้าปัด และเลขไมล์**</p>
                                            <p v-else class="red"><i class="mdi mdi-close-circle-outline"></i> หน้าปัด และเลขไมล์**</p>

                                            <p v-if="count[18] >= 1" class="green"><i class="mdi mdi-check-circle-outline"></i> เกียร์**</p>
                                            <p v-else class="red"><i class="mdi mdi-close-circle-outline"></i> เกียร์**</p>

                                            <p v-if="count[19] >= 1" class="green"><i class="mdi mdi-close-circle-outline"></i> กุญแจ</p>
                                            <p v-else class="red"><i class="mdi mdi-close-circle-outline"></i> กุญแจ</p>

                                            <p v-if="count[20] >= 1" class="green"><i class="mdi mdi-close-circle-outline"></i> ป้ายภาษี**</p>
                                            <p v-else class="red"><i class="mdi mdi-close-circle-outline"></i> ป้ายภาษี**</p>

                                            <p v-if="count[21] >= 1" class="green"><i class="mdi mdi-close-circle-outline"></i> สำเนาทะเบียนหน้ารายการจดทะเบียน และเจ้าของรถ (ล่าสุด)**</p>
                                            <p v-else class="red"><i class="mdi mdi-close-circle-outline"></i> สำเนาทะเบียนหน้ารายการจดทะเบียน และเจ้าของรถ (ล่าสุด)**</p>

                                            <p v-if="count[22] >= 1" class="green"><i class="mdi mdi-close-circle-outline"></i> เล่มฟ้าหน้า 18 (ถ้ามี)</p>
                                            <p v-else class="red"><i class="mdi mdi-close-circle-outline"></i> เล่มฟ้าหน้า 18 (ถ้ามี)</p>

                                        </div>
                                        <div class="mt-4">
                                            <p>**จำเป็นต้องมี</p>
                                            <p class="mb-0"><a href="#">ดูตัวอย่างการถ่ายภาพรถยนต์</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="card">
                                        <div class="card-body">
<div id="form">
                                            <div class="guide-line" id="agent">
                                                <p>ตัวอย่างการถ่ายรูป</p>
                                                    <img v-if="group != 0" :src="'/assets/images/photo-guild/guild-line-00'+ group + '.jpg'" width="100%" class="car_img_guide">
                                            </div>

                                            <h4 class="mb-2 font-size-18">อัพโหลดรูปหน้าปก</h4>

                                                <form @submit.prevent="sendData">
                                                        <div class="form-group">
                                                            <select class="form-control" v-model="group">
                                                                <option value="0">= เลือกประเภทของภาพ =</option>
                                                                <option value="10">ด้่านหน้าตรง</option>
                                                                <option value="11">ด้่านหลังตรง</option>
                                                                <option value="12">มุมเฉียงหน้าซ้าย</option>
                                                                <option value="13">มุมเฉียงหลังซ้าย</option>
                                                                <option value="14">ที่นั่งคนขับ</option>
                                                                <option value="15">ภายในหลังซ้าย</option>
                                                                <option value="16">พวงมาลัย และคอนโซล</option>
                                                                <option value="17">หน้าปัด และเลขไมล์</option>
                                                                <option value="18">เกียร์</option>
                                                                <option value="19">กุญแจ</option>
                                                                <option value="20">ป้ายภาษี</option>
                                                                <option value="21">สำเนาทะเบียนผู้ถือกรรมสิทธิ์</option>
                                                                <option value="22">เล่มฟ้าหน้า 18</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="file" name="file_upload" id="file_upload" @change="onFileChange">
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">อัพโหลด</button>
                                                        </div>
                                                </form>
</div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div id="car_img">
                                <div class="row" v-for="docs in img">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <img :src="docs.link_500" width="100%" class="car_img">
                                                <a :href="docs.link_500" target="_blank" type="button" class="btn btn-sm btn-primary waves-effect waves-light mt-2" style="margin-top: 10px;">รูปขนาดเต็ม</a>
                                                <button @click="sendDelete" :value="docs.id" type="button" class="btn btn-sm btn-danger waves-effect waves-light mt-2" style="margin-top: 10px;">ลบ</button>
                                                <p class="mt-1">อัพโหลดเมื่อ : {{ docs.datetime }}</p>
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

        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>


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
                            trade_price: '',
                            condition:'',
                            tlt_price: '',
                            sales: '',
                            status: '',
                            car_year: '',
                            reg_year: '',
                            transmission: '',
                            option: '',
                            vin: '',
                            mileage: '',
                            tel: '',
                            downpayment: '',
                            loanrate: '100',
                            loan: '',
                            interestrate: '7',
                            period: '6',
                            cal_price: '',
                            cal_tltprice: '',
                            vat: '',
                            sellername: '',
                            offer:[]
                        }
                    },
                    mounted () {
                        axios.get('/sales/system/car_mgr_detail.api.php?u=<?php echo $cid; ?>')
                            .then(response => {
                                if(response.data.status == 404) 
                                    swal("เกิดข้อผิดพลาดบางอย่าง", "อาจมีบางอย่างผิดปกติ (error : 404)", "warning",{ 
                                        button: "ตกลง"
                                    }).then((value) => {
                                        window.location.href = "/sales/mgr";
                                    });
                                
                                this.cal_price = response.data.car.cal_price;
                                this.cal_tltprice = response.data.car.cal_tlt_price;
                                var cal_down = this.cal_price - (this.cal_tltprice * (this.loanrate/100));
                                if(cal_down < 0){
                                    this.downpayment = 0
                                } else {
                                    this.downpayment = cal_down
                                }
                                this.loan = (this.cal_price - this.downpayment)
                                
                                this.id = response.data.car.id;
                                this.license = response.data.car.license;
                                this.brand = response.data.car.brand;
                                this.serie = response.data.car.serie;
                                this.section = response.data.car.section;
                                this.color = response.data.car.color;
                                this.price = response.data.car.price;
                                this.trade_price = response.data.car.trade_price;
                                this.sales = response.data.car.sales;
                                this.status = response.data.car.status;
                                this.car_year = response.data.car.car_year;
                                this.reg_year = response.data.car.reg_year;
                                this.tlt_price = response.data.car.tlt_price;
                                this.transmission = response.data.car.transmission;
                                this.option = response.data.car.option;
                                this.condition = response.data.car.condition;
                                this.vin = response.data.car.vin;
                                this.mileage = response.data.car.mileage;
                                this.tel = response.data.car.tel;
                                this.vat = response.data.car.vat;
                                this.sellername = response.data.car.sellername;
                                this.offer = response.data.offer;
                             
                            }),
                            this.calDownpayment();
                    },
                    methods: {
                        calDownpayment(e){
                            
                            var cal_down = this.cal_price - (this.cal_tltprice * (this.loanrate/100));
                            if(cal_down < 0){
                                this.downpayment = 0
                            } else {
                                this.downpayment = cal_down
                            }
                            this.loan = (this.cal_price - this.downpayment)
                        
                            
                        },
                        formatPrice(value) {
                            let val = (value/1).toFixed(2).replace(',', '.')
                            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                        }
                    }
                });

                var chkimg = new Vue({
                    el: '#chkimg',
                    data () {
                        return {
                            count: '',
                            status: ''
                        }
                    },
                    mounted() {
                        axios.get('/sales/system/chkimg.api.php?u=<?php echo $cid; ?>')
                            .then(response => {
                                this.count = response.data.count;
                                this.status = response.data.status;
                            })
                    },
                });

                var upload = new Vue({
                    el: '#form',
                    data () {
                        return {
                            file_upload: null,
                            group: '0'
                        }
                    },
                    methods: {
                        onFileChange(e) {
                            this.file_upload = e.target.files[0];
                        },
                        sendData() {
                            var a = this.file_upload;
                            var b = this.group;

                            if ((a == null || a == "" || b == "0" || b == null || b == "")) {
                                swal("ไม่สามารถทำรายการได้", "โปรดเลือกไฟล์เอกสารที่ต้องการทำรายการ", "warning",{ 
                                        button: "ตกลง"
                                    }
                                );
                            } else {
                                var formData = new FormData();
                                formData.append('file_upload', this.file_upload);
                            
                                swal({
                                    title: "กำลังอัพโหลด...",
                                    text: "โปรดรอสักครู่ ระบบกำลังอัพโหลดเอกสารของคุณ",
                                    icon: "info",
                                    buttons: false,
                                    closeOnClickOutside: false,
                                    closeOnEsc: false
                                });

                                axios.post('/sales/system/cfimg.api.php', formData, {
                                    headers: { 
                                        'Content-Type': 'multipart/form-data'
                                    }
                                }).then(res => {
                                    var cfimg_id =  res.data.result.id;
                                    var cfimg_link_500 =  res.data.result.variants[0];
                                    var cfimg_link =  res.data.result.variants[1];

                                    if(res.data.success == true) 
                                        axios.post('/sales/system/upload_img.ins.php',{
                                            aimg_img_id: cfimg_id,
                                            aimg_link:  cfimg_link,
                                            aimg_link_500: cfimg_link_500,
                                            aimg_parent: <?php echo $cid; ?>,
                                            aimg_group: this.group
                                        }).then(res => {
                                            if(res.data.status == 200) 
                                                swal("สำเร็จ", "อัพโหลดเอกสารสำเร็จ", "success",{ 
                                                    button: "ตกลง"
                                                }).then((value) => {
                                                    location.reload(true)
                                                });
                                            if(res.data.status == 400) 
                                                swal("ทำรายการไม่สำเร็จ", "อัพโหลดเอกสารไม่สำเร็จ อาจมีบางอย่างผิดปกติ (error : 400)", "warning",{ 
                                                    button: "ตกลง"
                                                }
                                            );
                                        });

                                    if(res.data.success == false) 
                                        swal("ทำรายการไม่สำเร็จ", "อัพโหลดเอกสารไม่สำเร็จ อาจมีบางอย่างผิดปกติ", "warning",{ 
                                            button: "ตกลง"
                                        }
                                    );
                                });
                            }

                            
                        }
                    }
                });

                var docs = new Vue({
                    el: '#car_img',
                    data () {
                        return {
                            img: []
                        }
                    },
                    mounted () {
                        axios.get('/sales/system/img.api.php?u=<?php echo $cid; ?>')
                          .then(response => (
                              this.img = response.data.img
                          ))
                    },
                    methods: {
                        sendDelete(e){
                            e.preventDefault();
                            swal({
                                title: 'คุณแน่ใจหรือไม่ ?',
                                text: "คุณต้องการลบรูปภาพใช่หรือไม่ โปรดตรวจสอบข้อมูลให้ถูกต้อง",
                                icon: "warning",
                                buttons: {
                                    cancel: "ยกเลิก",
                                    confirm: {
                                        text: "ดำเนินการต่อ",
                                    }
                                },
                                dangerMode: true
                            })
                            .then((willDelete) => {
                                if (willDelete) {
                                    axios.post('/sales/system/img_del.api.php', {
                                        id: e.target.value
                                    }).then(res => {
                                        if(res.data.status == 200)
                                            swal("สำเร็จ", "ลบรูปภาพเรียบร้อย", "success",{ 
                                                button: "ตกลง"
                                            }).then((value) => {
                                                location.reload();
                                            });

                                        if(res.data.status == 505) 
                                            swal("ทำรายการไม่สำเร็จ", "อาจมีบางอย่างผิดปกติ โปรดตรวจสอบเงื่อนไขการสมัครสมาชิกให้ถูกต้อง และครบถ้วน หรือติดต่อเจ้าหน้าที่", "warning",{ 
                                                button: "ตกลง"
                                            }
                                        );
                                    });
                                } else {
                                    swal("Your imaginary file is safe!");
                                }
                            });
                        }
                    }
                });

        </script>

              <script src="/assets/js/theme.js"></script>

    </body>
</html>
<?php } ?>