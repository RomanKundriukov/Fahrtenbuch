<!--Prüfen, ob Directory "Data" und File "Fahrtenbuch" existieren-->
<?php
$dataPfad = "../Data";
$filePfad = "../Data/Fahrtenbuch.xml";
$baseXML = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<Fahrtenbuch>

</Fahrtenbuch>
XML;

if(!is_dir($dataPfad)){
    mkdir($dataPfad, 0777, true);
}

if(!is_file($filePfad)){
    file_put_contents($filePfad, $baseXML);
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width:device-width, initial-scale=1.0">
    <title>Fahrtenbuch</title>
    <link rel="stylesheet" href="../Style/Dashboard.css">

    <script src="../Script/JS/goToUpdate.js"></script>
    <script src="../Script/JS/goToNew.js"></script>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../Image/logo_fahrtenbuch.png" alt="fahrtenbuchlogo" height="70" width="70">
        </div>
        <div class="nav-menu">

            <nav class="nav-button">
                <a href="UberUns.php">Über Uns</a>
            </nav>

            <nav class="nav-button">
                <a href="Kontakten.php">Kontakten</a>
            </nav>
        </div>
    </header>
    <div class="page">
        <div class="fahrten-title">
            <h1>Alle Fahrten</h1>
        </div>

        <div class="fahrten-table">

            <div class="my-table">
                <table>
                    <tr>
                        <th>
                            <label for="StartDatum">Start Datum</label>
                        </th>
                        <th>
                            <label for="EndDatum">End Datum</label>
                        </th>
                        <th>
                            <label for="UhrzeitVon">Uhrzeit von</label>
                        </th>
                        <th>
                            <label for="UhrzeitBis">Uhrzeit bis</label>
                        </th>
                        <th>
                            <label for="KmStart">Km Start</label>
                        </th>
                        <th>
                            <label for="KmEnd">KmEnd</label>
                        </th>
                        <th>
                            <label for="KmDiff">Km Diff</label>
                        </th>
                        <th>
                            <label for="Zweck">Zweck/Ziel</label>
                        </th>
                        <th>
                            <label for="Name">Name</label>
                        </th>
                        <th>
                            <label for="Auto">Auto</label>
                        </th>
                        <th>
                            <label for="Status">Status</label>
                        </th>
                    </tr>
                    <?php
                    $filePfad = "../Data/Fahrtenbuch.xml";

                    if(is_file($filePfad)){
                        $fahrtenbuch = simplexml_load_file($filePfad);

                        if(!empty($fahrtenbuch->Fahrt) && count($fahrtenbuch->Fahrt) > 0){
                            foreach($fahrtenbuch->Fahrt as $fahrt){
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
                                echo "<td>" . htmlspecialchars($fahrt->Auto) . "</td>";
                                echo "<td>" . htmlspecialchars($fahrt->Status) . "</td>";
                                echo "</tr>";
                            }
                        }else{
                            echo "<tr>";
                            echo "<td colspan='11'>Die Daten enthält keine Einträge</td>";
                            echo "</tr>";
                        }
                    }

                    ?>
                </table>
            </div>

        </div>

        <div class="ani-gif">
            <nav>
                <img class="my-nav" id="updateFahrt" src="../Image/update_fahrten.gif" height="50" width="50" alt="Update Fahrt"/>
            </nav>
            <nav>
                <img class="my-nav" id="newFahrt" src="../Image/add_fahrten.gif" height="50" width="50" alt="Neue Fahrt"/>
            </nav>
        </div>
    </div>
    <footer>
        @ 2024 - Fahrtenbuch. Alle Rechte vorbehalten.
    </footer>
</body>
</html>
