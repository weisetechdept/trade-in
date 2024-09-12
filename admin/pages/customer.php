
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Prospect Customer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/theme.min.css" rel="stylesheet" type="text/css" />

    <link href="/assets/plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@100;200;300;400;500;600;700;800&family=Kanit:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Chakra Petch', sans-serif;
        }
        .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
            font-family: 'Kanit', sans-serif;
            font-weight: 400;
        }
        .car-thumb {
            width: 85px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>

</head>

<body>
    <div id="layout-wrapper">

        <?php include 'inc-pages/nav.php'; ?>
        <?php include 'inc-pages/sidebar.php'; ?>

        
        <div class="main-content">

            <div class="page-content" id="newApp">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">ลูกค้ามุ่งหวัง</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Trade-in</a></li>
                                        <li class="breadcrumb-item active">ลูกค้ามุ่งหวัง</li>
                                    </ol>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="card">
                                <div class="card-body">

                                    <button type="button" class="btn btn-block btn-primary waves-effect waves-light" @click="addNew" data-toggle="modal" data-target="#exampleModal">
                                        เพิ่มลูกค้ามุ่งหวัง
                                    </button>

                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มลุกค้ามุ่งหวัง</h5>
                                                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label class="control-label">ID รถยนต์</label><br />
                                                        <select class="form-control search-sales"></select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">ชื่อลูกค้า</label>
                                                        <input class="form-control" type="text" v-model="selected.name">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">รายละเอียด</label>
                                                        <textarea class="form-control" type="text" v-model="selected.detail"></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">เบอร์โทร</label>
                                                        <input class="form-control" type="text" v-model="selected.tel">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">ไลน์ไอดี</label>
                                                        <input class="form-control" type="text" v-model="selected.line">
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="control-label">สถานะลูกค้า</label>
                                                        <select class="form-control" v-model="selected.status">
                                                            <option value="0">= เลือกสถานะลูกค้า =</option>
                                                            <option value="1">HOT (ต้องการซื้อภายใน 7 วัน)</option>
                                                            <option value="2">WORM (ต้องการซื้อภายใน 7 - 30 วัน)</option>
                                                            <option value="3">COOL (ต้องการซื้อมากกว่า 30 วัน)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary waves-effect waves-light" @click="AddCustomer">บันทึก</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลลุกค้ามุ่งหวัง</h5>
                                                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label class="control-label">ID รถยนต์ที่ต้องการแก้ไข</label><br />
                                                        <p>{{edit.carId}}</p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">รายละเอียด</label>
                                                        <textarea class="form-control" type="text" v-model="selected.detail"></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">เบอร์โทรติดต่อ</label>
                                                        <input class="form-control" type="text" v-model="selected.detail">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Line ID ติดต่อ</label>
                                                        <input class="form-control" type="text" v-model="selected.detail">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">สถานะลูกค้า</label>
                                                        <select class="form-control" v-model="selected.status">
                                                            <option value="0">= เลือกสถานะลูกค้า =</option>
                                                            <option value="1">HOT (ต้องการซื้อภายใน 7 วัน)</option>
                                                            <option value="2">WORM (ต้องการซื้อภายใน 7 - 30 วัน)</option>
                                                            <option value="3">COOL (ต้องการซื้อมากกว่า 30 วัน)</option>
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary waves-effect waves-light" @click="AddCustomer">บันทึก</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="datatable" class="table dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th width="45px">รหัส</th>
                                                <th width="120px">รูป</th>
                                                <th>รหัสรถ ID</th>
                                                <th>ชื่อลูกค้า</th>
                                                <th>รายละเอียด</th>
                                                <th>โทรติดต่อ</th>
                                                <th>ติดต่อ Line</th>
                                                <th>สถานะ</th>
                                                <th>วันที่เพิ่ม</th>
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
                                            </tr>
                                        </tbody>
                                    </table>

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
                            2019 © Xacton.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block">
                                Design & Develop by Weise Technika
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script src="/assets/js/theme.js"></script>
    <script>
        var App = new Vue({
            el: '#newApp',
            data: {
                car: [],
                selected: {
                    car: '0',
                    name: '',
                    detail: '',
                    tel: '',
                    line: '',
                    status: '0',
                },
                edit: {
                    carId: '',
                    detail: '',
                    tel: '',
                    line: '',
                    status: '0',
                }
            },
            mounted() {

                $('#datatable').DataTable({
                    ajax: '/admin/system/customer-list.api.php',
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
                    search: {
                        "regex": true,
                        "smart": false,
                    },
                });
                
            },
            methods: {
                deleteCust() {
                    swal({
                        title: "คุณแน่ใจหรือไม่?",
                        text: "คุณต้องการลบข้อมูลลูกค้านี้ใช่หรือไม่?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            axios.post('/admin/system/delete-customer.inc.php', {
                                id: e
                            }).then(function(response) {
                                if(response.data.status == 'success'){
                                    swal("สำเร็จ", response.data.message, "success");
                                    $('#datatable').DataTable().ajax.reload();
                                }else{
                                    swal("ผิดพลาด", response.data.message, "error");
                                }
                            });
                        }
                    });
 
                },
                addNew() {
                    axios.post('/admin/system/add-customer.api.php').then(function(response) {

                        $('.search-sales').select2({
                            data: response.data.car
                        });

                        $('.search-sales').on('change', function(e) {
                            App.selected.car = e.target.value;
                        });

                    });
                },
                AddCustomer() {
                    if(this.selected.car == '0'){
                        swal("ผิดพลาด", "กรุณาเลือก ID รถยนต์", "error");
                        return;
                    } else if(this.selected.name == ''){
                        swal("ผิดพลาด", "กรุณากรอกชื่อลูกค้า", "error");
                        return;
                    } else if(this.selected.detail == ''){
                        swal("ผิดพลาด", "กรุณากรอกรายละเอียด", "error");
                        return;
                    } else if(this.selected.status == '0'){
                        swal("ผิดพลาด", "กรุณาเลือกสถานะลูกค้า", "error");
                        return;
                    } else {3

                        axios.post('/admin/system/add-customer.inc.php', {
                            car: this.selected.car,
                            name: this.selected.name,
                            detail: this.selected.detail,
                            tel: this.selected.tel,
                            line: this.selected.line,
                            status: this.selected.status
                        }).then(function(response) {
                            if(response.data.status == 'success'){
                                swal("สำเร็จ", response.data.message, "success");
                                $('#exampleModal').modal('hide');
                                $('#datatable').DataTable().ajax.reload();
                            }else{
                                swal("ผิดพลาด", response.data.message, "error");
                            }
                        });

                    }
                    
                }
            }
        });
    </script>

</body>

</html>