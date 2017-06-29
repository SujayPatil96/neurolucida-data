<?php
	// Start the session
	session_start();
	ob_start();

	if (!isset($_SESSION['user'])) {
		header("Location: index.php");
	}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <title>Admin Panel</title>
  <link rel="stylesheet" type="text/css" media="all" href="css/admin_panel.css">
  <link rel="stylesheet" type="text/css" media="all" href="css/main.css">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,400i,700,700i" rel="stylesheet">
  <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
</head>

<body>
  <nav id="fixedbar">
    <ul id="fixednav">
		<!-- add some more tabs to the navbar here -->
    </ul>
  </nav>

  <div id="w">
    <nav id="navigation">
      <ul>
        <!-- add more tabs to the main navbar here -->
      </ul>
    </nav>

    <div id="content">
	<br>
    <h1>Brief Documentation.</h1>

	<form action="upload_worksheets.php" method="post" enctype="multipart/form-data" id="admin_panel">

	<fieldset>
		<legend><span class="number">1</span>Attachments</legend>
	</fieldset>

	<label for="filament_tracer">Attach the Filament Tracer Excel sheet here:</label>
	<input type="file" id="filament_tracer" name="filament_tracer" />
	<br /><br />

	<button type="submit" name="submit" id="submit">Submit</button>
	</form>

</body>
</html>
