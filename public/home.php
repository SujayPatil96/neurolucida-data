<?php
    ob_start();
    session_start();
    require_once '../includes/dbconnect.php';

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['user']) ) {
        header("Location: index.php");
    exit;
    }
    // select loggedin uers detail
    $res = mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
    $userRow = mysql_fetch_array($res);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome&nbsp;<?php echo $userRow['userName']; ?></title>
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,400i,700,700i" rel="stylesheet">
</head>

<style type="text/css">
    html, body {
        font-family: Josefin Sans, sans-serif;
        font-size: 20px;
    }

    div.main {
        position: relative;
        left: 45%;
        margin-top: 100px;
        /*border: 1px black solid;*/
        padding: 10px 10px 10px 10px;
        width: 160px;
        box-shadow: 10px 10px 5px #888888;
    }

    h1, h2 {
        margin-top: 100px;
        text-align: center;
    }
</style>

<body>
    <h1>You have encountered an error!</h1>
    <h2>Please click Sign out below and Sign In again.</h2>
    <div class="main">
        <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Hi, <?php echo $userRow['userName']; ?>.&nbsp;</a>
    <br><br>
        <a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;Sign Out</a>
    </div>
</body>
</html>
<?php ob_end_flush(); ?>
