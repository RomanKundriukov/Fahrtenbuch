<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $startDatum = $_POST['StartDatum'];
    $endDatum = $_POST['EndDatum'];
    $uhrzeitVon = $_POST['UhrzeitVon'];
    $uhrzeitBis = $_POST['UhrzeitBis'];
    $kmStart = $_POST['KmStart'];
    $kmEnd = $_POST['KmEnd'];
    $zweck = $_POST['Zweck'];
    $name = $_POST['Name'];

    $kmDiff = $kmEnd - $kmStart;

    // Wenn alles gültig ist, weiter mit Speichern
    $xmlFile = '../Daten/Fahrtenbuch.xml';
    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;

    if (file_exists($xmlFile)) {
        $dom->load($xmlFile);
    } else {
        $root = $dom->createElement('Fahrtenbuch');
        $dom->appendChild($root);
    }

    $root = $dom->documentElement;
    $fahrt = $dom->createElement('Fahrt');

    $fahrt->appendChild($dom->createElement('StartDatum', htmlspecialchars($startDatum, ENT_XML1, 'UTF-8')));
    $fahrt->appendChild($dom->createElement('EndDatum', htmlspecialchars($endDatum, ENT_XML1, 'UTF-8')));
    $fahrt->appendChild($dom->createElement('UhrzeitVon', htmlspecialchars($uhrzeitVon, ENT_XML1, 'UTF-8')));
    $fahrt->appendChild($dom->createElement('UhrzeitBis', htmlspecialchars($uhrzeitBis, ENT_XML1, 'UTF-8')));
    $fahrt->appendChild($dom->createElement('KmStart', htmlspecialchars($kmStart, ENT_XML1, 'UTF-8')));
    $fahrt->appendChild($dom->createElement('KmEnd', htmlspecialchars($kmEnd, ENT_XML1, 'UTF-8')));
    $fahrt->appendChild($dom->createElement('KmDiff', htmlspecialchars($kmDiff, ENT_XML1, 'UTF-8')));
    $fahrt->appendChild($dom->createElement('Zweck', htmlspecialchars($zweck, ENT_XML1, 'UTF-8')));
    $fahrt->appendChild($dom->createElement('Name', htmlspecialchars($name, ENT_XML1, 'UTF-8')));

    $root->appendChild($fahrt);

    if ($dom->save($xmlFile)) {
        http_response_code(200);
        //echo "Daten erfolgreich hinzugefügt.";
    } else {
        http_response_code(500);
        echo "Fehler beim Speichern der XML-Datei.";
    }
} else {
    http_response_code(405);
    echo "Ungültige Anfrage.";
}
?>
