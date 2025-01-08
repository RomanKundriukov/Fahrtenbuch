<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $xmlFile = realpath("../../Data/Fahrtenbuch.xml");

    if (is_file($xmlFile)) {
        $fahrtenbuch = simplexml_load_file($xmlFile);

    }else{
        die('Keine XML Datei wurde gefunden');
    }



    if (empty($fahrtenbuch->Fahrt) || count($fahrtenbuch->Fahrt) === 0) {
        die('Keine Fahrten in der XML-Datei gefunden.');
    }

    // Letztes Fahrt-Element
    $letzteFahrt = $fahrtenbuch->Fahrt[count($fahrtenbuch->Fahrt) - 1];

    // Eingaben validieren und aktualisieren
    $startDatum = htmlspecialchars($_POST['StartDatum'], ENT_XML1, 'UTF-8');
    $endDatum = htmlspecialchars($_POST['EndDatum'], ENT_XML1, 'UTF-8');
    $uhrzeitVon = htmlspecialchars($_POST['UhrzeitVon'], ENT_XML1, 'UTF-8');
    $uhrzeitBis = htmlspecialchars($_POST['UhrzeitBis'], ENT_XML1, 'UTF-8');
    $kmStart = filter_var($_POST['KmStart'], FILTER_VALIDATE_INT);
    $kmEnd = filter_var($_POST['KmEnd'], FILTER_VALIDATE_INT);
    $zweck = htmlspecialchars($_POST['Zweck'], ENT_XML1, 'UTF-8');
    $name = htmlspecialchars($_POST['Name'], ENT_XML1, 'UTF-8');
    $status = htmlspecialchars($_POST['Status'], ENT_XML1, 'UTF-8');

    if ($kmStart === false || $kmEnd === false || $startDatum === '' || $endDatum === '' || $zweck === '' || $name === '' || $status === '') {
        http_response_code(400);
        die('Fehlende oder ungültige Eingabedaten.');
    }

    $kmDiff = $kmEnd - $kmStart;

    $letzteFahrt->StartDatum = $startDatum;
    $letzteFahrt->EndDatum = $endDatum;
    $letzteFahrt->UhrzeitVon = $uhrzeitVon;
    $letzteFahrt->UhrzeitBis = $uhrzeitBis;
    $letzteFahrt->KmStart = $kmStart;
    $letzteFahrt->KmEnd = $kmEnd;
    $letzteFahrt->KmDiff = $kmDiff;
    $letzteFahrt->Zweck = $zweck;
    $letzteFahrt->Name = $name;
    $letzteFahrt->Status = $status;

    if ($fahrtenbuch->asXML($xmlFile)) {
        http_response_code(200);
        echo 'Daten erfolgreich aktualisiert.';
    } else {
        http_response_code(500);
        echo 'Fehler beim Speichern der XML-Datei.';
    }
} else {
    http_response_code(405);
    echo 'Ungültige Anfrage.';
}
?>