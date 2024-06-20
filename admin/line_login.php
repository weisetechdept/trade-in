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

							axios.post('/admin/system/line_login.api.php', {
								userId: profile.userId,
								userImg: profile.pictureUrl

							}).then(response => {

								if(response.data.status == '200'){

                                    window.location.href = "/admin/home";

								} else if(response.data.status == '400'){

									swal("เกิดข้อผิดพลาด", response.data.message, "warning",{ 
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