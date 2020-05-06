<?php
	include'DB.php';
	
	$staff_id = '';
	$first_name = '';
    $last_name = '';
    $address_id ='';
    $picture ='';
    $email ='';
    $store_id ='';
    $active ='';
    $username ='';
    $password ='';
	$last_update = '';
	$msg='';
	$update = false;

if(isset($_POST["insert"]))
{
	$first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address_id = $_POST['address_id'];
    
	//userImages is the Image directory that will store the pictures uploaded from the Staff table.  
    $target_path = "userImages/";
    $picture = $_FILES ['picture']['name'];
    $target_path = $target_path.basename($picture);
    

    $email = $_POST['email'];
	$store_id = $_POST['store_id'];
	$active = $_POST['active'];
    $username = $_POST['username'];
    $password = $_POST['password'];
	$last_update = date("Y-m-d H:i:s");
	
	
	$sqlstmt="INSERT INTO staff (first_name, last_name, address_id, picture, email, store_id, active, username, password, last_update) VALUES('$first_name', '$last_name', '$address_id', '$target_path', '$email', '$store_id', '$active', '$username', '$password', '$last_update')";
    //cho $sqlstmt;
    $insertResult = mysqli_query($conn, $sqlstmt) or die(mysqli_error($conn));

	//code to display image name with extension. move_uploaded_file() function checks to ensure that the file designated by filename is a valid upload file. If the file is valid, it will be moved to the filename given by $target_path i.e. the userImage directory.
	if (move_uploaded_file($_FILES['picture']['tmp_name'], $target_path)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
    //end of code
     
    $sqlpic="SELECT * FROM staff";
    $result=$conn->query($sqlpic);
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            $picpath=$row['picture']; 
        }
        //$conn->close();
    }

	if($insertResult){ 
		echo '<p class="msg">'."Record has been inserted successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'staff.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to insert record!".'</p>';
		echo "<script>setTimeout(\"location.href = 'staff.php';\",2000);</script>";
		echo mysqli_error($conn);
	}
}


if(isset($_GET["update"]))
{
	
	$update = true;
	$staff_id = $_GET["update"];
	
		$selResult = mysqli_query($conn, "SELECT * FROM staff WHERE staff_id = $staff_id;");
	
	if (!empty($selResult)){
		$row = mysqli_fetch_array($selResult);
        $staff_id = $row['staff_id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $address_id = $row['address_id'];
        $picture = $row ['picture'];
        $email = $row['email'];
		$store_id = $row['store_id'];
		$active = $row['active'];
        $username = $row['username'];
        $password = $row['password'];

    }		
	
}

if(isset($_POST["update"]))
{
	
	$staff_id = $_POST['staff_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address_id = $_POST['address_id'];
    
    
    $target_path = "userImages/";
    $picture = $_FILES ['picture']['name'];
    $target_path = $target_path.basename($picture);
	
    $email = $_POST['email'];
	$store_id = $_POST['store_id'];
	$active = $_POST['active'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $last_update = date('Y-m-d h:i:s');

	$updateResult = mysqli_query($conn, "UPDATE staff SET staff_id='$staff_id', first_name='$first_name', last_name='$last_name', address_id='$address_id', picture='$target_path', email='$email', store_id='$store_id', active='$active', username='$username', password='$password',  last_update='$last_update' WHERE staff_id=$staff_id;") or die($conn->error);
	
	if (move_uploaded_file($_FILES['picture']['tmp_name'], $target_path)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
      }
      
      $sqlpic="SELECT * FROM staff"; 
      $result=$conn->query($sqlpic);
      if($result->num_rows>0){
          while($row=$result->fetch_assoc()){
              $picpath=$row['picture']; 
          }
          //$conn->close();
      }
	
	if($updateResult){ 
		echo '<p class="msg">'."Record has been updated successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'staff.php';\", 2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to update record!".'</p>';
		echo "<script>setTimeout(\"location.href = 'staff.php';\", 2000);</script>";
	}
}

if (isset($_GET['delete'])) {
	$staff_id = $_GET['delete'];
	$deleteResult = mysqli_query($conn, "DELETE FROM staff WHERE staff_id= $staff_id");
	
	if($deleteResult){ 
		echo  '<p class="msg">'."Record has been deleted successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'staff.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to delete record! ".'</p>';
		echo "<script>setTimeout(\"location.href = 'staff.php';\",2000);</script>";
	}
}


?>
<html>
<head>
	<title>Sakila Database - Staff Table</title>
	
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
			text-align: centret;
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
			padding: 11px;
		}
		
		tr:hover {
			background: #F5F5F5;
		}
		
		form {
			width: 45%;
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
	<li><a href="staff.php">STAFF TABLE</a></li>
	<li style="float: right" class="title">SAKILA DATABASE</li>
	</ul>
	
	<div class="selection">
	<form action="staff.php" method="POST">
		<h3>Select Fields</h3>
		<input type="checkbox" name="selectField[]" value="staff_id" checked> <label>staff_id</label><br>
		<input type="checkbox" name="selectField[]" value="first_name" checked> <label>first_name</label><br>
		<input type="checkbox" name="selectField[]" value="last_name" checked> <label>last_name</label><br>
        <input type="checkbox" name="selectField[]" value="address_id" checked> <label>address_id</label><br>
		<input type="checkbox" name="selectField[]" value="picture" checked> <label>picture</label><br>
		<input type="checkbox" name="selectField[]" value="email" checked> <label>email</label><br>
		<input type="checkbox" name="selectField[]" value="store_id" checked> <label>store_id</label><br>
        <input type="checkbox" name="selectField[]" value="active" checked> <label>active</label><br>
		<input type="checkbox" name="selectField[]" value="username" checked> <label>username</label><br>
        <input type="checkbox" name="selectField[]" value="password" checked> <label>password</label><br>
		<input type="checkbox" name="selectField[]" value="last_update" checked> <label>last_update</label><br>
		<input type="submit" class="btn" name="select" value="Select"></input>
	</form>
	
	<div class="insert_update">
	<form action="staff.php" method="POST" enctype="multipart/form-data">
		<?php
			if ($update == true):
			?>
				<h3>Update Data</h3>
				<div class="inputGrp">
					<label>staff_id</label>
					<input type="number" name="staff_id" value="<?php echo $staff_id?>" readonly> <br/> 
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
					<label>address_id</label>
					<input type="number" name="address_id" value="<?php echo $address_id?>" > <br/>
				</div>	
				<div class="inputGrp">
					<form action="staff.php" method ="POST" enctype="multipart/form-data">	
					<label>picture</label>
					<input type="file" name="picture" value="<?php echo "<img src='".$row['picture']."' height='50' width='50'>"?>"><br/>
				</div>	
                <div class="inputGrp">	
					<label>email</label>
					<input type="email" name="email" value="<?php echo $email?>" > <br/>
				</div>	
                <div class="inputGrp">	
					<label>store_id</label>
					<input type="number" name="store_id" value="<?php echo $store_id?>" > <br/>
				</div>	
                <div class="inputGrp">	
					<label>active</label>
					<input type="number" name="active" value="<?php echo $active?>" > <br/>
				</div>	
                <div class="inputGrp">	
					<label>username</label>
					<input type="text" name="username" value="<?php echo $username?>" > <br/>
				</div>	
                <div class="inputGrp">	
					<label>password</label>
					<input type="password" name="password" value="<?php echo $password?>" > <br/>
				</div>	
				<input type="submit" class="btn" name="update" Value= "Update"></input>
				
			<?php else: ?>
				<h3>Insert Data</h3>
				
				<div class="inputGrp">
					<label>first_name</label>
					<input type="text" name="first_name" value="" placeholder="First Name" > <br/>
				</div>
				<div class="inputGrp">
					<label>last_name</label>
					<input type="text" name="last_name" value="" placeholder="Last Name" > <br/>
				</div>
                <div class="inputGrp">	
					<label>address_id</label>
					<input type="number" name="address_id" value="address_id"> <br/>
				</div>	
				<div class="inputGrp">	
					<label>picture</label>
                    <form action="staff.php" method ="POST" enctype="multipart/form-data">
                    <input type="hidden" value="10000000" name="filesize">
					<input type="file" name="picture"> <br/>
				</div>	
                <div class="inputGrp">	
					<label>email</label>
					<input type="email" name="email" value="" placeholder="Enter email"> <br/>
				</div>	
                <div class="inputGrp">	
					<label>store_id</label>
					<input type="number" name="store_id" value="store_id"> <br/>
				</div>	
                <div class="inputGrp">	
					<label>active</label>
					<input type="number" name="active" value="active" > <br/>
				</div>	
                <div class="inputGrp">	
					<label>username</label>
					<input type="text" name="username" value="" placeholder="Enter username" > <br/>
				</div>	
                <div class="inputGrp">	
					<label>password</label>
					<input type="password" name="password" value="" placeholder="Enter password"> <br/>
				</div>	
				<input type="submit" class="btn" name="insert" Value= "Insert"></input>
			<?php endif; ?>
		
			
	</form>	
	</div>
	
	<?php
	
		$selectResult = mysqli_query($conn, "SELECT * FROM staff;"); 
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
							<?php if(!empty($_POST['selectField'])&&in_array("staff_id",$_POST['selectField'])){ ?>
									<th>staff_id</th>
							<?php }
								  else{ ?>  <th style="display:none;">staff_id</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("first_name",$_POST['selectField'])){ ?>
									<th>first_name</th>
							<?php }
								  else{ ?>  <th style="display:none;">first_name</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("last_name",$_POST['selectField'])){ ?>
									<th>last_name</th>
							<?php }
								  else{ ?>  <th style="display:none;">last_name</th>  <?php } ?>

							<?php if(!empty($_POST['selectField'])&&in_array("address_id",$_POST['selectField'])){ ?>
									<th>address_id</th>
							<?php }
								  else{ ?>  <th style="display:none;">address_id</th>  <?php } ?>
								
								<?php if(!empty($_POST['selectField'])&&in_array("picture",$_POST['selectField'])){ ?>
									<th>picture</th>
							<?php }
								  else{ ?>  <th style="display:none;">picture</th>  <?php } ?>

							<?php if(!empty($_POST['selectField'])&&in_array("email",$_POST['selectField'])){ ?>
									<th>email</th>
							<?php }
								  else{ ?>  <th style="display:none;">email</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("store_id",$_POST['selectField'])){ ?>
									<th>store_id</th>
							<?php }
								  else{ ?>  <th style="display:none;">store_id</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("active",$_POST['selectField'])){ ?>
									<th>active</th>
							<?php }
								  else{ ?>  <th style="display:none;">active</th>  <?php } ?>

							<?php if(!empty($_POST['selectField'])&&in_array("username",$_POST['selectField'])){ ?>
									<th>username</th>
							<?php }
								  else{ ?>  <th style="display:none;">username</th>  <?php } ?>

							<?php if(!empty($_POST['selectField'])&&in_array("password",$_POST['selectField'])){ ?>
									<th>password</th>
							<?php }
								  else{ ?>  <th style="display:none;">password</th>  <?php } ?>
							
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
							<?php 	if (!empty($_POST['selectField'])&&in_array("staff_id",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['staff_id']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['staff_id']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("first_name",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['first_name']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['first_name']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("last_name",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['last_name']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['last_name']; ?>  </td>  <?php }
									
									if (!empty($_POST['selectField'])&&in_array("address_id",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['address_id']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['address_id']; ?>  </td>  <?php }

									if (!empty($_POST['selectField'])&&in_array("picture",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['picture']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo "<img src='".$row['picture']."' height='50' width='50'>" ?>  </td>  <?php }

									if (!empty($_POST['selectField'])&&in_array("email",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['email']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['email']; ?>  </td>  <?php }

									if (!empty($_POST['selectField'])&&in_array("store_id",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['store_id']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['store_id']; ?>  </td>  <?php }

									if (!empty($_POST['selectField'])&&in_array("active",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['active']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['active']; ?>  </td>  <?php }

									if (!empty($_POST['selectField'])&&in_array("username",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['username']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['username']; ?>  </td>  <?php }

									if (!empty($_POST['selectField'])&&in_array("password",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['password']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['password']; ?>  </td>  <?php }

									if (!empty($_POST['selectField'])&&in_array("last_update",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['last_update']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['last_update']; ?>  </td>  <?php } ?>
								
									<td><button type="submit" class="update_btn" name="update"><a href="staff.php?update=<?php echo $row['staff_id']; ?>">Update</a></button> </td>
									<td><button type="submit"  class="delete_btn" name="delete"><a href="staff.php?delete=<?php echo $row['staff_id']; ?>" onclick="return confirm('You are about to delete this record.');">Delete</a></button> </td>
							
							</tr>
					  <?php } ?>
					</table>
		
	<?php		} else{echo "You didn't select any fields.";}
	
			}else{
	?>
				<table>
					<tr>
						<th>staff_id</th>
						<th>first_name</th>
						<th>last_name</th>	
						<th>address_id</th>
						<th>picture</th>
						<th>email</th>
						<th>store_id</th>
						<th>active</th>
						<th>username</th>
						<th>password</th>
						<th>last_update</th>
						<th>Update</th>
						<th>Delete</th>
					</tr>
					<?php while ($row = mysqli_fetch_assoc($selectResult)){ ?>
					<tr>
						<td><?php echo $row['staff_id']; ?></td>
						<td><?php echo $row['first_name']; ?></td>
						<td><?php echo $row['last_name']; ?></td>
						<td><?php echo $row['address_id']; ?></td>
						<td><?php echo "<img src='".$row['picture']."' height='50' width='50'>";?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['store_id']; ?></td>
						<td><?php echo $row['active']; ?></td>
						<td><?php echo $row['username']; ?></td>
						<td><?php echo $row['password']; ?></td>
						<td><?php echo $row['last_update']; ?></td>
						<td><button type="submit"  class="update_btn" name="update"><a href="staff.php?update=<?php echo $row['staff_id']; ?>">Update</a></button> </td>
						<td><button type="submit" class="delete_btn" name="delete"><a href="staff.php?delete=<?php echo $row['staff_id']; ?>" onclick="return confirm('You are about to delete this record.');">Delete</a></button> </td>
							
					</tr>
				<?php } ?>
				</table>
		
	<?php		}
		} else{die("ERROR: Did not receive any result.");} 
	
	?>
</div>
</body>
</html>

