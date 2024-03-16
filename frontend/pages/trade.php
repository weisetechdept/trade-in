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
    margin-bottom: 20px;
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
img {
    width: 150px;
    height: 50px;
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
    </style>

</head>

<body>
    <div id="testdrive">
                
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
      
        <div class="navbar-topic">
            <p class="mb-0">12 ขั้นตอนถ่ายรูปขายรถง่ายๆ</p>
        </div>

    </div>

    <div id="layout-wrapper">

            <div class="container-fluid" id="step1"> 
                
                <div class="row">
                    <div class="card" style="border-radius: 0rem;border: 0;width: 100%;">
                        <div class="card-body" style="padding: 15px 0;">

                            <div class="select-car">
                                <p style="text-align:center;margin: 70px 0 0 0;">เลือกรถยนต์ที่ต้องการทดลองขับ</p>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content pt-2 step2 animate__animated animate__fadeInRight">
                <div class="container-fluid"> 

                    <div class="row justify-content-md-center">

                        <div class="col-12 col-lg-4">
                            <div class="card">
                                <div class="card-body">

                                    <label for="car">สาขาที่ต้องการทดลองขับ</label>
                                    <p class="book-tp" v-if="selected.branch == 'ho'">สำนักงานใหญ่ (รังสิตคลอง 7)</p>
                                    <p class="book-tp"  v-if="selected.branch == 'tm'">ตลาดไท</p>

                                    <label for="car">รถยนต์ทดลองขับ</label>
                                    <p class="book-tp">{{ infoDisplay.car }}</p>

                                    <div class="mb-3">

                                        <div class="form-group">
                                            <label for="date">วันที่จอง</label>
                                            <input type="date" id="date" class="form-control" v-model="selected.date" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" max="<?php echo date('Y-m-d', strtotime('+7 days')); ?>" @change="getTime">
                                        </div>

                                        <div class="form-group">
                                            <label for="time">เวลาจอง</label>
                                            <select id="time" name="time" v-model="selected.time" class="form-control" disabled>
                                                <option value="0">= เลือกเวลา =</option>
                                                <option v-for="t in bk.time" v-if="t.status == 1" :value="t.id">{{ t.time }}</option>
                                                <option v-for="t in bk.time" v-if="t.status == 0" :value="t.id" disabled>{{ t.time }} (ไม่ว่าง)</option>
                                            </select>
                                        </div>
                                        <div class="text-center">
                                            <p>บริษัท จะมอบหมายที่ปรึกษาการขาย<br />ติดต่อเพื่อยืนยันสิทธิ์ (วัน - เวลา) อีกครั้ง</p>
                                        </div>
                                        
                                    </div>
                                    <div class="text-center mt-4 pt-2 mb-3">
                                        <button class="btn btn-danger waves-effect waves-light" @click="nextStep2">ถัดไป</button>
                                    </div>
                                       
                                </div>
                            </div>
                        </div>
                    </div>

                  

                </div>
            </div>

            <div class="page-content pt-2 step3 animate__animated animate__fadeInRight">
                <div class="container-fluid"> 

                    <div class="row justify-content-md-center">

                        <div class="col-12 col-lg-4">
                            <div class="card">
                                <div class="card-body">

                                    <label for="car">สาขาที่ต้องการทดลองขับ</label>
                                    <p class="book-tp" v-if="selected.branch == 'ho'"><b>สำนักงานใหญ่ (รังสิตคลอง 7)</b><br />41/1 หมู่ 2 ถ.รังสิต-นครนายก<br />ต.ลำผักกูด อ.ธัญบุรี จ.ปทุมธานี<br />โทร 02 957 1111</p>
                                    <p class="book-tp"  v-if="selected.branch == 'tm'"><b>ตลาดไท</b>88 หมู่ 9 ถ.พหลโยธิน<br />ต.คลองหนึ่ง อ.คลองหลวง จ.ปทุมธานี<br />โทร 02 516 8000</p>

                                    <label for="car">รถยนต์ทดลองขับ</label>
                                    <p class="book-tp">{{ infoDisplay.car }}</p>

                                    <label for="date">วันที่จอง</label>
                                    <p class="book-tp">{{ selected.date }}</p>

                                    <label for="time">เวลาจอง</label>
                                    <p class="book-tp">{{ infoDisplay.time }}</p>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="car">ชื่อ (ไม่ใส่คำนำหน้า)</label>
                                            <input type="text" id="fname" v-model="selected.fname" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="car">นามสกุล</label>
                                            <input type="text" id="lname" v-model="selected.lname" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="car">เบอร์โทรศัพท์</label>
                                            <input type="text" id="tel" v-model="selected.tel" class="form-control" maxlength="10">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="car">อีเมล (ถ้ามี)</label>
                                            <input type="text" id="email" v-model="selected.email" class="form-control">
                                        </div>
                                    </div>

                                   
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <p>
                                                <input type="checkbox" class="mr-1" id="condition" v-model="selected.condition">
                                                ข้าพเจ้าได้อ่าน รับทราบและเข้าใจ<a href="https://home.toyotaparagon.com/%e0%b8%99%e0%b9%82%e0%b8%a2%e0%b8%9a%e0%b8%b2%e0%b8%a2%e0%b8%84%e0%b8%a7%e0%b8%b2%e0%b8%a1%e0%b9%80%e0%b8%9b%e0%b9%87%e0%b8%99%e0%b8%aa%e0%b9%88%e0%b8%a7%e0%b8%99%e0%b8%95%e0%b8%b1%e0%b8%a7/" target="_blank">รายละเอียด ข้อกำหนดและเงื่อนไข</a>ในการเก็บรวบรวม ใช้ และ/หรือเปิดเผยข้อมูลส่วนบุคคล ซึ่งเกี่ยวกับข้าพเจ้าในเว็บไซต์นี้โดยตลอดแล้วเห็นว่าถูกต้องตามความประสงค์ของข้าพเจ้า
                                            </p>
                                        </div>
                                    </div>
                                        

                                    <div class="text-center mt-4 pt-2 mb-3">
                                        <button class="btn btn-danger waves-effect waves-light" @click="insData">จองรถ</button>
                                    </div>
                                       
                                </div>
                            </div>
                        </div>
                    </div>

                  

                </div>
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

    <script src="/assets/js/booking.js?r=<?php echo rand(0,999999);?>"></script>
</body>

</html>