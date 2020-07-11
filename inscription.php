<?php
	require('connexion.php');
?>
<?php
	if(isset($_POST['register'])){
		if(isset($_POST['nom']) && isset($_POST['pseudo']) && isset($_POST['matricule']) && isset($_POST['statut']) && isset($_POST['class']) && isset($_POST['email']) && isset($_POST['pwd']) && isset($_POST['pwd_confirm'])){
			if($_POST['pwd_confirm'] === $_POST['pwd']){
				$q = $db->prepare("SELECT * FROM users_pred WHERE matricule = ? AND statut = ?");
				$q->execute([$_POST['matricule'], $_POST['statut']]);
				$nbre = $q->rowCount();
				$q = $db->prepare("SELECT * FROM users WHERE matricule = ? AND statut = ?");
				$q->execute([$_POST['matricule'], $_POST['statut']]);
				$nbre_u = $q->rowCount();
				if($nbre == 1 && $nbre_u == 0){
					$q = $db->prepare('INSERT INTO users(matricule, name, pseudo, email, password, statut, class) VALUES(:matricule, :name, :pseudo, :email, :password, :statut, :class)');
					$q->execute([
						'matricule' => $_POST['matricule'],
						'name' => $_POST['nom'],
						'pseudo' => $_POST['pseudo'],
						'email' => $_POST['email'],
						'password' => $_POST['pwd'],
						'statut' => $_POST['statut'],
						'class' => $_POST['class']
					]);
					header('Location: login.php');
				}else{
					die("matricule et statut non reconnus!");
				}
			}else{
				die("les mots de passe doivent etre identiques");	
			}
		}else{
			die("error");
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">

	<title>Inscription PEB</title>

	<link rel="shortcut icon" href="assets/images/gt_favicon.png">

	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen" >
	<link rel="stylesheet" href="assets/css/main.css">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top headroom" >
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="index.php"><img class="img-circle" src="assets/images/logo.png" style="height: 80px;"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<li><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="login.php">login</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
	<!-- /.navbar -->

	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">User access</li>
		</ol>

		<div class="row">

			<!-- Article main content -->
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Register</h1>
				</header>

				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Create your account</h3>
							<p class="text-center text-muted">Le Travail eloigne de nous 3 grands mots L'ennui, le vice et l'envie </p>
							<hr>

							<form method="post">
								<div class="form-group">
									<label>Nom <span class="text-danger">*</span></label>
									<input type="text" name="nom" class="form-control">
								</div>
								<div class="form-group">
									<label>Pseudo<span class="text-danger">*</span></label>
									<input type="text" name="pseudo" class="form-control">
								</div>
                				<div class="form-group">
									<label>Matricule <span class="text-danger">*</span></label>
									<input type="text" name="matricule" class="form-control">
								</div>

								<div class="form-group">
									<label>votre statut vous etes étudiant ou personnel de l'administration? <span class="text-danger">*</span></label><br>
									<input type="radio" name="statut" id="0"  value="0" >
									<label for="0">Etudiant</label> <br>
									<input type="radio" name="statut" id="1"  value="1" >
									<label for="0">Administrateur</label>
								</div>
								
               				 	<div class="form-group">
									<label>Niveau/Classe <span class="text-danger">*</span></label>
									<input type="text" name="class" class="form-control">
								</div>
								
                				<div class="form-group">
									<label>Email <span class="text-danger">*</span></label>
									<input type="email" name="email" class="form-control"/>
									
								</div>
								<div class="form-group">
									<label>Password <span class="text-danger">*</span></label>
									<input type="password" name="pwd" class="form-control">
								</div>
								<div class="form-group">
									<label>Password confirm<span class="text-danger">*</span></label>
									<input type="password" name="pwd_confirm" class="form-control">
								</div>
								
								<hr>

								<div class="row">
									<div class="col-lg-8">
										
									</div>
									<div class="col-lg-4 text-right">
										<button class="btn btn-action" type="submit" name="register">Register</button>
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>

			</article>
			<!-- /Article -->

		</div>
	</div>	<!-- /container -->


	<footer id="footer" class="top-space">

		<div class="footer1">
			<div class="container">
				<div class="row">

					<div class="col-md-3 widget">
						<h3 class="widget-title">Contact</h3>
						<div class="widget-body">
							<p>+237 691544196<br>
								<a href="mailto:#">rosetchameni508@gmail.com</a><br>
								<br>
								Bonamoussadi Douala-Cameroun
							</p>
						</div>
					</div>

					<div class="col-md-3 widget">
						<h3 class="widget-title">Follow me</h3>
						<div class="widget-body">
							<p class="follow-me-icons clearfix">
								<a href=""><i class="fa fa-twitter fa-2"></i></a>
								<a href=""><i class="fa fa-dribbble fa-2"></i></a>
								<a href=""><i class="fa fa-github fa-2"></i></a>
								<a href=""><i class="fa fa-facebook fa-2"></i></a>
							</p>
						</div>
					</div>

					<div class="col-md-6 widget">
						<h3 class="widget-title">Text widget</h3>
						<div class="widget-body">
							<p>Le Travail eloigne de nous trois grand mots:</p>
							<p>L'ennuit, Le vice et l'envie</p>
						</div>
					</div>

				</div> <!-- /row of widgets -->
			</div>
		</div>

		<div class="footer2">
			<div class="container">
				<div class="row">

					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="simplenav">
								<a href="#">Home</a> |
								<a href="about.php">About</a>|
								<a href="login.php">Log in</a>

							</p>
						</div>
					</div>

					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="text-right">
								Copyright &copy; 2020, rose Tchameni Designed by TPR
							</p>
						</div>
					</div>

				</div> <!-- /row of widgets -->
			</div>
		</div>
	</footer>





	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="assets/js/headroom.min.js"></script>
	<script src="assets/js/jQuery.headroom.min.js"></script>
	<script src="assets/js/template.js"></script>
</body>
</html>
