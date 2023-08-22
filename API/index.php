<?php

require_once "../_settings.php";


$result = Query("SELECT * FROM Indici_prospetto");

$return_obj->Data = array();

if ($result) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $return_obj->Data[] = array(
            $row['validFrom'],
            $row['indexValue']
        );
    }


    // Convert the data array to CSV format
    $csv_data = '';
    foreach ($return_obj->Data as $row) {
        $csv_data .= implode(';', $row) . PHP_EOL;
    }

    echo $csv_data;
} else {
    returndata(1, "Error loading data", null);
}



$date = date('m-Y');
$userEmail = isset($_GET['userEmail']) ? $_GET['userEmail'] : "";
$pcSerialNumber = $_GET['pcSerialNumber'];


if ($userEmail != "") {
    Query("UPDATE Utenti_prospetto
            SET lastAccess=JSON_SET(lastAccess, '$.$date', JSON_EXTRACT(lastAccess, '$.$date') + 1),
            pcSerialNumber = JSON_ARRAY_APPEND(pcSerialNumber, '$', '$pcSerialNumber')
        WHERE email = '$userEmail'");
} else {
    Query("UPDATE Utenti_prospetto
    SET lastAccess=JSON_SET(lastAccess, '$.$date', JSON_EXTRACT(lastAccess, '$.$date') + 1)
    WHERE JSON_CONTAINS(pcSerialNumber, '\"$pcSerialNumber\"')");
}


$conn->close();
