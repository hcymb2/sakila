<?php
    include'DB.php';
    
    $customer_id = '';
    $store_id = '';
    $first_name = '';
    $last_name = '';
    $email = '';
    $address_id = '';
    $active = '';
    $create_date = '';
	$last_update = '';
    $update = false;
    
if(isset($_POST["insert"]))
{
    $customer_id = $_POST['customer_id'];
    $store_id = $_POST['store_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $address_id = $_POST['address_id'];
    $active = $_POST['active'];
    $create_date = date("Y-m-d H:i:s");
    $last_update = date("Y-m-d H:i:s");

    $insertResult = mysqli_query($conn, "INSERT INTO customer (store_id, first_name, last_name, email, address_id, active, create_date, last_update) VALUES('$store_id', '$first_name', '$last_name', '$email', '$address_id', '$active', '$create_date', '$last_update');");


    if($insertResult){ 
		echo '<p class="msg">'."Record has been inserted successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'customer.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to insert record!".'</p>';
		echo "<script>setTimeout(\"location.href = 'customer.php';\",2000);</script>";
	}
}


if(isset($_GET["update"]))
{
	
	$update = true;
	$customer_id = $_GET["update"];
	
		$selResult = mysqli_query($conn, "SELECT * FROM cutsomer WHERE customer_id = $customer_id;");
	
	if (!empty($selResult)){
		$row = mysqli_fetch_array($selResult);
        $customer_id = $row['customer_id'];
        $store_id = $row['store_id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
        $address_id = $row['address_id'];
        $active = $row['active'];
        $create_date = date("Y-m-d H:i:s");
    }		
	
}

if(isset($_POST["update"]))
{
	
	$customer_id = $_POST['customer_id'];
    $store_id = $_POST['store_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $address_id = $_POST['address_id'];
    $active = $_POST['active'];
    $create_date = date("Y-m-d H:i:s");
    $last_update = date("Y-m-d H:i:s");

	$updateResult = mysqli_query($conn, "UPDATE customer SET store_id='$store_id', first_name='$first_name', last_name='$last_name', email='$email', address_id='$address_id', active='$active', create_date='$create_date', last_update='$last_update' WHERE customer_id=$customer_id;") or die($conn->error);
	
	
	if($updateResult){ 
		echo '<p class="msg">'."Record has been updated successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'customer.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to update record!".'</p>';
		echo "<script>setTimeout(\"location.href = 'customer.php';\",2000);</script>";
	}
}

if (isset($_GET['delete'])) {
	$customer_id = $_GET['delete'];
	$deleteResult = mysqli_query($conn, "DELETE FROM customer WHERE customer_id= $customer_id");
	
	if($deleteResult){ //using javascript to setTimeout so we can display whether query was succesful or not message
		echo  '<p class="msg">'."Record has been deleted successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'customer.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to delete record! ".'</p>';
		echo "<script>setTimeout(\"location.href = 'customer.php';\",2000);</script>";
	}
}


?>
<html>
<head>
	<title>Sakila Database - Customer Table</title>
	
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
	<li><a href="customer.php">CUSTOMER TABLE</a></li>
	<li style="float: right" class="title">SAKILA DATABASE</li>
	</ul>
	
	<div class="selection">
	<form action="customer.php" method="POST">
		<h3>Select Fields</h3>
		<input type="checkbox" name="selectField[]" value="customer_id" checked> <label>customer_id</label> </br>
		<input type="checkbox" name="selectField[]" value="store_id" checked> <label>store_id</label> </br>
        <input type="checkbox" name="selectField[]" value="first_name" checked> <label>first_name</label> </br>
		<input type="checkbox" name="selectField[]" value="last_name" checked> <label>last_name</label> </br>
		<input type="checkbox" name="selectField[]" value="email" checked> <label>email</label> </br>
		<input type="checkbox" name="selectField[]" value="address_id" checked> <label>address_id</label> </br>
		<input type="checkbox" name="selectField[]" value="active" checked> <label>active</label> </br>
		<input type="checkbox" name="selectField[]" value="create_date" checked> <label>create_date</label> </br>
		<input type="checkbox" name="selectField[]" value="last_update" checked> <label>last_update</label> </br>
		<input type="submit" class="btn" name="select" value="Select"></input>
	</form>

    <div class="insert_update">
	<form action="customer.php" method="POST">
		<?php
			if ($update == true):
			?>
				<h3>Update Data</h3>
				<div class="inputGrp">
					<label>customer_id</label>
					<input type="number" name="customer_id" value="<?php echo $customer_id?>" readonly > <br/> 
				</div>
				<div class="inputGrp">	
					<label>store_id</label>
					<input type="number" name="store_id" value="<?php echo $store_id?>" readonly > <br/> 
				</div>
                <div class="inputGrp">	
					<label>first_name</label>
					<input type="text" name="first_name" value="<?php echo $first_name?>" > <br/>
				</div>	
				<div class="inputGrp">
					<label>last_name</label>
					<input type="text" name="last_name" value="<?php echo $last_name?>" > <br/>
				</div>	
				<div class="inputGrp">	
					<label>email</label>
					<input type="email" name="email" value="<?php echo $email?>" > <br/>
				</div>	
				<div class="inputGrp">
					<label>address_id</label>
					<input type="number" name="address_id" value="<?php echo $address_id?>" > <br/>
				</div>
				<div class="inputGrp">	
					<label>active</label>
					<input type="number" name="active" value="<?php echo $active?>" > <br/>
				</div>	
				<div class="inputGrp">
					<label>create_date</label>
					<input type="date" name="create_date" value="<?php echo $create_date?>" > <br/>
				</div>
				<input type="submit" class="btn" name="update" Value= "Update"></input>

                <?php else: ?>
				<h3>Insert Data</h3>
                <div class="inputGrp">
					<label>customer_id</label>
					<input type="number" name="customer_id" value="customer_id" > <br/> 
				</div>
				<div class="inputGrp">	
					<label>store_id</label>
					<input type="number" name="store_id" value="" placeholder="store_id" > <br/> 
				</div>
                <div class="inputGrp">
					<label>first_name</label>
					<input type="text" name="first_name" value="" placeholder="First Name" > <br/>
				</div>
				<div class="inputGrp">
					<label>last_name</label>
					<input type="text" name="last_name" value="" placeholder="Last Name" > <br/>
				</div>	
				<div class="inputGrp">	
					<label>email</label>
					<input type="email" name="email" value="" placeholder="email" > <br/>
				</div>	
				<div class="inputGrp">
					<label>address_id</label>
					<input type="number" name="address_id" value="" placeholder="address_id" > <br/>
				</div>
				<div class="inputGrp">	
					<label>active</label>
					<input type="number" name="active" value="" placeholder="active" > <br/>
				</div>	
				<div class="inputGrp">
					<label>create_date</label>
					<input type="date" name="create_date" value="" placeholder="create_date" > <br/>
				</div>
                <input type="submit" class="btn" name="insert" Value= "Insert"></input>
            <?php endif; ?>
		
			
    </form>	
    </div>

    <?php
	
		$selectResult = mysqli_query($conn, "SELECT * FROM customer;"); 
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
                            <?php if(!empty($_POST['selectField'])&&in_array("customer_id",$_POST['selectField'])){ ?>
									<th>customer_id</th>
							<?php }
								  else{ ?>  <th style="display:none;">customer_id</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("store_id",$_POST['selectField'])){ ?>
									<th>store_id</th>
							<?php }
								  else{ ?>  <th style="display:none;">store_id</th>  <?php } ?>
							
                            <?php if(!empty($_POST['selectField'])&&in_array("first_name",$_POST['selectField'])){ ?>
									<th>first_name</th>
							<?php }
								  else{ ?>  <th style="display:none;">first_name</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("last_name",$_POST['selectField'])){ ?>
									<th>last_name</th>
							<?php }
								  else{ ?>  <th style="display:none;">last_name</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("email",$_POST['selectField'])){ ?>
									<th>email</th>
							<?php }
								  else{ ?>  <th style="display:none;">email</th>  <?php } ?>
								  
							<?php if(!empty($_POST['selectField'])&&in_array("address_id",$_POST['selectField'])){ ?>
									<th>address_id</th>
							<?php }
								  else{ ?>  <th style="display:none;">address_id</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("active",$_POST['selectField'])){ ?>
									<th>active</th>
							<?php }
								  else{ ?>  <th style="display:none;">active</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("create_date",$_POST['selectField'])){ ?>
									<th>create_date</th>
							<?php }
								  else{ ?>  <th style="display:none;">create_date</th>  <?php } ?>
							
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
							<?php 	if (!empty($_POST['selectField'])&&in_array("customer_id",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['customer_id']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['customer_id']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("store_id",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['store_id']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['store_id']; ?>  </td>  <?php }
                                    
                                    if (!empty($_POST['selectField'])&&in_array("first_name",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['first_name']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['first_name']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("last_name",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['last_name']; ?>  </td>  <?php }
                                    else{ ?>  <td style="display:none;"> <?php echo $row['last_name']; ?>  </td>  <?php }
                                    
                                    if (!empty($_POST['selectField'])&&in_array("email",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['email']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['email']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("address_id",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['address_id']; ?>  </td>  <?php }
                                    else{ ?>  <td style="display:none;"> <?php echo $row['address_id']; ?>  </td>  <?php }
                                    
                                    if (!empty($_POST['selectField'])&&in_array("active",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['active']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['active']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("create_date",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['create_date']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['create_date']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("last_update",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['last_update']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['last_update']; ?>  </td>  <?php } ?>
								
									<td><button type="submit" class="update_btn" name="update"><a href="customer.php?update=<?php echo $row['customer_id']; ?>">Update</a></button> </td>
									<td><button type="submit"  class="delete_btn" name="delete"><a href="customer.php?delete=<?php echo $row['customer_id']; ?>" onclick="return confirm('You are about to delete this record.');">Delete</a></button> </td>
							
							</tr>
					  <?php } ?>
					</table>
                    
    <?php		} else{echo "You didn't select any fields.";}
	
			}else{
	?>
				<table>
					<tr>
						<th>customer_id</th>
						<th>store_id</th>
						<th>first_name</th>
						<th>last_name</th>
						<th>email</th>
						<th>address_id</th>
						<th>active</th>
                        <th>create_date</th>
						<th>last_update</th>
						<th>Update</th>
						<th>Delete</th>
					</tr>
					<?php while ($row = mysqli_fetch_assoc($selectResult)){ ?>
					<tr>
						<td><?php echo $row['customer_id']; ?></td>
						<td><?php echo $row['store_id']; ?></td>
						<td><?php echo $row['first_name']; ?></td>
						<td><?php echo $row['last_name']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['address_id']; ?></td>
						<td><?php echo $row['active']; ?></td>
                        <td><?php echo $row['create_date']; ?></td>
						<td><?php echo $row['last_update']; ?></td>
						<td><button type="submit"  class="update_btn" name="update"><a href="customer.php?update=<?php echo $row['customer_id']; ?>">Update</a></button> </td>
						<td><button type="submit" class="delete_btn" name="delete"><a href="customer.php?delete=<?php echo $row['customer_id']; ?>" onclick="return confirm('You are about to delete this record.');">Delete</a></button> </td>
							
					</tr>
				<?php } ?>
				</table>
		
	<?php		}
		} else{die("ERROR: Did not receive any result.");} 
	
	?>
</div>
</body>
</html>
