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

        <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

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
            .red-font {
                color: red;
            }
            .green-font {
                color: green;
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
                                        <h4 class="mb-2 font-size-18">ข้อมูลจากเซลล์</h4>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th width="155px">รหัส ID</th>
                                                        <td>{{ id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th width="155px">ประเภทรถยนต์</th>
                                                        <td>{{ typeCar }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>เบาะโดยสาร</th>
                                                        <td>{{ seat }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>ประตู</th>
                                                        <td>{{ door }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>เกียร์</th>
                                                        <td>{{ transmission }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>เชื้อเพลิง</th>
                                                        <td>{{ fuel }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>ปีรถยนต์</th>
                                                        <td>{{ reg_year }}</td>
                                                    <tr>
                                                        <th>ราคาที่ยอมรับได้</th>
                                                        <td>{{ price }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>ชื่อผู้ขาย (ลูกค้า)</th>
                                                        <td>{{ seller_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>เบอร์โทรผู้ขาย</th>
                                                        <td>{{ tel }}</td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-2 font-size-18">ให้ราคา</h4>
                                        <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>ราคา</th>
                                                        <th>พันธมิตร</th>
                                                        <th width="180px">วันที่</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="offer in offer.display">
                                                        <td>{{ offer.price }}</td>
                                                        <th>{{ offer.partner }}</th>
                                                        <td>{{ offer.datetime }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <div id="accordion" class="custom-accordion mt-4 ">
                                                <div class="card mb-0">
                                                    <div class="card-header" id="headingOne">
                                                        <h5 class="m-0 font-size-15">
                                                            <a class="d-block pt-2 pb-2 text-dark" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                ส่งแจ้งเตือนให้ราคา <span class="float-right"><i class="mdi mdi-chevron-down accordion-arrow"></i></span>
                                                            </a>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                        <div class="card-body">

                                                            <div class="row">
                                                                <div class="col-12 col-md-6">
                                                                    <div>
                                                                        <div class="form-group">
                                                                            <label>ราคา</label>
                                                                            <input type="text" class="form-control" v-model="offer.price">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>พันธมิตร</label>
                                                                            <input type="text" class="form-control" v-model="offer.partner">
                                                                        </div>
                                                                        <input type="submit" class="btn btn-primary" @click="offerData" value="ส่งราคา">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                    </div>

                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-2 font-size-18">การแชร์</h4>
                                        <div class="row">
                                            <div class="col-12 col-lg-8">
                                                <label>การแชร์ข้อมูลรถคันนี้ : <span class="red-font" v-if="switchPublic == 0">ยังไม่แชร์</span><span class="green-font" v-else-if="switchPublic == 1">แชร์</span></label>
                                                <div class="input-group mb-3">
                                                    <button class="btn btn-outline-warning" @click="publicSwitch" type="button">เปลี่ยนสถานะการแชร์</button>
                                                </div>

                                                <div class="form-group" v-if="switchPublic == 1">
                                                    <div class="input-group">
                                                        <input type="text" :value="share_link" id="myInput" class="form-control">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-dark waves-effect waves-light" @click="copyLink" type="button">คัดลอก</button> 
                                                            <button class="btn btn-success" type="button" data-sharer="line" :data-title="'พ่อสื่อออนไลน์ รหัส ID : '+ share_link" :data-url="share_link">แชร์ผ่านไลน์</button>
                                                        </div>
                                                    </div>
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
                                        <h4 class="mb-2 font-size-18">ข้อมูลรถยนต์</h4>
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
                                                        <td>{{ reg_year }}</td>
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
                                                        <td>{{ tel }} <a :href="'tel:'+tel" class="btn btn-outline-success ml-2">โทร</a></td>
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
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>


<!-- 

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
-->

                        </div>


                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-2 font-size-18">ข้อมูลราคา</h4>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <tbody>
                                                    
                                                
                                                    <tr>
                                                        <th width="155px">ราคา</th>
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
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-2 font-size-18">จัดการข้อมูล</h4>
                                        <div class="table-responsive">
                                            <a :href="'/admin/edit/'+id" type="submit" class="btn btn-outline-warning waves-effect waves-light mr-1">แก้ใข</a> <a :href="'/admin/owner/'+id" type="submit" class="btn btn-outline-primary waves-effect waves-light mr-1">ย้ายผู้ดูแล</a> <button @click="deleteData" type="submit" class="btn btn-outline-danger waves-effect waves-light mr-1">ลบข้อมูล</button>
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
<!--
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
-->

                        <div id="car_img">
                            <div class="row" v-for="docs in img">
                                <div class="col-lg-6 col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <img :src="docs.link_500" width="100%" class="car_img">
                                            <a :href="docs.link_500" target="_blank" type="button" class="btn btn-sm btn-primary waves-effect waves-light mt-2" style="margin-top: 10px;">รูปขนาดเต็ม</a>
                                            <button @click="sendDelete" type="button" class="btn btn-sm btn-danger waves-effect waves-light mt-2" style="margin-top: 10px;">ลบ</button>
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

        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sharer.js@latest/sharer.min.js"></script>
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
                            typeCar: '',
                            seat: '',
                            door: '',
                            fuel: '',
                            engine: '',
                            passengerType: '',
                            suspension: '',
                            drive: '',
                            seller_name: '',
                            share_link: '',
                            
                            offer:{
                                price: '',
                                partner: '',
                                display: [],
                            },
                            switchPublic: false
                        }
                    },
                    mounted () {
                        axios.get('/admin/system/car_detail.api.php?u=<?php echo $cid; ?>')
                            .then(response => {
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

                                this.typeCar = response.data.car.type;
                                this.seat = response.data.car.seat;
                                this.door = response.data.car.door;
                                this.fuel = response.data.car.fuel;
                                this.engine = response.data.car.engine;
                                this.passengerType = response.data.car.passengerType;
                                this.suspension = response.data.car.suspension;
                                this.drive = response.data.car.drive;
                                this.seller_name = response.data.car.seller_name;

                                this.offer.display = response.data.offer;
                                this.share_link = response.data.car.share_link;

                                this.switchPublic = response.data.car.publicLink;
                             
                            }),
                            this.calDownpayment();
                    },
                    methods: {
                        deleteData() {
                            swal({
                                title: 'คุณแน่ใจหรือไม่ ?',
                                text: "คุณต้องการลบข้อมูลรถยนต์นี้หรือไม่ ?",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            }).then((willDelete) => {
                                if (willDelete) {
                                    
                                    axios.post('/admin/system/car_delete.api.php', {
                                        id: this.id
                                    }).then(res => {
                                        if(res.data.status == 200) 
                                            swal("สำเร็จ", "ลบข้อมูลสำเร็จ", "success",{ 
                                                button: "ตกลง"
                                            }).then((value) => {
                                                window.location.href = "/admin/home";
                                            });

                                        if(res.data.status == 400)
                                            swal("ทำรายการไม่สำเร็จ", "ลบข้อมูลไม่สำเร็จ อาจมีบางอย่างผิดปกติ (error : 400)", "warning",{ 
                                                button: "ตกลง"
                                            }
                                        );
                                    });
                                    
                                } 
                            });
                        },
                        publicSwitch(){
                            swal({
                                title: 'คุณแน่ใจหรือไม่ ?',
                                text: "คุณต้องการเปลี่ยนสถานะการแชร์ข้อมูลหรือไม่ ?",
                                icon: "info",
                                buttons: true,
                                dangerMode: true,
                            }).then((willDelete) => {
                                if (willDelete) {
                                    axios.post('/admin/system/public.edt.php', {
                                        id: this.id,
                                        switchPublic: this.switchPublic
                                    }).then(res => {
                                        if(res.data.status == 200) 
                                            swal("สำเร็จ", "เปลี่ยนสถานะการแชร์ข้อมูลสำเร็จ", "success",{ 
                                                button: "ตกลง"
                                            }).then((value) => {
                                                location.reload(true)
                                            });

                                        if(res.data.status == 400)
                                            swal("ทำรายการไม่สำเร็จ", "เปลี่ยนสถานะการแชร์ข้อมูลไม่สำเร็จ อาจมีบางอย่างผิดปกติ (error : 400)", "warning",{ 
                                                button: "ตกลง"
                                            }
                                        );
                                    });
                                } 
                            });
                        },
                        offerData() {
                            if(this.offer.price == '' || this.offer.partner == ''){
                                swal("ไม่สามารถทำรายการได้", "โปรดกรอกข้อมูลให้ครบถ้วน", "warning",{ 
                                        button: "ตกลง"
                                    }
                                );
                                return;
                            } else {

                                swal({
                                    title: 'คุณแน่ใจหรือไม่ ?',
                                    text: "คุณต้องการส่งข้อมูลให้ลูกค้าหรือไม่ ?",
                                    icon: "info",
                                    buttons: true,
                                    dangerMode: true,
                                }).then((willDelete) => {
                                    if (willDelete) {

                                        axios.post('/admin/system/offer.ins.php', {
                                            price: this.offer.price,
                                            partner: this.offer.partner,
                                            parent: this.id
                                        }).then(res => {
                                            if(res.data.status == 200) 
                                                swal("สำเร็จ", "เพิ่มข้อมูลสำเร็จ", "success",{ 
                                                    button: "ตกลง"
                                                }).then((value) => {
                                                    location.reload(true)
                                                });
                                            if(res.data.status == 400) 
                                                swal("ทำรายการไม่สำเร็จ", "เพิ่มข้อมูลไม่สำเร็จ อาจมีบางอย่างผิดปกติ (error : 400)", "warning",{ 
                                                    button: "ตกลง"
                                                }
                                            );
                                        });


                                    } else {
                                        swal("ยกเลิกการส่งข้อมูลสำเร็จ", {
                                            icon: "success",
                                        });
                                    }
                                });

                            }
                            
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
                        },
                        copyLink() {
                            var copyText = document.getElementById("myInput");
                            copyText.select();
                            copyText.setSelectionRange(0, 99999);
                            navigator.clipboard.writeText(copyText.value);
                            alert("คัดลอกลิ้ง : " + copyText.value);
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
        </script>
        <script src="/assets/js/theme.js"></script>

    </body>
</html>