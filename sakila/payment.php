<?php
	include'DB.php';
	
    $payment_id = '';
    $customer_id ='';
	$staff_id = '';
    $rental_id = '';
    $amount ='';
    $payment_date ='';
	$last_update = '';
	$update = false;

if(isset($_POST["insert"]))
{
    $customer_id = $_POST['customer_id'];
	$staff_id = $_POST['staff_id'];
    $rental_id = $_POST['rental_id'];
    $amount = $_POST['amount'];
    $payment_date = date("Y-m-d H:i:s");
	$last_update = date("Y-m-d H:i:s");
	
	$sqlstmt = "INSERT INTO payment (customer_id, staff_id, rental_id, amount, payment_date, last_update) VALUES('$customer_id', '$staff_id', '$rental_id', '$amount', '$payment_date', '$last_update')";
	$insertResult = mysqli_query($conn, $sqlstmt);


	
	if($insertResult){ //using javascript to setTimeout so we can display whether query was succesful or not message
		echo '<p class="msg">'."Record has been inserted successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'payment.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to insert record!".'</p>';
		echo "<script>setTimeout(\"location.href = 'payment.php';\",2000);</script>";
		echo mysqli_error($conn);
	}
}


if(isset($_GET["update"]))
{
	
	$update = true;
	$payment_id = $_GET["update"];
	
		$selResult = mysqli_query($conn, "SELECT * FROM payment WHERE payment_id = $payment_id;");
	
	if (!empty($selResult)){
        $row = mysqli_fetch_array($selResult);
		$payment_id = $row['payment_id'];
		$customer_id = $row['customer_id'];
        $staff_id = $row['staff_id'];
		$rental_id = $row['rental_id'];
		$amount = $row['amount'];
		$payment_date = ['payment_date'];
    }		
	
}

if(isset($_POST["update"]))
{
	$payment_id = $_POST['payment_id'];
	$customer_id = $_POST['customer_id'];
    $staff_id = $_POST['staff_id'];
	$rental_id = $_POST['rental_id'];
	$amount = $_POST['amount'];
	$payment_date = date("Y-m-d H:i:s");
    $last_update = date('Y-m-d h:i:s');

	$updateResult = mysqli_query($conn, "UPDATE payment SET payment_id='$payment_id', customer_id='$customer_id', staff_id = '$rental_id', amount='$amount', payment_date='$payment_date', last_update='$last_update' WHERE payment_id=$payment_id;") or die($conn->error);
	
	
	if($updateResult){ //using javascript to setTimeout so we can display whether query was succesful or not message
		echo '<p class="msg">'."Record has been updated successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'payment.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to update record!".'</p>';
		echo "<script>setTimeout(\"location.href = 'payment.php';\",2000);</script>";
	}
}

if (isset($_GET['delete'])) {
	$payment_id = $_GET['delete'];
	$deleteResult = mysqli_query($conn, "DELETE FROM payment WHERE payment_id= $payment_id");
	
	if($deleteResult){ //using javascript to setTimeout so we can display whether query was succesful or not message
		echo  '<p class="msg">'."Record has been deleted successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'payment.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to delete record! ".'</p>';
		echo "<script>setTimeout(\"location.href = 'payment.php';\",2000);</script>";
	}
}


?>
<html>
<head>
	<title>Sakila Database - Payment Table </title>
	
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
			width: 80%;
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
			padding: 5px;
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
	<li><a href="payment.php">PAYMENT TABLE</a></li>
	<li style="float: right" class="title">SAKILA DATABASE</li>
	</ul>
	
	<div class="selection">
	<form action="payment.php" method="POST">
		<h3>Select Fields</h3>
        <input type="checkbox" name="selectField[]" value="payment_id" checked> <label>payment_id</label><br>
        <input type="checkbox" name="selectField[]" value="customer_id" checked> <label>customer_id</label><br>
		<input type="checkbox" name="selectField[]" value="staff_id" checked> <label>staff_id</label><br>
        <input type="checkbox" name="selectField[]" value="rental_id" checked> <label>rental_id</label><br>
        <input type="checkbox" name="selectField[]" value="amount" checked> <label>amount</label><br>
        <input type="checkbox" name="selectField[]" value="payment_date" checked> <label>payment_date</label><br>
		<input type="checkbox" name="selectField[]" value="last_update" checked> <label>last_update</label><br>
		<input type="submit" class="btn" name="select" value="Select"></input>
	</form>
	
	<div class="insert_update">
	<form action="payment.php" method="POST">
		<?php
			if ($update == true):
			?>
				<h3>Update Data</h3>

				<div class="inputGrp">
					<label>payment_id</label>
					<input type="number" name="payment_id" value="<?php echo $payment_id?>" readonly> <br/>
                </div>
                <div class="inputGrp">
					<label>customer_id</label>
					<input type="number" name="customer_id" value="<?php echo $customer_id?>" > <br/>
                </div>
				<div class="inputGrp">	
					<label>staff_id</label>
					<input type="number" name="staff_id" value="<?php echo $staff_id?>" > <br/>
				</div>	
				<div class="inputGrp">
					<label>rental_id</label>
					<input type="number" name="rental_id" value="<?php echo $rental_id?>"  > <br/>
                </div>	
				<div class="inputGrp">
					<label>amount</label>
					<input type="number" step="0.01" name="amount" value="<?php echo $amount?>" placeholder="Enter amount value"  > <br/>
                </div>	
				<div class="inputGrp">
					<label>payment_date</label>
					<input type="date" name="payment_date" value="<?php echo $payment_date?>"  > <br/>
                </div>	

				<input type="submit" class="btn" name="update" Value= "Update"></input>
				
			<?php else: ?>
				<h3>Insert Data</h3>
				
                <div class="inputGrp">
					<label>customer_id</label>
					<input type="number" name="customer_id" value="customer_id" > <br/> 
                </div>

				<div class="inputGrp">
					<label>staff_id</label>
					<input type="number" name="staff_id" value="staff_id"> <br/>
				</div>
				<div class="inputGrp">
					<label>rental_id</label>
					<input type="number" name="rental_id" value="rental_id" > <br/>
                </div>
				<div class="inputGrp">
					<label>amount</label>
					<input type="number" step="0.01" name="amount" value="amount" placeholder="Enter amount value"> <br/>
				</div>
				<div class="inputGrp">
					<label>payment_date</label>
					<input type="date" name="payment_date" value="payment_date" > <br/>
				</div>

				<input type="submit" class="btn" name="insert" Value= "Insert"></input>
			<?php endif; ?>
		
			
	</form>	
	</div>
	
	<?php
	
		$selectResult = mysqli_query($conn, "SELECT * FROM payment;"); 
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
							<?php if(!empty($_POST['selectField'])&&in_array("payment_id",$_POST['selectField'])){ ?>
									<th>payment_id</th>
							<?php }
                                  else{ ?>  <th style="display:none;">payment_id</th>  <?php } ?>

                            <?php if(!empty($_POST['selectField'])&&in_array("customer_id",$_POST['selectField'])){ ?>
									<th>customer_id</th>
							<?php }
                                  else{ ?>  <th style="display:none;">customer_id</th>  <?php } ?>
                    
							<?php if(!empty($_POST['selectField'])&&in_array("staff_id",$_POST['selectField'])){ ?>
									<th>staff_id</th>
							<?php }
								  else{ ?>  <th style="display:none;">staff_id</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("rental_id",$_POST['selectField'])){ ?>
									<th>rental_id</th>
							<?php }
                                  else{ ?>  <th style="display:none;">rental_id</th>  <?php } ?>
                                  
                            <?php if(!empty($_POST['selectField'])&&in_array("amount",$_POST['selectField'])){ ?>
									<th>amount</th>
							<?php }
                                  else{ ?>  <th style="display:none;">amount</th>  <?php } ?>
                            
                            <?php if(!empty($_POST['selectField'])&&in_array("payment_date",$_POST['selectField'])){ ?>
								    <th>payment_date</th>
							<?php }
								  else{ ?>  <th style="display:none;">payment_date</th>  <?php } ?>
							
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
							<?php 	if (!empty($_POST['selectField'])&&in_array("payment_id",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['payment_id']; ?>  </td>  <?php }
                                    else{ ?>  <td style="display:none;"> <?php echo $row['payment_id']; ?>  </td>  <?php }
                                    
                                    if (!empty($_POST['selectField'])&&in_array("customer_id",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['customer_id']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['customer_id']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("staff_id",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['staff_id']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['staff_id']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("rental_id",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['rental_id']; ?>  </td>  <?php }
                                    else{ ?>  <td style="display:none;"> <?php echo $row['rental_id']; ?>  </td>  <?php }
                                    
                                    if (!empty($_POST['selectField'])&&in_array("amount",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['amount']; ?>  </td>  <?php }
                                    else{ ?>  <td style="display:none;"> <?php echo $row['amount']; ?>  </td>  <?php } 
                                    
                                    if (!empty($_POST['selectField'])&&in_array("payment_date",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['payment_date']; ?>  </td>  <?php }
                                    else{ ?>  <td style="display:none;"> <?php echo $row['payment_date']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("last_update",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['last_update']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['last_update']; ?>  </td>  <?php } ?>
								
									<td><button type="submit" class="update_btn" name="update"><a href="payment.php?update=<?php echo $row['payment_id']; ?>">Update</a></button> </td>
									<td><button type="submit"  class="delete_btn" name="delete"><a href="payment.php?delete=<?php echo $row['payment_id']; ?>" onclick="return confirm('You are about to delete this record.');">Delete</a></button> </td>
							
							</tr>
					  <?php } ?>
					</table>
		
	<?php		} else{echo "You didn't select any fields.";}
	
			}else{
	?>
				<table>
					<tr>
                        <th>payment_id</th>
                        <th>customer_id</th>
						<th>staff_id</th>
                        <th>rental_id</th>	
                        <th>amount</th>
                        <th>payment_date</th>
						<th>last_update</th>
						<th>Update</th>
						<th>Delete</th>
					</tr>
					<?php while ($row = mysqli_fetch_assoc($selectResult)){ ?>
					<tr>
                        <td><?php echo $row['payment_id']; ?></td>
                        <td><?php echo $row['customer_id']; ?></td>
						<td><?php echo $row['staff_id']; ?></td>
                        <td><?php echo $row['rental_id']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
                        <td><?php echo $row['payment_date']; ?></td>
						<td><?php echo $row['last_update']; ?></td>
						<td><button type="submit"  class="update_btn" name="update"><a href="payment.php?update=<?php echo $row['payment_id']; ?>">Update</a></button> </td>
						<td><button type="submit" class="delete_btn" name="delete"><a href="payment.php?delete=<?php echo $row['payment_id']; ?>" onclick="return confirm('You are about to delete this record.');">Delete</a></button> </td>
							
					</tr>
				<?php } ?>
				</table>
		
    <?php       }
	 } else{die("ERROR: Did not receive any result.");} 
	
	?>
</div>
</body>
</html>

