<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>พ่อสื่อ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="พ่อสื่อ" name="description" />
    <meta content="พ่อสื่อ" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <link href="/assets/plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@100;200;300;400;500;600;700;800&family=Kanit:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/theme.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <style>
        body {
            font-family: 'Kanit', sans-serif;
            font-weight: 300;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    font-family: 'Kanit', sans-serif;
    font-weight: 400;
}
label {
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
input[type="date"] {
    display:block;
    -webkit-appearance: textfield;
    -moz-appearance: textfield;
    min-height: 1.2em; 
    min-width: 96%;
    padding: 0px 2px;
    border: 1px solid #ccc;
    border-radius: 3px;
}
.footer {
    left: 0;
}
.navbar-header {
    margin-left: 0px;
    height: 65px;
}
.mt-main {
    margin-top: 68px;
}
.page-title-box {
    padding-bottom: 10px;
}
.logo-ti {
    border-radius: 15px;
    width: 100px;
    height: auto;
}
body {
    background-color: #eeeeee;
}
#page-topbar {
    border-bottom: 5px solid #5AB033;
}
.navbar-custom {
}
.navbar-topic {
    font-family: 'Prompt', sans-serif;
    padding: 10px;
    background-color: #2e2e2e;
    color: #fff;
    font-size: 26px;
    font-weight: 600;
    padding-left: 17px;
    display: block;
    text-align: center;
    padding: 40px 15px;
}
.red-line {
    width: 100px;
    height: 5px;
    background-color: #ff0000;
    margin-top: 5px;
}
.red-bar {
    padding: 0 17px;
    margin-bottom: 10px;
    margin-top: 85px;
    display: block;
    height: 40px;
    font-family: 'Prompt', sans-serif;
}
.red-bar .step {
    width: 33.3333333%;
    float: left;
    border-bottom: 3px solid #c2bfbf;
    text-align: center;
    font-size: 16px;
    font-weight: 500;
    color: #c2bfbf;
}
.red-bar .step.active {
    color: #5AB033;
    border-bottom: 3px solid #5AB033;
}
.s-li {
    padding-left: 15px;
    font-family: 'Prompt', sans-serif;
    color: #000;
    font-size: 13pt;
    padding-top: 12px;
}
li {
    list-style: none;
}
.wrapper {
position: relative;
overflow-x: hidden;
max-width: 100%;
border-radius: 13px;
}
.wrapper .icon {
position: absolute;
top: 0;
height: 100%;
width: 120px;
display: flex;
align-items: center;
}
.icon:first-child {
left: 0;
display: none;
/* background: linear-gradient(90deg, #fff 70%, transparent); */
}
.icon:last-child {
right: 0;
justify-content: flex-end;
/* background: linear-gradient(-90deg, #fff 70%, transparent); */
}
.icon i {
width: 40px;
height: 40px;
cursor: pointer;
font-size: 1.2rem;
text-align: center;
line-height: 40px;
border-radius: 50%;
background-color: #e5e5e5;
}
.icon i:hover {
    background: #ff0000;
    color: #fff;
}
.icon:first-child i {
margin-left: 5px;
} 
.icon:last-child i {
margin-right: 5px;
} 
.wrapper .tabs-box {
display: flex;
list-style: none;
overflow-x: hidden;
scroll-behavior: smooth;
padding: 20px 55px;
gap: 48px;
}
.tabs-box.dragging {
scroll-behavior: auto;
cursor: grab;
}
.tabs-box .tab {
cursor: pointer;
font-size: 1.18rem;
padding: 13px 20px;
}
.tabs-box .tab:hover{
    border-radius: 10px;
}
.tabs-box.dragging .tab {
user-select: none;
pointer-events: none;
}
.tabs-box .tab.active{
    color: #fff;
    border-color: transparent;
    padding: 0;
}

.tab > img {
    width: 270px;
    height: auto;
    object-fit: cover;
    border-radius: 10px;
}
.tabs-box .tab {
    padding: 0px 3px 3px 3px;
}
.tabs-box .tab.active {
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    border-radius: 10px;
    position: relative;
}

.tabs-box .tab.active::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('/assets/images/selected-over-lay.png');
    background-repeat: no-repeat;
    background-size: cover;
    z-index: 2;
    border-radius: 10px;
}
.btn-danger {
    color: #fff;
    background-color: #ff0000;
    border-color: #ff0000;
}
.selected > img {
    width: 60px;
    height: auto;
    z-index: 1;
    padding-right: 15px;
}
.selected {
    text-align: right;
}
.step2 {
    display: none;
}
.step3 {
    display: none;
}
.branch {
    display: flex;
    justify-content: center;
    gap: 25px;
    padding: 0;
    margin: 0;
}
.branch .tab-radio {
    display: flex;
    align-items: center;
    padding: 10px 20px;
    border-radius: 10px;
    border: 1px solid #e5e5e5;
    cursor: pointer;
    transition: all 0.3s;
    width: 155px;
    
}
.select-car {
    display: none;
}
.b-active {
    /* box-shadow: rgb(149 157 165 / 45%) 0px 8px 24px; */
    background-color: #ff0000;
    color: #fff;
}
.branch label {
    width: 100%;
    text-align: center;
    margin-bottom: 0;
}
input[type="radio"]{
    visibility: hidden;
    height: 0;
    width: 0;
}
.book-tp {
    padding-left: 15px;
}
a {
    color: #ff0000;
}
a:hover, a:active {
    color: #ff0000;
}
.swal-text {
    text-align: center;
}
.swal-button, .swal-button:hover, .swal-button:focus, .swal-button:visited{
    background-color: #ff0000;
    color: #fff;
}
.swal-button:active {
    background-color: #ce0404;
    color: #fff;
}
@media (min-width: 769px) {
    .navbar-topic {
        padding: 60px 15px;
    }
    .navbar-topic > p {
        margin-bottom: 0 !important;
        font-size: 28pt;
    }
}
.card ,.btn, input,select {
    font-size: 14pt !important;
}
.start {
    text-align: center;
}
.start img {
    width: 85%;
    height: auto;
    border-radius: 10px;
    padding: 0 15px;
}
.layout-2 {
    padding: 0 0 15px;
    background-color: #000;
}
.ci-green {
    background: rgb(55,238,25);
    background: linear-gradient(0deg, rgba(55,238,25,1) 0%, rgba(16,155,2,1) 100%);
    color:#000;
}
.photo-grid {
    padding : 20px;
    color: #fff;
}
.grid-row {
    margin-bottom: 20px;
}
.hidden {
    display: none;
}
.nextBtn2 {
    margin-top: 20px;
    text-align: center;
}
.nextBtn2 button {
    color: #000;
    border-radius: 10px;
    background: rgb(55, 238, 25);
    background: linear-gradient(0deg, rgba(55, 238, 25, 1) 0%, rgba(16, 155, 2, 1) 100%);
    border-color: rgb(55, 238, 25);
}
.green-btn button {
    background: rgb(55, 238, 25);
    background: linear-gradient(0deg, rgba(55, 238, 25, 1) 0%, rgba(16, 155, 2, 1) 100%);
    border-color: rgb(55, 238, 25);
    color: #000;
}
.headstep3 {
    margin: 30px 0 15px;
}
    </style>

</head>

<body>
    <div id="trade">
                
    <header id="page-topbar">
        <div id="nav" class="navbar-header">
            <div class="d-flex align-items-left">
                <div class="d-flex align-items-left">
                    <img src="/assets/images/logo.png" class="logo-ti">
                    <div class="s-li">How we move you.</div>
                </div>
            </div>
            <div class="d-flex align-items-center">
                
            </div>
        </div>
    </header>

    <div class="navbar-custom mt-main">

        <div class="red-bar mb-0">
            <div class="step active" id="barStep1">ขั้นตอน 1</div>
            <div class="step" id="barStep2">ขั้นตอน 2</div>
            <div class="step" id="barStep3">ขั้นตอน 3</div>
        </div>

    </div>

    <div id="layout-wrapper">

            <div id="step1"> 
            <div class="navbar-topic">
            <p class="mb-0">12 ขั้นตอนถ่ายรูปขายรถง่ายๆ</p>
        </div>
                <div class="row">
                    <div class="card" style="border-radius: 0rem;border: 0;width: 100%;">
                        <div class="card-body">

                            <div class="start">
                                <img @click="nextto2" src="/assets/images/photo-g.png" />
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid" id="step2"> 
                <div class="row">
                    <div class="card" style="border-radius: 0rem;border: 0;width: 100%;">
                        <div class="card-body layout-2">

                            <div class="navbar-topic ci-green">
                                <p class="mb-0">รูปภาพรถยนต์ ({{ upload.count }})</p>
                            </div>
                            <div class="photo-grid">
                                <p>กรุณาเพิ่มรูปรถยนต์ขั้นต่ำ 4 รูปภาพ</p>
                                <div class="row grid-row">
                        <div class="col-4">
                            <img v-if="upload.photo1 == '0'" src="/assets/images/grid/button-01.png" @click="uploadCar" data-btn="photo1" class="img-fluid" />
                            <img v-else src="/assets/images/grid/button-chk-01.png" @click="uploadCar" data-btn="photo1" class="img-fluid" />
                        </div>
                        <div class="col-4">
                            <img v-if="upload.photo2 == '0'" src="/assets/images/grid/button-02.png" @click="uploadCar" data-btn="photo2" class="img-fluid" />
                            <img v-else src="/assets/images/grid/button-chk-02.png" @click="uploadCar" data-btn="photo2" class="img-fluid" />
                        </div>
                        <div class="col-4">
                            <img v-if="upload.photo3 == '0'" src="/assets/images/grid/button-03.png" @click="uploadCar" data-btn="photo3" class="img-fluid" />
                            <img v-else src="/assets/images/grid/button-chk-03.png" @click="uploadCar" data-btn="photo3" class="img-fluid" />
                        </div>
                    </div>

                    <div class="row grid-row">
                        <div class="col-4">
                            <img v-if="upload.photo4 == '0'" src="/assets/images/grid/button-04.png" @click="uploadCar" data-btn="photo4" class="img-fluid" />
                            <img v-else src="/assets/images/grid/button-chk-04.png" @click="uploadCar" data-btn="photo4" class="img-fluid" />
                        </div>
                        <div class="col-4">
                            <img v-if="upload.photo5 == '0'" src="/assets/images/grid/button-05.png" @click="uploadCar" data-btn="photo5" class="img-fluid" />
                            <img v-else src="/assets/images/grid/button-chk-05.png" @click="uploadCar" data-btn="photo5" class="img-fluid" />
                        </div>
                        <div class="col-4">
                            <img v-if="upload.photo6 == '0'" src="/assets/images/grid/button-06.png" @click="uploadCar" data-btn="photo6" class="img-fluid" />
                            <img v-else src="/assets/images/grid/button-chk-06.png" @click="uploadCar" data-btn="photo6" class="img-fluid" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <img v-if="upload.photo7 == '0'" src="/assets/images/grid/button-07.png" @click="uploadCar" data-btn="photo7" class="img-fluid" />
                            <img v-else src="/assets/images/grid/button-chk-07.png" @click="uploadCar" data-btn="photo7" class="img-fluid" />
                        </div>
                        <div class="col-4">
                            <img v-if="upload.photo8 == '0'" src="/assets/images/grid/button-08.png" @click="uploadCar" data-btn="photo8" class="img-fluid" />
                            <img v-else src="/assets/images/grid/button-chk-08.png" @click="uploadCar" data-btn="photo8" class="img-fluid" />
                        </div>
                        <div class="col-4">
                            <img v-if="upload.photo9 == '0'" src="/assets/images/grid/button-09.png" @click="uploadCar" data-btn="photo9" class="img-fluid" />
                            <img v-else src="/assets/images/grid/button-chk-09.png" @click="uploadCar" data-btn="photo9" class="img-fluid" />
                        </div>
                    </div>

                    <div class="nextBtn2">
                        <button class="btn btn-primary" @click="nextStep2">ถัดไป</button>
                    </div>

                        


                </div>

            </div>


            <div class="page-content pt-2" id="step3">
                <div class="container-fluid"> 

                    <div class="row justify-content-md-center">
                    
                        <div class="col-12 col-lg-4">
                        <div class="headstep3">
                            <h4>ประเมินราคารถของคุณวันนี้</h4>
                        </div>
                            <div class="card">
                                <div class="card-body">
                                    
                                    <div class="form-group">
                                        <label>เลขทะเบียน</label>
                                        <input type="text" v-model="toupload.license" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label>ชื่อ - นามสกุล</label>
                                        <input type="text" v-model="toupload.name" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label>เบอร์โทรติดต่อ</label>
                                        <input type="text" v-model="toupload.tel" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                    <p>
                                                <input type="checkbox" class="mr-1" id="condition">
                                                ข้าพเจ้าได้อ่าน รับทราบและเข้าใจ<a href="https://home.toyotaparagon.com/%e0%b8%99%e0%b9%82%e0%b8%a2%e0%b8%9a%e0%b8%b2%e0%b8%a2%e0%b8%84%e0%b8%a7%e0%b8%b2%e0%b8%a1%e0%b9%80%e0%b8%9b%e0%b9%87%e0%b8%99%e0%b8%aa%e0%b9%88%e0%b8%a7%e0%b8%99%e0%b8%95%e0%b8%b1%e0%b8%a7/" target="_blank">รายละเอียด ข้อกำหนดและเงื่อนไข</a>ในการเก็บรวบรวม ใช้ และ/หรือเปิดเผยข้อมูลส่วนบุคคล ซึ่งเกี่ยวกับข้าพเจ้าในเว็บไซต์นี้โดยตลอดแล้วเห็นว่าถูกต้องตามความประสงค์ของข้าพเจ้า
                                            </p>
                                    </div>

                                    <div class="nextBtn2">
                                        <button class="btn btn-primary" @click="sendData">ประเมินราคา</button>
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

            
        <div class="hidden" >
            <input type="file" v-model="toupload.photo1" @change="photoUpload" id="photo1" class="form-control" />
            <input type="file" v-model="toupload.photo2" @change="photoUpload" id="photo2" class="form-control" />
            <input type="file" v-model="toupload.photo3" @change="photoUpload" id="photo3" class="form-control" />
            <input type="file" v-model="toupload.photo4" @change="photoUpload" id="photo4" class="form-control" />
            <input type="file" v-model="toupload.photo5" @change="photoUpload" id="photo5" class="form-control" />
            <input type="file" v-model="toupload.photo6" @change="photoUpload" id="photo6" class="form-control" />
            <input type="file" v-model="toupload.photo7" @change="photoUpload" id="photo7" class="form-control" />
            <input type="file" v-model="toupload.photo8" @change="photoUpload" id="photo8" class="form-control" />
            <input type="file" v-model="toupload.photo9" @change="photoUpload" id="photo9" class="form-control" />
        </div>

           
      

    </div>
 

  
    <div class="menu-overlay"></div>
    </div>

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
    <script src="/assets/js/theme.js"></script>

    <script>
        var trade = new Vue({
            el: '#trade',
            data: {
                upload: {
                    photo1: '0',
                    photo2: '0',
                    photo3: '0',
                    photo4: '0',
                    photo5: '0',
                    photo6: '0',
                    photo7: '0',
                    photo8: '0',
                    photo9: '0',
                    count: 0
                },
                toupload: {
                    photo1: '',
                    photo2: '',
                    photo3: '',
                    photo4: '',
                    photo5: '',
                    photo6: '',
                    photo7: '',
                    photo8: '',
                    photo9: '',
                    license: '',
                    name: '',
                    tel: ''
                }
            },
            methods: {
                photoUpload() {
                    if (document.getElementById('photo1').files.length > 0) {
                        this.upload.photo1 = '1';
                    }
                    if (document.getElementById('photo2').files.length > 0) {
                        this.upload.photo2 = '1';
                    }
                    if (document.getElementById('photo3').files.length > 0) {
                        this.upload.photo3 = '1';
                    }
                    if (document.getElementById('photo4').files.length > 0) {
                        this.upload.photo4 = '1';
                    }
                    if (document.getElementById('photo5').files.length > 0) {
                        this.upload.photo5 = '1';
                    }
                    if (document.getElementById('photo6').files.length > 0) {
                        this.upload.photo6 = '1';
                    }
                    if (document.getElementById('photo7').files.length > 0) {
                        this.upload.photo7 = '1';
                    }
                    if (document.getElementById('photo8').files.length > 0) {
                        this.upload.photo8 = '1';
                    }
                    if (document.getElementById('photo9').files.length > 0) {
                        this.upload.photo9 = '1';
                    }
                    
                },
                uploadCar(e) {
                    var btn = e.target.getAttribute('data-btn');
                    document.getElementById(btn).click();
                },
                nextStep2() {
                    if (this.upload.photo1 == '1' && this.upload.photo2 == '1' && this.upload.photo3 == '1' && this.upload.photo4 == '1') {
                        /*
                        document.getElementById('step3').style.display = 'block';
                        document.getElementById('step2').style.display = 'none';
                        document.getElementById('barStep2').classList.remove('active');
                        document.getElementById('barStep3').classList.add('active');
                        */
                    } else {
                        swal({
                            title: 'แจ้งเตือน',
                            text: 'กรุณาเพิ่ม 4 รูปแรกของรถยนต์คุณ',
                            icon: 'warning',
                            button: 'OK'
                        });
                    }
                },
                nextto2() {
                    /*
                    document.getElementById('step1').style.display = 'none';
                    document.getElementById('step2').style.display = 'block';
                    document.getElementById('barStep1').classList.remove('active');
                    document.getElementById('barStep2').classList.add('active');
                    */
                },
                sendData(){
                    if(this.toupload.license == '' || this.toupload.name == '' || this.toupload.tel == ''){
                        swal({
                            title: 'แจ้งเตือน',
                            text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                            icon: 'warning',
                            button: 'OK'
                        });
                    }else{
                        axios.post('/frontend/system/trade.api.php', this.toupload).then(function(res){
                            console.log(res.data);
                            
                        });
                    }
                }
            }
        });
    </script>
</body>

</html>