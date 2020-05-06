<?php
    include'DB.php';
    
	$film_id = '';
	$special_features = '';
    $update = false;
    
if(isset($_POST["insert"]))
{
	$film_id = $_POST['film_id'];
    $special_features = $_POST['special_features'];

    $insertResult = mysqli_query($conn, "INSERT INTO film_special_features (special_features) VALUES('$special_features');");


    if($insertResult){ 
		echo '<p class="msg">'."Record has been inserted successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'film_special_features.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to insert record!".'</p>';
		echo "<script>setTimeout(\"location.href = 'film_special_features.php';\",2000);</script>";
	}
}


if(isset($_GET["update"]))
{
	
	$update = true;
	$film_id = $_GET["update"];
	
		$selResult = mysqli_query($conn, "SELECT * FROM film_special_features WHERE film_id = $film_id;");
	
	if (!empty($selResult)){
		$row = mysqli_fetch_array($selResult);
        $film_id = $row['film_id'];
        $special_features = $row['special_features'];
    }		
	
}

if(isset($_POST["update"]))
{
	
	$film_id = $_POST['film_id'];
    $special_features = $_POST['special_features'];

	$updateResult = mysqli_query($conn, "UPDATE film_special_features SET special_features='$special_features' WHERE film_id=$film_id;") or die($conn->error);
	
	
	if($updateResult){ 
		echo '<p class="msg">'."Record has been updated successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'film_special_features.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to update record!".'</p>';
		echo "<script>setTimeout(\"location.href = 'film_special_features.php';\",2000);</script>";
	}
}

if (isset($_GET['delete'])) {
	$film_id = $_GET['delete'];
	$deleteResult = mysqli_query($conn, "DELETE FROM film_special_features WHERE film_id= $film_id");
	
	if($deleteResult){ //using javascript to setTimeout so we can display whether query was succesful or not message
		echo  '<p class="msg">'."Record has been deleted successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'film_special_features.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to delete record! ".'</p>';
		echo "<script>setTimeout(\"location.href = 'film_special_features.php';\",2000);</script>";
	}
}


?>
<html>
<head>
	<title>Sakila Database - Film_Special_Features Table</title>
	
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
			width: 70%;
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
	<li><a href="film_special_features.php">FILM SPECIAL FEATURES TABLE</a></li>
	<li style="float: right" class="title">SAKILA DATABASE</li>
	</ul>
	
	<div class="selection">
	<form action="film_special_features.php" method="POST">
		<h3>Select Fields</h3>
		<input type="checkbox" name="selectField[]" value="film_id" checked> <label>film_id</label> </br>
		<input type="checkbox" name="selectField[]" value="special_features" checked> <label>special_features</label> </br>
		<input type="submit" class="btn" name="select" value="Select"></input>
	</form>

    <div class="insert_update">
	<form action="film_special_features.php" method="POST">
		<?php
			if ($update == true):
			?>
				<h3>Update Data</h3>	
				<div class="inputGrp">
					<label>film_id</label>
					<input type="number" name="film_id" value="<?php echo $film_id?>" > <br/>
				</div>	
                <div class="inputGrp">
					<label>special_features</label>
					<input type="text" name="special_features" value="<?php echo $special_features?>" > <br/>
				</div>
				<input type="submit" class="btn" name="update" Value= "Update"></input>
				
			<?php else: ?>
				<h3>Insert Data</h3>
				<div class="inputGrp">
					<label>film_id</label>
					<input type="number" name="film_id" value="film_id" > <br/> 
				</div>
				<div class="inputGrp">
					<label>special_features</label>
					<input type="text" name="special_features" value="" placeholder="special_features" > <br/> 
				</div>
				<input type="submit" class="btn" name="insert" Value= "Insert"></input>
			<?php endif; ?>
		
			
	</form>	
	</div>

    <?php
	
		$selectResult = mysqli_query($conn, "SELECT * FROM film_special_features;"); 
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
							
							<?php if(!empty($_POST['selectField'])&&in_array("special_features",$_POST['selectField'])){ ?>
									<th>special_features</th>
							<?php }
								  else{ ?>  <th style="display:none;">special_features</th>  <?php } ?>
							
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
								
									if (!empty($_POST['selectField'])&&in_array("special_features",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['special_features']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['special_features']; ?>  </td>  <?php } ?>
								
									<td><button type="submit" class="update_btn" name="update"><a href="film_special_features.php?update=<?php echo $row['film_id']; ?>">Update</a></button> </td>
									<td><button type="submit"  class="delete_btn" name="delete"><a href="film_special_features.php?delete=<?php echo $row['film_id']; ?>" onclick="return confirm('You are about to delete this record.');">Delete</a></button> </td>
							
							</tr>
					  <?php } ?>
					</table>   
                            
    <?php		} else{echo "You didn't select any fields.";}
	
			}else{
	?>
				<table>
					<tr>
						<th>film_id</th>
						<th>special_features</th>
						<th>Update</th>
						<th>Delete</th>
					</tr>
					<?php while ($row = mysqli_fetch_assoc($selectResult)){ ?>
					<tr>
						<td><?php echo $row['film_id']; ?></td>
						<td><?php echo $row['special_features']; ?></td>
						<td><button type="submit"  class="update_btn" name="update"><a href="film_special_features.php?update=<?php echo $row['film_id']; ?>">Update</a></button> </td>
						<td><button type="submit" class="delete_btn" name="delete"><a href="film_special_features.php?delete=<?php echo $row['film_id']; ?>" onclick="return confirm('You are about to delete this record.');">Delete</a></button> </td>
							
					</tr>
				<?php } ?>
				</table>
		
	<?php		}
		} else{die("ERROR: Did not receive any result.");} 
	
	?>
</div>
</body>
</html>