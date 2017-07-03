<!DOCTYPE HTML>
<head>
    <title>Upload Status</title>
</head>
<link rel="stylesheet" href="css/main.css" />
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,400i,700,700i" rel="stylesheet">
<style type="text/css">
    html {
        font-family: Josefin Sans;
    }
</style>
<h1 style="text-align: center;"><u>Upload Status of all the files</u></h1>

<?php
    include '../includes/PHPExcel/Classes/PHPExcel.php';

    // fix the working directorys
    $target_dir = "data/wd/";

    // grab the filenames of all the uploaded files
    $target_filament_tracer = $target_dir . basename($_FILES["filament_tracer"]["name"]);

    // read the single filament tracer attachment
    echo "<ul>";
        // for area sheet
        if (move_uploaded_file($_FILES["filament_tracer"]["tmp_name"], $target_filament_tracer)) {
            echo "<li>The file <b>". basename( $_FILES["filament_tracer"]["name"]). "</b> has been uploaded." . "<br /></li>";
        } else {
            echo "<li>Sorry, there was an error uploading your file." . "<br /></li>";
        }
    echo "</ul>";
    echo "<hr />";
?>

<?php
    $inputFileType = 'Excel5';
    $inputFileName = 'data/wd/working_file.xls';

    /**  Create a new Reader of the type defined in $inputFileType  **/
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    /**  Read the list of worksheet names and select the one that we want to load  **/
    $worksheetList = $objReader->listWorksheetNames($inputFileName);
    $sheetname = $worksheetList[0];

    // print the list of all the sheets in the workbook
    // print_r($worksheetList);
    // echo "<hr />";

    // pick the name of the sheet that has the word 'sholl' in it
    foreach ($worksheetList as $key => $value) {
        if (stripos($value, "sholl")) {
            $shollSheetname = $value;
        }
    }
?>

<?php
    $filename = "data/wd/working_file.xls";

    $xls = new PHPExcel();
    $xlsReader= new PHPExcel_Reader_Excel5();
    $xlsTemplate = $xlsReader->load($filename);

    $sheet1 = $xlsTemplate->getSheetByName('Dendrite Area');
    $xls->addExternalSheet($sheet1, 0);
    $xls->removeSheetByIndex(1);
    $xlsWriter = new PHPExcel_Writer_Excel5($xls);
    echo "<ul>";
    if($xlsWriter->save("data/wd/Dendrite Area.xls") == 0) {
        echo "<li>The <b>Dendrite Area.xls</b> file has been retreived.</li>";
    }

    $sheet2 = $xlsTemplate->getSheetByName('Dendrite Length');
    $xls->addExternalSheet($sheet2, 0);
    $xls->removeSheetByIndex(1);
    $xlsWriter = new PHPExcel_Writer_Excel5($xls);
    if($xlsWriter->save("data/wd/Dendrite Length.xls") == 0) {
        echo "<li>The <b>Dendrite Length.xls</b> file has been retreived.</li>";
    }

    $sheet3 = $xlsTemplate->getSheetByName('Dendrite Volume');
    $xls->addExternalSheet($sheet3, 0);
    $xls->removeSheetByIndex(1);
    $xlsWriter = new PHPExcel_Writer_Excel5($xls);
    if($xlsWriter->save("data/wd/Dendrite Volume.xls") == 0) {
        echo "<li>The <b>Dendrite Volume.xls</b> file has been retreived.</li>";
    }

    $sheet4 = $xlsTemplate->getSheetByName('Filament Dendrite Area (sum)');
    $xls->addExternalSheet($sheet4, 0);
    $xls->removeSheetByIndex(1);
    $xlsWriter = new PHPExcel_Writer_Excel5($xls);
    if($xlsWriter->save("data/wd/Filament Dendrite Area (sum).xls") == 0) {
        echo "<li>The <b>Filament Dendrite Area (sum).xls</b> file has been retreived.</li>";
    }

    $sheet5 = $xlsTemplate->getSheetByName('Filament Dendrite Length (sum)');
    $xls->addExternalSheet($sheet5, 0);
    $xls->removeSheetByIndex(1);
    $xlsWriter = new PHPExcel_Writer_Excel5($xls);
    if($xlsWriter->save("data/wd/Filament Dendrite Length (sum).xls") == 0) {
        echo "<li>The <b>Filament Dendrite Length (sum).xls</b> file has been retreived.</li>";
    }

    $sheet6 = $xlsTemplate->getSheetByName('Filament Dendrite Volume (sum)');
    $xls->addExternalSheet($sheet6, 0);
    $xls->removeSheetByIndex(1);
    $xlsWriter = new PHPExcel_Writer_Excel5($xls);
    if($xlsWriter->save("data/wd/Filament Dendrite Volume (sum).xls") == 0) {
        echo "<li>The <b>Filament Dendrite Volume (sum).xls</b> file has been retreived.</li>";
    }

    $sheet7 = $xlsTemplate->getSheetByName($shollSheetname);
    $xls->addExternalSheet($sheet7, 0);
    $xls->removeSheetByIndex(1);
    $xlsWriter = new PHPExcel_Writer_Excel5($xls);
    if($xlsWriter->save("data/wd/" . $shollSheetname . ".xls") == 0) {
        echo "<li>The <b>" . $shollSheetname . ".xls</b> file has been retreived.</li>";
    }
    echo "</ul>";
?>

<!DOCTYPE HTML>
<button id="load_php">Click here to process the uploaded files!</button>
<div style="text-align: center">
    <a href="#" onclick="window.history.go(-1); return false" style="">&lt; &lt; GO BACK</a>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $('#load_php').click(function(){
       window.open('process_sholl.php','_blank');
    });
</script>
