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
			liff.init({ liffId: "2003233824-pbzEJ81J" }, () => {
				if (liff.isLoggedIn()) {
						liff.getProfile().then(profile => {
							console.log(profile);
                            
                            /*
							axios.post('/sales/system/auth.api.php', {
								userId: profile.userId,
							}).then(response => {
                                console.log(response.data);

								if(response.data.status == '200'){
									if(response.data.permission == 'user'){
										window.location.href = "/sales/home";
									} else if(response.data.permission == 'leader') {
										window.location.href = "/mgr/home";
									} else {
										window.location.href = "/404";
									}
								}
								if(response.data.status == '400'){
									swal("ท่านยังไม่ได้ลงทะเบียน", "โปรดติดต่อผู้ดูแลระบบ", "warning",{ 
											button: "ตกลง"
										}
									);
								}

							});
							*/

						}).catch(err => console.error(err));
				} else {
					liff.login();
				}
			}, err => console.error(err.code, error.message));
        </script>
	</body>
</html>