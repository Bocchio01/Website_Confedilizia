<?php

require_once "../_settings.php";


$result = Query("SELECT * FROM Indici_prospetto ORDER BY validFrom ASC");

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

$conn->close();
