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
            padding: calc(70px + 24px) calc(15px) 70px calc(15px);
        }
        
        /* Table Container */
        .table-container {
            width: 100%;
            overflow-x: auto;
            background: white;
        }
        
        /* Table Styles */
        #datatable {
            width: 100% !important;
            min-width: 1800px;
            white-space: nowrap;
        }
        
        #datatable th,
        #datatable td {
            padding: 8px 6px !important;
            vertical-align: middle;
            text-align: center;
        }
        
        /* Column widths */
        #datatable th:nth-child(1), #datatable td:nth-child(1) { width: 80px; min-width: 80px; }
        #datatable th:nth-child(2), #datatable td:nth-child(2) { width: 100px; min-width: 100px; }
        #datatable th:nth-child(3), #datatable td:nth-child(3) { width: 180px; min-width: 180px; }
        #datatable th:nth-child(4), #datatable td:nth-child(4) { width: 80px; min-width: 80px; }
        #datatable th:nth-child(5), #datatable td:nth-child(5) { width: 100px; min-width: 100px; }
        #datatable th:nth-child(6), #datatable td:nth-child(6) { width: 120px; min-width: 120px; }
        #datatable th:nth-child(7), #datatable td:nth-child(7) { width: 100px; min-width: 100px; }
        #datatable th:nth-child(8), #datatable td:nth-child(8) { width: 110px; min-width: 110px; }
        #datatable th:nth-child(9), #datatable td:nth-child(9) { width: 110px; min-width: 110px; }
        #datatable th:nth-child(10), #datatable td:nth-child(10) { width: 110px; min-width: 110px; }
        #datatable th:nth-child(11), #datatable td:nth-child(11) { width: 110px; min-width: 110px; }
        #datatable th:nth-child(12), #datatable td:nth-child(12) { width: 80px; min-width: 80px; }
        #datatable th:nth-child(13), #datatable td:nth-child(13) { width: 140px; min-width: 140px; }
        #datatable th:nth-child(14), #datatable td:nth-child(14) { width: 110px; min-width: 110px; }
        #datatable th:nth-child(15), #datatable td:nth-child(15) { width: 100px; min-width: 100px; }
        #datatable th:nth-child(16), #datatable td:nth-child(16) { width: 160px; min-width: 160px; }
        #datatable th:nth-child(17), #datatable td:nth-child(17) { width: 150px; min-width: 150px; }
        #datatable th:nth-child(18), #datatable td:nth-child(18) { width: 100px; min-width: 100px; }
        #datatable th:nth-child(19), #datatable td:nth-child(19) { width: 60px; min-width: 60px; }
        #datatable th:nth-child(20), #datatable td:nth-child(20) { width: 140px; min-width: 140px; }
        
        /* Header ปกติ - เฉพาะแถวแรก */
        #datatable thead tr:first-child th {
            background: #343a40;
            color: white;
            font-weight: 500;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 10;
            cursor: pointer; /* เปิด cursor pointer สำหรับ sort */
            border-bottom: 1px solid #495057;
        }
        
        #datatable thead tr:first-child th:hover {
            background: #495057;
        }
        
        /* เพิ่ม icon hint สำหรับ sortable columns */
        #datatable thead tr:first-child th:not(:nth-child(2)):not(:nth-child(20))::after {
            content: " ⇅";
            font-size: 10px;
            opacity: 0.6;
            margin-left: 4px;
        }
        
        /* Search row styles - แยกจาก header */
        .column-search-row {
            background: #f8f9fa !important;
        }
        
        .column-search-row th {
            padding: 8px 4px !important;
            background: #f8f9fa !important;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
            position: sticky;
            top: 40px;
            z-index: 9;
            cursor: default !important; /* ปิด cursor pointer */
            border-top: 3px solid #007bff; /* เส้นสีฟ้าเพื่อแยกจากแถว sort */
        }
        
        /* ปิด sort icons ในแถว search */
        .column-search-row th::before,
        .column-search-row th::after {
            display: none !important;
        }
        
        /* ปิด hover effect สำหรับแถว search */
        .column-search-row th:hover {
            background: #f8f9fa !important;
        }
        
        /* เพิ่ม label สำหรับแถว search */
        .column-search-row th:first-child::before {
            content: "🔍 ";
            font-size: 12px;
        }
        
        .column-search-row .form-control,
        .column-search-row .form-control-sm {
            font-size: 12px;
            padding: 0.3rem 0.5rem;
            height: 32px;
            width: 100%;
        }
        
        .column-search-row select.form-control {
            font-size: 12px;
            height: 32px;
        }
        
        /* Car thumbnail */
        .car-thumb {
            width: 80px;
            height: 55px;
            object-fit: cover;
            border-radius: 4px;
        }
        
        /* Badge styles */
        .badge-soft-unknow {
            background-color: #f6b9f7;
            color: #fff;
        }
        
        .badge-soft-primary {
            background-color: #b3d7ff;
            color: #004085;
        }
        
        .badge-soft-warning {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .badge-soft-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        
        /* Hide global search */
        #datatable_wrapper .dataTables_filter {
            display: none;
        }
        
        .btn-group, .btn-group-vertical {
            margin-bottom: 15px;
        }
        
        .card-body {
            padding: 1rem;
        }
        
        .card {
            margin-bottom: 10px;
        }
        
        @media (max-width: 768px) {
            .page-content {
                padding: calc(70px + 24px) 10px 70px 10px;
            }
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
                        <!-- Status Filter Buttons -->
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
                            <div class="modal-dialog modal-lg">
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

                        <!-- Table -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-container">
                                            <table id="datatable" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>รหัส</th>
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
                                                        <th>จัดการ</th>
                                                    </tr>
                                                    <!-- Column Search Row -->
                                                    <tr class="column-search-row">
                                                        <th><input type="text" class="form-control form-control-sm" placeholder="รหัส"></th>
                                                        <th></th>
                                                        <th><input type="text" class="form-control form-control-sm" placeholder="แบบรุ่น"></th>
                                                        <th><input type="text" class="form-control form-control-sm" placeholder="ปีรุ่น"></th>
                                                        <th><input type="text" class="form-control form-control-sm" placeholder="สี"></th>
                                                        <th>
                                                            <select class="form-control form-control-sm">
                                                                <option value="">ทุกคน</option>
                                                            </select>
                                                        </th>
                                                        <th>
                                                            <select class="form-control form-control-sm">
                                                                <option value="">ทุกทีม</option>
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
                                                        <th></th>
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
                    partners: []
                }
            },
            mounted: function() {
                this.loadFilterOptions();
                this.getData();
                this.initEventListeners();
            },
            methods: {
                loadFilterOptions: function() {
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

                populateSelectOptions: function() {
                    var self = this;
                    
                    setTimeout(function() {
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
                    }, 500);
                },

                clearAllFilters: function() {
                    $('.column-search-row input, .column-search-row select').val('');
                    if (this.dataTable) {
                        this.dataTable.columns().search('').draw();
                    }
                },

                loadData: function(stat) {
                    if (this.dataTable) {
                        var columnSearches = [];
                        this.dataTable.columns().every(function(index) {
                            columnSearches[index] = this.search();
                        });
                        
                        var currentPage = this.dataTable.page();
                        var self = this;
                        
                        this.dataTable.ajax.url('/admin/system/report-success.api.php?show=' + stat).load(function() {
                            self.dataTable.columns().every(function(index) {
                                if (columnSearches[index]) {
                                    this.search(columnSearches[index]);
                                }
                            });
                            
                            $('.column-search-row th').each(function(index) {
                                var input = $(this).find('input, select');
                                if (input.length > 0 && columnSearches[index]) {
                                    input.val(columnSearches[index]);
                                }
                            });
                            
                            try {
                                self.dataTable.page(currentPage).draw('page');
                            } catch(e) {
                                self.dataTable.draw();
                            }
                        });
                    }
                },

                updateStatus: function() {
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

                getEcard: function(event) {
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

                getData: function() {
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
                        responsive: false,
                        bInfo: false,
                        order: [[0, "desc"]],
                        scrollX: true,
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
                        stateSave: true, // เก็บสถานะการ sort
                        initComplete: function() {
                            var api = this.api();
                            
                            api.columns().every(function(index) {
                                var column = this;
                                var input = $('.column-search-row th').eq(index).find('input, select');
                                
                                if (input.length > 0) {
                                    input.on('keyup change clear', function() {
                                        var value = this.value;
                                        if (column.search() !== value) {
                                            // ค้นหาโดยไม่เปลี่ยน sort
                                            column.search(value).draw(false);
                                        }
                                    });
                                }
                            });
                            
                            console.log('DataTable initialized with column search');
                        }
                    });
                },

                initEventListeners: function() {
                    var self = this;
                    document.addEventListener('click', function(event) {
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