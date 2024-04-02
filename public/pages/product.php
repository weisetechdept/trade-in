<?php 
    // base64_encode('456');
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <title>พ่อสื่อ - </title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta content="Admin" name="author">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    
    <link href="/public/assets/css/mdb.min.css" rel="stylesheet" type="text/css" id="mdb">
    <link href="/public/assets/css/plugins.css" rel="stylesheet" type="text/css">
    <link href="/public/assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="/public/assets/css/coloring.css" rel="stylesheet" type="text/css">
    <link id="colors" href="css/colors/scheme-01.css" rel="stylesheet" type="text/css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Kanit', sans-serif !important;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Kanit', sans-serif !important;
        }
        @media (max-width: 992px) {
            #subheader {
                padding: 80px 0 50px 0 !important;
            }
        }
        section {
            padding: 35px 0 90px 0;
            position: relative;
        }
    </style>
</head>

<body class="dark-scheme">
    <div id="wrapper">
        
        <div id="de-preloader"></div>

        <header class="transparent has-topbar">
            <div id="topbar" class="topbar-dark text-light">
                <div class="container">
                    <div class="topbar-left xs-hide">
                        <div class="topbar-widget">
                            <div class="topbar-widget"><a href="#"><i class="fa fa-phone"></i>+208 333 9296</a></div>
                            <div class="topbar-widget"><a href="#"><i class="fa fa-envelope"></i>contact@rentaly.com</a></div>
                            <div class="topbar-widget"><a href="#"><i class="fa fa-clock-o"></i>Mon - Fri 08.00 - 18.00</a></div>
                        </div>
                    </div>
                     
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="de-flex sm-pt10">
                            <div class="de-flex-col">
                                <div class="de-flex-col">
                                <!-- logo begin //
                                    <div id="logo">
                                        <a href="index.html">
                                            <img class="logo-1" src="/public/assets/images/logo-light.png" alt="">
                                            <img class="logo-2" src="/public/assets/images/logo-light.png" alt="">
                                        </a>
                                    </div>
                                 -->
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="no-bottom no-top zebra" id="content">
            <div id="top"></div>
            
            <section id="subheader" class="jarallax text-light">
                <img src="/public/assets/images/background/2.jpg" class="jarallax-img" alt="">
                    <div class="center-y relative text-center">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 text-center">
									<h1>พ่อสื่อรถมือสอง</h1>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
            </section>

            <section id="detail" >
                <div class="container">
                    <div class="row g-5">
                        <div class="col-lg-6">

                            <div id="carouselExampleIndicators" class="carousel slide">
                                <div class="carousel-inner">
                                    <div v-for="(images, index) in img" class="carousel-item" :class="{ 'active': index === 0 }">
                                        <img class="d-block w-100" :src="images" alt="Slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                        </div>

                        <div class="col-lg-3">
                            <h3>{{ brand }} {{ section }}</h3>

                            <div class="spacer-10"></div>

                            <h4>Specifications</h4>
                            <div class="de-spec">
                                <div class="d-row">
                                    <span class="d-title">Body</span>
                                    <spam class="d-value">Sedan</spam>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Seat</span>
                                    <spam class="d-value">2 seats</spam>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Door</span>
                                    <spam class="d-value">2 doors</spam>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Luggage</span>
                                    <spam class="d-value">150</spam>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Fuel Type</span>
                                    <spam class="d-value">Hybird</spam>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Engine</span>
                                    <spam class="d-value">3000</spam>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Year</span>
                                    <spam class="d-value">2020</spam>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Mileage</span>
                                    <spam class="d-value">200</spam>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Transmission</span>
                                    <spam class="d-value">Automatic</spam>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Drive</span>
                                    <spam class="d-value">4WD</spam>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Fuel Economy</span>
                                    <spam class="d-value">18.5</spam>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Exterior Color</span>
                                    <spam class="d-value">Blue Metalic</spam>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Interior Color</span>
                                    <spam class="d-value">Black</spam>
                                </div>
                            </div>

                            <div class="spacer-single"></div>

                            <h4>Features</h4>
                            <ul class="ul-style-2">
                                <li>Bluetooth</li>
                                <li>Multimedia Player</li>
                                <li>Central Lock</li>
                                <li>Sunroof</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </section>
			
			
        </div>

        <a href="#" id="back-to-top"></a>
        
        <footer class="text-light">
            <div class="subfooter">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="de-flex">
                                <div class="de-flex-col">
                                    <a href="index.html">
                                        Copyright 2024 - พ่อสื่อรถมือสอง
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        
    </div>

    <script src="/public/assets/js/plugins.js"></script>
    <script src="/public/assets/js/designesia.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.1/axios.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   
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
                axios.get('/public/system/detail.api.php?id=NDIy')
                    .then(response => (
                        console.log(response.data),
                        this.img = response.data.img,
                        this.detail = response.data.detail
                    ))
            }
        });

    </script>

</body>

</html>