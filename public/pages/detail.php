<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>พ่อสื่อรถมือสอง</title>
    <meta name="description" content="เราเป็นตัวกลางที่จะหาผู้ซื้อและผู้ขายรถยนต์มือสอง พ่อสื่อรถมือสอง">
    <link href="/public/assets/css/style.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @media (min-width: 576px) {
            .container {
                max-width: 768px;
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
            height: 5px;
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
            border-bottom: 1px solid #fff;
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
        
    </style>
  </head>
  <body>
    <div class="line-green"></div>
    <div class="container">
        
        <div class="mt-4" id="detail">
            <div class="col-lg-12">
                <h3 class="mb-0">{{ detail.car_year }} {{ detail.brand }} {{ detail.section }}</h3>

                <div class="share-button">
                    <button class="btn btn-success" data-sharer="line" :data-title="'พ่อสื่อออนไลน์ รหัส ID : '+ detail.id" :data-url="detail.link"><i class="fa-regular fa-share-from-square"></i></button>
                </div>
                
                <div class="headline-des">
                    <h4>รายละเอียด</h4>
                    <h4 class="car-id">รหัส ID : {{ detail.id }}</h4>
                </div>
                <h5>ราคาที่ลูดค้าต้องการ :</h5>

                <div class="price-label">
                    <h2 class="price">฿ {{ detail.price }}</h2>
                </div>

                <table class="table table-sm">
                    <tbody>
                        <tr>
                            <th scope="row">ยี่ห้อ</th>
                            <td>{{ detail.brand }}</td>
                        </tr>
                        <tr>
                            <th scope="row">รุ่น</th>
                            <td>{{ detail.section }}</td>
                        </tr>
                        <tr>
                            <th scope="row">ปี</th>
                            <td>{{ detail.car_year }}</td>
                        </tr>
                        <tr>
                            <th scope="row">สี</th>
                            <td>{{ detail.color }}</td>
                        </tr>
                        <tr>
                            <th scope="row">จำนวนประตู</th>
                            <td>{{ detail.door }}</td>
                        </tr>
                        <tr>
                            <th scope="row">แถวที่นั่ง</th>
                            <td>{{ detail.seat }}</td>
                        </tr>
                        <tr>
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

                <div class="spacer-single"></div>
        <!--
                <h4>Features</h4>
                <ul class="ul-style-2">
                    <li>Bluetooth</li>
                    <li>Multimedia Player</li>
                    <li>Central Lock</li>
                    <li>Sunroof</li>
                </ul>
        -->
            </div>
            <div class="col-lg-6">
                <h4>รูปภาพ</h4>
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
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sharer.js@latest/sharer.min.js"></script>
   
    <script>
        var detail = new Vue({
            el: '#detail',
            data () {
                return {
                    img: [],
                    detail: []
                }
            },
            mounted () {
                axios.get('/public/system/detail.api.php?id=<?php echo $id ?>')
                    .then(response => (
                        this.img = response.data.img,
                        this.detail = response.data.detail
                    ))
            }
        });

    </script>
  </body>
</html>