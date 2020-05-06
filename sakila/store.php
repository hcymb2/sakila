<?php
	include'DB.php';
	
	$store_id = '';
	$manager_staff_id = '';
	$address_id = '';
	$last_update = '';
	$update = false;

if(isset($_POST["insert"]))
{
	$manager_staff_id = $_POST['manager_staff_id'];
	$address_id = $_POST['address_id'];
	$last_update = date("Y-m-d H:i:s");
	
	$sqlstmt = "INSERT INTO store (manager_staff_id, address_id, last_update) VALUES('$manager_staff_id', '$address_id', '$last_update')";
	$insertResult = mysqli_query($conn, $sqlstmt) or die(mysqli_error($conn));

	
	if($insertResult){ //using javascript to setTimeout so we can display whether query was succesful or not message
		echo '<p class="msg">'."Record has been inserted successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'store.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to insert record!".'</p>';
		echo mysqli_error($conn);
		//echo "<script>setTimeout(\"location.href = 'store.php';\",2000);</script>";
	}
}


if(isset($_GET["update"]))
{
	
	$update = true;
	$store_id = $_GET["update"];
	
		$selResult = mysqli_query($conn, "SELECT * FROM store WHERE store_id = $store_id;");
	
	if (!empty($selResult)){
		$row = mysqli_fetch_array($selResult);
        $store_id = $row['store_id'];
        $manager_staff_id = $row['manager_staff_id'];
        $address_id = $row['address_id'];
    }		
	
}

if(isset($_POST["update"]))
{
	
	$store_id = $_POST['store_id'];
    $manager_staff_id = $_POST['manager_staff_id'];
    $address_id = $_POST['address_id'];
    $last_update = date('Y-m-d h:i:s');

	$updateResult = mysqli_query($conn, "UPDATE store SET manager_staff_id='$manager_staff_id', address_id='$address_id', last_update='$last_update' WHERE store_id=$store_id;") or die($conn->error);
	
	
	if($updateResult){ //using javascript to setTimeout so we can display whether query was succesful or not message
		echo '<p class="msg">'."Record has been updated successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'store.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to update record!".'</p>';
		echo "<script>setTimeout(\"location.href = 'store.php';\",2000);</script>";
	}
}

if (isset($_GET['delete'])) {
	$store_id = $_GET['delete'];
	$deleteResult = mysqli_query($conn, "DELETE FROM store WHERE store_id= $store_id");
	
	if($deleteResult){ //using javascript to setTimeout so we can display whether query was succesful or not message
		echo  '<p class="msg">'."Record has been deleted successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'store.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to delete record! ".'</p>';
		echo "<script>setTimeout(\"location.href = 'store.php';\",2000);</script>";
	}
}


?>
<html>
<head>
	<title>Sakila Database - Store Table</title>
	
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
			width: 60%;
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
			text-align: center;
			border: none;
			height: 30px;
			padding: 4px;
		}
		
		tr:hover {
			background: #F5F5F5;
		}
		
		form {
			width: 20%;
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
	<li><a href="store.php">STORE TABLE</a></li>
	<li style="float: right" class="title">SAKILA DATABASE</li>
	</ul>
	
	<div class="selection">
	<form action="store.php" method="POST">
		<h3>Select Fields</h3>
		<input type="checkbox" name="selectField[]" value="store_id" checked> <label>store_id</label><br>
		<input type="checkbox" name="selectField[]" value="manager_staff_id" checked> <label>manager_staff_id</label><br>
		<input type="checkbox" name="selectField[]" value="address_id" checked> <label>address_id</label><br>
		<input type="checkbox" name="selectField[]" value="last_update" checked> <label>last_update</label><br>
		<input type="submit" class="btn" name="select" value="Select"></input>
	</form>
	
	<div class="insert_update">
	<form action="store.php" method="POST">
		<?php
			if ($update == true):
			?>
				<h3>Update Data</h3>
				<div class="inputGrp">
					<label>store_id</label>
					<input type="number" name="store_id" value="<?php echo $store_id?>" readonly> <br/> 
				</div>
				<div class="inputGrp">	
					<label>manager_staff_id</label>
					<input type="number" name="manager_staff_id" value="<?php echo $manager_staff_id?>" > <br/>
				</div>	
				<div class="inputGrp">
					<label>address_id</label>
					<input type="number" name="address_id" value="<?php echo $address_id?>"> <br/>
				</div>	
				<input type="submit" class="btn" name="update" Value= "Update"></input>
				
			<?php else: ?>
				<h3>Insert Data</h3>
				<div class="inputGrp">
					<label>store_id</label>
					<input type="number" name="store_id" value="store_id"> <br/> 
				</div>
				<div class="inputGrp">
					<label>manager_staff_id</label>
					<input type="number" name="manager_staff_id" value="manager_staff_id"> <br/>
				</div>
				<div class="inputGrp">
					<label>address_id</label>
					<input type="number" name="address_id" value="address_id"> <br/>
				</div>
				<input type="submit" class="btn" name="insert" Value= "Insert"></input>
			<?php endif; ?>
		
			
	</form>	
	</div>
	
	<?php
	
		$selectResult = mysqli_query($conn, "SELECT * FROM store;"); 
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
							<?php if(!empty($_POST['selectField'])&&in_array("store_id",$_POST['selectField'])){ ?>
									<th>store_id</th>
							<?php }
								  else{ ?>  <th style="display:none;">store_id</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("manager_staff_id",$_POST['selectField'])){ ?>
									<th>manager_staff_id</th>
							<?php }
								  else{ ?>  <th style="display:none;">manager_staff_id</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("address_id",$_POST['selectField'])){ ?>
									<th>address_id</th>
							<?php }
								  else{ ?>  <th style="display:none;">address_id</th>  <?php } ?>
							
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
							<?php 	if (!empty($_POST['selectField'])&&in_array("store_id",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['store_id']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['store_id']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("manager_staff_id",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['manager_staff_id']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['manager_staff_id']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("address_id",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['address_id']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['address_id']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("last_update",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['last_update']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['last_update']; ?>  </td>  <?php } ?>
								
									<td><button type="submit" class="update_btn" name="update"><a href="store.php?update=<?php echo $row['store_id']; ?>">Update</a></button> </td>
									<td><button type="submit"  class="delete_btn" name="delete"><a href="store.php?delete=<?php echo $row['store_id']; ?>" onclick="return confirm('You are about to delete this record.');">Delete</a></button> </td>
							
							</tr>
					  <?php } ?>
					</table>
		
	<?php		} else{echo "You didn't select any fields.";}
	
			}else{
	?>
				<table>
					<tr>
						<th>store_id</th>
						<th>manager_staff_id</th>
						<th>address_id</th>	
						<th>last_update</th>
						<th>Update</th>
						<th>Delete</th>
					</tr>
					<?php while ($row = mysqli_fetch_assoc($selectResult)){ ?>
					<tr>
						<td><?php echo $row['store_id']; ?></td>
						<td><?php echo $row['manager_staff_id']; ?></td>
						<td><?php echo $row['address_id']; ?></td>
						<td><?php echo $row['last_update']; ?></td>
						<td><button type="submit"  class="update_btn" name="update"><a href="store.php?update=<?php echo $row['store_id']; ?>">Update</a></button> </td>
						<td><button type="submit" class="delete_btn" name="delete"><a href="store.php?delete=<?php echo $row['store_id']; ?>" onclick="return confirm('You are about to delete this record.');">Delete</a></button> </td>
							
					</tr>
				<?php } ?>
				</table>
		
	<?php		}
		} else{die("ERROR: Did not receive any result.");} 
	
	?>
</div>
</body>
</html>

