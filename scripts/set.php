<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $startDatum = $_POST['StartDatum'];
    $endDatum = $_POST['EndDatum'];
    $uhrzeitVon = $_POST['UhrzeitVon'];
    $uhrzeitBis = $_POST['UhrzeitBis'];
    $kmStart = $_POST['KmStart'];
    $kmEnd = $_POST['KmEnd'];
    $kmDiff = $_POST['KmDiff'];
    $zweck = $_POST['Zweck'];
    $name = $_POST['Name'];

    // XML-Datei laden
    $xmlFile = '../Daten/Fahrtenbuch.xml'; // Pfad zur XML-Datei
    $xml = simplexml_load_file($xmlFile);



    if ($xml === false) {
        http_response_code(500);
        echo 'Fehler beim Laden der XML-Datei.';
        exit();
    }

    // Neue Fahrt hinzufügen
    $neueFahrt = $xml->addChild('Fahrt');
    $neueFahrt->addChild('Datum', htmlspecialchars($startDatum, ENT_XML1, 'UTF-8'));
    $neueFahrt->addChild('Datum', htmlspecialchars($endDatum, ENT_XML1, 'UTF-8'));
    $neueFahrt->addChild('UhrzeitVon', htmlspecialchars($uhrzeitVon, ENT_XML1, 'UTF-8'));
    $neueFahrt->addChild('UhrzeitBis', htmlspecialchars($uhrzeitBis, ENT_XML1, 'UTF-8'));
    $neueFahrt->addChild('KmStart', htmlspecialchars($kmStart, ENT_XML1, 'UTF-8'));
    $neueFahrt->addChild('KmEnd', htmlspecialchars($kmEnd, ENT_XML1, 'UTF-8'));
    $neueFahrt->addChild('KmDiff', htmlspecialchars($kmDiff, ENT_XML1, 'UTF-8'));
    $neueFahrt->addChild('Zweck', htmlspecialchars($zweck, ENT_XML1, 'UTF-8'));
    $neueFahrt->addChild('Name', htmlspecialchars($name, ENT_XML1, 'UTF-8'));

    // XML-Datei speichern
    if ($xml->asXML($xmlFile)) {
        echo 'Daten erfolgreich hinzugefügt.';
    } else {
        http_response_code(500);
        echo 'Fehler beim Speichern der XML-Datei.';
    }
} else {
    http_response_code(405);
    echo 'Ungültige Anfrage.';
}
?>
