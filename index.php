<?php 
session_start();
include "conf.php";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo SITE_NAME;?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="author" content="Dong Calmada">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body style="font-family:Arial">
		<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" id="nav-dbc">
			<a class="navbar-brand" href="index.php">Dong-B-C</a>
			<button class="navbar-toggler" type="button" data-toggle="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarcollapse">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a href="index.php?cat=feats" class="nav-link">Accomplishments</a>
					</li>
					<li class="nav-item">
						<a href="index.php?cat=notes" class="nav-link">Notes</a>
					</li>
					<li class="nav-item">
						<a href="index.php?cat=tags" class="nav-link">By Tags</a>
					</li>
				</ul>
				<form class="form-inline my-2 my-lg-0">
					<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				</form>
			</div>
		</nav>
		<div class='container-fluid' style="margin-top:100px">
			<div class='row'>
			<div class='col-md-3'>
				<div class="card card-inverse" id="quote" style="background-color:crimson;color:#d8d8d8;font-family:serif;font-style:italic;font-size:110%">
					<div class='card-body'>
						<p class="card-text"><?php $quote = `/usr/games/fortune`; echo $quote?></p>
					</div>
				</div>
			</div>
			<div class="col-md-9">
		<?php
		if (isset($_GET['cat'])) {
			switch ($_GET['cat']) {
				case 'feats':
					include 'accomplishments.php';
					break;
				case 'notes':
					include 'notes.php';
					break;
				case 'tags':
					include 'tags.php';
					break;
			}
		} else {
			?>
			<div class='row'>
			<div class='col-md-6'>
				<?php include 'accomplishments.php';?>
			</div>
			<div class='col-md-6'>
				<?php include 'notes.php';?>
			</div>
			</div>
			<?php
		}
		?>
			</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> 	
	</body>
</html>
