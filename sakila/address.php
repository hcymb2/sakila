<?php
	include'DB.php';
	
	$address_id = '';
	$address = '';
	$address2 = '';
	$district = '';
	$city_id = '';
	$postal_code = '';
	$phone ='';
	$last_update = '';
	$update = false;

if(isset($_POST["insert"]))
{
	$address_id = $_POST['address_id'];
	$address = $_POST['address'];
	$address2 = $_POST['address2'];
	$district = $_POST['district'];
	$city_id = $_POST['city_id'];
	$postal_code = $_POST['postal_code'];
	$phone =$_POST['phone'];
	$last_update = date("Y-m-d H:i:s");
	
	
	$insertResult = mysqli_query($conn, "INSERT INTO address (address_id, address, address2, district, city_id, postal_code, phone, last_update) VALUES('$address_id', '$address', '$address2', '$district', '$city_id', '$postal_code', '$phone', '$last_update');");

	
	if($insertResult){ 
		echo '<p class="msg">'."Record has been inserted successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'address.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to insert record!".'</p>';
		echo "<script>setTimeout(\"location.href = 'address.php';\",2000);</script>";
	}
}


if(isset($_GET["update"]))
{
	
	$update = true;
	$address_id = $_GET["update"];
	
		$selResult = mysqli_query($conn, "SELECT * FROM address WHERE address_id = $address_id;");
	
	if (!empty($selResult)){
		$row = mysqli_fetch_array($selResult);
        $address_id = $row['address_id'];
        $address = $row['address'];
		$address2 = $row['address2'];
		$district = $row['district'];
		$city_id = $row['city_id'];
		$postal_code = $row['postal_code'];
		$phone =$row['phone'];
    }		
	
}

if(isset($_POST["update"]))
{
	
	$address_id = $_POST['address_id'];
	$address = $_POST['address'];
	$address2 = $_POST['address2'];
	$district = $_POST['district'];
	$city_id = $_POST['city_id'];
	$postal_code = $_POST['postal_code'];
	$phone =$_POST['phone'];
	$last_update = date("Y-m-d H:i:s");

	$updateResult = mysqli_query($conn, "UPDATE address SET address='$address', address2='$address2', district='$district', city_id='$city_id', postal_code='$postal_code', phone='$phone', last_update='$last_update' WHERE address_id=$address_id;") or die($conn->error);
	
	
	if($updateResult){ 
		echo '<p class="msg">'."Record has been updated successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'address.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to update record!".'</p>';
		echo "<script>setTimeout(\"location.href = 'address.php';\",2000);</script>";
	}
}

if (isset($_GET['delete'])) {
	$address_id = $_GET['delete'];
	$deleteResult = mysqli_query($conn, "DELETE FROM address WHERE address_id= $address_id");
	
	if($deleteResult){ 
		echo  '<p class="msg">'."Record has been deleted successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'address.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to delete record! ".'</p>';
		echo "<script>setTimeout(\"location.href = 'address.php';\",2000);</script>";
	}
}


?>
<html>
<head>
	<title>Sakila Database - Address Table</title>
	
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
			text-align: center;
		}
		
		/*th{
				background-color: lightgrey;
				color: black;
		}*/
			
		tr {
			border-bottom: 1px solid #cbcbcb;
		}
		
		th, td{
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
	<li><a href="address.php">ADDRESS TABLE</a></li>
	<li style="float: right" class="title">SAKILA DATABASE</li>
	</ul>

	
	<div class="selection">
	<form action="address.php" method="POST">
		<h3>Select Fields</h3>
		<input type="checkbox" name="selectField[]" value="address_id" checked> <label>address_id</label> </br>
		<input type="checkbox" name="selectField[]" value="address" checked> <label>address</label> </br>
		<input type="checkbox" name="selectField[]" value="address2" checked> <label>address2</label> </br>
		<input type="checkbox" name="selectField[]" value="district" checked> <label>district</label> </br>
		<input type="checkbox" name="selectField[]" value="city_id" checked> <label>city_id</label> </br>
		<input type="checkbox" name="selectField[]" value="postal_code" checked> <label>postal_code</label> </br>
		<input type="checkbox" name="selectField[]" value="phone" checked> <label>phone</label> </br>
		<input type="checkbox" name="selectField[]" value="last_update" checked> <label>last_update</label> </br>
		<input type="submit" class="btn" name="select" value="Select"></input>
	</form>
	
	<div class="insert_update">
	<form action="address.php" method="POST">
		<?php
			if ($update == true):
			?>
				<h3>Update Data</h3>
				<div class="inputGrp">
					<label>address_id</label>
					<input type="number" name="address_id" value="<?php echo $address_id?>" readonly > <br/> 
				</div>
				<div class="inputGrp">	
					<label>address</label>
					<input type="text" name="address" value="<?php echo $address?>" > <br/>
				</div>	
				<div class="inputGrp">
					<label>address2</label>
					<input type="text" name="address2" value="<?php echo $address2?>" > <br/>
				</div>
				<div class="inputGrp">	
					<label>district</label>
					<input type="text" name="district" value="<?php echo $district?>" > <br/>
				</div>	
				<div class="inputGrp">
					<label>city_id</label>
					<input type="text" name="city_id" value="<?php echo $city_id?>" > <br/>
				</div>
				<div class="inputGrp">	
					<label>postal_code</label>
					<input type="text" name="postal_code" value="<?php echo $postal_code?>" > <br/>
				</div>	
				<div class="inputGrp">
					<label>phone</label>
					<input type="text" name="phone" value="<?php echo $phone?>" > <br/>
				</div>
				
				<input type="submit" class="btn" name="update" Value= "Update"></input>
				
			<?php else: ?>
				<h3>Insert Data</h3>				
				<div class="inputGrp">
					<label>address_id</label>
					<input type="number" name="address_id" value="address_id" > <br/> 
				</div>
				<div class="inputGrp">	
					<label>address</label>
					<input type="text" name="address" value="" placeholder="address"> <br/>
				</div>	
				<div class="inputGrp">
					<label>address2</label>
					<input type="text" name="address2" value="" placeholder="address2"> <br/>
				</div>
				<div class="inputGrp">	
					<label>district</label>
					<input type="text" name="district" value="" placeholder="district"> <br/>
				</div>	
				<div class="inputGrp">
					<label>city_id</label>
					<input type="text" name="city_id" value="" placeholder="city_id"> <br/>
				</div>
				<div class="inputGrp">	
					<label>postal_code</label>
					<input type="text" name="postal_code" value="" placeholder="postal_code"> <br/>
				</div>	
				<div class="inputGrp">
					<label>phone</label>
					<input type="text" name="phone" value="" placeholder="phone"> <br/>
				</div>
								
				<input type="submit" class="btn" name="insert" Value= "Insert"></input>
			<?php endif; ?>
		
			
	</form>	
	</div>
	
	<?php
	
		$selectResult = mysqli_query($conn, "SELECT * FROM address;"); 
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
							<?php if(!empty($_POST['selectField'])&&in_array("address_id",$_POST['selectField'])){ ?>
									<th>address_id</th>
							<?php }
								  else{ ?>  <th style="display:none;">address_id</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("address",$_POST['selectField'])){ ?>
									<th>address</th>
							<?php }
								  else{ ?>  <th style="display:none;">address</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("address2",$_POST['selectField'])){ ?>
									<th>address2</th>
							<?php }
								  else{ ?>  <th style="display:none;">address2</th>  <?php } ?>
								  
							<?php if(!empty($_POST['selectField'])&&in_array("district",$_POST['selectField'])){ ?>
									<th>district</th>
							<?php }
								  else{ ?>  <th style="display:none;">district</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("city_id",$_POST['selectField'])){ ?>
									<th>city_id</th>
							<?php }
								  else{ ?>  <th style="display:none;">city_id</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("postal_code",$_POST['selectField'])){ ?>
									<th>postal_code</th>
							<?php }
								  else{ ?>  <th style="display:none;">postal_code</th>  <?php } ?>
								  
							<?php if(!empty($_POST['selectField'])&&in_array("phone",$_POST['selectField'])){ ?>
									<th>phone</th>
							<?php }
								  else{ ?>  <th style="display:none;">phone</th>  <?php } ?>
							
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
							<?php 	if (!empty($_POST['selectField'])&&in_array("address_id",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['address_id']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['actor_id']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("address",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['address']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['address']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("address2",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['address2']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['address2']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("district",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['district']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['district']; ?>  </td>  <?php }
									
									if (!empty($_POST['selectField'])&&in_array("city_id",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['city_id']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['city_id']; ?>  </td>  <?php }
									
									if (!empty($_POST['selectField'])&&in_array("postal_code",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['postal_code']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['postal_code']; ?>  </td>  <?php }
									
									if (!empty($_POST['selectField'])&&in_array("phone",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['phone']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['phone']; ?>  </td>  <?php }
									
									
									if (!empty($_POST['selectField'])&&in_array("last_update",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['last_update']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['last_update']; ?>  </td>  <?php } ?>
								
									<td><button type="submit"  class="update_btn" name="update"><a href="address.php?update=<?php echo $row['address_id']; ?>">Update</a></button> </td>
									<td><button type="submit" class="delete_btn" name="delete"><a href="address.php?delete=<?php echo $row['address_id']; ?>" onclick="return confirm('You are about to delete this record.');">Delete</a></button> </td>
						
							</tr>
					  <?php } ?>
					</table>
		
	<?php		} else{echo "You didn't select any fields.";}
	
			}else{
	?>
				<table>
					<tr>
						<th>address_id</th>
						<th>address</th>
						<th>address2</th>
						<th>district</th>
						<th>city_id</th>
						<th>postal_code</th>
						<th>phone</th>
						<th>last_update</th>
						<th>Update</th>
						<th>Delete</th>
					</tr>
					<?php while ($row = mysqli_fetch_assoc($selectResult)){ ?>
					<tr>
						<td><?php echo $row['address_id']; ?></td>
						<td><?php echo $row['address']; ?></td>
						<td><?php echo $row['address2']; ?></td>
						<td><?php echo $row['district']; ?></td>
						<td><?php echo $row['city_id']; ?></td>
						<td><?php echo $row['postal_code']; ?></td>
						<td><?php echo $row['phone']; ?></td>
						<td><?php echo $row['last_update']; ?></td>
						<td><button type="submit"  class="update_btn" name="update"><a href="address.php?update=<?php echo $row['address_id']; ?>">Update</a></button> </td>
						<td><button type="submit" class="delete_btn" name="delete"><a href="address.php?delete=<?php echo $row['address_id']; ?>" onclick="return confirm('You are about to delete this record.');">Delete</a></button> </td>
							
					</tr>
				<?php } ?>
				</table>
		
	<?php		}
		} else{die("ERROR: Did not receive any result.");} 
	
	?>
</div>
</body>
</html>

