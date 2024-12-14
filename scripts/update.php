<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $xmlFile = '../Daten/Fahrtenbuch.xml';

    if (!file_exists($xmlFile)) {
        http_response_code(404);
        die('Die XML-Datei wurde nicht gefunden.');
    }

    $fahrtenbuch = simplexml_load_file($xmlFile);

    if (empty($fahrtenbuch->Fahrt) || count($fahrtenbuch->Fahrt) === 0) {
        http_response_code(404);
        die('Keine Fahrten in der XML-Datei gefunden.');
    }

    // Letztes Fahrt-Element
    $letzteFahrt = $fahrtenbuch->Fahrt[count($fahrtenbuch->Fahrt) - 1];

    // Eingaben validieren und aktualisieren
    $startDatum = htmlspecialchars($_POST['StartDatumUpdate'] , ENT_XML1, 'UTF-8');
    $endDatum = htmlspecialchars($_POST['EndDatumUpdate'] , ENT_XML1, 'UTF-8');
    $uhrzeitVon = htmlspecialchars($_POST['UhrzeitVonUpdate'], ENT_XML1, 'UTF-8');
    $uhrzeitBis = htmlspecialchars($_POST['UhrzeitBisUpdate'], ENT_XML1, 'UTF-8');
    $kmStart = filter_var($_POST['KmStartUpdate'], FILTER_VALIDATE_INT);
    $kmEnd = filter_var($_POST['KmEndUpdate'], FILTER_VALIDATE_INT);
    $zweck = htmlspecialchars($_POST['ZweckUpdate'] , ENT_XML1, 'UTF-8');
    $name = htmlspecialchars($_POST['NameUpdate'] , ENT_XML1, 'UTF-8');
    $kmDiff = $kmEnd - $kmStart;

    if (!$startDatum || !$endDatum || !$kmStart || !$kmEnd || !$zweck || !$name) {
        http_response_code(400);
        die('Fehlende oder ungültige Eingabedaten.');
    }

    $letzteFahrt->StartDatum = $startDatum;
    $letzteFahrt->EndDatum = $endDatum;
    $letzteFahrt->UhrzeitVon = $uhrzeitVon;
    $letzteFahrt->UhrzeitBis = $uhrzeitBis;
    $letzteFahrt->KmStart = $kmStart;
    $letzteFahrt->KmEnd = $kmEnd;
    $letzteFahrt->KmDiff = $kmDiff;
    $letzteFahrt->Zweck = $zweck;
    $letzteFahrt->Name = $name;

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
