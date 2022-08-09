<?php

include "_settings.php";
updateInteractions();


// $conn->close();
// returndata(0, "Connection with MySQL database closed");
?>


<!DOCTYPE html>
<html lang="it">

<?php echo render('./template/site/head.php', array('title' => 'Tabella completa tutti gli utenti'), 1); ?>

<head>
    <style>
        @import url(<?php echo UTILS_SITE ?>/template/site/_style_table.css);
    </style>
</head>

<body>
    <?php

    $tables = array('Utenti_prospetto', 'Visite_sito');
    foreach ($tables as $key => $table) {

        $res = Query("SELECT * FROM $table");
        echo "<h2>$table</h2><table border='1'><thead><tr>";

        while ($fieldinfo = $res->fetch_field()) echo "<th>$fieldinfo->name</th>";
        echo "</tr></thead><tbody>";

        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
            echo "<tr>";
            foreach ($row as $cell) echo "<td>" . htmlentities($cell) . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }

    ?>
</body>

</html>