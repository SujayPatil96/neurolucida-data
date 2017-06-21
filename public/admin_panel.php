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

	<div class="vertical_line1">
		<label for="dendrite_area">Attach a Dendrite Area Excel sheet here:</label>
		<input type="file" id="dendrite_area" name="dendrite_area" />
		<br /><br />

		<label for="dendrite_length">Attach a Dendrite Length Excel sheet here:</label>
		<input type="file" id="dendrite_length" name="dendrite_length" />
		<br /><br />

		<label for="dendrite_volume">Attach a Dendrite Volume Excel sheet here:</label>
		<input type="file" id="dendrite_volume" name="dendrite_volume" />
		<br /><br />
	</div>

	<div class="vertical_line2">
		<label for="fda_sheet">Attach a copy of the FDA (sum) Excel sheet here:</label>
		<input type="file" id="fda_sheet" name="fda_sheet" />
		<br /><br />

		<label for="fdv_sheet">Attach a copy of the FDV (sum) Excel sheet here:</label>
		<input type="file" id="fdv_sheet" name="fdv_sheet" />
		<br /><br />

		<label for="filament_length">Attach a copy of the Filament Length (sum) Excel sheet here:</label>
		<input type="file" id="filament_length" name="filament_length" />
		<br /><br />

		<label for="sholl_ints">Attach a copy of the No. of Sholl Intersections Excel sheet here:</label>
		<input type="file" id="sholl_ints" name="sholl_ints" />
		<br /><br />
	</div>

	<button type="submit" name="submit" id="submit">Submit</button>
	</form>

</body>
</html>
