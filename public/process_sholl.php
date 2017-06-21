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
        die('Error loading file "' . pathinfo($inputFileName,PATHINFO_BASENAME) . '": ' . $e->getMessage());
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

    // use this concept
    // $rowData[0][0] // gives the first column within for loop

    //  Loop through each row of the worksheet in turn
    for ($row = 1; $row <= $highestRow; $row++){
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
    $filamentNumber = array_slice($filamentNumber, 2);  // slice the filamentNumber array to remove the first 2 rows

    // find out all the positions associated with a value of radius
    for ($j = 0; $j < $radCount; $j++) {
        foreach ($radius as $key => $value) {
            if ($value == $uniqueRad[$j]) {
                $positionsRad[$value][] = $key;
            }
        }
    }

    echo "<pre>";
        print_r($positionsRad);
    echo "</pre>";
    echo "<hr />";

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
    echo "<pre>";
        print_r($radFilaments);
    echo "</pre>";

    // print out the filament numbers
    // echo "<pre>";
    //     print_r($filamentNumber);
    // echo "</pre>";
    // echo "<hr />";

    // print out the radius
    // echo "<pre>";
    //     print_r($radius);
    // echo "</pre>";
    // echo "<hr />";

    // print out the unique radii
    // echo "<pre>";
    //     print_r($uniqueRad);
    // echo "</pre>";
    // echo "<hr />";
?>
