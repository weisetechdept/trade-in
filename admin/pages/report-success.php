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
        
        /* Custom styles for column search */
        .column-search-row th {
            padding: 5px !important;
            border-bottom: 1px solid #dee2e6;
        }
        .column-search-row .form-control,
        .column-search-row .form-control-sm {
            font-size: 11px;
            padding: 0.25rem 0.5rem;
            height: auto;
        }
        .column-search-row select.form-control {
            font-size: 11px;
        }
        #datatable_wrapper .dataTables_filter {
            display: none; /* ซ่อน global search */
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
                        <div class="row mb-3">
                            <div class="col-12">
                                <button type="button" class="btn btn-outline-primary" @click="loadData('0,1,2,3,4')">
                                    ทั้งหมด
                                </button>
                                <button type="button" class="btn btn-outline-primary" @click="loadData('1')">
                                    ติดตามลูกค้า
                                </button>
                                <button type="button" class="btn btn-outline-warning" @click="loadData('2')">
                                    ไม่ได้สัมผัสรถ
                                </button>
                                <button type="button" class="btn btn-outline-info" @click="loadData('3')">
                                    ลูกค้าขายเอง / ขายที่อื่น
                                </button>
                                <button type="button" class="btn btn-outline-success" @click="loadData('4')">
                                    สำเร็จ
                                </button>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
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
                                                    <th scope="row">วันที่สร้าง</th>
                                                    <td></td>
                                                </tr>
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
                                                    <td><input v-model="ecard.price" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">ค่าคอม</th>
                                                    <td><input v-model="ecard.commission" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">วันที่จบ</th>
                                                    <td><input v-model="ecard.date" class="form-control" type="date" :value="ecard.date !== '0000-00-00' ? ecard.date : ''"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">สถานะรอง</th>
                                                    <td>
                                                        <select v-model="ecard.newcar" class="form-control">
                                                            <option value="0">= เลือกสถานะรอง =</option>
                                                            <option value="1">จบรถเก่า / จองรถใหม่</option>
                                                            <option value="2">จบรถเก่า / ไม่จองรถใหม่</option>
                                                            <option value="3">ไม่จบรถเก่า / ไม่จองรถใหม่</option>
                                                            <option value="4">ไม่จบรถเก่า / จองรถใหม่</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr v-if="ecard.newcar == 3 || ecard.newcar == 2 || ecard.newcar == 4 || ecard.newcar == 1">
                                                    <th scope="row">เหตุผล</th>
                                                    <td>
                                                        <select v-model="ecard.newcar_detail" class="form-control">
                                                            <option value="0">= เลือกเหตุผล =</option>
                                                            <option v-if="ecard.newcar == 4 || ecard.newcar == 3" value="8">ติดตามต่อ</option>
                                                            <option v-if="ecard.newcar == 4 || ecard.newcar == 3" value="9">ขายเองที่อื่นแล้ว</option>
                                                            <option v-if="ecard.newcar == 4 || ecard.newcar == 3" value="10">เปลี่ยนใจไม่ขาย</option>
                                                            <option v-if="ecard.newcar == 3 || ecard.newcar == 2" value="11">ยังไม่พร้อมออกรถใหม่</option>
                                                            <option v-if="ecard.newcar == 4 || ecard.newcar == 3" value="12">ราคาใกล้เคียงแต่ลูกค้าไม่ยอมลดราคา</option>
                                                            <option v-if="ecard.newcar == 4 || ecard.newcar == 3" value="13">ราคาใกล้เคียงแต่ลูกค้าเงียบไม่ตอบ</option>
                                                            <option v-if="ecard.newcar == 1 || ecard.newcar == 2" value="14">สำเร็จ</option>
                                                            <option v-if="ecard.newcar == 4 || ecard.newcar == 3" value="15">โพสต์ขายอยู่</option>
                                                            <option v-if="ecard.newcar == 4 || ecard.newcar == 3" value="16">เซลส์ไม่ตอบ</option>
                                                            <option v-if="ecard.newcar == 3" value="17">ราคาใกล้เคียงแต่ยังไม่จบรถใหม่</option>
                                                            <option v-if="ecard.newcar == 4 || ecard.newcar == 3" value="18">หนี้ท่วม</option>
                                                            <option v-if="ecard.newcar == 4 || ecard.newcar == 3" value="19">ลูกค้าต้องการมากกว่าราคาตั้งขาย</option>
                                                            <option v-if="ecard.newcar == 4 || ecard.newcar == 3" value="20">ลูกค้าไม่แจ้งราคาที่จะขาย</option>
                                                            <option v-if="ecard.newcar == 4 || ecard.newcar == 3" value="21">จบรถเก่าแล้ว/ลูกค้ายกเลิกขาย</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">หมายเหตุ</th>
                                                    <td>
                                                        <textarea v-model="ecard.detail" class="form-control" rows="3"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">รถใหม่ (RS)</th>
                                                    <td>
                                                        <select v-model="ecard.newcar_rs" class="form-control">
                                                            <option value="0">ยังไม่ RS</option>
                                                            <option value="1">RS แล้ว</option>
                                                        </select>
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
                                        <div class="d-flex flex-column">
                                            <table id="datatable" class="table table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th width="45px">รหัส</th>
                                                        <th>รูป</th>
                                                        <th>แบบรุ่น</th>
                                                        <th>ปีรุ่น</th>
                                                        <th>สี</th>
                                                        <th>เซลล์</th>
                                                        <th>ทีม</th>
                                                        <th>ตั้งขาย</th>
                                                        <th>จัด TLT</th>
                                                        <th>รับได้</th>
                                                        <th>เสนอราคา</th>
                                                        <th>เสนอ</th>
                                                        <th>ผู้ซื้อ</th>
                                                        <th>ราคา</th>
                                                        <th>ค่าคอม</th>
                                                        <th>สถานะรอง</th>
                                                        <th>หมายเหตุ</th>
                                                        <th>วันที่จบ</th>
                                                        <th>RS</th>
                                                        <th width="120px">จัดการ</th>
                                                    </tr>
                                                    <!-- Column Search Row -->
                                                    <tr class="column-search-row">
                                                        <th><input type="text" class="form-control form-control-sm" placeholder="รหัส"></th>
                                                        <th></th> <!-- รูป - ไม่ต้องค้นหา -->
                                                        <th><input type="text" class="form-control form-control-sm" placeholder="แบบรุ่น"></th>
                                                        <th><input type="text" class="form-control form-control-sm" placeholder="ปีรุ่น"></th>
                                                        <th><input type="text" class="form-control form-control-sm" placeholder="สี"></th>
                                                        <th>
                                                            <select class="form-control form-control-sm">
                                                                <option value="">ทุกคน</option>
                                                                <!-- จะเติมข้อมูลเซลล์ด้วย JS -->
                                                            </select>
                                                        </th>
                                                        <th>
                                                            <select class="form-control form-control-sm">
                                                                <option value="">ทุกทีม</option>
                                                                <!-- จะเติมข้อมูลทีมด้วย JS -->
                                                            </select>
                                                        </th>
                                                        <th><input type="text" class="form-control form-control-sm" placeholder="ตั้งขาย"></th>
                                                        <th><input type="text" class="form-control form-control-sm" placeholder="จัด TLT"></th>
                                                        <th><input type="text" class="form-control form-control-sm" placeholder="รับได้"></th>
                                                        <th><input type="text" class="form-control form-control-sm" placeholder="เสนอราคา"></th>
                                                        <th><input type="text" class="form-control form-control-sm" placeholder="เสนอ"></th>
                                                        <th>
                                                            <select class="form-control form-control-sm">
                                                                <option value="">ทุกคน</option>
                                                                <!-- จะเติมข้อมูลผู้ซื้อด้วย JS -->
                                                            </select>
                                                        </th>
                                                        <th><input type="text" class="form-control form-control-sm" placeholder="ราคา"></th>
                                                        <th><input type="text" class="form-control form-control-sm" placeholder="ค่าคอม"></th>
                                                        <th>
                                                            <select class="form-control form-control-sm">
                                                                <option value="">ทุกสถานะ</option>
                                                                <option value="1">จบรถเก่า / จองรถใหม่</option>
                                                                <option value="2">จบรถเก่า / ไม่จองรถใหม่</option>
                                                                <option value="3">ไม่จบรถเก่า / ไม่จองรถใหม่</option>
                                                                <option value="4">ไม่จบรถเก่า / จองรถใหม่</option>
                                                            </select>
                                                        </th>
                                                        <th><input type="text" class="form-control form-control-sm" placeholder="หมายเหตุ"></th>
                                                        <th><input type="text" class="form-control form-control-sm" placeholder="วันที่จบ"></th>
                                                        <th>
                                                            <select class="form-control form-control-sm">
                                                                <option value="">ทั้งหมด</option>
                                                                <option value="0">ยังไม่ RS</option>
                                                                <option value="1">RS แล้ว</option>
                                                            </select>
                                                        </th>
                                                        <th></th> <!-- จัดการ - ไม่ต้องค้นหา -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="20" class="text-center">กำลังโหลดข้อมูล...</td>
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
                    id: '',
                    partner: '0',
                    price: '',
                    commission: '',
                    newcar: '0',
                    newcar_detail: '0',
                    date: '',
                    detail: ' ',
                    newcar_rs: '0',
                    list: []
                },
                dataTable: null,
                filterOptions: {
                    sales: [],
                    teams: [],
                    partners: [],
                    colors: [],
                    models: [],
                    years: []
                }
            },
            mounted: function() {
                this.loadFilterOptions();
                this.getData();
                this.initEventListeners();
            },
            methods: {
                loadFilterOptions() {
                    var self = this;
                    axios.get('/admin/system/filter-options.api.php')
                        .then(response => {
                            if (response.data.success) {
                                self.filterOptions = response.data.data;
                                self.populateSelectOptions();
                            }
                        })
                        .catch(error => {
                            console.error('Error loading filter options:', error);
                        });
                },

                populateSelectOptions() {
                    var self = this;
                    
                    // เซลล์
                    var salesSelect = $('.column-search-row th').eq(5).find('select');
                    self.filterOptions.sales.forEach(function(sale) {
                        salesSelect.append(`<option value="${sale.name}">${sale.name}</option>`);
                    });
                    
                    // ทีม
                    var teamSelect = $('.column-search-row th').eq(6).find('select');
                    self.filterOptions.teams.forEach(function(team) {
                        teamSelect.append(`<option value="${team.name}">${team.name}</option>`);
                    });
                    
                    // ผู้ซื้อ
                    var partnerSelect = $('.column-search-row th').eq(12).find('select');
                    self.filterOptions.partners.forEach(function(partner) {
                        partnerSelect.append(`<option value="${partner.name}">${partner.name}</option>`);
                    });
                },

                clearAllFilters() {
                    // Clear all search inputs and selects
                    $('.column-search-row input, .column-search-row select').val('');
                    
                    // Clear DataTable column searches
                    if (this.dataTable) {
                        this.dataTable.columns().search('').draw();
                    }
                },

                loadData(stat) {
                    if (this.dataTable) {
                        // เก็บการค้นหาแต่ละคอลัมน์ไว้
                        var columnSearches = [];
                        this.dataTable.columns().every(function(index) {
                            columnSearches[index] = this.search();
                        });
                        
                        var currentPage = this.dataTable.page();
                        
                        this.dataTable.ajax.url('/admin/system/report-success.api.php?show=' + stat).load(function() {
                            // คืนค่าการค้นหาแต่ละคอลัมน์
                            this.dataTable.columns().every(function(index) {
                                if (columnSearches[index]) {
                                    this.search(columnSearches[index]);
                                }
                            });
                            
                            // คืนค่าใน input fields
                            $('.column-search-row th').each(function(index) {
                                var input = $(this).find('input, select');
                                if (input.length > 0 && columnSearches[index]) {
                                    input.val(columnSearches[index]);
                                }
                            });
                            
                            try {
                                this.dataTable.page(currentPage).draw('page');
                            } catch(e) {
                                this.dataTable.draw();
                                console.log('Could not return to previous page, staying on page 1');
                            }
                        });
                    }
                },

                updateStatus() {
                    if (this.ecard.date == '' || this.ecard.date == '0000-00-00' || this.ecard.date == null) {
                        this.ecard.date = '0000-00-00';
                    }

                    axios.post('/admin/system/success_insert.api.php', {
                        id: this.ecard.id,
                        partner: this.ecard.partner,
                        price: this.ecard.price,
                        commission: this.ecard.commission,
                        newcar: this.ecard.newcar,
                        newcar_detail: this.ecard.newcar_detail,
                        date: this.ecard.date,
                        detailStatus: this.ecard.detail,
                        newcar_rs: this.ecard.newcar_rs
                    }).then(response => {
                        console.log(response.data);
                        if (response.data.updateSucc && response.data.updateSucc.status == 'success') {
                            swal("สำเร็จ", "บันทึกข้อมูลเรียบร้อย", "success");
                            this.dataTable.ajax.reload(null, false);
                        } else {
                            swal("ผิดพลาด", "ไม่สามารถบันทึกข้อมูลได้", "error");
                        }
                    }).catch(error => {
                        console.error(error);
                        swal("ผิดพลาด", "ไม่สามารถบันทึกข้อมูลได้", "error");
                    });
                },

                getEcard(event) {
                    axios.get('/admin/system/success-info.api.php?id=' + event.target.getAttribute('data-ecard'))
                        .then(response => {
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

                    $('#exampleModal').modal('show');
                },

                getData() {
                    var self = this;
                    
                    this.dataTable = $('#datatable').DataTable({
                        ajax: {
                            url: '/admin/system/report-success.api.php',
                            dataSrc: function(json) {
                                console.log('AJAX response:', json);
                                return json.data;
                            }
                        },
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
                            "emptyTable": "ไม่มีข้อมูลในตาราง",
                            "zeroRecords": "ไม่พบข้อมูลที่ค้นหา"
                        },
                        dom: 'lBfrtip',
                        buttons: [
                            'copy', 'print',
                            {
                                text: 'ล้างตัวกรอง',
                                action: function (e, dt, node, config) {
                                    self.clearAllFilters();
                                }
                            }
                        ],
                        search: {
                            "regex": true,
                            "smart": false,
                        },
                        initComplete: function() {
                            var api = this.api();
                            
                            // Setup column search
                            api.columns().every(function(index) {
                                var column = this;
                                var input = $('.column-search-row th').eq(index).find('input, select');
                                
                                if (input.length > 0) {
                                    input.on('keyup change clear', function() {
                                        var value = this.value;
                                        if (column.search() !== value) {
                                            column.search(value).draw();
                                        }
                                    });
                                    
                                    // สำหรับ input text ให้ค้นหาเมื่อพิมพ์
                                    if (input.is('input[type="text"]')) {
                                        input.on('keyup', function() {
                                            var value = this.value;
                                            if (column.search() !== value) {
                                                column.search(value).draw();
                                            }
                                        });
                                    }
                                }
                            });
                            
                            console.log('DataTable initialized with column search');
                        }
                    });
                },

                initEventListeners() {
                    var self = this;
                    document.addEventListener('click', (event) => {
                        if (event.target.classList.contains('ecard-btn')) {
                            self.getEcard(event);
                        }
                    });
                }
            }
        });
    </script>

    <script src="/assets/js/theme.js"></script>
</body>
</html>