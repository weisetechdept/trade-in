<?php
    session_start();
    header('Access-Control-Allow-Origin: *');
    
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
            .file-upload {
                border: 0;
                padding: 0;
            }
            .warning-android {
                padding: 10px;
                margin-bottom: 20px;
                border: dashed 1px red;
            }
            .warning-android h5 {
                color: red;
                font-weight: 400;
            }
            #multiAndroid {
                display: none;
            }
            .gray_bg {
                background-color: #f1f1f1;
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
                                                        <tr class="gray_bg">
                                                            <th>รถอยู่จังหวัด</th>
                                                            <td>{{ pv }}</td>
                                                        </tr>
                                                        <tr class="gray_bg">
                                                            <th>สถานะไฟแนนซ์</th>
                                                            <td>{{ fin }}</td>
                                                        </tr>
                                                        <tr class="gray_bg">
                                                            <th>ความพร้อมปล่อยรถ</th>
                                                            <td>{{ ready }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>สถานะ</th>
                                                            <td v-if="status == '0'"><span class="badge badge-soft-success">ไม่มีสถานะ.</span></td>
                                                            <td v-if="status == '1'"><span class="badge badge-soft-success">ติดตามลูกค้า</span></td>
                                                            <td v-if="status == '2'"><span class="badge badge-soft-success">ไม่ได้สัมผัสรถ</span></td>
                                                            <td v-if="status == '3'"><span class="badge badge-soft-success">ลูกค้าขายเอง / ขายที่อื่น</span></td>
                                                            <td v-if="status == '4'"><span class="badge badge-soft-success">สำเร็จ</span></td>
                                                            <td v-if="status == '10'"><span class="badge badge-soft-danger">ลบ</span></td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                                <div class="form-group mt-3">
                                                    <h4 class="mb-2 font-size-18">จัดการข้อมูล</h4>
                                                    <a :href="'/sales/edit/'+id" type="submit" class="btn btn-outline-warning waves-effect waves-light mr-2">แก้ใข</a> <button type="button" class="btn btn-success waves-effect waves-light" @click="sendNotify">ส่งข้อมูลให้ทีมพ่อสื่อ</button>
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

                            <div class="row" id="btnAndroid">
                                <div class="col-lg-6 col-md-12">
                                    <div class="warning-android">
                                        <h5>สำหรับ Android ที่อัพโหลดรูปไม่ได้ ให้ใช้งานระบบสำหรับ Android (โดยคลิกปุ่มด้านล่าง)</h5>
                                        <button type="button" @click="androidUpload" class="btn btn-danger waves-effect btn-block">ระบบกำลังอัพโหลดสำหรับ Android</button>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                    

                    <div class="row" id="multiUpload">
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mb-2 font-size-18">อัพโหลดรูป (อัพได้ครั้งละหลายรูป)</h4>

                                        <p class="red">สามารถอัพโหลดรูปได้ครั้งละไม่เกิน 5 รูป</p>

                                        <div class="form-group">
                                            <select class="form-control" v-model="group" id="exampleFormControlSelect1">
                                                <option value="0">= เลือกประเภทรูป =</option>
                                                <option value="10">รูปภายนอกรถยนต์ (Code: 10)</option>
                                                <option value="20">รูปภายในรถยนต์ (Code: 20)</option>
                                                <option value="30">รูปเอกสารรถยนต์ (Code: 30)</option>
                                                <option value="40">รูปห้องเครื่อง ช่วงล่าง ใต้ท้องรถ (Code: 40)</option>
                                                <option value="50">รูปตำหนิรถยนต์แต่ละจุด (Code: 50)</option>
                                            </select>
                                        </div>
                                    
                                        <div class="row">
                                            <div class="col form-group mt-2">
                                                <input type="file" class="form-control file-upload" id="uploadfiles" ref="uploadfiles" accept="image/*"  multiple />
                                            </div>
                                        </div>

                                        <div class="form-group mb-0">
                                            <button type="button" @click='uploadFile()' class="btn btn-primary waves-effect waves-light mb-2">อัพโหลด</button>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="multiAndroid">
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mb-3 font-size-18">อัพโหลดรูปสำหรับ Android</h4>

                                        <div class="form-group">
                                            <select class="form-control" v-model="group" id="exampleFormControlSelect1">
                                                <option value="0">= เลือกประเภทรูป =</option>
                                                <option value="10">รูปภายนอกรถยนต์ (Code: 10)</option>
                                                <option value="20">รูปภายในรถยนต์ (Code: 20)</option>
                                                <option value="30">รูปเอกสารรถยนต์ (Code: 30)</option>
                                                <option value="40">รูปห้องเครื่อง ช่วงล่าง ใต้ท้องรถ (Code: 40)</option>
                                                <option value="50">รูปตำหนิรถยนต์แต่ละจุด (Code: 50)</option>
                                            </select>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col form-group">
                                                <p class="red">สามารถอัพโหลดรูปอย่างน้อย 1 รูป และไม่เกิน 5 รูปต่อครั้ง</p>
                                                <div class="mb-4">
                                                    <p class="mb-2">รูปที่ 1</p>
                                                    <input type="file" class="form-control file-upload" id="uploadAndroid1" ref="uploadAndroid1">
                                                </div>

                                                <div class="mb-4">
                                                    <p class="mb-2">รูปที่ 2</p>
                                                    <input type="file" class="form-control file-upload" id="uploadAndroid2" ref="uploadAndroid2">
                                                </div>

                                                <div class="mb-4">
                                                    <p class="mb-2">รูปที่ 3</p>
                                                    <input type="file" class="form-control file-upload" id="uploadAndroid3" ref="uploadAndroid3">
                                                </div>
                                                
                                                <div class="mb-4">
                                                    <p class="mb-2">รูปที่ 4</p>
                                                    <input type="file" class="form-control file-upload" id="uploadAndroid4" ref="uploadAndroid4">
                                                </div>

                                                <div class="mb-4">
                                                    <p class="mb-2">รูปที่ 5</p>
                                                    <input type="file" class="form-control file-upload" id="uploadAndroid5" ref="uploadAndroid5">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="button" @click='uploadFile()' class="btn btn-block btn-primary waves-effect waves-light mb-2">อัพโหลด</button>
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
    
        <div class="menu-overlay"></div>

        <script src="/assets/js/jquery.min.js"></script>
        <script src="/assets/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/js/metismenu.min.js"></script>
        <script src="/assets/js/waves.js"></script>
        <script src="/assets/js/simplebar.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.1/axios.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

        <script>
            
                var uploadAndroid = new Vue({
                    el: '#multiAndroid',
                    data () {
                        return {
                            file: "",
                            filenames: [],
                            id: '<?php echo $cid; ?>',
                            group: '0'
                        }
                    },
                    methods: {

                        uploadFile() {
                            var f = this.$refs.uploadAndroid1.files.length + this.$refs.uploadAndroid2.files.length + this.$refs.uploadAndroid3.files.length + this.$refs.uploadAndroid4.files.length + this.$refs.uploadAndroid5.files.length;
                            if(f <= 0){
                                swal("เกิดข้อผิดพลาดบางอย่าง", "กรุณาเลือกรูปเพื่ออัพโหลด", "warning",{ 
                                    button: "ตกลง"
                                });
                                return;
                            } else if(this.group == 0) {
                                swal("เกิดข้อผิดพลาดบางอย่าง", "กรุณาเลือกประเภทของรูป", "warning",{ 
                                    button: "ตกลง"
                                });
                            } else {

                                var el = this;
                                var formData = new FormData();
                                var files = [this.$refs.uploadAndroid1.files[0], this.$refs.uploadAndroid2.files[0], this.$refs.uploadAndroid3.files[0], this.$refs.uploadAndroid4.files[0], this.$refs.uploadAndroid5.files[0]];
                                var totalfiles = files.length;
                                for (var index = 0; index < totalfiles; index++) {
                                    formData.append("files[]", files[index]);
                                }
                                formData.append('id', '<?php echo $cid; ?>');
                                formData.append('group', this.group);

                                axios.post('/sales/system/multi_upload.api.php', formData,
                                {
                                    headers: {
                                        'Content-Type': 'multipart/form-data'
                                    },
                                    onUploadProgress: function(progressEvent) {
                                        var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                                        swal({
                                            title: 'กำลังอัพโหลด',
                                            text: 'กรุณารอสักครู่...',
                                            buttons: false,
                                            closeOnClickOutside: false,
                                            closeOnEsc: false,
                                            icon: '/assets/images/Spin.gif'
                                        });
                                    }
                                })
                                .then(function (response) {
                                    
                                    swal.close();
                                    if(response.data.status == 200) 
                                        swal("สำเร็จ", "อัพโหลดรูปสำเร็จ", "success",{ 
                                            button: "ตกลง"
                                        }).then((value) => {
                                            location.reload(true)
                                        });
                                })

                            }
                            
                        }
            
                    }
                });

                var uploadMul = new Vue({
                    el: '#multiUpload',
                    data () {
                        return {
                            file: "",
                            filenames: [],
                            id: '<?php echo $cid; ?>',
                            group: '0'
                        }
                    },
                    methods: {
                        uploadFile: function(){
                            if(this.$refs.uploadfiles.files.length <= 0 || this.group == 0){
                                swal("เกิดข้อผิดพลาดบางอย่าง", "กรุณาเลือกไฟล์ที่ต้องการอัพโหลด และประเภทของรูป", "warning",{ 
                                    button: "ตกลง"
                                });
                                return;
                            } else if (this.$refs.uploadfiles.files.length > 5) {
                                swal("เกิดข้อผิดพลาดบางอย่าง", "คุณสามารถอัพโหลดไฟล์ได้ไม่เกิน 5 ไฟล์", "warning",{ 
                                    button: "ตกลง"
                                });
                                return;
                            } else {
                                swal({
                                    title: 'คุณแน่ใจหรือไม่ ?',
                                    text: "คุณต้องการอัพโหลดไฟล์ที่เลือกหรือไม่ ?",
                                    icon: "info",
                                    buttons: true,
                                    dangerMode: true,
                                }).then((willDelete) => {
                                    if (willDelete) {

                                        var el = this;
                                        let formData = new FormData();
                                        var files = this.$refs.uploadfiles.files;
                                        var totalfiles = this.$refs.uploadfiles.files.length;
                                        for (var index = 0; index < totalfiles; index++) {
                                            formData.append("files[]", files[index]);
                                        }
                                        formData.append('id', this.id);
                                        formData.append('group', this.group);

                                        axios.post('/sales/system/multi_upload.api.php', formData,
                                        {
                                            headers: {
                                                'Content-Type': 'multipart/form-data'
                                            },
                                            onUploadProgress: function(progressEvent) {
                                                var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                                                swal({
                                                    title: 'กำลังอัพโหลด',
                                                    text: 'กรุณารอสักครู่...',
                                                    buttons: false,
                                                    closeOnClickOutside: false,
                                                    closeOnEsc: false,
                                                    icon: '/assets/images/Spin.gif'
                                                });
                                            }
                                        })
                                        .then(function (response) {
                                            console.log(response);
                                            swal.close();
                                            if(response.data.status == 200) 
                                                swal("สำเร็จ", "อัพโหลดรูปสำเร็จ", "success",{ 
                                                    button: "ตกลง"
                                                }).then((value) => {
                                                    location.reload(true)
                                                });
                                        })
                                        .then(function (response) {
                                            console.log(response);
                                            swal.close();
                                            if(response.data.status == 200) 
                                                swal("สำเร็จ", "อัพโหลดรูปสำเร็จ", "success",{ 
                                                    button: "ตกลง"
                                                }).then((value) => {
                                                    location.reload(true)
                                                });
                                        })

                                    } 
                                });
                            }
                        }
                            
                    }
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
                            sellername: '',
                            pv: '',
                            fin: '',
                            ready: '',
                            offer: [],

                        }
                    },
                    mounted () {
                        axios.get('/sales/system/car_detail.api.php?u=<?php echo $cid; ?>')
                            .then(response => {
                                console.log(response.data);
                                if(response.data.status == 404) 
                                    swal("เกิดข้อผิดพลาดบางอย่าง", "อาจมีบางอย่างผิดปกติ (error : 404)", "warning",{ 
                                        button: "ตกลง"
                                    }).then((value) => {
                                        window.location.href = "/sales/home";
                                    });
                                this.offer = response.data.offer;
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
                                this.pv = response.data.car.pv;
                                this.fin = response.data.car.fin;
                                this.ready = response.data.car.ready;

                            }),
                            this.calDownpayment();
                    },
                    methods: {
                        androidUpload(){
                            $('#multiAndroid').show();
                            $('#multiUpload').hide();
                            $('#btnAndroid').hide();
                        },
                        sendNotify() {
                            
                            swal({
                                title: 'คุณแน่ใจหรือไม่ ?',
                                text: "คุณต้องการส่งข้อมูลให้ทีมพ่อสื่อใช่หรือไม่ โปรดตรวจสอบข้อมูลให้ถูกต้อง",
                                icon: "warning",
                                buttons: {
                                    cancel: "ยกเลิก",
                                    confirm: {
                                        text: "ดำเนินการต่อ",
                                    }
                                },
                                dangerMode: true
                            }).then((willDelete) => {
                                if (willDelete) {
                                    axios.post('/sales/system/sendNotify.api.php',{
                                        id: this.id,
                                    }).then(res => {
                                        if(res.data.status == 200) 
                                            swal("สำเร็จ", "ส่งข้อมูลให้ทีมพ่อสื่อสำเร็จ", "success",{ 
                                                button: "ตกลง"
                                            }).then((value) => {
                                                location.reload(true)
                                            });
                                        if(res.data.status == 400) 
                                            swal("ทำรายการไม่สำเร็จ", "ส่งข้อมูลให้ทีมพ่อสื่อไม่สำเร็จ อาจมีบางอย่างผิดปกติ (error : 400)", "warning",{ 
                                                button: "ตกลง"
                                            }
                                        );
                                    });
                                }
                            });
                            
                        },
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

