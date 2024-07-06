<?php
    session_start();
    date_default_timezone_set("Asia/Bangkok");

    if(!isset($_SESSION['tin_partner']) && $_SESSION['partner_id'] !== ''){
        header('Location: /404');
    } else {

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>รถมือสอง</title>
    <meta name="description" content="เราเป็นตัวกลางที่จะหาผู้ซื้อและผู้ขายรถยนต์มือสอง รถมือสอง">
    <link href="/public/assets/css/style.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @media (min-width: 576px) {
            .container {
                max-width: 580px;
            }
        }
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #000;
            color: #fff;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Kanit', sans-serif;
            color: #fff;
        }
        .head {
            padding-top: 50px;
        }
        .de-spec .d-value {
            font-weight: 600;
            color: #fff;
        }
        .line-green {
            background: rgb(55,238,25);
            background: linear-gradient(0deg, rgba(55,238,25,1) 0%, rgba(16,155,2,1) 100%);
            /* height: 5px; */
        }
        .price-label {
            background-color: #363636;
            text-align: center;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        .headline-des {
            display: flex;
            justify-content: space-between;
            /* border-bottom: 1px solid #fff; */
            margin-bottom: 15px;
        }
        .car-id {
            color: rgba(55,238,25,1);
        }
        .de-spec span {
            width: 110px;
            display: inline-block;
        }
        table tr {
            color: #fff;
        }
       
        @media only screen and (max-width: 767px){
            .container {
                padding-left: 0px;
                padding-right: 0px;
            }
        }

        .share-button button {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            background-color: #fff;
            color: #000;
        }
        .share-button {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 15px;
        }
        .download-button {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 15px;
        }
        .offer img {
            width: 100%;
        }
        .cal-com {
            
        }
        .offer-box {
            padding: 15px;
            background-color: #505050;
            border-radius: 0 0 10px 10px;
        }
        .sendOfferBtn {
            text-align: center;
        }
        .OfferCost {
            background-color: #363636;
            text-align: center;
            padding: 10px;
            font-size: 20px;
            border-radius: 10px;
            margin-bottom: 5px;
        }
        .cal-com a {
            color: rgba(55, 238, 25, 1);
        }
        .cal-com a:hover {
            color: rgba(55, 238, 25, 1);
        }
        .cal-com a:active {
            color: rgba(55, 238, 25, 1);
        }
        .heading {
            color: rgba(55, 238, 25, 1);
        }
        .pt-nav {
            display: flex;
            justify-content: flex-end;
            padding: 10px;
        }
        .pt-nav .avatar {
            border-radius: 50%;
            width: 40px;
        }
        .pt-nav .username {
            margin-right: 15px;
            margin-top: 7px;
        }
    </style>
  </head>
  <body>
    <div class="line-green">
        <div class="container">
            <div class="pt-nav">
                <p class="mb-0 username"><?php echo $_SESSION['partner_name'];?></p>
                <img class="avatar" src="<?php echo $_SESSION['partner_img'];?>">
            </div>
        </div>
    </div>
    <div class="container">
        
        <div class="mt-4" id="detail">
            <div class="col-lg-12">
                <h3 class="mb-0">{{ detail.car_year }} {{ detail.brand }} {{ detail.section }}</h3>

                <div class="share-button">
                    <button class="btn btn-success" data-sharer="line" :data-title="'รถออนไลน์ รหัส ID : '+ detail.id" :data-url="detail.link"><i class="fa-regular fa-share-from-square"></i></button>
                </div>
                
                <div class="headline-des">
                    <h4 class="heading">รายละเอียด</h4>
                    <h4 class="car-id">รหัส ID : {{ detail.id }}</h4>
                </div>

                <table class="table table-sm">
                    <tbody>
                        <tr>
                            <th scope="row" width="170px">ยี่ห้อ</th>
                            <td>{{ detail.brand }}</td>
                        </tr>
                        <tr>
                            <th scope="row">รุ่น</th>
                            <td>{{ detail.serie }}</td>
                        </tr>
                        <tr>
                            <th scope="row">เกรด</th>
                            <td>{{ detail.section }}</td>
                        </tr>
                        <tr>
                            <th scope="row">ปี</th>
                            <td>{{ detail.reg_year }}</td>
                        </tr>
                        <tr>
                            <th scope="row">สี</th>
                            <td>{{ detail.color }}</td>
                        </tr>
                        <tr v-if="detail.type == 2">
                            <th scope="row">จำนวนประตู</th>
                            <td>{{ detail.door }}</td>
                        </tr>
                        <tr>
                            <th scope="row">แถวที่นั่ง</th>
                            <td>{{ detail.seat }}</td>
                        </tr>
                        <tr v-if="detail.type == 2">
                            <th scope="row">ระบบขับเคลื่อน</th>
                            <td>{{ detail.drive }}</td>
                        </tr>
                        <tr>
                            <th scope="row">เชื้อเพลิง</th>
                            <td>{{ detail.fuel }}</td>
                        </tr>
                        <tr>
                            <th scope="row">ขนาดเครื่องยนต์ (CC.)</th>
                            <td>{{ detail.engine }}</td>
                        </tr>
                        <tr>
                            <th scope="row">เลขไมล์</th>
                            <td>{{ detail.mileage }}</td>
                        </tr>
                        <tr>
                            <th scope="row">เกียร์</th>
                            <td>{{ detail.transmission }}</td>
                        </tr>
                        <tr>
                            <th scope="row">สภาพรถ</th>
                            <td>{{ detail.condition }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-5">
                    <h4 class="heading">ข้อมูลเกี่ยวกับเจ้าของรถ</h4>
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <th scope="row" width="170px">ปัจจุบันรถอยู่จังหวัด</th>
                                <td>{{ detail.pv }}</td>
                            </tr>
                            <tr>
                                <th scope="row">สถานะไฟแนนซ์</th>
                                <td>{{ detail.fin }}</td>
                            </tr>
                            <tr>
                                <th scope="row">ความพร้อมปล่อยรถ</th>
                                <td>{{ detail.ready }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="offer mt-3">
                    <a href="/partner/offer/{{ detail.id }}"><img src="/partner/assets/images/offer-price.png"></a>
                </div>

                <div class="offer-box">

                    <div class="form-group">
                        <h4>ราคาที่คุณจะเสนอ</h4>
                        <input type="text" class="form-control" v-model="cal.price" @change="calTotal" placeholder="ใส่ราคาที่คุณต้องการ">

                        <div class="cal-com mt-4">
                            <h4 class="mb-0">จำนวนเงินที่คุณต้องจ่าย</h4>
                            <label><a href="#" class="link">*อัตราค่าคอมมิชชั่น</a> ค่าธรรมเนียม และอื่นๆ</label>
                        </div>
                        
                        <table class="table table-sm mb-4">
                            <tbody>
                                <tr>
                                    <td scope="row" width="150px">ราคาที่คุณเสนอ</td>
                                    <td>{{ cal.price_display }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">ค่าคอมมิชชั่น*</td>
                                    <td>{{ cal.commission }}</td>
                                </tr>
                            </tbody>
                        </table>
                        

                        <div class="OfferCost">
                            ค่าใช้จ่ายทั้งหมด (บาท)
                            <h2 class="mb-0">{{ cal.total }}</h2>
                        </div>
                        <div class="sendOfferBtn">
                            <button type="button" @click="sendOf" class="btn btn-success mt-3">ส่งข้อเสนอ</button>
                        </div>
                    </div>
                </div>

                <div class="offer-history mt-4 mb-4">
                    <h4 class="heading">ประวัติการเสนอราคาของคุณ</h4>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">ราคาที่เสนอ</th>
                                <th scope="col">วันที่</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="hist in history">
                                <td>{{ hist.price }}</td>
                                <td>{{ hist.datetime }}</td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>

                <div class="spacer-single"></div>
        
            </div>
            <div class="col-lg-12">
                <div class="headline-des">
                    <h4>รูปภาพ</h4>
                </div>
            </div>

            <div class="line-green"></div>
            <div v-for="images in img" class="">
                <img :src="images" style="width:100%;">
            </div>
            
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.1/axios.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sharer.js@latest/sharer.min.js"></script>
   
    <script>
        var detail = new Vue({
            el: '#detail',
            data () {
                return {
                    img: [],
                    detail: [],
                    history: [],
                    cal: {
                        price: '',
                        commission: 0,
                        total: 0,
                        price_display: ''
                    }
                }
            },
            mounted () {
                axios.get('/partner/system/detail.api.php?id=<?php echo $id; ?>')
                    .then(response => {
                        if (response.data.detail.share == 1) {
                            this.img = response.data.img;
                            this.detail = response.data.detail;
                            this.history = response.data.history;
                        } else {
                            swal("Detail not found", "Please try again", "error",{
                                button: "OK",
                            }).then((value) => {
                                window.location.href = '/404';
                            });
                        }
                    })
            },
            watch: {
                cal: {
                    handler: function() {
                        this.calTotal();
                    },
                    deep: true
                }
            },
            methods: {
                sendOf() {
                    if(this.cal.price == '') {
                        swal("กรุณากรอกราคาที่ต้องการเสนอ", "Please try again", "error",{
                            button: "OK",
                        });
                    } else if(this.cal.price.length <= 4) {
                        swal("ไม่สามรถทำรายการได้", "เนื่องจากคุณให้ราคาน้อยเกินไป โปรดทำรายการอีกครั้ง", "error",{
                            button: "OK",
                        });
                    } else {
                        swal({
                            title: 'คุณแน่ใจหรือไม่',
                            text: "โปรดตรวจสอบข้อมูลให้ถูกต้อง เพื่อยืนยันการส่งราคาของคุณ",
                            icon: "info",
                            buttons: true,
                            dangerMode: true,
                        }).then((wilOkay) => {
                            if (wilOkay) {
                                axios.post('/partner/system/noti_offer.inc.php', {
                                    id: this.detail.id,
                                    price: this.cal.price,
                                    commission: this.cal.commission,
                                    total: this.cal.total,
                                    parent: <?php echo $_SESSION['partner_id']; ?>
                                })
                                .then(response => {
                                    if(response.data.status == '200') {
                                        swal("สำเร็จ", "ส่งข้อเสนอเรียบร้อย", "success",{
                                            button: "OK",
                                        }).then((value) => {
                                            window.location.reload();
                                        });
                                    } else if (response.data.status == '400'){
                                        swal("ไม่สำเร็จ", "Please try again", "error",{
                                            button: "OK",
                                        });
                                    }
                                })
                            }
                        });
                    } 
                },
                calTotal() {
                    if(this.cal.price <= 100000) {
                        var interest = 6000;
                    }else if(this.cal.price > 100000 && this.cal.price <= 200000) {
                        var interest = 9000;
                    }else if(this.cal.price > 200000 && this.cal.price <= 500000) {
                        var interest = 11000;
                    } else if(this.cal.price > 500000){
                        var interest = 13000;
                    }

                    this.cal.price_display = this.cal.price.toLocaleString();
                    this.cal.commission = interest.toLocaleString();
                    this.cal.total = (parseInt(this.cal.price) + parseInt(interest)).toLocaleString();
                }
            }
        });

    </script>
  </body>
</html>

<?php  }  ?>