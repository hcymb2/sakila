<?php
    include'DB.php';
    
    $language_id = '';
	$name = '';
	$last_update = '';
    $update = false;
    
if(isset($_POST["insert"]))
{
    $language_id = $_POST['language_id'];
	$name = $_POST['name'];
    $last_update = date("Y-m-d H:i:s");

    $insertResult = mysqli_query($conn, "INSERT INTO language (name, last_update) VALUES('$name', '$last_update');");


    if($insertResult){ 
		echo '<p class="msg">'."Record has been inserted successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'language.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to insert record!".'</p>';
		echo "<script>setTimeout(\"location.href = 'language.php';\",2000);</script>";
	}
}


if(isset($_GET["update"]))
{
	
	$update = true;
	$language_id = $_GET["update"];
	
		$selResult = mysqli_query($conn, "SELECT * FROM language WHERE language_id = $language_id;");
	
	if (!empty($selResult)){
		$row = mysqli_fetch_array($selResult);
        $language_id = $row['language_id'];
        $name = $row['name'];
    }		
	
}

if(isset($_POST["update"]))
{
	
	$language_id = $_POST['language_id'];
	$name = $_POST['name'];
    $last_update = date("Y-m-d H:i:s");

	$updateResult = mysqli_query($conn, "UPDATE language SET name='$name', last_update='$last_update' WHERE language_id=$language_id;") or die($conn->error);
	
	
	if($updateResult){ 
		echo '<p class="msg">'."Record has been updated successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'language.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to update record!".'</p>';
		echo "<script>setTimeout(\"location.href = 'language.php';\",2000);</script>";
	}
}

if (isset($_GET['delete'])) {
	$language_id = $_GET['delete'];
	$deleteResult = mysqli_query($conn, "DELETE FROM language WHERE language_id= $language_id");
	
	if($deleteResult){ //using javascript to setTimeout so we can display whether query was succesful or not message
		echo  '<p class="msg">'."Record has been deleted successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'language.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to delete record! ".'</p>';
		echo "<script>setTimeout(\"location.href = 'language.php';\",2000);</script>";
	}
}


?>
<html>
<head>
	<title>Sakila Database - Language Table</title>
	
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
	<li><a href="language.php">LANGUAGE TABLE</a></li>
	<li style="float: right" class="title">SAKILA DATABASE</li>
	</ul>
	
	<div class="selection">
	<form action="language.php" method="POST">
		<h3>Select Fields</h3>
		<input type="checkbox" name="selectField[]" value="language_id" checked> <label>language_id</label> </br>
		<input type="checkbox" name="selectField[]" value="name" checked> <label>name</label> </br>
		<input type="checkbox" name="selectField[]" value="last_update" checked> <label>last_update</label> </br>
		<input type="submit" class="btn" name="select" value="Select"></input>
	</form>

    <div class="insert_update">
	<form action="language.php" method="POST">
		<?php
			if ($update == true):
			?>
				<h3>Update Data</h3>
				<div class="inputGrp">
					<label>language_id</label>
					<input type="number" name="language_id" value="<?php echo $language_id?>" readonly> <br/> 
				</div>	
				<div class="inputGrp">
					<label>name</label>
					<input type="text" name="name" value="<?php echo $name?>" > <br/>
				</div>	
				<input type="submit" class="btn" name="update" Value= "Update"></input>
				
			<?php else: ?>
				<h3>Insert Data</h3>
				<div class="inputGrp">
					<label>language_id</label>
					<input type="number" name="language_id" value="language_id" > <br/> 
				</div>
				<div class="inputGrp">
					<label>name</label>
					<input type="text" name="name" value="" placeholder="name" > <br/> 
				</div>
				<input type="submit" class="btn" name="insert" Value= "Insert"></input>
			<?php endif; ?>
		
			
	</form>	
	</div>

    <?php
	
		$selectResult = mysqli_query($conn, "SELECT * FROM language;"); 
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
                            <?php if(!empty($_POST['selectField'])&&in_array("language_id",$_POST['selectField'])){ ?>
									<th>language_id</th>
							<?php }
								  else{ ?>  <th style="display:none;">language_id</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("name",$_POST['selectField'])){ ?>
									<th>name</th>
							<?php }
								  else{ ?>  <th style="display:none;">name</th>  <?php } ?>
							
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
							<?php 	if (!empty($_POST['selectField'])&&in_array("language_id",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['language_id']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['language_id']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("name",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['name']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['name']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("last_update",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['last_update']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['last_update']; ?>  </td>  <?php } ?>
								
									<td><button type="submit" class="update_btn" name="update"><a href="language.php?update=<?php echo $row['language_id']; ?>">Update</a></button> </td>
									<td><button type="submit"  class="delete_btn" name="delete"><a href="language.php?delete=<?php echo $row['language_id']; ?>" onclick="return confirm('You are about to delete this record.');">Delete</a></button> </td>
							
							</tr>
					  <?php } ?>
					</table>   
                            
    <?php		} else{echo "You didn't select any fields.";}
	
			}else{
	?>
				<table>
					<tr>
						<th>language_id</th>
						<th>name</th>
						<th>last_update</th>
						<th>Update</th>
						<th>Delete</th>
					</tr>
					<?php while ($row = mysqli_fetch_assoc($selectResult)){ ?>
					<tr>
						<td><?php echo $row['language_id']; ?></td>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['last_update']; ?></td>
						<td><button type="submit"  class="update_btn" name="update"><a href="language.php?update=<?php echo $row['language_id']; ?>">Update</a></button> </td>
						<td><button type="submit" class="delete_btn" name="delete"><a href="language.php?delete=<?php echo $row['language_id']; ?>" onclick="return confirm('You are about to delete this record.');">Delete</a></button> </td>
							
					</tr>
				<?php } ?>
				</table>
		
	<?php		}
		} else{die("ERROR: Did not receive any result.");} 
	
	?>
</div>
</body>
</html>