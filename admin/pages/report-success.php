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
    <title>Trade-In Success Report</title>
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
        .badge-soft-unknow {
            background-color: #f6b9f7;
            color: #fff;
        }
        @media (min-width: 768px) {
            .page-content {
                padding: calc(70px + 24px) calc(5px / 2) 70px calc(5px / 2);
            }
            div.dataTables_wrapper div.dataTables_filter {
                text-align: right;
                float: right;
            }
        }
        .bg-light-gray {
            background-color:rgb(239, 239, 239);
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

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">รายงานรถที่ซื้อสำเร็จ</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Trade-in</a></li>
                                        <li class="breadcrumb-item active">รายงานรถที่ซื้อสำเร็จ</li>
                                    </ol>
                                </div>
                                
                            </div>
                        </div>
                    </div>  
        <div id="app">
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลขายของ {{ ecard.id }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th scope="row">ผู้ซื้อ</th>
                                            <td>
                                                <select v-model="ecard.partner" class="form-control">
                                                    <option value="0">= เลือกพันธมิตร =</option>
                                                    <option v-for="pt in ecard.list" :value="pt.id">{{ pt.name }}</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">ราคารับซื้อ</th>
                                            <td><input  v-model="ecard.price" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">ค่าคอม</th>
                                            <td><input  v-model="ecard.commission" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">วันที่จบ</th>
                                            <td><input v-model="ecard.date" class="form-control" type="date" ></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">สถานะรอง</th>
                                            <td> <select v-model="ecard.newcar" class="form-control">
                                                    <option value="0">= เลือกสถานะรอง =</option>
                                                    <option value="1">จบรถเก่า / จองรถใหม่</option>
                                                    <option value="2">จบรถเก่า / ไม่จองรถใหม่</option>
                                                    <option value="3">ไม่จบรถเก่า / จองรถใหม่</option>
                                                    <option value="4">ไม่จบรถเก่า / ไม่จองรถใหม่</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr v-if="ecard.newcar == 3 || ecard.newcar == 2">
                                            <th scope="row">เหตุผล</th>
                                            <td> 
                                                <select v-model="ecard.newcar_detail" class="form-control">
                                                    <option value="0">= เลือกเหตุผล =</option>
                                                    <option v-if="ecard.newcar == 3" value="1">ลูกค้าไม่พร้อมขาย</option>
                                                    <option v-if="ecard.newcar == 3" value="2">ไม่ขายแล้ว</option>
                                                    <option v-if="ecard.newcar == 3" value="3">รอหาผู้ซื้อ</option>
                                                    <option v-if="ecard.newcar == 2" value="4">ลูกค้าไม่ประสงค์จะจองรถใหม่อยู่แล้ว</option>
                                                    <option v-if="ecard.newcar == 2" value="5">ยังไม่ตัดสินใจ</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">หมายเหตุ</th>
                                            <td>
                                                <textarea v-model="ecard.detail" class="form-control" rows="3"></textarea>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" @click="updateStatus" data-dismiss="modal">บันทึก</button>
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">ปิด</button>
                            </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="datatable" class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th colspan="8" >ข้อมูล Trade</th>
                                                <th colspan="6" class="bg-light-gray" >ข้อมูลขาย</th>
                                                <th>จัดการ</th>
                                            </tr>
                                            <tr>
                                                <th width="45px">รหัส</th>
                                                <th>รูป</th>
                                                <th>แบบรุ่น</th>
                                                <th>ปีรุ่น</th>
                                                <th>สี</th>
                                                <th>เซลล์</th>
                                                <th>ทีม</th>
                                                <th>สถานะ</th>
                                                <th>ผู้ซื้อ</th>
                                                <th>ราคา</th>
                                                <th>ค่าคอม</th>
                                                <th>สถานะ</th>
                                                <th>หมายเหตุ</th>
                                                <th>วันที่จบ</th>
                                                <th>จัดการ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>

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
        
        var app = new Vue({
            el: '#app',
            data: {
                ecard: {
                    id:'',
                    partner:'0',
                    price:'',
                    commission:'',
                    newcar:'0',
                    newcar_detail:'0',
                    date: '0000-00-00',
                    detail:'',
                    list: []
                },
            },
            mounted: function(){
                this.getData();
                this.initEventListeners();
            },
            methods: {
                updateStatus(){
                    if(this.ecard.partner == 0){
                        swal("ผิดพลาด", "กรุณาเลือกพันธมิตร", "error");
                        return;
                    } else
                    if(this.ecard.price == ''){
                        swal("ผิดพลาด", "กรุณากรอกราคารับซื้อ", "error");
                        return;
                    } else
                    if(this.ecard.commission == ''){
                        swal("ผิดพลาด", "กรุณากรอกค่าคอม", "error");
                        return;
                    } else
                    if(this.ecard.newcar == 0){
                        swal("ผิดพลาด", "กรุณาเลือกสถานะรอง", "error");
                        return;
                    } else
                    if(this.ecard.newcar == 3 || this.ecard.newcar == 2){
                        if(this.ecard.newcar_detail == 0){
                            swal("ผิดพลาด", "กรุณาเลือกเหตุผล", "error");
                            return;
                        }
                    } else
                    if(this.ecard.date == '0000-00-00'){
                        swal("ผิดพลาด", "กรุณาเลือกวันที่จบ", "error");
                        return;
                    } else {
                        axios.post('/admin/system/success_insert.api.php', {
                            id: this.ecard.id,
                            partner: this.ecard.partner,
                            price: this.ecard.price,
                            commission: this.ecard.commission,
                            newcar: this.ecard.newcar,
                            newcar_detail: this.ecard.newcar_detail,
                            date: this.ecard.date,
                            detail: this.ecard.detail
                        }).then(response => {
                            console.log(response.data);
                            if(response.data.updateSucc.status == 'success'){
                                swal("สำเร็จ", "บันทึกข้อมูลเรียบร้อย", "success");
                                $('#datatable').DataTable().ajax.reload(); // Reload the DataTable
                            } else {
                                swal("ผิดพลาด", "ไม่สามารถบันทึกข้อมูลได้", "error");
                            }
                        }).catch(error => {
                            console.error(error);
                        });
                    }
                    
                },
                getEcard(event) {
                    axios.get('/admin/system/success-info.api.php?id=' + event.target.getAttribute('data-ecard'))
                        .then(response => {
                            //console.log(response.data);
                            this.ecard.list = response.data.data;
                            this.ecard.id = response.data.jobData.id;
                            this.ecard.partner = response.data.jobData.partner;
                            this.ecard.price = response.data.jobData.price;
                            this.ecard.commission = response.data.jobData.commission;
                            this.ecard.newcar = response.data.jobData.newcar;
                            this.ecard.newcar_detail = response.data.jobData.newcar_detail;
                            this.ecard.date = response.data.jobData.date;
                            this.ecard.detail = response.data.jobData.detail;
                        })
                        .catch(error => {
                            console.error(error);
                        });

                    let ecardId = event.target.getAttribute('data-ecard');
                    $('#exampleModal').modal('show');
                },
                getData(){
                    $('#datatable').DataTable({
                        ajax: '/admin/system/report-success.api.php',
                        pageLength: 10,
                        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
                        processing: true,
                        serverSide: true,
                        responsive: true,
                        bInfo: false,
                        order: [[0, "desc"]],
                        language: {
                            "processing": "กำลังดาวน์โหลดข้อมูล...",
                            "search": "ค้นหา:",
                            "lengthMenu": "แสดง _MENU_ รายการ",
                        },
                        dom: 'lBfrtip',
                        buttons: [
                            'copy', 'print'
                        ],
                        search: {
                            "regex": true,
                            "smart": false,
                        },
                    });
                },
                initEventListeners() {
                    document.addEventListener('click', (event) => {
                        if (event.target.classList.contains('ecard-btn')) {
                            this.getEcard(event);
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
