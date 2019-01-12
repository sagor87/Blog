<?php include 'inc/header.php';?>

<?php
 $db = new Database();

 if($_SERVER["REQUEST_METHOD"] == "POST"){
 
 $fname = $fm->validation($_POST['firstname']);
 $lname = $fm->validation($_POST['lastname']);
 $email = $fm->validation($_POST['email']);
 $body = $fm->validation($_POST['body']);

 $fname = mysqli_real_escape_string($db->link, $fname);
 $lname = mysqli_real_escape_string($db->link, $lname);
 $email = mysqli_real_escape_string($db->link, $email);
 $email = mysqli_real_escape_string($db->link, $email);
	
	$errorf = "";
	$errorl = "";
	$errore = "";
	$errorb = "";
	
	if(empty($fname)) {
	$errorf = "first name must not be empty";
	}if(empty($lname)) {
	$errorl = "last name must not be empty";
	}if(empty($email)) {
	$errore = "email must not be empty";
	}if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
	$errore = "Invalidate email address";
	}if(empty($body)) {
	$errorb = "message must not be empty";
	}else{
		 $query = "INSERT INTO tbl_contact(firstname,lastname,email,body) values('$fname','$lname','$email','$body')";
               
               $contact = $db->insert($query);
               if($contact){
                 echo "<span class ='success'>Message Sent Successfully</span>";
             }else{echo "<span class ='error'>Message not Sent Successfully</span>";
         }
	}
}


?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<h2>Contact us</h2>
			 
			 <?php
			 /*if (isset($error)) {
					echo "<span style= 'color:red'>$error</span>";
				}if (isset($msg)) {
					echo "<span style='color:green'>$msg</span>";
				}*/
				?>

			<form action="" method="post">
				<table>
					<tr>
						<td>Your First Name:</td>
						<td>
							<?php 
							if (isset($errorf)) {echo "<span style= 'color:red'>$errorf</span>";}?>
							<input type="text" name="firstname" placeholder="Enter first name" />
						</td>
					</tr>
					<tr>
						<td>Your Last Name:</td>
						<td>
							<?php 
							if (isset($errorl)) {echo "<span style= 'color:red'>$errorl</span>";}?>
							<input type="text" name="lastname" placeholder="Enter Last name" />
						</td>
					</tr>

					<tr>
						<td>Your Email Address:</td>
						<td>
							<?php 
							if (isset($errore)) {echo "<span style= 'color:red'>$errore</span>";}?>
							<input type="text" name="email" placeholder="Enter Email Address" />
						</td>
					</tr>
					<tr>
						<td>Your Message:</td>
						<td>
							<?php 
							if (isset($errorb)) {echo "<span style= 'color:red'>$errorb</span>";}?>
							<textarea name="body"></textarea>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="submit" value="Sent"/>
						</td>
					</tr>
				</table>
				<form>				
				</div>

</div>
		

<?php include 'inc/sidebar.php';?>
<?php include 'inc/footer.php';?>