<?php
$ordnerPfad = '../Daten';
$filePfad = '../Daten/Fahrtenbuch.xml';

$basisXml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<Fahrtenbuch>

</Fahrtenbuch>
XML;

if (!is_dir($ordnerPfad)) {
    mkdir($ordnerPfad, 0777, true);
    //echo "Ordner '$ordnerPfad' wurde erstellt.<br>";
} else {
    //echo "Ordner '$ordnerPfad' existiert bereits.<br>";
}

if (!is_file($filePfad)) {
    file_put_contents($filePfad, $basisXml);
    //echo "Datei '$filePfad' wurde erstellt.<br>";
} else {
    //echo "Datei '$filePfad' existiert bereits.<br>";
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Простой логин</title>
    <link rel="stylesheet" href="/styles/dashboard.css">
</head>
<body>
    <h1>Fahrtenbuch</h1>
    <div class="page">
        <div class="fahrtenbuch-all me-boxshadow me-margin">
            <h3>Alle Fahrten</h3>
            <table id="fahrtenbuchTable">
                <tr>
                    <th>Start Datum</th>
                    <th>End Datum</th>
                    <th>Uhrzeit von</th>
                    <th>Uhrzeit bis</th>
                    <th>Km Start</th>
                    <th>Km End</th>
                    <th>Km Diff</th>
                    <th>Zweck/Ziel</th>
                    <th>Name</th>
                </tr>
                <tr>
                    <?php
                    $pfad = '../Daten/Fahrtenbuch.xml';

                    if (file_exists($pfad)) {
                        $fahrtenbuch = simplexml_load_file($pfad);

                        if(!empty($fahrtenbuch->Fahrt) && count($fahrtenbuch->Fahrt) > 0) {

                            $anzahlFahrten = count($fahrtenbuch->Fahrt);

                            foreach($fahrtenbuch->Fahrt as $fahrt) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($fahrt->StartDatum) . "</td>";
                                echo "<td>" . htmlspecialchars($fahrt->EndDatum) . "</td>";
                                echo "<td>" . htmlspecialchars($fahrt->UhrzeitVon) . "</td>";
                                echo "<td>" . htmlspecialchars($fahrt->UhrzeitBis) . "</td>";
                                echo "<td>" . htmlspecialchars($fahrt->KmStart) . "</td>";
                                echo "<td>" . htmlspecialchars($fahrt->KmEnd) . "</td>";
                                echo "<td>" . htmlspecialchars($fahrt->KmDiff) . "</td>";
                                echo "<td>" . htmlspecialchars($fahrt->Zweck) . "</td>";
                                echo "<td>" . htmlspecialchars($fahrt->Name) . "</td>";
                                echo "<tr>";
                            }
                        }else{
                            echo "<tr><td colspan='9'>Die Daten enthält keine Einträge</td></tr>";
                        }
                    }
                    ?>
                </tr>
            </table>
        </div>

        <div class="new-add me-boxshadow me-margin">
            <h3>New</h3>
            <form method="post" id="fahrtenbuchForm">
                <table>
                    <tr>
                        <th> </th>
                        <th> Daten </th>
                    </tr>
                    <tr>
                        <td>
                            <label for="StartDatum">Start Datum</label>
                        </td>
                        <td>
                            <input type="date" name="StartDatum" id="StartDatum" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="EndDatum">End Datum</label>
                        </td>
                        <td>
                            <input type="date" name="EndDatum" id="EndDatum" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="UhrzeitVon">Uhrzeit von</label>
                        </td>
                        <td>
                            <input type="time" name="UhrzeitVon" id="UhrzeitVon" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="UhrzeitBis">Uhrzeit bis</label>
                        </td>
                        <td>
                            <input type="time" name="UhrzeitBis" id="UhrzeitBis">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="KmStart">Km Start</label>
                        </td>
                        <td>
                            <input type="text" name="KmStart" id="KmStart" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="KmEnd">Km End</label>
                        </td>
                        <td>
                            <input type="text" name="KmEnd" id="KmEnd">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Zweck">Zweck/Ziel</label>
                        </td>
                        <td>
                            <input type="text" name="Zweck" id="Zweck" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Name">Name</label>
                        </td>
                        <td>
                            <input type="text" name="Name" id="Name" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <input type="submit" name="submitBtn" id="submitBtn">
                        </td>
                    </tr>
                </table>


            </form>
        </div>

        <div class="letz-bearb me-boxshadow me-margin">
            <h3>Bearbeiten</h3>
            <form id="fahrtenbuchFormUpdate" method="post">
                <table>
                    <tr>
                        <th><label for="StartDatumUpdate">Start Datum</label></th>
                        <th><label for="EndDatumUpdate">End Datum</label></th>
                        <th><label for="UhrzeitVonUpdate">Uhrzeit von</label></th>
                        <th><label for="UhrzeitBisUpdate">Uhrzeit bis</label></th>
                        <th><label for="KmStartUpdate">Km Start</label></th>
                        <th><label for="KmEndUpdate">Km End</label></th>
                        <th><label for="KmDiffUpdate">Km Diff</label></th>
                        <th><label for="ZweckUpdate">Zweck/Ziel</label></th>
                        <th><label for="NameUpdate">Name</label></th>
                    </tr>
                    <?php
                    $pfad = '../Daten/Fahrtenbuch.xml';

                    if (file_exists($pfad)) {
                        $fahrtenbuch = simplexml_load_file($pfad);

                        if (!empty($fahrtenbuch->Fahrt) && count($fahrtenbuch->Fahrt) > 0) {
                            $letzteFahrt = $fahrtenbuch->Fahrt[count($fahrtenbuch->Fahrt) - 1];

                            echo "<tr>";
                            echo "<td><input type='date' name='StartDatumUpdate' id='StartDatumUpdate' value='" . htmlspecialchars($letzteFahrt->StartDatum) . "' required></td>";
                            echo "<td><input type='date' name='EndDatumUpdate' id='EndDatumUpdate' value='" . htmlspecialchars($letzteFahrt->EndDatum) . "' required></td>";
                            echo "<td><input type='time' name='UhrzeitVonUpdate' id='UhrzeitVonUpdate' value='" . htmlspecialchars($letzteFahrt->UhrzeitVon) . "' required></td>";
                            echo "<td><input type='time' name='UhrzeitBisUpdate' id='UhrzeitBisUpdate' value='" . htmlspecialchars($letzteFahrt->UhrzeitBis) . "'></td>";
                            echo "<td><input type='number' name='KmStartUpdate' id='KmStartUpdate' value='" . htmlspecialchars($letzteFahrt->KmStart) . "' required></td>";
                            echo "<td><input type='number' name='KmEndUpdate' id='KmEndUpdate' value='" . htmlspecialchars($letzteFahrt->KmEnd) . "' required></td>";
                            echo "<td><span id='KmDiffUpdate'>" . htmlspecialchars($letzteFahrt->KmDiff) . "</span></td>";
                            echo "<td><input type='text' name='ZweckUpdate' id='ZweckUpdate' value='" . htmlspecialchars($letzteFahrt->Zweck) . "' required></td>";
                            echo "<td><input type='text' name='NameUpdate' id='NameUpdate' value='" . htmlspecialchars($letzteFahrt->Name) . "' required></td>";
                            echo "</tr>";
                            echo "<tr><td colspan='9' style='text-align: center;'><input type='submit' id='updBtn' name='updBtn'></td></tr>";
                        } else {
                            echo "<tr><td colspan='9'>Die Daten enthalten keine Einträge</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>Die Datei wurde nicht gefunden.</td></tr>";
                    }
                    ?>
                </table>
            </form>


        </div>
    </div>

<script src="../scripts/FahrtenbuchIsExist.js"></script>
<script src="../scripts/UpdateDaten.js"></script>
</body>

</html>
