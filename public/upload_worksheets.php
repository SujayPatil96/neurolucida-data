<!DOCTYPE HTML>
<head>
    <title>Upload Status</title>
</head>
<h1 style="text-align: center;"><u>Upload Status of all the files</u></h1>

<?php
    // fix the working directory
    $target_dir = "data/wd/";

    // grab the filenames of all the uploaded files
    $target_dendrite_area = $target_dir . basename($_FILES["dendrite_area"]["name"]);
    $target_dendrite_length = $target_dir . basename($_FILES["dendrite_length"]["name"]);
    $target_dendrite_volume = $target_dir . basename($_FILES["dendrite_volume"]["name"]);
    $target_fda_sheet = $target_dir . basename($_FILES["fda_sheet"]["name"]);
    $target_fdv_sheet = $target_dir . basename($_FILES["fdv_sheet"]["name"]);
    $target_filament_length = $target_dir . basename($_FILES["filament_length"]["name"]);
    $target_sholl_ints = $target_dir . basename($_FILES["sholl_ints"]["name"]);

    // start the list
    echo "<ul>";
        // for area sheet
        if (move_uploaded_file($_FILES["dendrite_area"]["tmp_name"], $target_dendrite_area)) {
            echo "<li>The file ". basename( $_FILES["dendrite_area"]["name"]). " has been uploaded." . "<br /></li>";
        } else {
            echo "<li>Sorry, there was an error uploading your file." . "<br /></li>";
        }
        // for volume sheet
        if (move_uploaded_file($_FILES["dendrite_length"]["tmp_name"], $target_dendrite_length)) {
            echo "<li>The file ". basename( $_FILES["dendrite_length"]["name"]). " has been uploaded." . "<br /></li>";
        } else {
            echo "<li>Sorry, there was an error uploading your file." . "<br /></li>";
        }
        // for shpericity sheet
        if (move_uploaded_file($_FILES["dendrite_volume"]["tmp_name"], $target_dendrite_volume)) {
            echo "<li>The file ". basename( $_FILES["dendrite_volume"]["name"]). " has been uploaded." . "<br /></li>";
        } else {
            echo "<li>Sorry, there was an error uploading your file." . "<br /></li>";
        }
        // for intensity mean sheet with ch = 1
        if (move_uploaded_file($_FILES["fda_sheet"]["tmp_name"], $target_fda_sheet)) {
            echo "<li>The file ". basename( $_FILES["fda_sheet"]["name"]). " has been uploaded." . "<br /></li>";
        } else {
            echo "<li>Sorry, there was an error uploading your file." . "<br /></li>";
        }
        // for intensity mean sheet with ch = 2
        if (move_uploaded_file($_FILES["fdv_sheet"]["tmp_name"], $target_fdv_sheet)) {
            echo "<li>The file ". basename( $_FILES["fdv_sheet"]["name"]). " has been uploaded." . "<br /></li>";
        } else {
            echo "<li>Sorry, there was an error uploading your file." . "<br /></li>";
        }
        // for intensity mean sheet with ch = 3
        if (move_uploaded_file($_FILES["filament_length"]["tmp_name"], $target_filament_length)) {
            echo "<li>The file ". basename( $_FILES["filament_length"]["name"]). " has been uploaded." . "<br /></li>";
        } else {
            echo "<li>Sorry, there was an error uploading your file." . "<br /></li>";
        }
        // for intensity mean sheet with ch = 4
        if (move_uploaded_file($_FILES["sholl_ints"]["tmp_name"], $target_sholl_ints)) {
            echo "<li>The file ". basename( $_FILES["sholl_ints"]["name"]). " has been uploaded." . "<br /></li>";
        } else {
            echo "<li>Sorry, there was an error uploading your file." . "<br /></li>";
        }
    echo "</ul>";
?>

<?php
    // PHP script to apply styles to the table
    // echo "<style>";
    // echo "
    //     body {
    //         font-family: Josefin Sans;
    //     }
    //     ";
    // echo "</style>";
    //
    // echo "<head><title>Processed Worksheets</title></head>";
    // echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"//fonts.googleapis.com/css?family=Josefin+Sans\" />";
    // echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/main.css\" />";
    // echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/admin_.css\" />";
?>

<!DOCTYPE HTML>
<button id="load_php">Click here to process the uploaded files!</button>
<div style="text-align: center">
    <a href="#" onclick="window.history.go(-1); return false" style="">&lt; &lt; GO BACK</a>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $('#load_php').click(function(){
       window.open('excel_read.php','_blank');
    });
</script>


<?php
    //  Read your first excel sheet
//     $inputFileName = 'data/wd/working_file_1.xls';
//
//     try {
//         $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
//         $objReader = PHPExcel_IOFactory::createReader($inputFileType);
//         $objPHPExcel = $objReader->load($inputFileName);
//     } catch(Exception $e) {
//         die('Error loading file "'.pathinfo($inputFileName, PATHINFO_BASENAME).'": '.$e->getMessage());
//     }
//
//     //  Get worksheet dimensions
//     $sheet = $objPHPExcel->getSheet(0);
//     $highestRow = $sheet->getHighestRow();
//     $highestColumn = $sheet->getHighestColumn();    // returns a char
//
//     // Get the column number ,i.e., convert the char to an int
//     $highestColNumber = PHPExcel_Cell::columnIndexFromString($highestColumn);
//
//     // test
//     echo "The number of rows in the excel sheet is: " . $highestRow  . "<br />";
//     echo "The number of columns in the excel sheet is: " . $highestColumn  . "<br />";
//     echo "The number of columns in the excel sheet in 'int' format : " . $highestColNumber . "<br />";
//     echo "<hr />";
//
//     // looping through each row of the worksheet
//     for ($row = 1; $row <= $highestRow; $row++){
//         //  Read a row of data into an array
//         $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
//
//         // test
//         // echo "<pre>";
//             // print_r($rowData[0]);
//             // echo "<br />";
//         // echo "</pre>";
//     }
//
//     $radiusCol = $sheet->rangeToArray('A1' . ':'  . 'A' . $highestRow , NULL, TRUE, FALSE); // fetch the radius colum
//     $intersectionsCol = $sheet->rangeToArray('B1' . ':'  . 'B' . $highestRow , NULL, TRUE, FALSE); // fetch the intersections colum
//     $lengthsCol = $sheet->rangeToArray('C1' . ':'  . 'C' . $highestRow , NULL, TRUE, FALSE); // fetch the length colum
//     $nodesCol = $sheet->rangeToArray('G1' . ':'  . 'G' . $highestRow , NULL, TRUE, FALSE); // fetch the nodes colum
//     $endingsCol = $sheet->rangeToArray('H1' . ':'  . 'H' . $highestRow , NULL, TRUE, FALSE); // fetch the endings colum
//
//     // printing out each of the individual column arrays to the screen
//     // test
//     // print_r($radiusCol);
//     // echo "<hr />";
//     //
//     // print_r($intersectionsCol);
//     // echo "<br />";
//     //
//     // print_r($lengthsCol);
//     // echo "<br />";
//     //
//     // print_r($nodesCol);
//     // echo "<br />";
//     //
//     // print_r($endingsCol);
//     // echo "<br />";
//
//     // output the columns data into an HTML table
//     echo "<table>";
//         foreach ($radiusCol as $key => $value) {
//             echo "<tr>";
//             foreach ($value as $subkey => $subvalue) {
//                 echo "<td>" . $subvalue . "</td>";
//             }
//             echo "</tr>";
//         }
//     echo "</table>";
//
//     echo "<table>";
//         foreach ($intersectionsCol as $key => $value) {
//             echo "<tr>";
//             foreach ($value as $subkey => $subvalue) {
//                 echo "<td>" . $subvalue . "</td>";
//             }
//             echo "</tr>";
//         }
//     echo "</table>";
//
//     echo "<table>";
//         foreach ($lengthsCol as $key => $value) {
//             echo "<tr>";
//             foreach ($value as $subkey => $subvalue) {
//                 echo "<td>" . $subvalue . "</td>";
//             }
//             echo "</tr>";
//         }
//     echo "</table>";
//
//     echo "<table>";
//         foreach ($nodesCol as $key => $value) {
//             echo "<tr>";
//             foreach ($value as $subkey => $subvalue) {
//                 echo "<td>" . $subvalue . "</td>";
//             }
//             echo "</tr>";
//         }
//     echo "</table>";
//
//     echo "<table>";
//         foreach ($endingsCol as $key => $value) {
//             echo "<tr>";
//             foreach ($value as $subkey => $subvalue) {
//                 echo "<td>" . $subvalue . "</td>";
//             }
//             echo "</tr>";
//         }
//     echo "</table>";
// ?>
<!-- // <!DOCTYPE HTML>
// <style type="text/css">
//     table {
//         float: left;
//     }
// </style> -->
