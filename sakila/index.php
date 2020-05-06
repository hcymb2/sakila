<html>
<head>
	<title>Sakila Database</title>
</head>

<body>
	
		<style>
			
			image{
			max-width: 50%;
			height: auto;
			 
			}

			body{
			 background-image: url('dataIllustration.jpg');
			 background-repeat: no-repeat;
			 background-attachment: scroll;
			 background-position: right 100px;
			 background-size: 40%;
			 padding-top: 10px; 
			}
			
			h1 {
			
			color: #FFD700;
			text-align: center;
			font-size: 70;
			}
			
			.title {
			position: relative;
			padding: 10px;
			font-size: 15px;
			color: white;
			background: #39CCCC;
			border: none;
			border-radius: 5px;
			margin:10px 80px;
			width:20%;
	
			}
			.right{
				margin:5px 10px;
			}
			
			.index title:hover {
				color: black;
  				background-color: white;
			}
			
			.title:hover {background-color: #20B2AA}
		
		</style>
	
	
	
	<h1>SAKILA DATABASE</h1>
		
		
		
			<div class="index">
				<!-- <a href="index.php" class="title">HOME</a> -->
				
				<input type="button" class="title left" onclick="location.href='actor.php';" value="actor">
				<input type="button" class="title right" onclick="location.href='film_category.php';" value="film_category"> <br/>
				
				<input type="button" class="title left" onclick="location.href='address.php';" value="address">
				<input type="button" class="title right" onclick="location.href='film_text.php';" value="film_text"> <br/>
				
				<input type="button" class="title left" onclick="location.href='category.php';" value="category">
				<input type="button" class="title right" onclick="location.href='inventory.php';" value="inventory"> <br/>
				
				<input type="button" class="title left" onclick="location.href='city.php';" value="city">
				<input type="button" class="title right" onclick="location.href='language.php';" value="language"> <br/>
				
				<input type="button" class="title left" onclick="location.href='country.php';" value="country">
				<input type="button" class="title right" onclick="location.href='payment.php';" value="payment"> <br/>
				
				<input type="button" class="title left" onclick="location.href='customer.php';" value="customer">
				<input type="button" class="title right" onclick="location.href='rental.php';" value="rental"> <br/>
				
				<input type="button" class="title left" onclick="location.href='film.php';" value="film">
				<input type="button" class="title right" onclick="location.href='staff.php';" value="staff"> <br/>
				
				<input type="button" class="title left" onclick="location.href='film_actor.php';" value="film_actor">
				<input type="button" class="title right" onclick="location.href='store.php';" value="store"> <br/>
			
				
			</div>
    
		
		
		<!--<img src ="dataIllustration.jpg" alt= "Data Illustration"> -->
</body>
</html>
