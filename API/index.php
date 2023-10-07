<?php

require_once "../_settings.php";


$result = Query("SELECT * FROM Indici_prospetto");

$return_obj->Data = array();

if ($result) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $return_obj->Data[] = array(
            $row['validFrom'],
            $row['indexValue'] / 100
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

logError($_GET);


if (isset($_GET['pcSerialNumber'])) {
    $date = date('m-Y');
    $userEmail = $_GET['userEmail'] ?? "";
    $pcSerialNumber = trim($_GET['pcSerialNumber']);


    if ($userEmail != "") {

        $selectQuery = "SELECT JSON_EXTRACT(lastAccess, '$.\"$date\"') as date_value FROM Utenti_prospetto WHERE email = '$userEmail'";
        $result = Query($selectQuery)->fetch_array(MYSQLI_ASSOC);

        if ($result['date_value'] === null) {
            $updateQuery = "UPDATE Utenti_prospetto
            SET lastAccess = JSON_SET(lastAccess, '$.\"$date\"', 1),
            pcSerialNumber = JSON_ARRAY_APPEND(pcSerialNumber, '$', '$pcSerialNumber')
        WHERE email = '$userEmail'";
        } else {
            $updatedValue = intval($result['date_value']) + 1;
            $updateQuery = "UPDATE Utenti_prospetto
            SET lastAccess = JSON_SET(lastAccess, '$.\"$date\"', $updatedValue),
            pcSerialNumber = JSON_ARRAY_APPEND(pcSerialNumber, '$', '$pcSerialNumber')
        WHERE email = '$userEmail'";
        }
    } else {
        $selectQuery = "SELECT JSON_EXTRACT(lastAccess, '$.\"$date\"') as date_value FROM Utenti_prospetto WHERE JSON_CONTAINS(pcSerialNumber, '\"$pcSerialNumber\"')";
        $result = Query($selectQuery)->fetch_array(MYSQLI_ASSOC);

        if ($result['date_value'] === null) {
            $updateQuery = "UPDATE Utenti_prospetto
            SET lastAccess = JSON_SET(lastAccess, '$.\"$date\"', 1)
        WHERE JSON_CONTAINS(pcSerialNumber, '\"$pcSerialNumber\"')";
        } else {
            $updatedValue = intval($result['date_value']) + 1;
            $updateQuery = "UPDATE Utenti_prospetto
            SET lastAccess = JSON_SET(lastAccess, '$.\"$date\"', $updatedValue)
        WHERE JSON_CONTAINS(pcSerialNumber, '\"$pcSerialNumber\"')";
        }
    }

    Query($updateQuery);
}

$conn->close();
