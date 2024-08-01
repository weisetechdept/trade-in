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
    <title>Trade-In Partner List</title>
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
        .btn-group, .btn-group-vertical {
            margin-bottom: 15px;
        }
        .search-btn {
            margin-top: 27px;
        }
        .car-thumb {
            width: 85px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }
        .avatar {
            width: 135px;
            border-radius: 50%;
        }
        .profile {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }
        .swal-footer {
            text-align: center;
        }
        .offer_thumb {
            width: 50px;
            height: 35px;
            object-fit: cover;
            border-radius: 5px;

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
                <div class="container-fluid" id="partner">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">พันธมิตร</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Trade-in</a></li>
                                        <li class="breadcrumb-item active">พันธมิตร</li>
                                    </ol>
                                </div>
                                
                            </div>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="profile">
                                <img :src="partner.profile_img" alt="" class="avatar">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td width="135px">รหัสพันธมิตร</td>
                                                <td>{{ partner.id }}</td>
                                            </tr>
                                            <tr>
                                                <td>ชื่อพันธมิตร</td>
                                                <td>{{ partner.name }}</td>
                                            </tr>
                                            <tr>
                                                <td>เบอร์โทร</td>
                                                <td>{{ partner.tel }}</td>
                                            </tr>
                                            <tr>
                                                <td>บริษัท</td>
                                                <td>
                                                    <span v-if="partner.busi_match == '0'">ยังไม่ได้เลือก</span>
                                                    <span v-else>{{ partner.busi_db_name }}</span>
                                                     ({{ partner.busi_name }})
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>กลุ่มพันธมิตร</td>
                                                <td>{{ partner.group_name }}</td>
                                            </tr>

                                            <tr>
                                                <td>สถานะ</td>
                                                <td v-if="partner.status == '0'"><span class="badge badge-warning">รอตรวจสอบ</span></td>
                                                <td v-if="partner.status == '1'"><span class="badge badge-success">อนุมัติ</span></td>
                                                <td v-if="partner.status == '10'"><span class="badge badge-danger">ไม่อนุมัติ</span></td>
                                            </tr>
                                            <tr>           
                                                <td>วันที่สมัคร</td>
                                                <td>
                                                    {{ partner.create_date }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div> 
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">จัดการ</h3>
                                    <button type="button" class="btn btn-outline-warning waves-effect waves-light mr-1" data-toggle="modal" data-target="#exampleModal">แก้ใข</button>
                                    <button v-if="partner.status == 0" type="button" @click="verify" class="btn btn-success mr-1">อนุมัติสมาชิก</button>
                                    <button v-if="partner.status == 1" type="button" @click="verify" class="btn btn-danger mr-1">ระงับชั่วคราว</button>
                                </div> 
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">แก้ใขข้อมูล</h5>
                                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="name">ชื่อ</label>
                                        <input type="text" class="form-control" v-model="edit.fname">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">นามสกุล</label>
                                        <input type="text" class="form-control" v-model="edit.lname">
                                    </div>

                                    <div class="form-group">
                                        <label for="tel">เบอร์โทร</label>
                                        <input type="number" class="form-control" v-model="edit.tel" maxlength="10">
                                    </div>

                                    <div class="form-group">
                                        <label for="tel">กลุ่มพัมธมิตร</label>
                                        <select class="form-control" v-model="edit.group">
                                            <option value="0">ยังไม่ได้เลือก</option>
                                            <option v-for="pagp in partner_group" :value="pagp.id">{{ pagp.name }}</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="tel">บริษัท</label>
                                        <select class="form-control" v-model="edit.busi">
                                            <option value="0">ยังไม่ได้เลือก</option>
                                            <option v-for="pabu in partner_busi" :value="pabu.id">{{ pabu.name }}</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" @click="updateData" class="btn btn-primary waves-effect waves-light">บันทึกการแก้ใข</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">ประวัติการเสนอราคาล่าสุด</h3>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>รูป</th>
                                                <th>รหัสรถ</th>
                                                <th>ราคา (บาท)</th>
                                                <th width="170px">วันที่เสนอ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="off in offered">
                                                <td><img :src="off.img" class="offer_thumb"></td>
                                                <td><a :href="'/admin/detail/'+ off.id" target="_blank">{{ off.id }}</a></td>
                                                <td>{{ off.price }}</td>
                                                <td>{{ off.datetime }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-sm btn-outline-info waves-effect waves-light mr-1" data-toggle="modal" data-target="#Modal2" @click="offer_history">ดูประวัติการเสนอราคาทั้งหมด</button>
                                </div> 
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="Modal2" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">ดูประวัติการเสนอราคาทั้งหมด</h5>
                                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>การเสนอราคาทั้งหมด {{ allOffer.length }} ครั้ง</p>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>รูป</th>
                                                <th>รหัสรถ</th>
                                                <th>ราคา (บาท)</th>
                                                <th width="170px">วันที่เสนอ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="aof in allOffer">
                                                <td><img :src="aof.img" class="offer_thumb"></td>
                                                <td><a :href="'/admin/detail/'+ aof.id" target="_blank">{{ aof.id }}</a></td>
                                                <td>{{ aof.price }}</td>
                                                <td>{{ aof.datetime }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal" aria-label="Close">ปิด</button>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script src="/assets/js/theme.js"></script>
    <script>
        var partner = new Vue({
            el: '#partner',
            data: {
                partner: [],
                partner_group:[],
                partner_busi:[],
                edit: {
                    fname: '',
                    lname: '',
                    tel: '',
                    group: '',
                    busi: ''
                },
                offered: [],
                allOffer: []
            },
            mounted (){
                this.fetchData();
            },
            methods: {
                offer_history(){
                    axios.post('/admin/system/offer_history.api.php',{
                        id: this.partner.id
                    }).then(function (response) {
                        partner.allOffer = response.data.offered;
                        console.log(partner.allOffer);
                    })
                },
                fetchData(){
                    axios.get('/admin/system/partner-detail.api.php?id=<?php echo $id; ?>')
                    .then(function (response) {
                        partner.partner = response.data.detail;
                        partner.partner_group = response.data.partner_gp;
                        partner.partner_busi = response.data.partner_busi;
                        partner.edit.fname = response.data.detail.fname;
                        partner.edit.lname = response.data.detail.lname;
                        partner.edit.tel = response.data.detail.tel;
                        partner.edit.group = response.data.detail.group;
                        partner.edit.busi = response.data.detail.busi_match;
                        partner.offered = response.data.offered;
                    })
                },
                updateData(){
                    if(this.edit.fname == '' || this.edit.lname == '' || this.edit.tel == '' || this.edit.group == '0' || this.edit.busi == '0'){
                        swal('ไม่สามารถแก้ใขข้อมูลได้','ระบบไม่สามารถบันทึกค่าว่างลงในฐานข้อมูล',{
                            icon: 'warning',
                            button: 'ตกลง'
                        });
                        return;
                    }else{
                        swal('คุณต้องการแก้ใขข้อมูลใช่หรือไม่?','',{
                            buttons: {
                                cancel: "ยกเลิก",
                                confirm: {
                                    text: "ยืนยัน",
                                    value: "confirm",
                                }
                            },
                        }).then((value) => {
                            if(value == 'confirm'){
                                $('#exampleModal').modal('hide');
                                axios.post('/admin/system/partner-update.api.php',{
                                    id: this.partner.id,
                                    fname: this.edit.fname,
                                    lname: this.edit.lname,
                                    tel: this.edit.tel,
                                    group: this.edit.group,
                                    busi: this.edit.busi
                                }).then(function (response) {
                                    
                                    if(response.data.status == 'success'){
                                        swal('แก้ใขข้อมูลสำเร็จ','',{
                                            icon: 'success',
                                            button: 'ตกลง'
                                        }).then((value) => {
                                            partner.fetchData();
                                        })
                                    } else {
                                        swal('แก้ใขข้อมูลไม่สำเร็จ','กรุณาลองใหม่อีกครั้ง','error');
                                    }
                                    
                                })
                                
                            }
                        })
                    }
                },
                verify(){
                    if(this.partner.busi_match == '0'){
                        swal("ไม่สามารถดำเนินการได้","กรุณาเลือกบริษัทก่อนทำการอนุมัติ","warning"
                        ,{
                            button: "ตกลง",
                        })
                    } else {
                        swal({
                            title: "ยืนยันการอนุมัติ",
                            text: "คุณต้องการอนุมัติสมาชิกคนนี้ใช่หรือไม่?",
                            icon: "warning",
                            buttons: true,
                            dangerMode: false,
                        }).then((willOK) => {
                            if (willOK) {
                                axios.post('/admin/system/partner-verify.api.php',{
                                    id: this.partner.id
                                }).then(function (response) {
                                    if(response.data.status == 'success'){
                                        swal('อนุมัติสมาชิกสำเร็จ','',{
                                            icon: 'success',
                                            button: 'ตกลง'
                                        }).then((value) => {
                                            partner.fetchData();
                                        })
                                    } else {
                                        swal('อนุมัติสมาชิกไม่สำเร็จ', response.data.message ,'error');
                                    }
                                })
                            }
                        });
                    }
                    
                }
            
            },
        });
        
    </script>
    <script src="/assets/js/theme.js"></script>

</body>

</html>
<?php } ?>