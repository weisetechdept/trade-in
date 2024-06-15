<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <title>Car Detail</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="A77" name="description" />
        <meta content="A77" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="/assets/images/favicon.ico">
        <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@100;200;300;400;500;600;700;800&family=Kanit:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- App css -->
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/theme.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
    
    <div class="row" id="multiAndroid">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-2 font-size-18">อัพโหลดรูปสำหรับ Android</h4>

                        <div class="form-group">
                            <select class="form-control" v-model="group" id="exampleFormControlSelect1">
                                <option value="0">= เลือกประเภทรูป =</option>
                                <option value="10">รูปภายนอกรถยนต์ (Code: 10)</option>
                                <option value="20">รูปภายในรถยนต์ (Code: 20)</option>
                                <option value="30">รูปเอกสารรถยนต์ (Code: 30)</option>
                                <option value="40">รูปห้องเครื่อง ช่วงล่าง ใต้ท้องรถ (Code: 40)</option>
                                <option value="50">รูปตำหนิรถยนต์แต่ละจุด (Code: 50)</option>
                            </select>
                        </div>
                        
                        <div class="row">
                            <div class="col form-group mt-2">
                                <p>รูปที่ 1</p>
                                <input type="file" class="form-control file-upload" id="uploadAndroid" ref="uploadAndroid">
                            </div>
                        </div>

                        <div id="addImage"></div>

                        <button type="button" @click="addImage" class="btn btn-outline-warning waves-effect waves-light mb-2">เพิ่มรูป</button>

                        <div class="form-group mt-4">
                            <button type="button" @click='uploadFile()' class="btn btn-block btn-primary waves-effect waves-light mb-2">อัพโหลด</button>
                        </div>

                </div>
            </div>
        </div>
    </div>

    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/metismenu.min.js"></script>
    <script src="/assets/js/waves.js"></script>
    <script src="/assets/js/simplebar.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.1/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script>
        var uploadAndroid = new Vue({
            el: '#multiAndroid',
            data () {
                return {
                    file: "",
                    filenames: [],
                    id: '<?php echo $cid; ?>',
                    group: '0',
                    input: ''
                }
            },
            methods: {
                addImage: function(){
                    
                    var html = '<div class="row"><div class="col form-group mt-2"><p>รูปที่</p><input type="file" class="form-control file-upload" id="uploadAndroid" ref="uploadAndroid"><button class="btn btn-danger" @click="deleteImage">ลบ</button></div></div>';
                    $('#addImage').append(html);
                    
                },
                deleteImage: function(){
                    $('#addImage').remove();
                },
                uploadFile: function(){
                    if(this.$refs.uploadAndroid.files.length <= 0 || this.group == 0){
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
                                var el = this;
                                let formData = new FormData();
                                var files = this.filenames;
                                var totalfiles = this.filenames.length;
                                for (var index = 0; index < totalfiles; index++) {
                                    formData.append("files[]", files[index].file);
                                }
                                formData.append('id', this.id);
                                formData.append('group', this.group);
                                axios.post('/sales/system/multi_upload.api.php', formData,
                                {
                                    headers: {
                                        'Content-Type': 'multipart/form-data'
                                    },
                                    onUploadProgress: function(progressEvent) {
                                        var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                                        swal({
                                            title: 'กำลังอัพโหลด',
                                            text: 'กรุณารอสักครู่...',
                                            buttons: false,
                                            closeOnClickOutside: false,
                                            closeOnEsc: false,
                                            icon: '/assets/images/Spin.gif'
                                        });
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
                            }
                        });
                    }
                }
        
            }
        });

    </script>
</body>
</html>