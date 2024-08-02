<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Trade-In Admin Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="A77" name="description" />
    <meta content="A77" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="/assets/images/favicon.ico">

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
        .avatar-line {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div id="layout-wrapper">
        
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid" v-if="lineUid !== ''">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">เพิ่มสมาชิกใหม่ (ผู้ดูแล)</h4>
                                
                            </div>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="avatar-line">
                                        <img :src="lineImg" alt="" class="avatar">
                                    </div>
                                    <div>
                                        <p>ชื่อไลน์ของคุณ : {{ lineName }}</p>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" v-model="nameSys" placeholder="ชื่อของคุณที่ใช้งานระบบ">
                                        <button class="btn btn-primary mt-2" @click="sendData">บันทึก</button>
                                    </div>

                                </div> 
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
      

    </div>
  
    <div class="menu-overlay"></div>

    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/metismenu.min.js"></script>
    <script src="/assets/js/waves.js"></script>
    <script src="/assets/js/simplebar.min.js"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.1/axios.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script src="https://static.line-scdn.net/liff/edge/versions/2.9.0/sdk.js"></script>
    <script>
            var regis = new Vue({
                el: '#layout-wrapper',
                data: {
                    lineName: '',
                    lineImg: '/assets/images/users/avatar-1.jpg',
                    lineUid: '',
                    nameSys: ''
                },
                mounted() {
                    this.lineLogin();
                },
                methods: {

                    lineLogin() {
                        liff.init({ liffId: "2003233824-RwQD0nL0" }, () => {
                            if (liff.isLoggedIn()) {
                                liff.getProfile().then(profile => {
                                    
                                    this.lineName = profile.displayName;
                                    this.lineImg = profile.pictureUrl;
                                    this.lineUid = profile.userId;
                                    
                                }).catch(err => console.error(err));
                            } else {
                                liff.login();
                            }
                        }, err => console.error(err.code, error.message));
                    },
                    sendData () {
                        if(this.lineName == '' || this.lineUid == '' || this.nameSys == ''){
                            swal("เกิดข้อผิดพลาด", "กรุณากรอกชื่อของคุณที่ใช้งานระบบ", "warning",{ 
                                    button: "ตกลง"
                                }
                            );

                        } else {

                            axios.post('/admin/system/line_regis.inc.php', {
                                lineUid: this.lineUid,
                                lineImg: this.lineImg,
                                nameSys: this.nameSys
                            }).then(response => {

                                if(response.data.status == 'success'){
                                    swal("สำเร็จ", "บันทึกข้อมูลเรียบร้อย รอการอนุมัติจากผู้ดูแลระบบ", "success",{ 
                                        button: "ตกลง"
                                    }).then(() => {
                                        window.location.href = '/access';
                                    });
                                } else {
                                    swal("เกิดข้อผิดพลาด", response.data.message, "error",{ 
                                        button: "ตกลง"
                                    });
                                }

                            }).catch(err => {
                                swal("เกิดข้อผิดพลาด", response.data.message, "error",{ 
                                    button: "ตกลง"
                                });

                            });

                        }
                    }
                }
            });

        </script>

    <script src="/assets/js/theme.js"></script>

</body>

</html>