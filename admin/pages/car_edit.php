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
            .yell-bg {
                background-color: #ffffdc;
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

                            <div class="col-lg-6 col-md-12" id="agent">
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
                                                        <td><input type="email" class="form-control" v-model="license"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>เลขตัวถัง</th>
                                                        <td><input type="email" class="form-control" v-model="vin"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>ห้อ ซีรี่ รุ่น</th>
                                                        <td>{{ brand }} {{ serie }} {{ section }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>รุ่นปี</th>
                                                        <td>{{ car_year }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>สี</th>
                                                        <td><input type="email" class="form-control" v-model="color"></td>
                                                    </tr>
                                                    <tr class="car_select">
                                                        <th>แก้ใขยี่ห้อ ซีรี่ รุ่น</th>
                                                        <td>
                                                            <select class="form-control" v-model="for_change" @change="onChange($event)">
                                                                <option value="0">ใช้รุ่นที่เลือกอยู่ตอนนี้</option>
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
                                                            <select class="form-control"  v-model="transmission">
                                                                <option value="AT">AT อัตโนมัติ</option>
                                                                <option value="MT">MT ธรรมดา</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>ปีจดทะเบียน</th>
                                                        <td><input type="text" class="form-control" v-model="reg_year"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>เลขไมล์</th>
                                                        <td><input type="text" class="form-control" v-model="mileage"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>ราคาที่ยอมรับได้</th>
                                                        <td><input type="text" class="form-control" v-model="price"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>สถานะ Vat</th>
                                                        <td>
                                                            <select class="form-control"  v-model="vat">
                                                                <option value="0">ไม่มี Vat</option>
                                                                <option value="1">มี Vat</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>ราคาตั้งขาย</th>
                                                        <td><input type="text" class="form-control" v-model="trade_price"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>เพิ่มเติม</th>
                                                        <td><textarea class="form-control" v-model="option" rows="3"></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <th>สภาพ</th>
                                                        <td><textarea class="form-control" v-model="condition" rows="3"></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <th>ชื่อเซลล์</th>
                                                        <td><input type="text" class="form-control" v-model="sales"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>ทีมเซลล์</th>
                                                        <td><input type="text" class="form-control" v-model="sales_team"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>เบอร์โทรศัพท์</th>
                                                        <td><input type="text" class="form-control" v-model="tel"></td>
                                                    </tr>


                                                    <tr class="yell-bg">
                                                        <th>ปัจจุบันรถอยู่จังหวัดใด</th>
                                                        <td>
                                                            <select v-model="pv" class="form-control">
                                                                <option value="">= เลือกจังหวัด =</option>
                                                                <option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
                                                                <option value="กระบี่">กระบี่ </option>
                                                                <option value="กาญจนบุรี">กาญจนบุรี </option>
                                                                <option value="กาฬสินธุ์">กาฬสินธุ์ </option>
                                                                <option value="กำแพงเพชร">กำแพงเพชร </option>
                                                                <option value="ขอนแก่น">ขอนแก่น</option>
                                                                <option value="จันทบุรี">จันทบุรี</option>
                                                                <option value="ฉะเชิงเทรา">ฉะเชิงเทรา </option>
                                                                <option value="ชัยนาท">ชัยนาท </option>
                                                                <option value="ชัยภูมิ">ชัยภูมิ </option>
                                                                <option value="ชุมพร">ชุมพร </option>
                                                                <option value="ชลบุรี">ชลบุรี </option>
                                                                <option value="เชียงใหม่">เชียงใหม่ </option>
                                                                <option value="เชียงราย">เชียงราย </option>
                                                                <option value="ตรัง">ตรัง </option>
                                                                <option value="ตราด">ตราด </option>
                                                                <option value="ตาก">ตาก </option>
                                                                <option value="นครนายก">นครนายก </option>
                                                                <option value="นครปฐม">นครปฐม </option>
                                                                <option value="นครพนม">นครพนม </option>
                                                                <option value="นครราชสีมา">นครราชสีมา </option>
                                                                <option value="นครศรีธรรมราช">นครศรีธรรมราช </option>
                                                                <option value="นครสวรรค์">นครสวรรค์ </option>
                                                                <option value="นราธิวาส">นราธิวาส </option>
                                                                <option value="น่าน">น่าน </option>
                                                                <option value="นนทบุรี">นนทบุรี </option>
                                                                <option value="บึงกาฬ">บึงกาฬ</option>
                                                                <option value="บุรีรัมย์">บุรีรัมย์</option>
                                                                <option value="ประจวบคีรีขันธ์">ประจวบคีรีขันธ์ </option>
                                                                <option value="ปทุมธานี">ปทุมธานี </option>
                                                                <option value="ปราจีนบุรี">ปราจีนบุรี </option>
                                                                <option value="ปัตตานี">ปัตตานี </option>
                                                                <option value="พะเยา">พะเยา </option>
                                                                <option value="พระนครศรีอยุธยา">พระนครศรีอยุธยา </option>
                                                                <option value="พังงา">พังงา </option>
                                                                <option value="พิจิตร">พิจิตร </option>
                                                                <option value="พิษณุโลก">พิษณุโลก </option>
                                                                <option value="เพชรบุรี">เพชรบุรี </option>
                                                                <option value="เพชรบูรณ์">เพชรบูรณ์ </option>
                                                                <option value="แพร่">แพร่ </option>
                                                                <option value="พัทลุง">พัทลุง </option>
                                                                <option value="ภูเก็ต">ภูเก็ต </option>
                                                                <option value="มหาสารคาม">มหาสารคาม </option>
                                                                <option value="มุกดาหาร">มุกดาหาร </option>
                                                                <option value="แม่ฮ่องสอน">แม่ฮ่องสอน </option>
                                                                <option value="ยโสธร">ยโสธร </option>
                                                                <option value="ยะลา">ยะลา </option>
                                                                <option value="ร้อยเอ็ด">ร้อยเอ็ด </option>
                                                                <option value="ระนอง">ระนอง </option>
                                                                <option value="ระยอง">ระยอง </option>
                                                                <option value="ราชบุรี">ราชบุรี</option>
                                                                <option value="ลพบุรี">ลพบุรี </option>
                                                                <option value="ลำปาง">ลำปาง </option>
                                                                <option value="ลำพูน">ลำพูน </option>
                                                                <option value="เลย">เลย </option>
                                                                <option value="ศรีสะเกษ">ศรีสะเกษ</option>
                                                                <option value="สกลนคร">สกลนคร</option>
                                                                <option value="สงขลา">สงขลา </option>
                                                                <option value="สมุทรสาคร">สมุทรสาคร </option>
                                                                <option value="สมุทรปราการ">สมุทรปราการ </option>
                                                                <option value="สมุทรสงคราม">สมุทรสงคราม </option>
                                                                <option value="สระแก้ว">สระแก้ว </option>
                                                                <option value="สระบุรี">สระบุรี </option>
                                                                <option value="สิงห์บุรี">สิงห์บุรี </option>
                                                                <option value="สุโขทัย">สุโขทัย </option>
                                                                <option value="สุพรรณบุรี">สุพรรณบุรี </option>
                                                                <option value="สุราษฎร์ธานี">สุราษฎร์ธานี </option>
                                                                <option value="สุรินทร์">สุรินทร์ </option>
                                                                <option value="สตูล">สตูล </option>
                                                                <option value="หนองคาย">หนองคาย </option>
                                                                <option value="หนองบัวลำภู">หนองบัวลำภู </option>
                                                                <option value="อำนาจเจริญ">อำนาจเจริญ </option>
                                                                <option value="อุดรธานี">อุดรธานี </option>
                                                                <option value="อุตรดิตถ์">อุตรดิตถ์ </option>
                                                                <option value="อุทัยธานี">อุทัยธานี </option>
                                                                <option value="อุบลราชธานี">อุบลราชธานี</option>
                                                                <option value="อ่างทอง">อ่างทอง </option>
                                                                <option value="อื่นๆ">อื่นๆ</option>
                                                            </select>
                                                        </td>
                                                    </tr>

                                                    <tr class="yell-bg">
                                                        <th>สถานะไฟแนนซ์</th>
                                                        <td><select v-model="fin" class="form-control">
                                                                <option value="">= โปรดเลือกสถานะไฟแนนซ์ =</option>
                                                                <option value="1">ติดไฟแนนซ์</option>
                                                                <option value="2">ปลอดภาระ / ไม่ติดไฟแนนซ์</option>
                                                            </select>
                                                        </td>
                                                    </tr>

                                                    <tr class="yell-bg">
                                                        <th>ยอดคงเหลือไฟแนนซ์</th>
                                                        <td><input v-model="loan" type="text" class="form-control" maxlength="10"></td>
                                                    </tr>

                                                    <tr class="yell-bg">
                                                        <th>ความพร้อมปล่อยรถ</th>
                                                        <td>
                                                            <select v-model="ready" class="form-control">
                                                                <option value="">= เลือกความพร้อม =</option>
                                                                <option value="1">พร้อมปล่อยรถทันที</option>
                                                                <option value="2">รอจบรถใหม่ก่อน</option>
                                                            </select>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>สถานะการตรวจรถ</th> 
                                                        <td>
                                                            <select class="form-control" v-model="car_check">
                                                                <option value="0">ไม่ได้สัมผัสรถ</option>
                                                                <option v-for="man in manCheck" :value="man.id">{{ man.name }}</option>
                                                            </select>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>สถานะ</th> 
                                                        <td>
                                                            <select class="form-control" v-model="status">
                                                                <option value="1">ติดตามลูกค้า</option>
                                                                <option value="2">ไม่ได้สัมผัสรถ</option>
                                                                <option value="3">ลูกค้าขายเอง / ขายที่อื่น</option>
                                                                <option value="4">สำเร็จ</option>
                                                                <option value="10">ลบ</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>ชื่อลูกค้า</th>
                                                        <td><input type="text" class="form-control" v-model="cust_name"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>เบอร์โทรศัพท์</th>
                                                        <td><input type="text" class="form-control" v-model="cust_tel"></td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                            <div class="form-group mt-3">
                                                <h4 class="mb-2 font-size-18">จัดการข้อมูล</h4>
                                                <button @click="sendData" type="submit" class="btn btn-success waves-effect waves-light mr-1">บันทึก</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6" id="car_img">
                                <div>
                                    <div class="row" v-for="docs in img">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <img :src="docs.link_500" width="100%" class="car_img">
                                                    <a :href="docs.link_500" target="_blank" type="button" class="btn btn-sm btn-primary waves-effect waves-light mt-2" style="margin-top: 10px;">รูปขนาดเต็ม</a>
                                                    <p class="mt-1">อัพโหลดเมื่อ : {{ docs.datetime }}</p>
                                                </div>
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
                            condition: '',
                            vat: '',
                            pv: '',
                            fin: '',
                            loan: '',
                            ready: '',
                            cust_name: '',
                            cust_tel: '',
                            car_check: '',
                            manCheck:[]
                        }
                    },
                    mounted () {
                        axios.get('/admin/system/car_edit.api.php?u=<?php echo $cid; ?>')
                            .then(response => {
                                
                                if(response.data.status == 404) 
                                    swal("เกิดข้อผิดพลาดบางอย่าง", "อาจมีบางอย่างผิดปกติ (error : 404)", "warning",{ 
                                        button: "ตกลง"
                                    }).then((value) => {
                                        window.location.href = "/admin/home";
                                    });

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
                                this.select = response.data.brand;
                                this.tel = response.data.car.tel;
                                this.sales_team = response.data.car.sale_team;
                                this.vat = response.data.car.vat;
                                this.pv = response.data.car.pv;
                                this.fin = response.data.car.fin;
                                this.loan = response.data.car.loan;
                                this.ready = response.data.car.ready;
                                this.cust_name = response.data.car.cust_name;
                                this.cust_tel = response.data.car.cust_tel;
                                this.car_check = response.data.car.car_check;

                                this.manCheck = response.data.manCheck;
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
                            axios.post('/admin/system/car_detail.edt.php', {
                                id: this.id,
                                license: this.license,
                                brand: this.brand,
                                serie: this.serie,
                                section: this.section,
                                transmission: this.transmission,
                                color: this.color,
                                price: this.price,
                                trade_price: this.trade_price,
                                sales: this.sales,
                                status: this.status,
                                car_year: this.car_year,
                                reg_year: this.reg_year,
                                transmission: this.transmission,
                                option: this.option,
                                vin: this.vin,
                                mileage: this.mileage,
                                for_change: this.for_change,
                                for_section: this.for_section,
                                condition: this.condition,
                                tel: this.tel,
                                sales_team: this.sales_team,
                                vat: this.vat,
                                pv: this.pv,
                                fin: this.fin,
                                loan: this.loan,
                                ready: this.ready,
                                cust_name: this.cust_name,
                                cust_tel: this.cust_tel,
                                car_check: this.car_check
                                
                            }).then(res => {
                                console.log(res);
                                if(res.data.status == 200) 
                                    swal("สำเร็จ", "เพิ่มสมาชิกเรียบร้อย", "success",{ 
                                        button: "ตกลง"
                                    }).then((value) => {
                                        window.location.href = "/admin/detail/"+this.id
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
                    }
                });
                
        </script>

              <!-- App js -->
              <script src="/assets/js/theme.js"></script>

    </body>
</html>

<?php } ?>