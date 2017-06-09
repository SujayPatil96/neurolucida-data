<?php
    ob_start();
    session_start();
    if( isset($_SESSION['user'])!="" ){
    header("Location: home.php");
    }
    include_once '../includes/dbconnect.php';

    $error = false;

    if ( isset($_POST['btn-signup']) ) {

    // clean user inputs to prevent sql injections
    $name = trim($_POST['name']);
    $name = strip_tags($name);
    $name = htmlspecialchars($name);

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    // basic name validation
    if (empty($name)) {
    $error = true;
    $nameError = "Please enter your full name.";
    } else if (strlen($name) < 3) {
    $error = true;
    $nameError = "Name must have atleat 3 characters.";
    } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
    $error = true;
    $nameError = "Name must contain alphabets and space.";
    }

    //basic email validation
    if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
    $error = true;
    $emailError = "Please enter valid email address.";
    } else {
    // check email exist or not
    $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
    $result = mysql_query($query);
    $count = mysql_num_rows($result);
    if($count!=0){
    $error = true;
    $emailError = "Provided Email is already in use.";
    }
    }
    // password validation
    if (empty($pass)){
    $error = true;
    $passError = "Please enter password.";
    } else if(strlen($pass) < 6) {
    $error = true;
    $passError = "Password must have atleast 6 characters.";
    }

    // password encrypt using SHA256();
    $password = hash('sha256', $pass);

    // if there's no error, continue to signup
    if( !$error ) {

    $query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
    $res = mysql_query($query);

    if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully registered, you may login now";
    unset($name);
    unset($email);
    unset($pass);
    } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later...";
    }
    }
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Page</title>
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,400i,700,700i" rel="stylesheet">

<style type="text/css">
    html, body {
        font-family: Josefin Sans, sans-serif;
    }

    h2 {
        font-weight: bold;
        text-align: center;
    }
</style>

</head>
<body>

<div class="container">

 <div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    <div class="col-md-12">
        <div class="form-group">
            <h2 class="">Sign Up.</h2>
        </div>
        <div class="form-group"><hr /></div>

<?php
   if (isset($errMSG)) {
?>
    <div class="form-group">
            <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
                <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
             </div>
    </div>
<?php
   }
?>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            <input type="text" name="name" class="form-control" placeholder="Enter your name here.." maxlength="50" value="<?php echo $name ?>" />
        </div>
            <span class="text-danger"><?php echo $nameError; ?></span>
    </div>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <input type="email" name="email" class="form-control" placeholder="Enter your email id here.." maxlength="40" value="<?php echo $email ?>" />
        </div>
            <span class="text-danger"><?php echo $emailError; ?></span>
    </div>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            <input type="password" name="pass" class="form-control" placeholder="Enter your password here.." maxlength="15" />
        </div>
            <span class="text-danger"><?php echo $passError; ?></span>
    </div>

    <div class="form-group"><hr /></div>

    <div class="form-group">
        <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
    </div>

    <div class="form-group"><hr /></div>

    <div class="form-group">
        <a href="index.php">Click here to Sign in...</a>
    </div>
    </div>
    </form>
</div><!-- end of the div with login-form id -->

</div>  <!-- end of container class -->

</body>
</html>
<?php ob_end_flush(); ?>
