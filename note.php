<?php
include('config.php');
// fetching admin email where mail will send
if (isset($_POST['back'])) {
	header("Location: index.php");
	return;
}
/*$sql ="SELECT emailId from tblemail";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0):
foreach($results as $result):
$adminemail=$result->emailId;
endforeach;
endif;*/
if(isset($_POST['submit']))
{
// getting Post values
$name=$_POST['name'];
$phoneno=$_POST['phonenumber'];
$email=$_POST['emailaddres'];
$subject=$_POST['subject'];
$message=$_POST['message'];

$isread=0;
// Insert query
$sql="INSERT INTO  contact_info(FullName,PhoneNumber,EmailId,Subject,Message,Is_Read) VALUES(:fname,:phone,:email,:subject,:message,:isread)";
$query = $dbh->prepare($sql);
// Bind parameters
$query->bindParam(':fname',$name,PDO::PARAM_STR);
$query->bindParam(':phone',$phoneno,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':subject',$subject,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->bindParam(':isread',$isread,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{

echo "<script>alert('Your info submitted successfully.');</script>";
}
else
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}


}


?>
<!DOCTYPE HTML>
<html>
<div class="background">


	<head>

		<title>Essay Submission Portal</title>
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">


	</head>



	<body>

		<!-- ESSAY FORM -->

		<div class="main">
			<div class="main-section">
				<div class="login-form">
					<h2>Essay Submission</h2>
					<p>Submit your Essay through our online portal.</p>
					<span></span>
					<form name="ContactForm" method="post">

						<h4>your name</h4>
						<input type="text" name="name" class="user" placeholder="Johne" autocomplete="off" required>
						<h4>your phone number</h4>
						<input type="text" name="phonenumber" class="phone" placeholder="0123456789" maxlength="10" required autocomplete="off">

						<h4>your email address</h4>
						<input type="email" name="emailaddres" class="email" placeholder="Example@mail.com" required autocomplete="off">

						<h4>Essay Topic</h4>
						<input type="text" name="subject" class="email" placeholder="Subject" autocomplete="off">

						<h4>Your Submission</h4>

						<textarea class="mess" name="message" placeholder="Write your Essay here" required></textarea>


						<input class="btn btn-outline-dark" type="submit" value="Submit Essay" name="submit">

						

					</form>
					<form method="post">
						<input style="margin-top: 5px;" class="btn btn-outline-dark" type="submit" value="Go Back" name="back"> 
					</form>

				</div>
			</div>
		</div>


	</body>
</div>

</html>
