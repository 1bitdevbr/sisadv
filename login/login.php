<?php
	require_once(__DIR__ . '/../config.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title><?= $title; ?>&nbsp;[ Acesso ao Sistema ]</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--===============================================================================================-->
		<link rel="icon" type="image/png" href="../dist/img/icons/favicon.ico"/>
		<!--===============================================================================================-->
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
		<!--===============================================================================================-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="css/animate.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="css/animsition.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" href="css/style.css">
		<!--===============================================================================================-->
	</head>
	<body class="img js-fullheight" style="background-image: url(../dist/img/sis/bg1.jpg);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5  animated pulse myForm">
					<img class="img-logo" src="../dist/img/sis/logo.png">
					<img class="img-title" src="../dist/img/sis/sisadv.png">
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
						<h3 class="mb-4 text-center">[ Acesso ao Sistema ]</h3>
						<form class="signin-form" name="formLogin" action="../access/authentication.php" method="POST">
							<div class="form-group">
								<input type="text" class="form-control" name="USR_LOGIN" placeholder="Usuário" autofocus required>
							</div>
							<div class="form-group">
								<input id="password-field" type="password" class="form-control" name="USR_PASS" placeholder="Senha" required>
								<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" style="color: rgb( 58, 100, 140 );"></span>
							</div>
							<div class="form-group">
								<button type="submit" class="form-control btn btn-primary submit px-3">Login</button>
							</div>
						</form>
						<?php
                            $IP = $_SERVER[ 'REMOTE_ADDR' ];
                            echo '<div class="w-100 mt-5 text-center"><span style="font-size: 1.0em; font-weight: 600; letter-spacing: 0.1em; color: rgb(248, 248, 242);">&mdash; IP: ' . $IP . ' &mdash;</span></div>';
						?>
						<div class="fixed-bottom text-center">
							<p>&copy; 2005-<?= date( "Y" ); ?> by <a href="https://1bit.dev.br" style="color: rgb( 134, 144, 153 );" onmouseover="this.style.color='rgb( 248, 248, 226 )'" onmouseout="this.style.color='rgb( 134, 144, 153 )'">1bit.dev.br</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
	<!--===============================================================================================-->
	<script src="js/animsition.min.js"></script>
	<!--===============================================================================================-->

	</body>
</html>