<!DOCTYPE HTML>
<head>
    <title>Processed Sholl Data</title>
</head>
<!-- <link rel="stylesheet" href="css/main.css"> -->
<h1 style="text-align: center;">Sholl analysis data</h1>
<style type="text/css">
    td, th {
        border: 1px solid black;
        padding-left: 10px;
        padding-right: 10px;
    }
</style>

<?php
    //  Include PHPExcel_IOFactory
    include '../includes/PHPExcel/Classes/PHPExcel.php';

    $inputFileName = 'data\wd\Filament No. Sholl Intersec-14.xls';

    //  Read your Excel worksheet
    try {
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);
    } catch(Exception $e) {
        die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
    }

    //  Get worksheet dimensions
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    // declare arrays to hold filament number, radius and IDs
    $filamentNumber = [];
    $radius = [];
    $filamentID = [];
    $filaRadius = [];
    $uniqueRad = [];
    $positionsRad = [];
    $radFilamennts = [];
    $filamentSum = []; // contains the sum of the number of filaments for each radius
    $radID = [];    // contains the filament IDs associated with a specific radius
    $filamentImplode = [];  // contains the filament IDs imploded

    // use this concept
    // $rowData[0][0] // gives the first column within for loop

    //  Loop through each row of the worksheet in turn
    for ($row = 1; $row <= $highestRow; $row++) {
        //  Read a row of data into an array
        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                        NULL,
                                        TRUE,
                                        FALSE);
        // print_r($rowData[0]);
        // echo "<hr />";

        $filamentNumber[] = $rowData[0][0]; // filament numbers
        $radius[] = $rowData[0][3]; // radius
        $filamentID[] = $rowData[0][5]; // filament IDs

        $filaRadius[0][] = $rowData[0][0];
        $filaRadius[1][] = $rowData[0][3];
    }
    // total count of the radius array
    $totRadCount = count($radius);

    // eliminate duplicate values from the $radius array
    $uniqueRad = array_unique($radius);
    $uniqueRad = array_slice($uniqueRad, 2);
    $radCount = count($uniqueRad); // removing all the headers and blank cells

    $radius = array_slice($radius, 2);  // slice the radius array to remove the first 2 rows
    $filamentID = array_slice($filamentID, 2);  // slice the filamentID array to remove the first 2 rows
    $filamentNumber = array_slice($filamentNumber, 2);  // slice the filamentNumber array to remove the first 2 rows

    // find out all the positions associated with a value of radius
    for ($j = 0; $j < $radCount; $j++) {
        foreach ($radius as $key => $value) {
            if ($value == $uniqueRad[$j]) {
                $positionsRad[$value][] = $key;
            }
        }
    }

    // array to filter out the positions of specific radii
    // echo "<pre>";
    //     print_r($positionsRad);
    // echo "</pre>";
    // echo "<hr />";

    $i = 0;
    // print all the filament numbers with positions in $positionsRad
    foreach ($positionsRad as $key => $value) {
        foreach ($value as $subkey => $subvalue) {
            // echo $filamentNumber[$subvalue];
            // echo "<br />";
            $radFilaments[$i][] = $filamentNumber[$subvalue];
        }
        $i++;
    }

    // print out the filament numbers in associative array format
    // echo "<pre>";
    //     print_r($radFilaments);
    // echo "</pre>";

    // compute the sum of the number of filaments for each radius
    foreach ($radFilaments as $key => $value) {
        $filamentSum[] = array_sum($value);
    }

    // echo "<hr />";
    // print out the filament sum values
    // echo "<pre>";
    //     print_r($filamentSum);
    // echo "</pre>";

    // echo "<hr />";
    $j = 0;
    foreach ($positionsRad as $key => $value) {
        foreach ($value as $subkey => $subvalue) {
            $radID[$j][] = $filamentID[$subvalue];
        }
        $j++;
    }

    // print out the $radID array
    // echo "<pre>";
    //     print_r($radID);
    // echo "</pre>";

    // echo "<hr />";
    $j = 0;
    // implode all the filament IDs into $filamentImplode array
    foreach ($radID as $key => $value) {
        $filamentImplode = implode(', ', $value);
    }
?>

<?php
    // print out all of the array data from the above PHP block into HTML tables
    echo "<table>";
    $j = 0;
    // implode all the filament IDs into $filamentImplode array
    echo "<th>Radius</th><th>Filament IDs</th><th>No. of sholl intersections</th>";
    foreach ($radID as $key => $value) {
        $filamentImplode = implode(', ', $value);
        echo "<tr>";
        echo "<td>" . $j . "</td>";
            print_r("<td>" . $filamentImplode . "</td>");
            print_r("<td>" . $filamentSum[$j] . "</td>");
        echo "</tr>";
        $j++;
    }
    echo "</table>";
?>

<?php
    // script to process Dendrite Area values
    $inputFileName = 'data\wd\Dendrite Area.xls';

    //  Read your Excel worksheet
    try {
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);
    } catch(Exception $e) {
        die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
    }

    //  Get worksheet dimensions
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    // use this concept
    // $rowData[0][0] // gives the first column within for loop

    // declare all the arrays you need
    $dendriteArea = []; // values of all the dendrite areas
    $dendriteFilamentID = [];   // filament IDs associated with Dendrite Area

    // echo "<hr />";
    //  Loop through each row of the worksheet in turn
    for ($row = 3; $row <= $highestRow; $row++) {
        //  Read a row of data into an array
        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                        NULL,
                                        TRUE,
                                        FALSE);
        // print_r($rowData[0]);
        // echo "<hr />";

        $dendriteArea[] = $rowData[0][0];   // copy all the values of DA into $dendriteArea
        $dendriteFilamentID[] = $rowData[0][6]; // copy all the values of Filament ID into $dendriteFilamentID
    }

    // print out the Dendrite Area values
    // echo "<pre>";
    // print_r($dendriteArea);
    // echo "</pre>";
    //
    // // print out the Filament ID values
    // echo "<pre>";
    // print_r($dendriteFilamentID);
    // echo "</pre>";
?>

<?php
    // script to process the Dendrite Length
    $inputFileName = 'data\wd\Dendrite Length.xls';

    //  Read your Excel worksheet
    try {
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);
    } catch(Exception $e) {
        die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
    }

    //  Get worksheet dimensions
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    // use this concept
    // $rowData[0][0] // gives the first column within for loop

    // declare all the arrays you need
    $dendriteLength = []; // values of all the dendrite areas

    // echo "<hr />";
    //  Loop through each row of the worksheet in turn
    for ($row = 3; $row <= $highestRow; $row++) {
        //  Read a row of data into an array
        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                        NULL,
                                        TRUE,
                                        FALSE);
        // print_r($rowData[0]);
        // echo "<hr />";

        $dendriteLength[] = $rowData[0][0];   // copy all the values of DA into $dendriteLength
    }

    // print out the Dendrite Area values
    // echo "<pre>";
    // print_r($dendriteLength);
    // echo "</pre>";
?>

<?php
    // script to process the Dendrite Volume
    $inputFileName = 'data\wd\Dendrite Volume.xls';

    //  Read your Excel worksheet
    try {
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);
    } catch(Exception $e) {
        die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
    }

    //  Get worksheet dimensions
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    // use this concept
    // $rowData[0][0] // gives the first column within for loop

    // declare all the arrays you need
    $dendriteVolume = []; // values of all the dendrite areas

    // echo "<hr />";
    //  Loop through each row of the worksheet in turn
    for ($row = 3; $row <= $highestRow; $row++) {
        //  Read a row of data into an array
        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                        NULL,
                                        TRUE,
                                        FALSE);
        // print_r($rowData[0]);
        // echo "<hr />";

        $dendriteVolume[] = $rowData[0][0];   // copy all the values of DA into $dendriteVolume
    }

    // print out the Dendrite Area values
    // echo "<pre>";
    // print_r($dendriteVolume);
    // echo "</pre>";
?>

<?php
    echo "<hr />";
    // table to combine filament ID, dendrite area, length and volume
    echo "<table style=\"float: left;\">";
    echo "<th>Filament ID</th>";
        foreach ($dendriteFilamentID as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value . "</td>";
            echo "</tr>";
        }
    echo "</table>";

    echo "<table style=\"float: left;\">";
    echo "<th>Dendrite Area</th>";
        foreach ($dendriteArea as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value . "</td>";
            echo "</tr>";
        }
    echo "</table>";

    echo "<table style=\"float: left;\">";
    echo "<th>Dendrite Length</th>";
        foreach ($dendriteLength as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value . "</td>";
            echo "</tr>";
        }
    echo "</table>";

    echo "<table>";
    echo "<th>Dendrite Volume</th>";
        foreach ($dendriteVolume as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value . "</td>";
            echo "</tr>";
        }
    echo "</table>";
?>

<?php
    // script to process the Dendrite Area (sum)
    $inputFileName = 'data\wd\Filament Dendrite Area (sum).xls';

    //  Read your Excel worksheet
    try {
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);
    } catch(Exception $e) {
        die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
    }

    //  Get worksheet dimensions
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    // use this concept
    // $rowData[0][0] // gives the first column within for loop

    // declare all the arrays you need
    $denAreaSum = []; // values of all the dendrite areas
    $filDenID = [];    // filament IDs associated with dendrite area (sum) values

    // echo "<hr />";
    //  Loop through each row of the worksheet in turn
    for ($row = 3; $row <= $highestRow; $row++) {
        //  Read a row of data into an array
        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                        NULL,
                                        TRUE,
                                        FALSE);
        // print_r($rowData[0]);
        // echo "<hr />";

        $denAreaSum[] = $rowData[0][0];   // copy all the values of DA into $denAreaSum
        $filDenID[] = $rowData[0][4];  // copy all the filament ID values into $filDenID
    }

    // print out the Dendrite Area values
    // echo "<pre>";
    // print_r($denAreaSum);
    // echo "</pre>";
    //
    // // print out the Filament IDs
    // echo "<pre>";
    // print_r($filDenID);
    // echo "</pre>";
?>

<?php
    // script to process all the filament lengths
    $inputFileName = 'data\wd\Filament Length (sum).xls';

    //  Read your Excel worksheet
    try {
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);
    } catch(Exception $e) {
        die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
    }

    //  Get worksheet dimensions
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    // use this concept
    // $rowData[0][0] // gives the first column within for loop

    // declare all the arrays you need
    $filamentLength = []; // values of all the dendrite areas

    // echo "<hr />";
    //  Loop through each row of the worksheet in turn
    for ($row = 3; $row <= $highestRow; $row++) {
        //  Read a row of data into an array
        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                        NULL,
                                        TRUE,
                                        FALSE);
        // print_r($rowData[0]);
        // echo "<hr />";

        $filamentLength[] = $rowData[0][0];   // copy all the values of DA into $filamentLength
    }

    // print out the Dendrite Area values
    // echo "<pre>";
    // print_r($filamentLength);
    // echo "</pre>";
?>

<?php
    // script to process all the filament dendrite volume (sum) values
    $inputFileName = 'data\wd\Filament Dendrite Volume (sum).xls';

    //  Read your Excel worksheet
    try {
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);
    } catch(Exception $e) {
        die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
    }

    //  Get worksheet dimensions
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    // use this concept
    // $rowData[0][0] // gives the first column within for loop

    // declare all the arrays you need
    $filDenVolume = []; // values of all the dendrite areas

    // echo "<hr />";
    //  Loop through each row of the worksheet in turn
    for ($row = 3; $row <= $highestRow; $row++) {
        //  Read a row of data into an array
        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                        NULL,
                                        TRUE,
                                        FALSE);
        // print_r($rowData[0]);
        // echo "<hr />";

        $filDenVolume[] = $rowData[0][0];   // copy all the values of DA into $filDenVolume
    }

    // print out the Dendrite Area values
    // echo "<pre>";
    // print_r($filDenVolume);
    // echo "</pre>";
?>

<?php
    echo "<hr />";
    // print out the table containing the data from filament dendrite area, length and volume (sum)
    echo "<table style=\"float: left;\">";
    echo "<th>Filament ID</th>";
        foreach ($filDenID as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value . "</td>";
            echo "</tr>";
        }
    echo "</table>";

    echo "<table style=\"float: left;\">";
    echo "<th>Filament Dendrite Area (sum)</th>";
        foreach ($denAreaSum as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value . "</td>";
            echo "</tr>";
        }
    echo "</table>";

    echo "<table style=\"float: left;\">";
    echo "<th>Filament Length (sum)</th>";
        foreach ($filamentLength as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value . "</td>";
            echo "</tr>";
        }
    echo "</table>";

    echo "<table>";
    echo "<th>Filament Dendrite Volume (sum)</th>";
        foreach ($filDenVolume as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value . "</td>";
            echo "</tr>";
        }
    echo "</table>";

?>
