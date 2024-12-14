<?php
$pfad = '../Daten/Fahrtenbuch.xml';

if(!file_exists($pfad))
{
    $basisXml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<Fahrtenbuch>

</Fahrtenbuch>
XML;
    $ordnerPfad = dirname($pfad);
    if (!is_dir($ordnerPfad)) {
        mkdir($ordnerPfad, 0777, true); // Ordner rekursiv erstellen
        // Datei erstellen und Basisstruktur einfügen
        file_put_contents($pfad, $basisXml);
    }

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
                        $fahrtenbuch = new DOMDocument('1.0', 'utf-8');
                        $fahrtenbuch->load($pfad);

                        $entries = $fahrtenbuch->getElementsByTagName('Fahrt'); // Passe 'Fahrt' an deinen XML-Tag an, der einzelne Fahrten repräsentiert

                        if ($entries->length > 0) {
                            foreach ($entries as $entry) {
                                echo "<tr>";
                                echo "<td>" . $entry->getElementsByTagName('StartDatum')[0]->nodeValue . "</td>";
                                echo "<td>" . $entry->getElementsByTagName('EndDatum')[0]->nodeValue . "</td>";
                                echo "<td>" . $entry->getElementsByTagName('UhrzeitVon')[0]->nodeValue . "</td>";
                                echo "<td>" . $entry->getElementsByTagName('UhrzeitBis')[0]->nodeValue . "</td>";
                                echo "<td>" . $entry->getElementsByTagName('KmStart')[0]->nodeValue . "</td>";
                                echo "<td>" . $entry->getElementsByTagName('KmEnd')[0]->nodeValue . "</td>";
                                echo "<td>" . $entry->getElementsByTagName('KmDiff')[0]->nodeValue . "</td>";
                                echo "<td>" . $entry->getElementsByTagName('Zweck')[0]->nodeValue . "</td>";
                                echo "<td>" . $entry->getElementsByTagName('Name')[0]->nodeValue . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>Keine Daten verfügbar</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>Die Datei $pfad wurde nicht gefunden.</td></tr>";
                    }
                    ?>
                </tr>
            </table>
        </div>

        <div class="new-add me-boxshadow me-margin">
            <h3>New</h3>
            <form id="fahrtenbuchForm">
                <table>
                    <tr>
                        <th> </th>
                        <th> Daten </th>
                    </tr>
                    <tr>
                        <td>
                            <label for="Datum">Start Datum</label>
                        </td>
                        <td>
                            <input type="date" name="StartDatum" id="StartDatum" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Datum">End Datum</label>
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
                            <label for="KmDiff">Km Diff</label>
                        </td>
                        <td>
                            <input type="text" name="KmDiff" id="KmDiff">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Zweck">Zweck</label>
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
                            <input type="submit" name="submit" id="submitBtn">
                        </td>
                    </tr>
                </table>


            </form>
        </div>

        <div class="letz-bearb me-boxshadow me-margin">
            <h3>Bearbeiten</h3>
        </div>
    </div>

<script src="../scripts/FahrtenbuchIsExist.js"></script>
</body>

</html>
