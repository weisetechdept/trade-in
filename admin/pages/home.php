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
    <title>Trade-In List</title>
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
        tr {
            height: 20px;
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
        .modal-body {
            background-color: #000;
            padding: 0rem;
        }
        .e-card-bg {
            background-image: url(/assets/images/ecard-bg.png);
            background-repeat: no-repeat;
            background-position: top;
            background-size: 100% auto;
            padding: 386px 27px 25px;
            position: relative;
            width: 500px;
            min-height: 420px;
        }
        .car-thumb-ecard {
            width: 150px;
            height: 105px;
            object-fit: cover;
            border-radius: 5px;
            position: absolute;
            top: 108px;
            left: 15px;
        }
        .headline {
            position: absolute;
            color: #fff;
            font-size: 1rem;
            top: 100px;
            left: 175px;
            font-weight: 600;
        }
        .sub-headline {
            position: absolute;
            color: #fff;
            font-size: 0.8rem;
            top: 122px;
            left: 175px;
        }
        .partner-price {
            position: absolute;
            color: #64F22F;
            font-size: 2.5rem;
            top: 165px;
            left: 212px;
            font-weight: 600;
            width: 235px;
            text-align: center;
        }
        .partner-price-des {
            position: absolute;
            color: #fff;
            font-size: 0.8rem;
            top: 217px;
            left: 271px;
            text-align: center;
            line-height: 1.2;
        }
        .web-price {
            position: absolute;
            color: #64F22F;
            font-size: 1.1rem;
            top: 261px;
            left: 193px;
            font-weight: 600;
            width: 123px;
            text-align: center;
        }
        .web-price-des {
            position: absolute;
            color: #fff;
            font-size: 0.55rem;
            top: 287px;
            left: 187px;
            text-align: center;
            line-height: 1.25;
        }

        .finance-price {
            position: absolute;
            color: #64F22F;
            font-size: 1.1rem;
            top: 261px;
            left: 350px;
            font-weight: 600;
            width: 123px;
            text-align: center;
        }
        .finance-price-des {
            position: absolute;
            color: #fff;
            font-size: 0.55rem;
            top: 287px;
            left: 384px;
            text-align: center;
            line-height: 1.25;
        }
        .offer-price {
            position: absolute;
            color: #fff;
            font-size: 0.55rem;
            top: 315px;
            left: 225px;
            text-align: center;
            line-height: 1.25;
        }
        .offer-price {
            position: absolute;
            color: #fff;
            font-size: 1rem;
            top: 321px;
            left: 363px;
            text-align: center;
            line-height: 1.25;
        }
        .sale-info {
            position: absolute;
            color: #fff;
            font-size: 0.6rem;
            top: 281px;
            left: 27px;
            text-align: left;
            line-height: 1.5;
        }
       .col1 {
            text-align: center;
            width: 70px;
        }
        .col2 {
            text-align: center;
            width: 138px;
        }
        .col3 {
            text-align: center;
            width: 115px;
        }
        .col4 {
            text-align: center;
            width: 119px;
        }
        .trans_table {
            color: #fff;
            font-size: 0.7rem;
        }
        #capture {
  overflow: visible !important; /* ป้องกันการตัดเนื้อหาที่เกินขอบ */
  width: 100%; 
  max-width: 800px;
  background-color: #000;
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
                                <h4 class="mb-0 font-size-18">รถยนต์</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Trade-in</a></li>
                                        <li class="breadcrumb-item active">รถยนต์</li>
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
                                <h5 class="modal-title" id="exampleModalLabel">e-Card</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="e-card-bg" id="capture">

                                    <img src="https://imagedelivery.net/FG9yH3i4rybjZWgNeKKJvA/66cdf591-5dae-4b14-f0cc-3a4a77ca5400/resize500" class="car-thumb-ecard">
                                    <p class="headline">2022 Toyota Yaris</p>
                                    <p class="sub-headline">รุ่น 1.2 E CVT ปี 2020 ทะเบียน กท 1234<br />ราคาที่ลูกค้ายอมรับได้ </p>

                                    <div class="partner-price">
                                        <p>1,000,000</p>
                                    </div>
                                    <p class="partner-price-des">ราคาจากพันธมิตรเรา<br />สูงสุด ณ 18 มี.ค. 2568</p>


                                    <div class="web-price">
                                        <p>1,200,000*</p>
                                    </div>
                                    <p class="web-price-des">ราคาคั้งขายจากเว็บไซต์<br />รถมือสองจากทั้งหมด 145 ทั่วประเทศ</p>

                                    <div class="finance-price">
                                        <p>950,000</p>
                                    </div>
                                    <p class="finance-price-des">ยอดจัดไฟแนนซ์<br />เต็มจำนวน</p>

                                    <p class="offer-price">จำนวน 10 ครั้ง</p>

                                    <p class="sale-info">
                                        รหัสรถ: 1254<br />
                                        เซลล์: นาย สมชาย ใจดี<br />
                                        ทีม: I<br />
                                        วันที่สร้าง: 18 มี.ค. 2568
                                    </p>
                                    
                                    <table class="trans_table">
                                        <tr>
                                            <td class="col1">10</td>
                                            <td class="col2">1,000,000</td>
                                            <td class="col3">AAA</td>
                                            <td class="col4">1 มี.ค. 68, 13:30</td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" id="save-btn">บันทึกภาพ</button> <button type="button" class="btn btn-secondary" id="share-btn">แชร์</button> <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
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
                                                <th width="45px">รหัส</th>
                                                <th>รูป</th>
                                                <th>เซลล์</th>
                                                <th>ทีม</th>
                                                <th>จังหวัด</th>
                                                <th>รถยนต์</th>
                                                <th>ปี</th>
                                                <th>ทะเบียน</th>
                                                <th>ราคาตั้งขาย</th>
                                                <th>ยอดจัดTLT</th>
                                                <th>ราคาที่รับได้</th>
                                                <th>เสนอราคา</th>
                                                <th>จำนวน</th>
                                                <th>ตรวจรถ</th>
                                                <th>สถานะ</th>
                                                <th width="90px">วันที่สร้าง</th>
                                                <th width="140px">จัดการ</th>
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

    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
 
    <script>
        
        var app = new Vue({
            el: '#app',
            data: {
                ecard: {
                    car: '1',
                    section: '2',
                    gen: '3'
                }
            },
            mounted: function(){
                this.getData();
                this.initEventListeners();


                async function captureImage() {
    const element = document.getElementById('capture');
    
    const canvas = await html2canvas(element, {
      scale: window.devicePixelRatio,
      useCORS: true,
      scrollY: -window.scrollY,
      windowWidth: document.documentElement.offsetWidth,
      windowHeight: document.documentElement.scrollHeight
    });

    return canvas.toDataURL('image/png');
  }

  // ฟังก์ชัน Save ภาพ
  async function saveImage() {
    const dataUrl = await captureImage();
    const link = document.createElement('a');
    link.href = dataUrl;
    link.download = 'shared-image.png';
    link.click();
  }

  // ฟังก์ชัน Share ภาพ
  async function shareImage() {
    const dataUrl = await captureImage();
    const blob = await (await fetch(dataUrl)).blob();
    const file = new File([blob], 'shared-image.png', { type: 'image/png' });

    if (navigator.canShare && navigator.canShare({ files: [file] })) {
      try {
        await navigator.share({
          files: [file],
          title: 'Shared Content',
          text: 'Check this out!',
        });
      } catch (error) {
        console.error('Error sharing:', error);
      }
    } else {
      // แชร์ผ่าน Line หรือ Messenger
      const encodedUrl = encodeURIComponent(dataUrl);
      window.open(`https://line.me/R/msg/text/?${encodedUrl}`, '_blank');
    }
  }

  // Event Listeners
  document.getElementById('share-btn').addEventListener('click', shareImage);
  document.getElementById('save-btn').addEventListener('click', saveImage);
    
 
            },
            methods: {
                getEcard(event) {
                    let ecardId = event.target.getAttribute('data-ecard');
                    //swal(`Good job! ${ecardId}`, "You clicked the button!", "success");
                    $('#exampleModal').modal('show');
                },
                getData(){
                    $('#datatable').DataTable({
                        ajax: '/admin/system/home-copy.api.php',
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
