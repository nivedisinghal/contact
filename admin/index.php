<?php
 session_start();
//Database Configuration File
include('includes/config.php');
error_reporting(0);
if(isset($_POST['login']))
  {
 
    // Getting username and password
    $uname=$_POST['username'];
    $password=$_POST['password'];
    // Fetch data from database on the basis of username/email and password
    $sql ="SELECT UserName,Password FROM teacher WHERE (UserName=:usname)";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':usname', $uname, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach ($results as $row) {
$hashpass=$row->Password;
}
//verifying Password
if (password_verify($password, $hashpass)) {
$_SESSION['userlogin']=$_POST['username'];
    echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
  } else {
$wrongpassword="You entered wrong password.";
 
  }
}
//if username or email not found in database
else{
$wrongemail="User not registered with us.";
  }
 
}
?>


<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <title>Teachers login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>
<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="images/img-01.png" alt="IMG">
                </div>
               
                
                <form class="login100-form validate-form" method="post" action="index.php">
					<span class="login100-form-title">
						Teacher login
					</span>
                    <?php if($wrongpassword):?>
                        <div class="alert bg-danger alert-icon-left alert-dismissible mb-2" role="alert">
                            <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Oh snap ! </strong> <?php echo htmlentities($wrongpassword); ?>
                        </div>
                    <?php endif;?>
    
                    <?php if($wrongemail):?>
                        <div class="alert bg-danger alert-icon-left alert-dismissible mb-2" role="alert" >
                            <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Oh snap ! </strong> <?php echo htmlentities($wrongemail); ?>
                        </div>
                    <?php endif;?>
                    
                    <div class="wrap-input100 validate-input" data-validate = "Valid username is required">
                        <input type="text" class="input100" id="username" name="username" placeholder="Your Username" tabindex="1" required data-validation-required-message="Please enter your username.">
                        
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
                    </div>
                    
                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <input type="password" class="input100" id="password" name="password" placeholder="Enter Password" tabindex="2" required data-validation-required-message="Please enter valid passwords.">
                        
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                    </div>
                    
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" name="login" type="submit">
                            Login
                        </button>
                    </div>
                    
                    <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
                        <a class="txt2" href="#">
                            Username / Password?
                        </a>
                    </div>
                    
                    <div class="text-center p-t-136">
                        <a class="txt2" href="create.php">
                            Create your Account
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    
    
    
    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script >
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
    
    
</body>
</html>