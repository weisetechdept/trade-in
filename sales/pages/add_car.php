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
            .hd-f {
                display: none;
                background-color: #f0f0f0;
            }
            .hd-fc {
                display: none;
                background-color: #f0f0f0;
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
                                                        <th width="150px">ประเภทรถ</th>
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <div class="form-check form-check-inline mb-2">
                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" @click="onTypeCar" id="inlineRadio1" value="1">
                                                                    <label class="form-check-label">เก๋ง <small>(SEDAN,HB,SUV,MPV,PPV)</small></label>
                                                                </div><br />
                                                                <div class="form-check form-check-inline mb-2">
                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" @click="onTypeCar" id="inlineRadio2" value="2">
                                                                    <label class="form-check-label">กระบะ <small>(Truck)</small></label>
                                                                </div><br />
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" @click="onTypeCar" id="inlineRadio2" value="3">
                                                                    <label class="form-check-label">รถตู้ หรืออื่นๆ</label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr class="hd-f">
                                                        <th>ห้องโดยสาร</th>
                                                        <td>
                                                            <select class="form-control" v-model="send.passengerType">
                                                                <option value="0">= โปรดเลือกห้องโดยสาร =</option>
                                                                <option value="1">มีแค็ป / C-Cab</option>
                                                                <option value="2">ไม่มีแค็ป / B-Cab</option>
                                                                <option value="3">4 ประตู / D-Cab</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr class="hd-f">
                                                        <th>ระบบช่วงล่าง</th>
                                                        <td>
                                                            <select class="form-control" v-model="send.suspension">
                                                                <option value="0">= โปรดเลือกระบบช่วงล่าง =</option>
                                                                <option value="1">ตัวเตี้ย</option>
                                                                <option value="2">ยกสูง</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr class="hd-f">
                                                        <th>ระบบขับเคลื่อน</th>
                                                        <td>
                                                            <select class="form-control" v-model="send.drive">
                                                                <option value="0">= โปรดเลือกระบบขับเคลื่อน =</option>
                                                                <option value="1">ขับเคลื่อน 2 ล้อ</option>
                                                                <option value="2">ระบบขับเคลื่อน 4 ล้อ</option>
                                                            </select>
                                                        </td>
                                                    </tr>


                                                    <tr>
                                                        <th>เบาะโดยสาร</th>
                                                        <td>
                                                            <select class="form-control" v-model="send.seat">
                                                                <option value="0">= โปรดเลือกจำนวนเบาะโดยสาร =</option>
                                                                <option value="1">1 แถว</option>
                                                                <option value="2">2 แถว</option>
                                                                <option value="3">3 แถว</option>
                                                                <option value="4">มากกว่า 3 แถว</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>ประตู</th>
                                                        <td>
                                                            <select class="form-control" v-model="send.door">
                                                                <option value="0">= โปรดเลือกจำนวนประตู =</option>
                                                                <option value="2">2 ประตู</option>
                                                                <option value="3">3 ประตู</option>
                                                                <option value="4">4 ประตู</option>
                                                                <option value="5">5 ประตู</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>เกียร์</th>
                                                        <td>
                                                            <select class="form-control" v-model="send.transmission">
                                                                <option value="0">= โปรดเลือกเกียร์ =</option>
                                                                <option value="AT">เกียร์อัตโนมัติ</option>
                                                                <option value="MT">เกียร์ธรรมดา</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>เชื้อเพลิง<br /><small>(เลือกได้มากกว่า 1)</small></th>
                                                        <td>
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="checkbox" @click="fuelType" value="1">
                                                                <label class="form-check-label">
                                                                    เบนซิน
                                                                </label>
                                                            </div>

                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="checkbox" @click="fuelType" value="2">
                                                                <label class="form-check-label">
                                                                    ดีเซล
                                                                </label>
                                                            </div>

                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="checkbox" @click="fuelType" value="3">
                                                                <label class="form-check-label">
                                                                    LPG
                                                                </label>
                                                            </div>

                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="checkbox" @click="fuelType" value="4">
                                                                <label class="form-check-label">
                                                                    NGV
                                                                </label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" @click="fuelType" value="5">
                                                                <label class="form-check-label">
                                                                    EV (ไฟฟ้า)
                                                                </label>
                                                            </div>
                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>ขนาดเครื่องยนต์ (CC.)</th>
                                                        <td><input type="number" class="form-control" id="numbers-only" maxlength="4" v-model="send.engine"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>ปีผลิตรถยนต์ (ค.ศ.)</th>
                                                        <td><input type="number" class="form-control" id="numbers-only" maxlength="4" v-model="send.year"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>ราคาที่ยอมรับได้</th>
                                                        <td><input type="number" class="form-control" id="numbers-only" v-model="send.price"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>ชื่อ ผู้ขาย</th>
                                                        <td><input type="text" class="form-control" v-model="send.seller_name"></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <th>เบอร์โทร ผู้ขาย</th>
                                                        <td><input type="number" class="form-control" id="numbers-only" maxlength="10" v-model="send.tel"></td>
                                                    </tr>

                                                    <tr>
                                                        <th>ปัจจุบันรถอยู่จังหวัดใด<br /><small>(เพื่อให้พันธมิตรเข้าไปดูรถจริง)</small></th>
                                                        <td><select v-model="send.pv" class="form-control">
                                                                <option value="0">= เลือกจังหวัด =</option>
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

                                                    <tr>
                                                        <th>สถานะไฟแนนซ์</th>
                                                        <td>
                                                            <select @change="onFinance" v-model="send.fin" class="form-control">
                                                                <option value="0">= โปรดเลือกสถานะไฟแนนซ์ =</option>
                                                                <option value="1">ติดไฟแนนซ์</option>
                                                                <option value="2">ปลอดภาระ / ไม่ติดไฟแนนซ์</option>
                                                            </select>
                                                        </td>
                                                    </tr>

                                                    <tr class="hd-fc">
                                                        <th>ยอดคงเหลือ</th>
                                                        <td><input type="text" class="form-control"  v-model="send.loan" maxlength="10"></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <th>ความพร้อมปล่อยรถ</th>
                                                        <td>
                                                            <select class="form-control"  v-model="send.ready">
                                                                <option value="0">= เลือกความพร้อม =</option>
                                                                <option value="1">พร้อมปล่อยรถทันที</option>
                                                                <option value="2">รอจบรถใหม่ก่อน</option>
                                                            </select>
                                                        </td>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


        <script>
            
                var agent_detail = new Vue({
                    el: '#agent',
                    data () {
                        return {
                            send:{
                                type: '0',
                                seat: '0',
                                door: '0',
                                transmission: '0',
                                fuel: [],
                                engine: '',
                                price: '',
                                seller_name: '',
                                tel: '',
                                /* if truck */
                                passengerType: '0',
                                suspension: '0',
                                drive: '0',
                                year: '',
                                pv: '',
                                fin: '',
                                loan: '',
                                ready: ''
                            },
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
                                this.user.id = response.data.user.id;
                        })

                        const inputField = document.querySelector('#numbers-only');
                        inputField.onkeydown = (event) => {
                            // Only allow if the e.key value is a number or if it's 'Backspace'
                            if(isNaN(event.key) && event.key !== 'Backspace') {
                                event.preventDefault();
                            }
                        };
                    },
                    methods: {
                        onFinance(e){
                            if(e.target.value == '1'){
                                $(".hd-fc").css("display", "revert");
                            } else if(e.target.value == '2') {
                                $(".hd-fc").css("display", "none");
                            }
                        },
                        onTypeCar(e){
                            if(e.target.value == '2'){
                                $(".hd-f").css("display", "revert");
                            } else if(e.target.value == '1' || e.target.value == '3') {
                                $(".hd-f").css("display", "none");
                            }

                            if(e.target.value == '1'){
                                this.send.type = '1';
                            } else if(e.target.value == '2') {
                                this.send.type = '2';
                            } else if(e.target.value == '3') {
                                this.send.type = '3';
                            }
                        },
                        fuelType(e){
                            if (e.target.checked) {
                                this.send.fuel.push(e.target.value);
                            } else {
                                const index = this.send.fuel.indexOf(e.target.value);
                                if (index > -1) {
                                    this.send.fuel.splice(index, 1);
                                }
                            }
                        },




                        sendData() {
                            if(this.send.type == '0' || this.send.seat == '0' || this.send.door == '0' || this.send.tranmission == '0' || this.send.fuel.length == 0 || this.send.engine == '' || this.send.price == '' || this.send.seller_name == '' || this.send.tel == ''){
                                swal("กรุณากรอกข้อมูลให้ครบถ้วน", "โปรดตรวจสอบข้อมูลให้ครบถ้วน", "warning",{ 
                                    button: "ตกลง"
                                });
                            } else if(this.send.type == '2' && (this.send.passengerType == '0' || this.send.suspension == '0' || this.send.drive == '0')) {
                                swal("กรุณากรอกข้อมูลให้ครบถ้วน", "โปรดตรวจสอบข้อมูลให้ครบถ้วน", "warning",{ 
                                    button: "ตกลง"
                                });
                            } else if(this.send.fin == '1' && this.send.loan == ''){
                                swal("กรุณากรอกข้อมูลให้ครบถ้วน", "ใส่จำนวนยอดคงเหลือไฟแนนซ์", "warning",{ 
                                    button: "ตกลง"
                                })
                            } else {
                                if (this.isSubmitting) return; // Prevent double submission
                                this.isSubmitting = true;

                                axios.post('/sales/system/new_car_up.inc.php', {
                                    id: this.user.id,
                                    type: this.send.type,
                                    seat: this.send.seat,
                                    door: this.send.door,
                                    transmission: this.send.transmission,
                                    fuel: this.send.fuel,
                                    engine: this.send.engine,
                                    price: this.send.price,
                                    seller_name: this.send.seller_name,
                                    tel: this.send.tel,
                                    passengerType: this.send.passengerType,
                                    suspension: this.send.suspension,
                                    drive: this.send.drive,
                                    year: this.send.year,
                                    pv: this.send.pv,
                                    fin: this.send.fin,
                                    loan: this.send.loan,
                                    ready: this.send.ready
                                }).then(res => {
                                    this.isSubmitting = false; // Reset submission state
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
                                }).catch(error => {
                                    this.isSubmitting = false; // Reset submission state on error
                                    console.error(error);
                                });
                            }
                        }






                    }
                });
                
        </script>

              <!-- App js -->
              <script src="/assets/js/theme.js"></script>

    </body>
</html>
<?php } ?>
