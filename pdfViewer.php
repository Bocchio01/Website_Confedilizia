<?php

include_once "./_settings.php";
updateInteractions();

$error = 2; // Assume there is an error until proven otherwise

if (isset($_GET['pdf'])) {
    $pdfName = $_GET['pdf'];
    $fullPdfPath = HOST_SITE . '/assets/pdf/' . $pdfName . '.pdf';

    if (fileExists($fullPdfPath)) {
        $error = 0; // No error
    } else {
        $error = 1; // PDF file does not exist
    }
} else {
    $error = 2; // No PDF file specified
    header("HTTP/1.1 500 Internal Server Error");
    header("Location: " . HOST_SITE . "/500.php");
}


$conn->close();
returndata(0, "Connection with MySQL database closed");
?>


<!DOCTYPE html>
<html lang="it">

<?php echo render('./template/site/head.php', array('title' => 'Visualizzatore PDF'), 1); ?>

<body>
    <div>

        <?php echo render('./template/site/header.php', array('title' => 'Prospetto di calcolo', 'subtitle' => 'visualizzatore PDF')); ?>

        <main>

            <?php switch ($error):
                case 0: ?>
                    <!-- Embed PDF -->
                    <object data=<?php echo $fullPdfPath ?> type="application/pdf" width="100%" style="height:90vh; margin-block: 1em;">
                        <p>Impossibile visualizzare il PDF. <a href=<?php echo $fullPdfPath ?>>Scaricalo</a> per visualizzarlo.</p>
                    </object>
                <?php break;
                case 1: ?>
                    <p><b>Il file richiesto sembrerebbe non esistere.</b></p>
                    <p>Se pensi possa essere un problema del sito, contatta l'assistenza tecnica cliccando sull'indirizzo email in fondo alla pagina.</p>
                <?php break;
                case 2: ?>
                    <h4>Errore</h4>
                    <p>Non è stato possibile visualizzare il prospetto di calcolo.</p>
                    <hr>
                    <p>Contatta l'amministratore del sito.</p>
            <?php endswitch; ?>

        </main>

        <?php echo render('./template/site/footer.php', array()); ?>

    </div>
</body>

</html>