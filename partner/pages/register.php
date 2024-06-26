<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>พันธมิตรรถมือสอง</title>
    <meta name="description" content="เราเป็นตัวกลางที่จะหาผู้ซื้อและผู้ขายรถยนต์มือสอง รถมือสอง">
    <link href="/public/assets/css/style.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @media (min-width: 576px) {
            .container {
                max-width: 480px;
            }
        }
        html {
            background-color: #000;
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
            .col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
                position: relative;
                width: 100%;
                min-height: 1px;
                padding-right: 30px;
                padding-left: 30px;
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
        .profile-avatar {
            width: 165px;
            height: 165px;
            border-radius: 50%;
        }
        .profile {
            margin: 60px 0 30px 0;
            text-align: center;
        }
        .from-register {
            padding-bottom: 60px;
        }
    </style>
  </head>
  <body>
    <div class="line-green"></div>

        <div class="container" id="detail">

            <div class="col profile">
                <img :src="profile.userImg" class="profile-avatar">
            </div>

            <div class="col from-register">

                <div class="form-group">
                    <label for="car-id">ชื่อธุรกิจของคุณ</label>
                    <input type="text" maxlength="96" v-model="send.bus_name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="car-id">ชื่อจริง (ผู้ใช้งาน)</label>
                    <input type="text" maxlength="64" v-model="send.pt_fname" class="form-control">
                </div>

                <div class="form-group">
                    <label for="car-id">นามสกุล (ผู้ใช้งาน)</label>
                    <input type="text" maxlength="64" v-model="send.pt_lname" class="form-control">
                </div>

                <div class="form-group">
                    <label for="car-id">เบอร์โทรศัพท์</label>
                    <input type="text" id="numbers-only" maxlength="10" v-model="send.tel" class="form-control">
                </div>

                <div class="form-group">
                    <button class="btn btn-success" @click="sendData">สมัครสมาชิก</button>
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
    <script src="https://static.line-scdn.net/liff/edge/versions/2.9.0/sdk.js"></script>
    <script>
     
        var detail = new Vue({
            el: '#detail',
            data () {
                return {
                    profile: {
                        userImg: ''
                    },
                    send: {
                        userId: '',
                        bus_name: '',
                        pt_fname: '',
                        pt_lname: '',
                        tel: ''
                    }
                }
            },
            mounted () {
                this.getLineLogin();
                this.numOnly();
            },
            methods: {
                getLineLogin() {

                    liff.init({ liffId: "2003233824-jgPyN2mN" }, () => {
                        if (liff.isLoggedIn()) {
                                liff.getProfile().then(profile => {
                                    
                                this.send.userId = profile.userId;
                                this.profile.userImg = profile.pictureUrl;

                            }).catch(err => console.error(err));
                        } else {
                            liff.login();
                        }
                    }, err => console.error(err.code, error.message));

                },
                numOnly() {
                    var inputField = document.querySelector('#numbers-only');

                    inputField.onkeydown = function(event) {
                        if(isNaN(event.key) && event.key !== 'Backspace') {
                            event.preventDefault();
                        }
                    };
                },
                sendData() {
                    if(this.send.bus_name == '' || this.send.bus_name == null || this.send.pt_fname == '' || this.send.pt_fname == null || this.send.pt_lname == '' || this.send.pt_lname == null || this.send.tel.length < 9 || this.send.tel.length > 10 || this.send.tel == '' || this.send.tel == null){
                        swal("ไม่สามารถทำรายการได้", "กรุณากรอกข้อมูลให้ถูกต้องครบถ้วน ก่อนทำการสมัครสมาชิก", "warning");
                        return;
                    } else if(this.send.userId == '' || this.send.userId == null ) {
                        swal("กรุณาเข้าสู้ระบบ", "โปรดเข้าสูระบบด้วย Line Login ก่อนจึงจะสามารถทำรายการได้", "warning");
                        return;
                    } else {
                        axios.post('/partner/system/register.inc.php', 
                            uid = this.send.userId,
                            img_profile = this.profile.userImg,
                            bus_name = this.send.bus_name,
                            pt_fname = this.send.pt_fname,
                            pt_lname = this.send.pt_lname,
                            tel = this.send.tel
                        ).then(res => {
                            if(res.data.status == 200){
                                swal("สมัครสมาชิกสำเร็จ", "ขอบคุณที่สมัครสมาชิกกับเรา หากมีการตรวจสอบข้อมูลแล้วเสร็จระบบจะแจ้งผลการสมัครผ่าน Line OA นี้", "success");

                            } else if(res.data.status == 400) {
                                swal("ไม่สามารถทำรายการได้", res.data.message, "warning");
                            }
                        }).catch(err => console.error(err));
                    }
                }
               
            }
        });

    </script>
  </body>
</html>