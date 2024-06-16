var uploadMul = new Vue({
    el: '#multiUpload',
    data () {
        return {
            file: "",
            filenames: [],
            id: '<?php echo $cid; ?>',
            group: '0'
            
        }
    },
    methods: {
        uploadFile: function(){
            if(this.$refs.uploadfiles.files.length <= 0 || this.group == 0){
                swal("เกิดข้อผิดพลาดบางอย่าง", "กรุณาเลือกไฟล์ที่ต้องการอัพโหลด และประเภทของรูป", "warning",{ 
                    button: "ตกลง"
                });
                return;
            } else {
                swal({
                    title: 'คุณแน่ใจหรือไม่ ?',
                    text: "คุณต้องการอัพโหลดไฟล์ที่เลือกหรือไม่ ?",
                    icon: "info",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {

                        swal("กรุณารอสักครู่", "ระบบกำลังอัพโหลดไฟล์", "info", {
                            button: false
                        })

                        var el = this;
                        let formData = new FormData();
                        var files = this.$refs.uploadfiles.files;
                        var totalfiles = this.$refs.uploadfiles.files.length;
                        for (var index = 0; index < totalfiles; index++) {
                            formData.append("files[]", files[index]);
                        }
                        formData.append('id', this.id);
                        formData.append('group', this.group);

                        axios.post('/admin/system/multi_upload.api.php', formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then(function (response) {
                            console.log(response);
                            swal.close();
                            if(response.data.status == 200) 
                                swal("สำเร็จ", "อัพโหลดรูปสำเร็จ", "success",{ 
                                    button: "ตกลง"
                                }).then((value) => {
                                    location.reload(true)
                                });
                        })
                        .catch(function (error) {
                            console.log(error);
                        }); 

                    } 
                });
            }
        }
            
    }
});

var agent_detail = new Vue({
    el: '#agent',
    data () {
        return {
            id: '',
            license: '',
            brand: '',
            serie: '',
            section: '',
            transmission: '',
            color: '',
            price: '',
            trade_price: '',
            condition:'',
            tlt_price: '',
            sales: '',
            status: '',
            car_year: '',
            reg_year: '',
            transmission: '',
            option: '',
            vin: '',
            mileage: '',
            tel: '',
            downpayment: '',
            loanrate: '100',
            loan: '',
            interestrate: '7',
            period: '6',
            cal_price: '',
            cal_tltprice: '',
            vat: '',
            typeCar: '',
            seat: '',
            door: '',
            fuel: '',
            engine: '',
            passengerType: '',
            suspension: '',
            drive: '',
            seller_name: '',
            share_link: '',
            
            offer:{
                price: '',
                partner: '',
                display: [],
            },
            switchPublic: false
        }
    },
    mounted () {
        axios.get('/admin/system/car_detail.api.php?u=<?php echo $cid; ?>')
            .then(response => {
                if(response.data.status == 404) 
                    swal("เกิดข้อผิดพลาดบางอย่าง", "อาจมีบางอย่างผิดปกติ (error : 404)", "warning",{ 
                        button: "ตกลง"
                    }).then((value) => {
                        window.location.href = "/admin/home";
                    });
                
                this.cal_price = response.data.car.cal_price;
                this.cal_tltprice = response.data.car.cal_tlt_price;
                var cal_down = this.cal_price - (this.cal_tltprice * (this.loanrate/100));
                if(cal_down < 0){
                    this.downpayment = 0
                } else {
                    this.downpayment = cal_down
                }
                this.loan = (this.cal_price - this.downpayment)
                
                this.id = response.data.car.id;
                this.license = response.data.car.license;
                this.brand = response.data.car.brand;
                this.serie = response.data.car.serie;
                this.section = response.data.car.section;
                this.color = response.data.car.color;
                this.price = response.data.car.price;
                this.trade_price = response.data.car.trade_price;
                this.sales = response.data.car.sales;
                this.status = response.data.car.status;
                this.car_year = response.data.car.car_year;
                this.reg_year = response.data.car.reg_year;
                this.tlt_price = response.data.car.tlt_price;
                this.transmission = response.data.car.transmission;
                this.option = response.data.car.option;
                this.condition = response.data.car.condition;
                this.vin = response.data.car.vin;
                this.mileage = response.data.car.mileage;
                this.tel = response.data.car.tel;
                this.vat = response.data.car.vat;

                this.typeCar = response.data.car.type;
                this.seat = response.data.car.seat;
                this.door = response.data.car.door;
                this.fuel = response.data.car.fuel;
                this.engine = response.data.car.engine;
                this.passengerType = response.data.car.passengerType;
                this.suspension = response.data.car.suspension;
                this.drive = response.data.car.drive;
                this.seller_name = response.data.car.seller_name;

                this.offer.display = response.data.offer;
                this.share_link = response.data.car.share_link;

                this.switchPublic = response.data.car.publicLink;
             
            }),
            this.calDownpayment();
    },
    methods: {
        deleteData() {
            swal({
                title: 'คุณแน่ใจหรือไม่ ?',
                text: "คุณต้องการลบข้อมูลรถยนต์นี้หรือไม่ ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    
                    axios.post('/admin/system/car_delete.api.php', {
                        id: this.id
                    }).then(res => {
                        if(res.data.status == 200) 
                            swal("สำเร็จ", "ลบข้อมูลสำเร็จ", "success",{ 
                                button: "ตกลง"
                            }).then((value) => {
                                window.location.href = "/admin/home";
                            });

                        if(res.data.status == 400)
                            swal("ทำรายการไม่สำเร็จ", "ลบข้อมูลไม่สำเร็จ อาจมีบางอย่างผิดปกติ (error : 400)", "warning",{ 
                                button: "ตกลง"
                            }
                        );
                    });
                    
                } 
            });
        },
        publicSwitch(){
            swal({
                title: 'คุณแน่ใจหรือไม่ ?',
                text: "คุณต้องการเปลี่ยนสถานะการแชร์ข้อมูลหรือไม่ ?",
                icon: "info",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    axios.post('/admin/system/public.edt.php', {
                        id: this.id,
                        switchPublic: this.switchPublic
                    }).then(res => {
                        if(res.data.status == 200) 
                            swal("สำเร็จ", "เปลี่ยนสถานะการแชร์ข้อมูลสำเร็จ", "success",{ 
                                button: "ตกลง"
                            }).then((value) => {
                                location.reload(true)
                            });

                        if(res.data.status == 400)
                            swal("ทำรายการไม่สำเร็จ", "เปลี่ยนสถานะการแชร์ข้อมูลไม่สำเร็จ อาจมีบางอย่างผิดปกติ (error : 400)", "warning",{ 
                                button: "ตกลง"
                            }
                        );
                    });
                } 
            });
        },
        offerData() {
            if(this.offer.price == '' || this.offer.partner == ''){
                swal("ไม่สามารถทำรายการได้", "โปรดกรอกข้อมูลให้ครบถ้วน", "warning",{ 
                        button: "ตกลง"
                    }
                );
                return;
            } else if(this.sales == 'ไม่ผู้ดูแล'){
                swal("ไม่สามารถทำรายการได้", "ยังไม่มีเซลล์ผู้ดูแลลูกค้า", "warning",{ 
                        button: "ตกลง"
                    }
                );
                return;
            } else {

                swal({
                    title: 'คุณแน่ใจหรือไม่ ?',
                    text: "คุณต้องการส่งข้อมูลให้ลูกค้าหรือไม่ ?",
                    icon: "info",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {

                        axios.post('/admin/system/offer.ins.php', {
                            price: this.offer.price,
                            partner: this.offer.partner,
                            parent: this.id
                        }).then(res => {
                            if(res.data.status == 200) 
                                swal("สำเร็จ", "เพิ่มข้อมูลสำเร็จ", "success",{ 
                                    button: "ตกลง"
                                }).then((value) => {
                                    location.reload(true)
                                });
                            if(res.data.status == 400) 
                                swal("ทำรายการไม่สำเร็จ", "เพิ่มข้อมูลไม่สำเร็จ อาจมีบางอย่างผิดปกติ (error : 400)", "warning",{ 
                                    button: "ตกลง"
                                }
                            );
                        });


                    } else {
                        swal("ยกเลิกการส่งข้อมูลสำเร็จ", {
                            icon: "success",
                        });
                    }
                });

            }
            
        },
        calDownpayment(e){
            
            var cal_down = this.cal_price - (this.cal_tltprice * (this.loanrate/100));
            if(cal_down < 0){
                this.downpayment = 0
            } else {
                this.downpayment = cal_down
            }
            this.loan = (this.cal_price - this.downpayment)
            
        },
        formatPrice(value) {
            let val = (value/1).toFixed(2).replace(',', '.')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
        copyLink() {
            var copyText = document.getElementById("myInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);
            alert("คัดลอกลิ้ง : " + copyText.value);
        }
    }
});


var docs = new Vue({
    el: '#car_img',
    data () {
        return {
            img: null
        }
    },
    mounted () {
        axios.get('/admin/system/img.api.php?u=<?php echo $cid; ?>')
          .then(response => (
              this.img = response.data.img
          ))
    },
    methods: {
        sendDelete(e){
            e.preventDefault();
            swal({
                title: 'คุณแน่ใจหรือไม่ ?',
                text: "คุณต้องการลบรูปภาพใช่หรือไม่ โปรดตรวจสอบข้อมูลให้ถูกต้อง",
                icon: "warning",
                buttons: {
                    cancel: "ยกเลิก",
                    confirm: {
                        text: "ดำเนินการต่อ",
                    }
                },
                dangerMode: true
            })
            .then((willDelete) => {
                if (willDelete) {
                    axios.post('/admin/system/img_del.api.php', {
                        id: e.target.value
                    }).then(res => {
                        if(res.data.status == 200)
                            swal("สำเร็จ", "ลบรูปภาพเรียบร้อย", "success",{ 
                                button: "ตกลง"
                            }).then((value) => {
                                location.reload();
                            });

                        if(res.data.status == 505) 
                            swal("ทำรายการไม่สำเร็จ", "อาจมีบางอย่างผิดปกติ โปรดตรวจสอบเงื่อนไขการสมัครสมาชิกให้ถูกต้อง และครบถ้วน หรือติดต่อเจ้าหน้าที่", "warning",{ 
                                button: "ตกลง"
                            }
                        );
                    });
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
        }
    }
});