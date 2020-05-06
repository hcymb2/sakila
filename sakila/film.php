<?php
    include'DB.php';
    
    $film_id = '';
    $title = '';
    $release_year = '';
    $language_id = '';
    $rental_duration = '';
    $rental_rate = '';
    $length = '';
    $replacement_cost = '';
    $rating = '';
	$last_update = '';
    $update = false;
    
if(isset($_POST["insert"]))
{
    $film_id = $_POST['film_id'];
    $title = $_POST['title'];
    $release_year = $_POST['release_year'];
    $language_id = $_POST['language_id'];
    $rental_duration = $_POST['rental_duration'];
    $rental_rate = $_POST['rental_rate'];
    $length = $_POST['length'];
    $replacement_cost = $_POST['replacement_cost'];
    $rating = $_POST['rating'];
    $last_update = date("Y-m-d H:i:s");

    $insertResult = mysqli_query($conn, "INSERT INTO film (title, release_year, language_id, rental_duration, rental_rate, length, replacement_cost, rating, last_update) VALUES('$title', '$release_year', '$language_id', '$rental_duration', '$rental_rate', '$length', '$replacement_cost', '$rating', '$last_update');");


    if($insertResult){ 
		echo '<p class="msg">'."Record has been inserted successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'film.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to insert record!".'</p>';
		echo "<script>setTimeout(\"location.href = 'film.php';\",2000);</script>";
	}
}


if(isset($_GET["update"]))
{
	
	$update = true;
	$film_id = $_GET["update"];
	
		$selResult = mysqli_query($conn, "SELECT * FROM film WHERE film_id = $film_id;");
	
	if (!empty($selResult)){
		$row = mysqli_fetch_array($selResult);
        $film_id = $row['film_id'];
        $title = $row['title'];
        $release_year = $row['release_year'];
        $language_id = $row['language_id'];
        $rental_duration = $row['rental_duration'];
        $rental_rate = $row['rental_rate'];
        $length = $row['length'];
        $replacement_cost = $row['replacement_cost'];
        $rating = $row['rating'];
    }		
	
}

if(isset($_POST["update"]))
{
	
	$film_id = $_POST['film_id'];
    $title = $_POST['title'];
    $release_year = $_POST['release_year'];
    $language_id = $_POST['language_id'];
    $rental_duration = $_POST['rental_duration'];
    $rental_rate = $_POST['rental_rate'];
    $length = $_POST['length'];
    $replacement_cost = $_POST['replacement_cost'];
    $rating = $_POST['rating'];
    $last_update = date("Y-m-d H:i:s");

	$updateResult = mysqli_query($conn, "UPDATE film SET title='$title', release_year='$release_year', language_id='$language_id', rental_duration='$rental_duration', rental_rate='$rental_rate', length='$length', replacement_cost='$replacement_cost', rating='$rating', last_update='$last_update' WHERE film_id=$film_id;") or die($conn->error);
	
	
	if($updateResult){ 
		echo '<p class="msg">'."Record has been updated successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'film.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to update record!".'</p>';
		echo "<script>setTimeout(\"location.href = 'film.php';\",2000);</script>";
	}
}

if (isset($_GET['delete'])) {
	$film_id = $_GET['delete'];
	$deleteResult = mysqli_query($conn, "DELETE FROM film WHERE film_id= $film_id");
	
	if($deleteResult){ //using javascript to setTimeout so we can display whether query was succesful or not message
		echo  '<p class="msg">'."Record has been deleted successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'film.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to delete record! ".'</p>';
		echo "<script>setTimeout(\"location.href = 'film.php';\",2000);</script>";
	}
}


?>
<html>
<head>
	<title>Sakila Database - Film Table</title>
	
	<style>
		
		body {
			font-size: 20px;
		}
		
		h1 {
			font-size: 30px;
			margin: 30px ;
			padding: 5px 10px;
			text-align: center;
			background-color: lightgrey;
		}
		
		table{
			width: 100%;
			margin: 30px ;
			border-collapse: collapse;
			text-align: left;
		}
		
		/*th{
				background-color: lightgrey;
				color: black;
		}*/
			
		tr {
			border-bottom: 1px solid #cbcbcb;
		}
		
		th, td{
			text-align:center;
			border: none;
			height: 30px;
			padding: 2px;
		}
		
		tr:hover {
			background: #F5F5F5;
		}
		
		form {
			width: 30%;
			margin: 50px;
			text-align: left;
			padding: 20px; 
			border: 1px solid #bbbbbb; 
			border-radius: 5px;
		}
		
	/*	.selection{
				margin-left: 250px;
		}
		
		.insert_update{
				margin-left: 250px;
		}
	*/	
		.inputGrp {
			margin: 10px 0px 10px 0px;
		}
		
		.inputGrp label {
			display: block;
			text-align: left;
			margin: 3px;
		}
		
		.inputGrp input {
			height: 30px;
			width: 100%;
			padding: 5px 10px;
			font-size: 16px;
			border-radius: 5px;
			border: 1px solid gray;
		}
		
		.btn {
			padding: 10px;
			font-size: 15px;
			color: white;
			background: #fe5e51;
			border: none;
			border-radius: 5px;
		}
		
		.update_btn {
			padding: 7px;
			font-size: 15px;
			color: white;
			background: rgb(70,224,208);
			border: none;
			border-radius: 5px;
		}
		
		.delete_btn {
			padding: 7px;
			font-size: 15px;
			color: white;
			background: rgb(70,224,208);
			border: none;
			border-radius: 5px;
		}
		
		.msg {
			margin: 30px auto; 
			padding: 10px; 
			border-radius: 5px; 
			color: #0ca60f; 
			background: #dff0d8; 
			border: 1px solid #0ca60f;
			width: 50%;
			text-align: center;
		}
		
		.msgFailed {
			margin: 30px auto; 
			padding: 10px; 
			border-radius: 5px; 
			color: #a60f0c; 
			background: #f0d8df; 
			border: 1px solid #a60f0c;
			width: 50%;
			text-align: center;
		}
        
		a:link {
			color: black;
		}
		  
		/* visited link */
		a:visited {
			color: black;
		}
		  
		/* mouse over link */
		a:hover {
			color: white;
		}
		  
		/* selected link */
		a:active {
			color: blue;
		}
		
		ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
		overflow: hidden;
		background-color: #39CCCC;
		
		}

		li {
		 float: left;
		}

		li a {
		display: block;
		color: white;
		text-align: center;
		padding: 14px 16px;
		text-decoration: none;
		background-color: #20B2AA;
		}

		.active {
		 background-color: #FFD700;
		}
		
		.title{
			padding: 14px 16px;
		}
		
		
	</style>
	
</head>

<body>
	
	<ul>
	<li><a class="active" href="index.php">Home</a></li>
	<li><a href="film.php">FILM TABLE</a></li>
	<li style="float: right" class="title">SAKILA DATABASE</li>
	</ul>
	
	<div class="selection">
	<form action="film.php" method="POST">
		<h3>Select Fields</h3>
		<input type="checkbox" name="selectField[]" value="film_id" checked> <label>film_id</label> </br>
		<input type="checkbox" name="selectField[]" value="title" checked> <label>title</label> </br>
        <input type="checkbox" name="selectField[]" value="release_year" checked> <label>release_year</label> </br>
		<input type="checkbox" name="selectField[]" value="language_id" checked> <label>language_id</label> </br>
		<input type="checkbox" name="selectField[]" value="rental_duration" checked> <label>rental_duration</label> </br>
		<input type="checkbox" name="selectField[]" value="rental_rate" checked> <label>rental_rate</label> </br>
		<input type="checkbox" name="selectField[]" value="length" checked> <label>length</label> </br>
		<input type="checkbox" name="selectField[]" value="replacement_cost" checked> <label>replacement_cost</label> </br>
        <input type="checkbox" name="selectField[]" value="rating" checked> <label>rating</label> </br>
		<input type="checkbox" name="selectField[]" value="last_update" checked> <label>last_update</label> </br>
		<input type="submit" class="btn" name="select" value="Select"></input>
	</form>

    <div class="insert_update">
	<form action="film.php" method="POST">
		<?php
			if ($update == true):
			?>
				<h3>Update Data</h3>
				<div class="inputGrp">
					<label>film_id</label>
					<input type="number" name="film_id" value="<?php echo $film_id?>" readonly > <br/> 
				</div>
				<div class="inputGrp">	
					<label>title</label>
					<input type="text" name="title" value="<?php echo $title?>" readonly > <br/> 
				</div>
                <div class="inputGrp">	
					<label>release_year</label>
					<input type="year" name="release_year" value="<?php echo $release_year?>" > <br/>
				</div>	
				<div class="inputGrp">
					<label>language_id</label>
					<input type="number" name="language_id" value="<?php echo $language_id?>" > <br/>
				</div>	
				<div class="inputGrp">	
					<label>rental_duration</label>
					<input type="number" name="rental_duration" value="<?php echo $rental_duration?>" > <br/>
				</div>	
				<div class="inputGrp">
					<label>rental_rate</label>
					<input type="number" step="0.01" name="rental_rate" value="<?php echo $rental_rate?>" > <br/>
				</div>
				<div class="inputGrp">	
					<label>length</label>
					<input type="number" name="length" value="<?php echo $length?>" > <br/>
				</div>	
				<div class="inputGrp">
					<label>replacement_cost</label>
					<input type="number" step="0.01" name="replacement_cost" value="<?php echo $replacement_cost?>" > <br/>
				</div>
                <div class="inputGrp">	
					<label>rating</label>
					<input type="text" name="rating" value="<?php echo $rating?>" readonly > <br/> 
				</div>
				<input type="submit" class="btn" name="update" Value= "Update"></input>

                <?php else: ?>
				<h3>Insert Data</h3>
                <div class="inputGrp">
					<label>film_id</label>
					<input type="number" name="film_id" value="film_id" > <br/> 
				</div>
				<div class="inputGrp">	
					<label>title</label>
					<input type="text" name="title" value="" placeholder="title" > <br/> 
				</div>
                <div class="inputGrp">	
					<label>release_year</label>
					<input type="year" name="release_year" value="" placeholder="release_year" > <br/> 
				</div>	
				<div class="inputGrp">
					<label>language_id</label>
					<input type="number" name="language_id" value="" placeholder="language_id" > <br/> 
				</div>	
				<div class="inputGrp">	
					<label>rental_duration</label>
					<input type="number" name="rental_duration" value="" placeholder="rental_duration" > <br/> 
				</div>	
				<div class="inputGrp">
					<label>rental_rate</label>
					<input type="number" step="0.01" name="rental_rate" value="" placeholder="rental_rate" > <br/> 
				</div>
				<div class="inputGrp">	
					<label>length</label>
					<input type="number" name="length" value="" placeholder="length" > <br/> 
				</div>	
				<div class="inputGrp">
					<label>replacement_cost</label>
					<input type="number" step="0.01" name="replacement_cost" value="" placeholder="replacement_cost" > <br/> 
				</div>
                <div class="inputGrp">	
					<label>rating</label>
					<input type="text" name="rating" value="" placeholder="rating" > <br/> 
				</div>
				<input type="submit" class="btn" name="update" Value= "Update"></input>
            <?php endif; ?>
		
			
    </form>	
    </div>

    <?php
	
		$selectResult = mysqli_query($conn, "SELECT * FROM film;"); 
		$resultCheck = mysqli_num_rows($selectResult);

		if($resultCheck > 0)
		{
			if(isset($_POST["select"]))
			{
				if(isset($_POST["select"])&&!empty($_POST['selectField']))
				{
	?>
					<table>
						<tr>
                            <?php if(!empty($_POST['selectField'])&&in_array("film_id",$_POST['selectField'])){ ?>
									<th>film_id</th>
							<?php }
								  else{ ?>  <th style="display:none;">film_id</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("title",$_POST['selectField'])){ ?>
									<th>title</th>
							<?php }
								  else{ ?>  <th style="display:none;">title</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("release_year",$_POST['selectField'])){ ?>
									<th>release_year</th>
							<?php }
								  else{ ?>  <th style="display:none;">release_year</th>  <?php } ?>
								  
							<?php if(!empty($_POST['selectField'])&&in_array("language_id",$_POST['selectField'])){ ?>
									<th>language_id</th>
							<?php }
								  else{ ?>  <th style="display:none;">language_id</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("rental_duration",$_POST['selectField'])){ ?>
									<th>rental_duration</th>
							<?php }
								  else{ ?>  <th style="display:none;">rental_duration</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("rental_rate",$_POST['selectField'])){ ?>
									<th>rental_rate</th>
							<?php }
								  else{ ?>  <th style="display:none;">rental_rate</th>  <?php } ?>
								  
							<?php if(!empty($_POST['selectField'])&&in_array("length",$_POST['selectField'])){ ?>
									<th>length</th>
							<?php }
								  else{ ?>  <th style="display:none;">length</th>  <?php } ?>
                            
                            <?php if(!empty($_POST['selectField'])&&in_array("replacement_cost",$_POST['selectField'])){ ?>
									<th>replacement_cost</th>
							<?php }
								  else{ ?>  <th style="display:none;">replacement_cost</th>  <?php } ?>
								  
							<?php if(!empty($_POST['selectField'])&&in_array("rating",$_POST['selectField'])){ ?>
									<th>rating</th>
							<?php }
								  else{ ?>  <th style="display:none;">rating</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("last_update",$_POST['selectField'])){ ?>
									<th>last_update</th>
							<?php }
								  else{ ?>  <th style="display:none;">last_update</th>  <?php } ?>
							
							<th>Update</th>
							<th>Delete</th>
							
						</tr>

                            <?php
							while($row = mysqli_fetch_assoc($selectResult))
							{ ?>
							<tr> 
							<?php 	if (!empty($_POST['selectField'])&&in_array("film_id",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['film_id']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['film_id']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("title",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['title']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['title']; ?>  </td>  <?php }
                                    
                                    if (!empty($_POST['selectField'])&&in_array("release_year",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['release_year']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['release_year']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("language_id",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['language_id']; ?>  </td>  <?php }
                                    else{ ?>  <td style="display:none;"> <?php echo $row['language_id']; ?>  </td>  <?php }
                                    
                                    if (!empty($_POST['selectField'])&&in_array("rental_duration",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['rental_duration']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['rental_duration']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("rental_rate",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['rental_rate']; ?>  </td>  <?php }
                                    else{ ?>  <td style="display:none;"> <?php echo $row['rental_rate']; ?>  </td>  <?php }
                                    
                                    if (!empty($_POST['selectField'])&&in_array("length",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['length']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['length']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("replacement_cost",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['replacement_cost']; ?>  </td>  <?php }
                                    else{ ?>  <td style="display:none;"> <?php echo $row['replacement_cost']; ?>  </td>  <?php }
                                    
                                    if (!empty($_POST['selectField'])&&in_array("rating",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['rating']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['rating']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("last_update",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['last_update']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['last_update']; ?>  </td>  <?php } ?>
								
									<td><button type="submit" class="update_btn" name="update"><a href="film.php?update=<?php echo $row['film_id']; ?>">Update</a></button> </td>
									<td><button type="submit"  class="delete_btn" name="delete"><a href="film.php?delete=<?php echo $row['film_id']; ?>" onclick="return confirm('You are about to delete this record.');">Delete</a></button> </td>
							
							</tr>
					  <?php } ?>
					</table>
                        
    <?php		} else{echo "You didn't select any fields.";}
	
			}else{
	?>
				<table>
					<tr>
						<th>film_id</th>
						<th>title</th>
						<th>release_year</th>
						<th>language_id</th>
						<th>rental_duration</th>
						<th>rental_rate</th>
						<th>length</th>
                        <th>replacement_cost</th>
						<th>rating</th>
						<th>last_update</th>
						<th>Update</th>
						<th>Delete</th>
					</tr>
					<?php while ($row = mysqli_fetch_assoc($selectResult)){ ?>
					<tr>
						<td><?php echo $row['film_id']; ?></td>
						<td><?php echo $row['title']; ?></td>
						<td><?php echo $row['release_year']; ?></td>
						<td><?php echo $row['language_id']; ?></td>
						<td><?php echo $row['rental_duration']; ?></td>
						<td><?php echo $row['rental_rate']; ?></td>
						<td><?php echo $row['length']; ?></td>
                        <td><?php echo $row['replacement_cost']; ?></td>
						<td><?php echo $row['rating']; ?></td>
						<td><?php echo $row['last_update']; ?></td>
						<td><button type="submit"  class="update_btn" name="update"><a href="film.php?update=<?php echo $row['film_id']; ?>">Update</a></button> </td>
						<td><button type="submit" class="delete_btn" name="delete"><a href="film.php?delete=<?php echo $row['film_id']; ?>" onclick="return confirm('You are about to delete this record.');">Delete</a></button> </td>
							
					</tr>
				<?php } ?>
				</table>
		
	<?php		}
		} else{die("ERROR: Did not receive any result.");} 
	
	?>
</div>
</body>
</html>