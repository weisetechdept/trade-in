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

        <link rel="shortcut icon" href="/assets/images/favicon.ico">

        <link href="/assets/plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="/assets/plugins/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="/assets/plugins/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="/assets/plugins/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />

        <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@100;200;300;400;500;600;700;800&family=Kanit:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/theme.min.css" rel="stylesheet" type="text/css" />

        <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
        <link href="/assets/css/admin/car-detail.css" rel="stylesheet">

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
                                                            <button class="btn btn-success" data-sharer="line" :data-title="'พ่อสื่อออนไลน์ รหัส ID : '+ share_link" :data-url="share_link">แชร์ผ่านไลน์</button>
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

                        <div class="row" id="multiUpload">
                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-2 font-size-18">อัพโหลดรูป (V.Beta)</h4>

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
                                                    <input type="file" class="form-control file-upload" id="uploadfiles" ref="uploadfiles" multiple />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="button" @click='uploadFile()' class="btn btn-primary waves-effect waves-light">อัพโหลด</button>
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
                                            
                                            <a :href="docs.link_500" target="_blank" type="button" class="btn btn-sm btn-outline-primary waves-effect waves-light mt-2" style="margin-top: 10px;">รูปขนาดเต็ม</a>
                                            <button @click="sendDelete" type="button" class="btn btn-sm btn-outline-danger waves-effect waves-light mt-2" style="margin-top: 10px;">ลบ</button>
                                            <div class="btn-right">
                                                <button type="button" class="btn btn-sm btn-warning waves-effect waves-light mt-2" style="margin-top: 10px;">ตั้งเป็นรูปหน้าปก</button>
                                            </div>

                                            <p class="mt-2 mb-0">อัพโหลดเมื่อ : {{ docs.datetime }}, หมวดหมู่: {{ docs.group }}</p>
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

        <script src="/assets/js/jquery.min.js"></script>
        <script src="/assets/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/js/metismenu.min.js"></script>
        <script src="/assets/js/waves.js"></script>
        <script src="/assets/js/simplebar.min.js"></script>

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
        
        <script src="/assets/js/admin/car-detail.js"></script>
        <script src="/assets/js/theme.js"></script>

    </body>
</html>