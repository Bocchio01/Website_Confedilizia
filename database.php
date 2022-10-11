<?php

include_once "./_settings.php";
updateInteractions();

include_once "./_isAdmin.php";


$datas = array();
$tables = array('Utenti_prospetto', 'Demo_data', 'Illimitata_data', 'Visite_sito');

foreach ($tables as $table) {
    $datas[$table] = Query("SELECT * FROM $table");
}


$conn->close();
returndata(0, "Connection with MySQL database closed");
?>


<!DOCTYPE html>
<html lang="it">

<?php echo render('./template/site/head.php', array('title' => 'Database', 'robots' => 'noindex'), 1); ?>

<body>
    <a href="/">
        <h1>Prospetto di calcolo</h1>
    </a>
    <?php foreach ($datas as $nameTable => $data) : ?>
        <h3><?php echo $nameTable ?></h3>
        <table>
            <thead>
                <tr>
                    <?php while ($fieldinfo = $data->fetch_field()) : ?>
                        <th> <?php echo $fieldinfo->name ?></th>
                    <?php endwhile; ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $data->fetch_array(MYSQLI_ASSOC)) : ?>
                    <tr>
                        <?php foreach ($row as $cell) : ?>
                            <td> <?php echo htmlentities($cell) ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endforeach; ?>
</body>

</html>