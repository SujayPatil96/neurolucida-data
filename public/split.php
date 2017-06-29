<?php
    include '../includes/PHPExcel/Classes/PHPExcel.php';

    $inputFileType = 'Excel5';
    $inputFileName = 'data/working_file.xls';

    /**  Create a new Reader of the type defined in $inputFileType  **/
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    /**  Read the list of worksheet names and select the one that we want to load  **/
    $worksheetList = $objReader->listWorksheetNames($inputFileName);
    $sheetname = $worksheetList[0];

    print_r($worksheetList);
    echo "<hr />";

    // pick the name of the sheet that has the word 'sholl' in it
    foreach ($worksheetList as $key => $value) {
        if (stripos($value, "sholl")) {
            $shollSheetname = $value;
        }
    }

    // print the sholl sheet name
    echo $shollSheetname;
    echo "<hr />";

?>

<?php
    $filename = "data/working_file.xls";

    $xls = new PHPExcel();
    $xlsReader= new PHPExcel_Reader_Excel5();
    $xlsTemplate = $xlsReader->load($filename);

    $sheet1 = $xlsTemplate->getSheetByName('Dendrite Area');
    $xls->addExternalSheet($sheet1, 0);
    $xls->removeSheetByIndex(1);
    $xlsWriter = new PHPExcel_Writer_Excel5($xls);
    $xlsWriter->save("data/Dendrite Area.xls");

    $sheet2 = $xlsTemplate->getSheetByName('Dendrite Length');
    $xls->addExternalSheet($sheet2, 0);
    $xls->removeSheetByIndex(1);
    $xlsWriter = new PHPExcel_Writer_Excel5($xls);
    $xlsWriter->save("data/Dendrite Length.xls");

    $sheet3 = $xlsTemplate->getSheetByName('Dendrite Volume');
    $xls->addExternalSheet($sheet3, 0);
    $xls->removeSheetByIndex(1);
    $xlsWriter = new PHPExcel_Writer_Excel5($xls);
    $xlsWriter->save("data/Dendrite Volume.xls");

    $sheet4 = $xlsTemplate->getSheetByName('Filament Dendrite Area (sum)');
    $xls->addExternalSheet($sheet4, 0);
    $xls->removeSheetByIndex(1);
    $xlsWriter = new PHPExcel_Writer_Excel5($xls);
    $xlsWriter->save("data/Filament Dendrite Area (sum).xls");

    $sheet5 = $xlsTemplate->getSheetByName('Filament Dendrite Length (sum)');
    $xls->addExternalSheet($sheet5, 0);
    $xls->removeSheetByIndex(1);
    $xlsWriter = new PHPExcel_Writer_Excel5($xls);
    $xlsWriter->save("data/Filament Dendrite Length (sum).xls");

    $sheet6 = $xlsTemplate->getSheetByName('Filament Dendrite Volume (sum)');
    $xls->addExternalSheet($sheet6, 0);
    $xls->removeSheetByIndex(1);
    $xlsWriter = new PHPExcel_Writer_Excel5($xls);
    $xlsWriter->save("data/Filament Dendrite Volume (sum).xls");

    $sheet7 = $xlsTemplate->getSheetByName($shollSheetname);
    $xls->addExternalSheet($sheet7, 0);
    $xls->removeSheetByIndex(1);
    $xlsWriter = new PHPExcel_Writer_Excel5($xls);
    $xlsWriter->save("data/" . $shollSheetname . ".xls");

?>
