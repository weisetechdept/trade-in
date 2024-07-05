<?php 
    session_start();
    date_default_timezone_set("Asia/Bangkok");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="/loyalty/images/favicon.png">
		<title>Trade-in Admin Auth</title>
		<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
		<style>
			.swal-text {
				text-align: center;
				font-family: 'Kanit', sans-serif;
			}
			.swal-button {
				background-color: #e03131;
				font-family: 'Kanit', sans-serif;
				border-radius: 20px;
			}
			.swal-footer {
    			text-align: center;
			}
			.swal-modal {
    			border-radius: 20px;
			}
		</style>
	</head>
	<body>

		<script src="https://static.line-scdn.net/liff/edge/versions/2.9.0/sdk.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.1/axios.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
		<script>
			liff.init({ liffId: "2003233824-jePdvMnv" }, () => {
				if (liff.isLoggedIn()) {
						liff.getProfile().then(profile => {
							axios.post('/partner/system/line_login.api.php', {
								userId: profile.userId,
								userImg: profile.pictureUrl

							}).then(response => {

                                if(response.data.status == '200'){
									<?php if(empty($_GET['way'])){ ?>
										window.location.href = "/partner/home";
									<?php } elseif($_GET['way'] == 'car') {?>
										window.location.href = "/pt/stock/<?php echo $_GET['id'];?>";
									<?php } ?>

								}
								if(response.data.status == '400'){
									swal("ท่านยังไม่ได้ลงทะเบียน", "โปรดติดต่อผู้ดูแลระบบ", "warning",{ 
											button: "ตกลง"
										}
									);
								}
								if(response.data.status == '401'){
									swal("อยู่ในขั้นตอนรอการอนุมัติ", "โปรดรอ อาจจะใช้เวลาสักครู่เพื่อให้เจ้าหน้าที่ตรวจสอบข้อมูล", "warning",{ 
											button: "ตกลง"
										}
									);
								}
                                
							});

						}).catch(err => console.error(err));
				} else {
					liff.login();
				}
			}, err => console.error(err.code, error.message));
            
        </script>
	</body>
</html>