<?php
include_once "./_settings.php";
updateInteractions();
include_once "./_isAdmin.php";


// Check for edit or delete actions based on query parameters
if (isset($_GET['editData'])) {
    $editId = $_GET['editData'];
    $newData = $_GET['newData'];
    Query("UPDATE Indici_prospetto SET indexValue = $newData WHERE id = $editId");
    header("Location: ./updateIndices.php");
}

if (isset($_GET['deleteData'])) {
    $deleteId = $_GET['deleteData'];
    Query("DELETE FROM Indici_prospetto WHERE id = $deleteId");
    header("Location: ./updateIndices.php");
}

if (isset($_GET['addData'])) {
    $validFrom = $_GET['validFrom'];
    $indexValue = $_GET['indexValue'];
    Query("INSERT INTO Indici_prospetto (validFrom, indexValue) VALUES ('$validFrom', $indexValue)");
    header("Location: ./updateIndices.php");
}

$result = Query("SELECT * FROM Indici_prospetto WHERE id<>1 ORDER BY validFrom ASC");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['validFrom'] =  $row['validFrom'];
        $row['indexValue'] = number_format($row['indexValue'], 3);
        $indiciProspettoDatas[] = $row;
    }
};

$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<?php echo render('./template/site/head.php', array('title' => 'Indici ISTAT', 'robots' => 'noindex'), 1); ?>

<body>
    <a href="/">
        <h1>Prospetto di calcolo</h1>
    </a>
    <h3>Indici_prospetto</h3>
    <table>
        <thead>
            <tr>
                <th>Valido da</th>
                <th>Coefficiente</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($indiciProspettoDatas as $indiciProspettoData) : ?>
                <tr>
                    <td><?php echo date('d/m/Y', strtotime($indiciProspettoData['validFrom'])); ?></td>
                    <td><?php echo $indiciProspettoData['indexValue']; ?></td>
                    <td>
                        <button onclick="editData(<?php echo $indiciProspettoData['id']; ?>, <?php echo $indiciProspettoData['indexValue']; ?>)">Modifica dato</button>
                        <button onclick="deleteData(<?php echo $indiciProspettoData['id']; ?>)">Elimina dato</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td><input type="date" id="validFrom" name="validFrom" value="<?php echo date('Y-m-d'); ?>"></td>
                <td><input type="number" id="indexValue" name="indexValue" step=".001" value="0.000"></td>
                <td><button onclick="window.location.href = '?addData&validFrom=' + document.getElementById('validFrom').value + '&indexValue=' + document.getElementById('indexValue').value">Aggiungi dato</button></td>
            </tr>
        </tbody>
    </table>

    <!-- <h3>Calcolatore ISTAT</h3>
    <script src='https://rivaluta.istat.it/Rivaluta/Widget/rivalutazioneIstat.js' type='text/javascript'></script> -->
</body>
<script>
    function editData(ID, previousData) {
        var newData = prompt('Inserisci il nuovo valore:', previousData);
        if (newData !== null) {
            window.location.href = "?editData=" + ID + "&newData=" + newData.replace(',', '.');
        }
    }

    function deleteData(ID) {
        var confirmDelete = confirm('Are you sure you want to delete this data?');
        if (confirmDelete) {
            window.location.href = "?deleteData=" + ID;
        }
    }
</script>

</html>