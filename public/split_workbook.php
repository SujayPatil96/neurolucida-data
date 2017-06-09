<?php
    // move the uploaded file to a working directory
    $target_dir = "data/wd/";

    // grab the filenames of all the uploaded files
    $target_file = $target_dir . basename($_FILES["init_workbook"]["name"]);

    if (move_uploaded_file($_FILES["init_workbook"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["init_workbook"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
?>

<?php
    // code to initially count the number of files in a directory
    $directory = "data/wd/";
    $filecount = 0;
    $files = glob($directory . "*.{xls}", GLOB_BRACE);
    if ($files){
        $filecount = count($files);
    }
    // test
    echo "<hr />";
    echo "There are $filecount files";
    echo "<br />";
?>

<?php

    //  Include PHPExcel_IOFactory
    include '../includes/PHPExcel/Classes/PHPExcel.php';

    $fileType = 'Excel2007';
    $inputFileName = 'data/wd/working_file.xls';

    $objPHPExcelReader = PHPExcel_IOFactory::createReader($fileType);
    $objPHPExcel = $objPHPExcelReader->load($inputFileName);

    $sheetIndex = 0;
    $sheetCount = $objPHPExcel->getSheetCount();
    while ($sheetIndex < $sheetCount) {
        ++$sheetIndex;
        $workSheet = $objPHPExcel->getSheet(0);

        $newObjPHPExcel = new PHPExcel();
        $newObjPHPExcel->removeSheetByIndex(0);
        $newObjPHPExcel->addExternalSheet($workSheet);

        $objPHPExcelWriter = PHPExcel_IOFactory::createWriter($newObjPHPExcel,$fileType);
        $outputFileTemp = explode('.',$inputFileName);
        $outputFileName = $outputFileTemp[0].$sheetIndex.'.'.$outputFileTemp[1];
        $objPHPExcelWriter->save($outputFileName);
    }

    //  Read your Excel workbook
    // try {
    //     $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    //     $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    //     $objPHPExcel = $objReader->load($inputFileName);
    // } catch(Exception $e) {
    //     die('Error loading file "'.pathinfo($inputFileName, PATHINFO_BASENAME).'": '.$e->getMessage());
    // }

    //  Get worksheet dimensions
    // $sheet = $objPHPExcel->getSheet(0);
    // $highestRow = $sheet->getHighestRow();
    // $highestColumn = $sheet->getHighestColumn();    // returns a char


    // test
    // echo "The number of rows in the excel sheet is: " . $highestRow  . "<br />";
    // echo "The number of columns in the excel sheet is: " . $highestColumn  . "<br />";
    // $rowCount = $highestRow  - 2;
    // $colCount = PHPExcel_Cell::columnIndexFromString($highestColumn);
    // echo "The number of rows in the excel sheet to be considered: " . $rowCount . "<br />";
    // echo "The number of columns in the excel sheet to be considered: " . $colCount . "<br />";

    // Get the column number ,i.e., convert the char to an int
    // $colNumber = PHPExcel_Cell::columnIndexFromString($highestColumn);

    // $subsetSeq = [];
    // $j = 0;
    // $comb = [];
    // //  Loop through each row of the worksheet in turn
    // for ($row = 3; $row <= $highestRow; $row++){
    //     //  Read a row of data into an array
    //     $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
    //
    //     for ($i=0 ; $i < $colNumber ; $i++) {
    //         $subsetSeq[$j] = $rowData[0][$i];
    //         $j++;
    //     }
    // }

    // processing to reverse all the values in associative array
    // $k = array_keys($subsetSeq);
    //
    // $v = array_values($subsetSeq);
    //
    // $rv = array_reverse($v);
    //
    // $b = array_combine($k, $rv);
    //
    // $array1 = [];
    // $array2 = [];
    // $array1 = array_slice($b, 0, 5);
    // $array2 = array_slice($b, 5, 9);

    // test
    // print_r($array2);
    // echo "<br />";
    // print_r($array1);

    // output the array data into an HTML table
    // echo "<table>";
    //     echo "<tr>";
    //     foreach ($array2 as $row) {
    //         echo "<td>$row</td>";
    //     }
    //     echo "</tr>";
    //
    //     echo "<tr>";
    //     foreach ($array1 as $row) {
    //         echo "<td>$row</td>";
    //     }
    //     echo "</tr>";
    // echo "</table>";
?>
