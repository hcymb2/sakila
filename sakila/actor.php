<?php
	
	//Including the DB.php file because this holds the actual code to establish a connection to the database. 
	include'DB.php';

	
	//Declaring variables and initialising them to their default values for best practice.
	$actor_id = '';
	$first_name = '';
	$last_name = '';
	$last_update = '';
	$update = false;

if(isset($_POST["insert"])) //Using post method to see if submit button has been pressed.
{
	//Values of each field are collected using $_POST variable.
	$actor_id = $_POST['actor_id'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$last_update = date("Y-m-d H:i:s");
	
	//Performing an Insert query on the database via the established connection. The $actor_id is auto incremented hence does not need to be included in the SQL statement.
	$insertResult = mysqli_query($conn, "INSERT INTO actor (first_name, last_name, last_update) VALUES('$first_name', '$last_name', '$last_update');");

	
	if($insertResult){ //Using javascript to setTimeout so we can display whether query was succesful or not message
		echo '<p class="msg">'."Record has been inserted successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'actor.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to insert record!".'</p>';
		echo "<script>setTimeout(\"location.href = 'actor.php';\",2000);</script>";
	}
}


if(isset($_GET["update"])) 
{
	//$_GET method will show the value of the primary key, actor_id, in the URL of the page which will be collected to select values of that record from the database and display it on the update form. 
	$update = true;
	$actor_id = $_GET["update"];
	
		//Using the actor_id gotten using the $_GET variable to select that record from the database.
		$selResult = mysqli_query($conn, "SELECT * FROM actor WHERE actor_id = $actor_id;");
	
	//Placing the result returned from the query above in an array called $row. Then indexing this array to assign values to each of the field variables.
	if (!empty($selResult)){
		$row = mysqli_fetch_array($selResult);
        $actor_id = $row['actor_id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
    }		
	
}

if(isset($_POST["update"]))
{
	//The field variables are assigned the values inserted by the user in the update form via the $_POST variable.
	$actor_id = $_POST['actor_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $last_update = date('Y-m-d h:i:s');

	//Performing an Update query on the database via the established connection. 
	$updateResult = mysqli_query($conn, "UPDATE actor SET first_name='$first_name', last_name='$last_name', last_update='$last_update' WHERE actor_id=$actor_id;") or die($conn->error);
	
	
	if($updateResult){ 
		echo '<p class="msg">'."Record has been updated successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'actor.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to update record!".'</p>';
		echo "<script>setTimeout(\"location.href = 'actor.php';\",2000);</script>";
	}
}

if (isset($_GET['delete'])) { //Executing the Delete query if Delete button was pressed. The $_GET method is used to collect the value of the primary key.
	$actor_id = $_GET['delete'];
	$deleteResult = mysqli_query($conn, "DELETE FROM actor WHERE actor_id= $actor_id");
	
	if($deleteResult){
		echo  '<p class="msg">'."Record has been deleted successfuly.".'</p>';
		echo "<script>setTimeout(\"location.href = 'actor.php';\",2000);</script>"; 
	}
	else{
		echo '<p class="msgFailed">'."Failed to delete record! ".'</p>';
		echo "<script>setTimeout(\"location.href = 'actor.php';\",2000);</script>";
	}
}


?>
<html>
<head>
	<!-- This is the title that will be displayed on the tab of the page. -->
	<title>Sakila Database - Actor Table</title> 
	
	<!-- All elements were allocated to classes, the style tag allows us to use CSS to design the different elements/ groups of elements as we like. -->
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

	<!-- This is the code for the navigation bar in the header of the webpage. -->
	<ul>
	<li><a class="active" href="index.php">Home</a></li>
	<li><a href="actor.php">ACTOR TABLE</a></li>
	<li style="float: right" class="title">SAKILA DATABASE</li>
	</ul>
	
	<!-- Select form. It collects the values of checked fields in the array selectField[]. -->
	<div class="selection">
	<form action="actor.php" method="POST">
		<h3>Select Fields</h3>
		<input type="checkbox" name="selectField[]" value="actor_id" checked> <label>actor_id</label> </br>
		<input type="checkbox" name="selectField[]" value="first_name" checked> <label>first_name</label> </br>
		<input type="checkbox" name="selectField[]" value="last_name" checked> <label>last_name</label> </br>
		<input type="checkbox" name="selectField[]" value="last_update" checked> <label>last_update</label> </br>
		<input type="submit" class="btn" name="select" value="Select"></input>
	</form>
	
	<!-- The insert and update forms have the same structure hence they are in an if-else condition. -->
	<div class="insert_update">
	<form action="actor.php" method="POST">
		<?php
			//when update == true, get method will collect the actor_id and perform a select query to get the values of that record and assign them to the field variables.
			if ($update == true):
			?>
			
				<h3>Update Data</h3>
				
				<!-- The values in this form have been set to echo the values of the field variables. The primary key has been set to read-only so that its not changed by mistake and we can update the correct record. -->
				<div class="inputGrp">
					<label>actor_id</label>
					<input type="number" name="actor_id" value="<?php echo $actor_id?>" readonly> <br/> 
				</div>
				<div class="inputGrp">	
					<label>first_name</label>
					<input type="text" name="first_name" value="<?php echo $first_name?>" > <br/>
				</div>	
				<div class="inputGrp">
					<label>last_name</label>
					<input type="text" name="last_name" value="<?php echo $last_name?>" > <br/>
				</div>	
				<input type="submit" class="btn" name="update" Value= "Update"></input>
				
			<?php else: ?>
				<h3>Insert Data</h3>
				<div class="inputGrp">
					<label>actor_id</label>
					<input type="number" name="actor_id" value="actor_id" > <br/> 
				</div>
				<div class="inputGrp">
					<label>first_name</label>
					<input type="text" name="first_name" value="" placeholder="First Name" > <br/>
				</div>
				<div class="inputGrp">
					<label>last_name</label>
					<input type="text" name="last_name" value="" placeholder="Last Name" > <br/>
				</div>
				<input type="submit" class="btn" name="insert" Value= "Insert"></input>
			<?php endif; ?>
		
			
	</form>	
	</div>
	
	<?php
	
	//This is the code for performing a select query. This php section has been kept within the html body because the results from the select query are being displayed in a table format in the website, which uses html to build.
		$selectResult = mysqli_query($conn, "SELECT * FROM actor;"); 
		$resultCheck = mysqli_num_rows($selectResult);

		if($resultCheck > 0)
		{
			if(isset($_POST["select"])) //This if conditon checks whether the user has selected any fields.
			{
				if(isset($_POST["select"])&&!empty($_POST['selectField'])) //This if conditon checks whether the selectField array is empty or not. If it is empty the user will be notified that they have not selected any fields.
				{
	?>
					<table>
						<tr>
							<!--Each column/field header is surrounded in an if condition, so that only if it is in the selectField array i.e the user had checked this field it will be displayed. Otherwise, using the html display property, that field won't be displayed.-->
							<?php if(!empty($_POST['selectField'])&&in_array("actor_id",$_POST['selectField'])){ ?>
									<th>actor_id</th>
							<?php }
								  else{ ?>  <th style="display:none;">actor_id</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("first_name",$_POST['selectField'])){ ?>
									<th>first_name</th>
							<?php }
								  else{ ?>  <th style="display:none;">first_name</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("last_name",$_POST['selectField'])){ ?>
									<th>last_name</th>
							<?php }
								  else{ ?>  <th style="display:none;">last_name</th>  <?php } ?>
							
							<?php if(!empty($_POST['selectField'])&&in_array("last_update",$_POST['selectField'])){ ?>
									<th>last_update</th>
							<?php }
								  else{ ?>  <th style="display:none;">last_update</th>  <?php } ?>
							
							<th>Update</th>
							<th>Delete</th>
							
						</tr>
						
							<?php
							//$row collects the results of the Select query in an array format. And by indexing this array the values are places in rows in the table on the website.
							while($row = mysqli_fetch_assoc($selectResult))
							{ ?>
							<tr> 
							<?php 	if (!empty($_POST['selectField'])&&in_array("actor_id",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['actor_id']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['actor_id']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("first_name",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['first_name']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['first_name']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("last_name",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['last_name']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['last_name']; ?>  </td>  <?php }
								
									if (!empty($_POST['selectField'])&&in_array("last_update",$_POST['selectField'])){ ?>
										<td>  <?php echo $row['last_update']; ?>  </td>  <?php }
									else{ ?>  <td style="display:none;"> <?php echo $row['last_update']; ?>  </td>  <?php } ?>
									
									<!--When either the update or delete button are clicked both use the $_GET method to get the actor_id. When the delete button is clicked, the onclick attribute shows a confirmation box before executing the delete query. -->
									<td><button type="submit" class="update_btn" name="update"><a href="actor.php?update=<?php echo $row['actor_id']; ?>">Update</a></button> </td>
									<td><button type="submit"  class="delete_btn" name="delete"><a href="actor.php?delete=<?php echo $row['actor_id']; ?>" onclick="return confirm('You are about to delete this record.');">Delete</a></button> </td>
							
							</tr>
					  <?php } ?>
					</table>
		
	<?php		} else{echo "You didn't select any fields.";}
	
			}else{ //By default, all the fields are selected. Hence the entire table from the database is displayed, they way it is.
	?>
				<table>
					<tr>
						<th>actor_id</th>
						<th>first_name</th>
						<th>last_name</th>	
						<th>last_update</th>
						<th>Update</th>
						<th>Delete</th>
					</tr>
					<?php while ($row = mysqli_fetch_assoc($selectResult)){ ?>
					<tr>
						<td><?php echo $row['actor_id']; ?></td>
						<td><?php echo $row['first_name']; ?></td>
						<td><?php echo $row['last_name']; ?></td>
						<td><?php echo $row['last_update']; ?></td>
						<td><button type="submit"  class="update_btn" name="update"><a href="actor.php?update=<?php echo $row['actor_id']; ?>">Update</a></button> </td>
						<td><button type="submit" class="delete_btn" name="delete"><a href="actor.php?delete=<?php echo $row['actor_id']; ?>" onclick="return confirm('You are about to delete this record.');">Delete</a></button> </td>
							
					</tr>
				<?php } ?>
				</table>
		
	<?php		}
		} else{die("ERROR: Did not receive any result.");} 
	
	?>
</div>
</body>
</html>

