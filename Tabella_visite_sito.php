<?php

include_once "./_settings.php";
updateInteractions();

include_once "./_isAdmin.php";


require_once './_lib/phplot-6.2.0/phplot.php';


function DefaultGraph($data, $type = 'linepoints')
{
    $plot = new PHPlot();

    $plot->SetFailureImage(False);
    $plot->SetPrintImage(False);
    $plot->SetDataValues($data);
    $plot->SetPlotType($type);
    $plot->SetBackgroundColor('#fdfdff');
    $plot->SetTransparentColor('#fdfdff');
    $plot->SetFontGD('x_label', 3);
    $plot->SetFontGD('y_label', 3);
    $plot->SetFontGD('generic', 3);
    $plot->SetFontGD('y_title', 4);
    $plot->SetFontGD('x_title', 4);
    $plot->SetPointShapes('dot');
    $plot->SetLineStyles('solid');

    // $plot->SetXLabelType('time');
    $plot->SetXTickLabelPos('none');
    $plot->SetXTickPos('none');
    $plot->SetLineWidths(3);
    // $plot->SetYTickIncrement(1);

    if (count($data) > 12) {
        $plot->SetXLabelAngle(90);
    }


    return $plot;
}


function graphAndData(String $query)
{

    global $fromYear, $currentYear, $currentMonth;

    $idArray = Query($query)->fetch_array(MYSQLI_ASSOC)['idArray'];

    for ($i = $fromYear; $i <= $currentYear; $i++) {
        if ($i == $currentYear) $nMonth = $currentMonth;
        else $nMonth = 12;

        for ($j = 0; $j <= $nMonth; $j++) {

            $row = Query("SELECT SUM(JSON_EXTRACT(`$i`, '$[$j]')) AS numberVisitsMonth FROM Visite_sito WHERE id IN ($idArray)")->fetch_array(MYSQLI_ASSOC);

            $example_data[] = array(
                $j + 1 . '-' . $i,
                $row['numberVisitsMonth'],
            );
        }
    }

    return $example_data;
}

$pageNames = array();
$result = Query("SELECT pageName FROM Visite_sito ORDER BY id");
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $pageNames[] = $row['pageName'];
}

$currentYear = (int) date("Y");
$currentMonth = (int) date("m") - 1;

$graphAndData = array();
$graphOnly = array();
$dataOnly = array();

$fromYear = empty($_GET['fromYear']) ? 2022 : $_GET['fromYear'];
$byPageName = empty($_GET['byPageName']) ? array('Scelta_programma') : $_GET['byPageName'];


// Selling table
$table = array();
$table[0]['title'] = 'Statistiche vendite totali dal 2020';

$Illimitati = Query("SELECT
                    SUM(IF(hasPayed = 0, nLicences, 0)) AS numNotPayed,
                    SUM(IF(hasPayed = 0, nLicences * priceEach, 0)) AS notPayed,
                    SUM(IF(hasPayed = 1, nLicences, 0)) AS numPayed,
                    SUM(IF(hasPayed = 1, nLicences * priceEach, 0)) AS payed
                FROM Illimitata_data");
$Demo = Query("SELECT  SUM(nLicences) AS demo FROM Demo_data")->fetch_array(MYSQLI_ASSOC)['demo'];

$row = $Illimitati->fetch_array(MYSQLI_ASSOC);

$table[0]['head'] = array(
    'Licenze pagate',
    'Licenze non pagate',
    'Demo',
);
$table[0]['body'][0] = array(
    $row['numPayed'] . " => " . $row['payed'] . "€",
    $row['numNotPayed'] . " => " . $row['notPayed'] . "€",
    $Demo,
);


// Selling graph
for ($i = $fromYear; $i <= $currentYear; $i++) {
    if ($i == $currentYear) $nMonth = $currentMonth;
    else $nMonth = 12;

    for ($j = 0; $j <= $nMonth; $j++) {

        $Illimitati = Query("SELECT
                                 SUM(IF(hasPayed = 1, nLicences, 0)) AS reqPayed, 
                                 SUM(IF(hasPayed = 0, nLicences, 0)) AS reqNotPayed 
                             FROM Illimitata_data WHERE
                                 YEAR(dateRequest) = $i AND 
                                 MONTH(dateRequest) = $j + 1")->fetch_array(MYSQLI_ASSOC);

        $Demo = Query("SELECT
                           SUM(IF(hasPayed = 1, nLicences, 0)) AS reqDemo
                       FROM Demo_data WHERE
                           YEAR(dateRequest) = $i AND
                           MONTH(dateRequest) = $j + 1")->fetch_array(MYSQLI_ASSOC);

        $example_data[] = array(
            $j + 1 . '-' . $i,
            (int) $Illimitati['reqPayed'],
            (int) $Illimitati['reqNotPayed'],
            (int) $Demo['reqDemo'],
        );
    }
}

$data['graph'] = DefaultGraph($example_data);
$data['graph']->SetYTitle('Andamento vendite');
$data['graph']->SetLegend(array('Pagate', 'Non pagate', 'Demo'));
$data['graph']->DrawGraph();
$data['title'] = 'Andamento vendite';

$graphOnly[] = $data;


// Sum all visit
$example_data = graphAndData("SELECT GROUP_CONCAT(id) AS idArray FROM Visite_sito");
$data['graph'] = DefaultGraph($example_data);
$data['graph']->SetYTitle('Numero visite per mese');
$data['graph']->DrawGraph();
$data['title'] = 'Andamento generale del sito';

$example_data = null;
$graphOnly[] = $data;


// Visit from pages in byPageName array
if (!empty($byPageName)) {
    foreach ($byPageName as $number => $pageName) {
        $example_data = graphAndData("SELECT GROUP_CONCAT(id) AS idArray FROM Visite_sito WHERE pageName = '$pageName'");

        $data['graph'] = DefaultGraph($example_data);
        $data['graph']->SetYTitle('Numero visite per mese');
        $data['graph']->DrawGraph();

        $data['title'] = $pageName;

        $example_data = null;
        $graphOnly[] = $data;
    }
}



$conn->close();
returndata(0, "Connection with MySQL database closed");
?>


<!DOCTYPE html>
<html lang="it">

<?php echo render('./template/site/head.php', array('title' => 'Tabella visite sito'), 1); ?>

<head>
    <style>
        .data {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
            align-items: flex-start;
            align-content: flex-start;
            width: 100%;
            overflow: auto;
        }

        .card {
            box-shadow: 2px 3px 7px 2px rgba(0, 0, 0, 0.4);
            margin: 15px;
            border-radius: 0.5em;
            background-color: #fdfdff;
            padding: 2em;
            overflow: auto;
        }

        .card>img {
            max-width: 100%;
        }

        table {
            max-width: 100%;
        }
    </style>
</head>

<body>
    <a href="/">
        <h1>Prospetto di calcolo</h1>
    </a>
    <h3>Visite sito</h3>

    <form action="" method="GET">
        <label for="fromYear">Anno di partenza visualizzazione:</label>
        <select name="fromYear" id="fromYear">
            <?php for ($year = $currentYear; $year >= 2020; $year--) : ?>
                <option value="<?php echo $year ?>"><?php echo $year ?></option>
            <?php endfor; ?>
        </select>
        <label for="byPageName">Seleziona una o più pagine del sito:</label>
        <select name="byPageName[]" id="byPageName" multiple>
            <?php foreach ($pageNames as $pageName) : ?>
                <option value="<?php echo $pageName ?>"><?php echo $pageName ?></option>
            <?php endforeach; ?>
        </select>
        <input name="submit" id="submit" type="submit" value="Genera">
    </form>

    <div class="data">
        <?php foreach ($table as $data) : ?>
            <div class="card">
                <h2><?php echo $data['title'] ?></h2>

                <table>
                    <thead>
                        <tr>
                            <?php foreach ($data['head'] as $index => $headValue) : ?>
                                <th><?php echo $headValue ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php foreach ($data['body'] as $bodyLine) : ?>
                                <?php foreach ($bodyLine as $index => $bodyValue) : ?>
                                    <td style="text-align: center"><?php echo $bodyValue ?></td>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </tr>
                    </tbody>
                </table>

            </div>
        <?php endforeach; ?>
    </div>

    <div class="data">
        <?php foreach ($graphOnly as $data) : ?>
            <div class="card graph">
                <h2><?php echo $data['title'] ?></h2>
                <img src="<?php echo $data['graph']->EncodeImage() ?>" alt=<?php echo $data['title'] ?> loading="lazy">
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>