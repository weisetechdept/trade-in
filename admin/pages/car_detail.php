<?php
    session_start();
    if($_SESSION['tin_admin'] != true){
        header("location: /404");
        exit();
    }
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
                                                        <th width="155px">รหัส ID</th>
                                                        <td>{{ id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>เลขทะเบียน</th>
                                                        <td>{{ license }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>เลขตัวถัง</th>
                                                        <td>{{ vin }}</td>
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
                                                        <th>ปีจดทะเบียน</th>
                                                        <td>{{ reg_year }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>ราคา</th>
                                                        <td>{{ price }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>สถานะ Vat</th>
                                                        <td v-if="vat == '1'">มี Vat</td>
                                                        <td v-if="vat == '0'">ไม่มี Vat</td>
                                                    </tr>
                                                    <tr>
                                                        <th>ราคาตั้งขาย</th>
                                                        <td>{{ trade_price }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>ราคากลาง (TLT)</th>
                                                        <td>{{ tlt_price }}</td>
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
                                                        <th>เซลผู้ดูแล</th>
                                                        <td>{{ sales }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>เบอร์โทรศัพท์</th>
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
                                                <a :href="'/admin/edit/'+id" type="submit" class="btn btn-outline-warning waves-effect waves-light mr-1">แก้ใข</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-2 font-size-18">คำนวณยอดผ่อน</h4>
                                        
                                        <div class="row">
                                            <div class="col-md-6 col-xl-6">
                                                <div class="card bg-success border-success">
                                                    <div class="card-body">
                                                        <div class="mb-2">
                                                            <h5 class="card-title mb-0 text-white">ผ่อน / เดือน (รวม VAT)</h5>
                                                        </div>
                                                        <div class="row d-flex align-items-center mb-2">
                                                            <div class="col-8">
                                                                <h2 class="d-flex align-items-center text-white mb-0">
                                                                    {{ formatPrice((((this.loan + (((this.loan * this.interestrate)/100) * this.period)) * 1.07) / (this.period * 12)).toFixed(2)) }}
                                                                </h2>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-6">
                                                <div class="card bg-secondary border-secondary">
                                                    <div class="card-body">
                                                        <div class="mb-2">
                                                            <h5 class="card-title mb-0 text-white">ผ่อน / เดือน (ไม่รวม VAT)</h5>
                                                        </div>
                                                        <div class="row d-flex align-items-center mb-2">
                                                            <div class="col-8">
                                                                <h2 class="d-flex align-items-center text-white mb-0">
                                                                    {{ formatPrice(((this.loan + (((this.loan * this.interestrate)/100) * this.period)) / (this.period * 12)).toFixed(2)) }}
                                                                </h2>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-xl-6">
                                                <div class="card bg-primary border-primary">
                                                    <div class="card-body">
                                                        <div class="mb-2">
                                                            <h5 class="card-title mb-0 text-white">ระยะเวลาผ่อน</h5>
                                                        </div>
                                                        <div class="row d-flex align-items-center mb-2">
                                                            <div class="col-8">
                                                                <h2 class="d-flex align-items-center text-white mb-0">
                                                                    {{ period * 12 }}
                                                                </h2>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-6">
                                                <div class="card bg-warning border-warning">
                                                    <div class="card-body">
                                                        <div class="mb-2">
                                                            <h5 class="card-title mb-0 text-white">เงินดาวน์</h5>
                                                        </div>
                                                        <div class="row d-flex align-items-center mb-2">
                                                            <div class="col-8">
                                                                <h2 class="d-flex align-items-center text-white mb-0">
                                                                    {{ formatPrice(downpayment.toFixed(2)) }}
                                                                </h2>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <table class="table mb-0">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">เรทการกู้</th>
                                                    <td><select class="form-control" v-model="loanrate" @change="calDownpayment($event)" :value="loanrate">
                                                        <option value="100">100%</option>
                                                        <option value="95">95%</option>
                                                        <option value="90">90%</option>
                                                        <option value="85">85%</option>
                                                        <option value="80">80%</option>
                                                        <option value="75">75%</option>
                                                        <option value="70">70%</option>
                                                        <option value="65">65%</option>
                                                        <option value="60">60%</option>
                                                        <option value="55">55%</option>
                                                        <option value="50">50%</option>
                                                    </select></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">ดอกเบี้ย</th>
                                                    <td><input class="form-control" v-model="interestrate" :value="interestrate"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">ระยะเวลาผ่อน </th>
                                                    <td>
                                                        <select class="form-control" v-model="period" :value="period">
                                                            <option value="3">36</option>
                                                            <option value="4">48</option>
                                                            <option value="5">60</option>
                                                            <option value="6">72</option>
                                                            <option value="7">84</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <br />
                                    <p>
                                        <button class="btn btn-outline-info ml-1" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                            รายละเอียดการคำนวณ
                                        </button>
                                    </p>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        ราคาขาย : {{ price }} บาท<br />
                                        ราคากลาง (TLT) : {{ tlt_price }} บาท<br />
                                        เรทการกู้ : {{ loanrate }} %<br />
                                        ดาวน์ : {{ formatPrice(downpayment.toFixed(2)) }} บาท<br />
                                        ยอดจัด : {{ formatPrice(loan.toFixed(2)) }} บาท<br />
                                        ดอกเบี้ย : {{ interestrate }} %<br />
                                        ดอกเบี้ยต่อปี : {{ formatPrice(((loan * interestrate)/100).toFixed(2)) }} บาท<br />
                                        ระยะเวลาผ่อน : {{ period }} ปี ({{ period * 12 }} เดือน)<br />
                                        ดอกเบี้ยตลอดอายุสัญญา : {{ formatPrice((((loan * interestrate)/100) * period).toFixed(2)) }} บาท<br />
                                        ยอดสินเชื่อรวมดอกเบี้ย : {{ formatPrice((loan + (((loan * interestrate)/100) * period)).toFixed(2)) }} บาท<br />
                                        ราคาภาษีมูลค่าเพิ่ม (VAT) : {{ formatPrice(((loan + (((loan * interestrate)/100) * period)) * 0.07).toFixed(2)) }} บาท<br />
                                        ยอดรวมสินเชื่อหลัง VAT : {{ formatPrice(((loan + (((loan * interestrate)/100) * period)) * 1.07).toFixed(2)) }} บาท<br />
                                        ยอดผ่อนต่อเดือน : {{ formatPrice((((this.loan + (((this.loan * this.interestrate)/100) * this.period)) * 1.07) / (this.period * 12)).toFixed(2)) }} บาท<br />
                                    </div>
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
                                        <h4 class="mb-2 font-size-18">อัพโหลดรูปหน้าปก</h4>
                                        <div id="form">
                                          <form @submit.prevent="sendData">
                                                <div class="form-group">
                                                    <select class="form-control" v-model="group" id="exampleFormControlSelect1">
                                                        <option value="0">เลือกประเภทรูป</option>
                                                        <option value="1">รูปหน้าปก</option>
                                                        <option value="2">รูปอื่นๆ</option>
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

                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-2 font-size-18">อัพโหลดรูปรถยนต์</h4>
                                        <div class="form-group">
                                            <input type="file" class="filepond">
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

        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>


        <script>
                FilePond.parse(document.body);
                FilePond.setOptions({
                    server: {
                        process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                            // fieldName is the name of the input field
                            // file is the actual file object to send
                            const formData = new FormData();
                            formData.append(fieldName, file, file.name);

                            const request = new XMLHttpRequest();
                            request.open('POST', '/admin/system/multi_upload.php');

                            // Should call the progress method to update the progress to 100% before calling load
                            // Setting computable to false switches the loading indicator to infinite mode
                            request.upload.onprogress = (e) => {
                                progress(e.lengthComputable, e.loaded, e.total);
                                axios.post('/admin/system/multi_upload.php', formData, {
                                    headers: { 
                                        'Content-Type': 'multipart/form-data'
                                    }
                                }).then(res => {
                                    console.log(res.data);
                                });
                            };

                            // Should call the load method when done and pass the returned server file id
                            // this server file id is then used later on when reverting or restoring a file
                            // so your server knows which file to return without exposing that info to the client
                            request.onload = function () {
                                if (request.status >= 200 && request.status < 300) {
                                    // the load method accepts either a string (id) or an object
                                    load(request.responseText);
                                } else {
                                    // Can call the error method if something is wrong, should exit after
                                    error('oh no');
                                }
                            };

                            request.send(formData);

                            // Should expose an abort method so the request can be cancelled
                            return {
                                abort: () => {
                                    // This function is entered if the user has tapped the cancel button
                                    request.abort();

                                    // Let FilePond know the request has been cancelled
                                    abort();
                                },
                            };
                        },
                    },
                });
                


                
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

                        }
                    },
                    mounted () {
                        axios.get('/admin/system/car_detail.api.php?u=<?php echo $cid; ?>')
                            .then(response => {
                                console.log(response.data);
                                if(response.data.status == 404) 
                                    swal("เกิดข้อผิดพลาดบางอย่าง", "อาจมีบางอย่างผิดปกติ (error : 404)", "warning",{ 
                                        button: "ตกลง"
                                    }).then((value) => {
                                        window.location.href = "/admin/home";
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

                                axios.post('/admin/system/cfimg.api.php', formData, {
                                    headers: { 
                                        'Content-Type': 'multipart/form-data'
                                    }
                                }).then(res => {
                                    var cfimg_id =  res.data.result.id;
                                    var cfimg_link_500 =  res.data.result.variants[0];
                                    var cfimg_link =  res.data.result.variants[1];

                                    if(res.data.success == true) 
                                        axios.post('/admin/system/upload_img.ins.php',{
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
                            img: null
                        }
                    },
                    mounted () {
                        axios.get('/admin/system/img.api.php?u=<?php echo $cid; ?>')
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
                                    axios.post('/admin/system/img_del.api.php', {
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


       $(document).ready(function () {
            // First register any plugins
            FilePond.registerPlugin( FilePondPluginImagePreview,FilePondPluginImageTransform);

            const inputElement = document.querySelector('input[class="my-pond"]');
            
            // Create the FilePond instance
            FilePond.create(inputElement, {
                allowMultiple: true,
                allowImageResize: true,
                imageResizeTargetWidth: 1024,
                imageResizeTargetHeight: 1024,
                imageTransformOutputQuality: 70
            });
            
            FilePond.setOptions({
                server: {
                    url: "/Checking/ProcessUpload",
                    process: (fieldName, file, metadata, load, error, progress, abort) => {
                        const formData = new FormData();
                        formData.append(fieldName, file, file.name);
                        formData.append("DelegateId", "8476");

                        const request = new XMLHttpRequest();
                        request.open('POST', "/Checking/ProcessUpload");
                        // Setting computable to false switches the loading indicator to infinite mode
                        request.upload.onprogress = (e) => {
                            progress(e.lengthComputable, e.loaded, e.total);
                        };

                        request.onload = function() {
                            if (request.status >= 200 && request.status < 300) {
                                load(request.responseText); // the load method accepts either a string (id) or an object
                            } else {
                                error('Error during Upload!');
                            }
                        };

                        request.send(formData);
                        //expose an abort method so the request can be cancelled
                        return {
                            abort: () => {
                                // This function is entered if the user has tapped the cancel button
                                request.abort();
                                // Let FilePond know the request has been cancelled
                                abort();
                            }
                        };
                    }, // we've not implemented these endpoints yet, so leave them null!
                    fetch: null,
                    remove: null,
                }
            });
        });
        </script>

              <!-- App js -->
              <script src="/assets/js/theme.js"></script>

    </body>
</html>