<!DOCTYPE html>
<html lang="en">
<head>
<title>Homepage</title>
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>	
	<!-- Bootstrap -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Slick Carousel -->
	<script type="text/javascript" src="slick/slick.min.js"></script>
	<link rel="stylesheet" type="text/css" href="./slick/slick.css">
	<link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">
	<!-- Custom -->
	<script type="text/javascript" src="Homepage.js"></script>
	<script type="text/javascript" src="Search.js"></script>
	<link rel="stylesheet" type="text/css" href="Homepage.css">
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	
	<!-- Consistent Nav Dropdown -->
	<div class="dropdown" style="position: absolute; top: 10%;">
		<button id="side_nav" class="btn dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-chevron-right"></span></button>
		<ul id="slide_nav_sub" class="dropdown-menu" role="menu">
			<li role="presentation"><a href="./Homepage.php"><button class="btn btn-block">Home</button></a></li>
			<li role="presentation"><a href="./Help.html"><button class="btn btn-block">Help</button></a></li>
			<li role="presentation"><a href="./AdvancedSearch.php"><button class="btn btn-block">Search</button></a></li> 
		</ul>
	</div>
	<!-- Title, Link Bar, and Icon + DATE-->
	<div class="container" id="head_elements">	
		<div>
			<h3 style="font-size: xx-large;">What to Watch<small style="font-size: small; margin-left: 10px; color: black;">Community driven entertainment suggestions</small></h3>
		</div>
		<div id="nav_bar_top">
			<nav class="navbar navbar-default navbar-fixed">
				<div class="container-fluid">
					<img class="navbar-brand" src="./Graphics/logo.png">
					<ul id="nav_bar_links" class="list-inline navbar-nav" style="margin-left: 10px;">
						<li><a href="./Contact.html"><button type="button" class="btn btn-default navbar-btn">Contact</button></a></li>

						<li><a href="./Help.html"><button type="button" class="btn btn-default navbar-btn">Help</button></a></li>

						<li><a href="./AdvancedSearch.php"><button type="button" class="btn btn-default navbar-btn">Search</button></a></li>

					</ul>
					<ul class="list-inline navbar-nav navbar-right">
						<li><a href="./Login.php"><button type="button" class="btn btn-default navbar-btn"><span class="glyphicon glyphicon-user"></span>Log In</button></a></li>
					</ul>
				</div>
			</nav>
			<div style="text-align: center; font-size: large;">
				<span style="margin: 1%;" id="t_date"><?php 
					print date("l, F jS");
					print "<br>"; ?>
				</span>
				<h3 style="text-decoration: underline;">Top 10 Movies Out Now : </h3>
			</div>
		</div>
	</div>
	<!-- Carousel -->
	<div class="container" id="slide">
		<div class="myclass" data-slick='{"slidesToShow": 3, "slidesToScroll": 4, "centerMode": true, "autoplaySpeed": 300}' style="margin: 50px;">
			<div><img id="slide1" src="https://images-na.ssl-images-amazon.com/images/M/MV5BMjM2ODA4MTM0M15BMl5BanBnXkFtZTgwNzE5OTYxMDI@._V1_SX300.jpg" style="width:300px;height:400px;"></div>
			<div><img id="slide2" src="https://images-na.ssl-images-amazon.com/images/M/MV5BMjI4MzU5NTExNF5BMl5BanBnXkFtZTgwNzY1MTEwMDI@._V1_SX300.jpg" style="width:300px;height:400px;"></div>
			<div><img id="slide3" src="https://images-na.ssl-images-amazon.com/images/M/MV5BMjMxOTM1OTI4MV5BMl5BanBnXkFtZTgwODE5OTYxMDI@._V1_SX300.jpg" style="width:300px;height:400px;"></div>
			<div><img id="slide4" src="https://images-na.ssl-images-amazon.com/images/M/MV5BMjA0MTkzMDI1MF5BMl5BanBnXkFtZTgwMjQxNDE0MDI@._V1_SX300.jpg" style="width:300px;height:400px;"></div>
			<div><img id="slide5" src="https://images-na.ssl-images-amazon.com/images/M/MV5BMTkxNDc3OTcxMV5BMl5BanBnXkFtZTgwODk2NjAzOTE@._V1_SX300.jpg" style="width:300px;height:400px;"></div>
			<div><img id="slide6" src="https://images-na.ssl-images-amazon.com/images/M/MV5BMjQ1NjM3MTUxNV5BMl5BanBnXkFtZTgwMDc5MTY5OTE@._V1_SX300.jpg" style="width:300px;height:400px;"></div>
			<div><img id="slide7" src="https://images-na.ssl-images-amazon.com/images/M/MV5BMjM2MjE5Mzc4OF5BMl5BanBnXkFtZTgwMjc3NjEyMDI@._V1_SX300.jpg" style="width:300px;height:400px;"></div>
			<div><img id="slide8" src="https://images-na.ssl-images-amazon.com/images/M/MV5BOTI4NDkxMTAxM15BMl5BanBnXkFtZTgwMzU1Mzk5OTE@._V1_SX300.jpg" style="width:300px;height:400px;"></div>
			<div><img id="slide9" src="https://images-na.ssl-images-amazon.com/images/M/MV5BMjM1MTkwNTQ1Ml5BMl5BanBnXkFtZTgwNTc5ODgxOTE@._V1_SX300.jpg" style="width:300px;height:400px;"></div>
			<div><img id="slide10" src="https://images-na.ssl-images-amazon.com/images/M/MV5BMTExMzU0ODcxNDheQTJeQWpwZ15BbWU4MDE1OTI4MzAy._V1_SX300.jpg" style="width:300px;height:400px;"></div>
		</div>
	</div>
</body>
</html>

